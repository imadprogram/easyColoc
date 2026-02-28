<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Colocation;
use App\Models\Expense;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // --- COMMON DATA (for everyone) ---
        // Reputation is already on the user model

        // --- ADMIN DATA ---
        if ($user->is_global_admin) {
            $totalUsers = User::count();
            $totalColocations = Colocation::count();
            $globalVolume = Expense::sum('amount');
            $bannedCount = User::whereNotNull('banned_at')->count();
            $allUsers = User::orderBy('created_at', 'desc')->get();

            return view('dashboard', compact(
                'totalUsers', 
                'totalColocations', 
                'globalVolume', 
                'bannedCount',
                'allUsers'
            ));
        }

        // --- REGULAR USER DATA ---
        // Fetch neighbors (people in the same colocation)
        $neighbors = $user->colocation ? $user->colocation->users : collect([]);
        
        // Fetch last 5 expenses in their colocation
        $recentExpenses = $user->colocation 
            ? Expense::where('colocation_id', $user->colocation_id)->latest()->take(5)->get() 
            : collect([]);

        // Calculate their total personal expenses for the current month
        $monthlyExpenses = $user->expenses()
            ->whereMonth('created_at', now()->month)
            ->sum('amount');

        return view('dashboard', compact('monthlyExpenses', 'neighbors', 'recentExpenses'));
    }

    public function ban(User $user)
    {
        // Safety check: Don't ban yourself
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas vous bannir vous-même !');
        }

        // Toggle the ban: If banned, unban. If not, ban.
        if ($user->banned_at) {
            $user->update(['banned_at' => null]);
            $message = "L'utilisateur a été débanni.";
        } else {
            $user->update(['banned_at' => now()]);
            $message = "L'utilisateur a été banni.";
        }

        return redirect()->back()->with('success', $message);
    }
}
