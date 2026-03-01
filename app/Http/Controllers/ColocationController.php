<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColocationRequest;
use App\Http\Requests\UpdateColocationRequest;
use App\Models\Colocation;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Expense;
use App\Models\User;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColocationRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);
        
        $colocation = Colocation::create([
            'name' => $request->name,
            'owner_id' => auth()->user()->id,
            'invite_token' => Str::random(10)
        ]);

        $user = auth()->user();
        $user->colocation_id = $colocation->id;
        $user->joined_at = now();
        $user->save();


        return redirect()->route('colocation')->with('success' , 'Colocation created succussfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(\Illuminate\Http\Request $request)
    {
        $user = auth()->user();
        $colocation = $user->colocation;

        if (!$colocation || $colocation->status !== 'active') {
            return view('no_colocation');
        }

        // --- POINT 9: FILTERING BY MONTH ---
        $month = $request->get('month'); // Expecting '2026-02' format
        $query = $colocation->expenses()->with(['user', 'category']);

        if ($month) {
            $query->whereMonth('created_at', date('m', strtotime($month)))
                  ->whereYear('created_at', date('Y', strtotime($month)));
        }

        $expenses = $query->latest()->get();

        // --- POINT 10: CATEGORY STATS ---
        $categoryStats = $expenses->groupBy('category_id')->map(function ($group) {
            return [
                'name' => $group->first()->category->name,
                'total' => $group->sum('amount')
            ];
        });

        // Get available months from expenses for the dropdown (database-agnostic approach)
        $availableMonths = $colocation->expenses()
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($e) => $e->created_at->format('Y-m'))
            ->unique()
            ->values();

        $settlements = \App\Models\Settlement::where('colocation_id', $colocation->id)
                                             ->where('is_paid', false)
                                             ->with(['debtor', 'creditor'])
                                             ->get();

        return view('colocation', compact('colocation', 'settlements', 'expenses', 'categoryStats', 'availableMonths', 'month'));
    }

    
    public function showInvite($token)
    {
        $colocation = Colocation::where('invite_token', $token)->where('status', 'active')->first();

        if (!$colocation) {
            return redirect()->route('dashboard')->with('error', 'Lien d\'invitation invalide ou colocation annulée.');
        }

        if (!auth()->check()) {
            session(['url.intended' => url()->current()]);
            return redirect()->route('register')->with('info', 'Créez un compte pour rejoindre la coloc.');
        }

        $user = auth()->user();
        
        if ($user->colocation_id === $colocation->id) {
            return redirect()->route('colocation')->with('info', 'Vous êtes déjà dans cette colocation.');
        }

        if ($user->colocation_id) {
            return redirect()->route('dashboard')->with('error', 'Vous êtes déjà dans une autre colocation !');
        }

        return view('invite', compact('colocation'));
    }

    public function accept($token)
    {
        $colocation = Colocation::where('invite_token', $token)->where('status', 'active')->first();

        if (!$colocation) {
            return redirect()->route('dashboard')->with('error', 'Lien d\'invitation invalide ou colocation annulée.');
        }

        $user = auth()->user();
        
        if ($user->colocation_id) {
            return redirect()->route('dashboard')->with('error', 'Vous êtes déjà dans une colocation !');
        }

        $user->colocation_id = $colocation->id;
        $user->joined_at = now();
        $user->left_at = null; // Clean up old status
        $user->save();

        return redirect()->route('colocation')->with('success', 'Bienvenue dans la colocation !');
    }

    /**
     * Decline an invitation.
     */
    public function decline()
    {
        // Just send them back to the dashboard with a message
        return redirect()->route('dashboard')->with('info', 'Invitation refusée.');
    }

    /**
     * Leave the current colocation (for members only).
     */
    public function leave()
    {
        $user = auth()->user();
        $colocation = $user->colocation;

        if (!$colocation || $colocation->owner_id === $user->id) {
            return redirect()->back()->with('error', 'L\'owner ne peut pas quitter la colocation sans l\'annuler.');
        }

        // --- POINT 7: REPUTATION LOGIC ---
        // We check if they still have unpaid debts (unpaid settlements)
        $hasDebt = \App\Models\Settlement::where('debtor_id', $user->id)
                                         ->where('is_paid', false)
                                         ->exists();

        if ($hasDebt) {
            $user->decrement('reputation'); // -1 penalty
        } else {
            $user->increment('reputation'); // +1 reward
        }

        // Leave the colocation
        $user->colocation_id = null;
        $user->left_at = now();
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Vous avez quitté la colocation.');
    }

    /**
     * Kick a member (Owner only).
     */
    public function kick(User $member)
    {
        $owner = auth()->user();
        $colocation = $owner->colocation;

        if ($colocation->owner_id !== $owner->id || $member->colocation_id !== $colocation->id) {
            return redirect()->back()->with('error', 'Action non autorisée.');
        }

        if ($member->id === $owner->id) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas vous retirer vous-même.');
        }

        // --- POINT 8: DEBT TRANSFER TO OWNER ---
        // If the member has unpaid debts, the owner "takes them"
        $debts = \App\Models\Settlement::where('debtor_id', $member->id)
                                        ->where('is_paid', false)
                                        ->get();

        foreach ($debts as $debt) {
            $debt->update(['debtor_id' => $owner->id]);
        }

        // Remove the member
        $member->colocation_id = null;
        $member->left_at = now();
        $member->save();

        return redirect()->back()->with('success', $member->name . ' a été retiré de la colocation.');
    }

    /**
     * Cancel the colocation (Owner only).
     */
    public function cancel()
    {
        $owner = auth()->user();
        $colocation = $owner->colocation;

        if ($colocation->owner_id !== $owner->id) {
            return redirect()->back()->with('error', 'Seul l\'owner peut annuler la colocation.');
        }

        // Mark colocation as cancelled
        $colocation->update(['status' => 'cancelled']);

        // --- POINT 7: GLOBAL REPUTATION UPDATE ---
        foreach ($colocation->users as $member) {
            $hasDebt = \App\Models\Settlement::where('debtor_id', $member->id)
                                             ->where('is_paid', false)
                                             ->exists();
            if ($hasDebt) {
                $member->decrement('reputation');
            } else {
                $member->increment('reputation');
            }

            // Remove everyone from the coloc
            $member->update([
                'colocation_id' => null,
                'left_at' => now()
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'La colocation a été annulée.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colocation $colocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColocationRequest $request, Colocation $colocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colocation $colocation)
    {
        //
    }
}
