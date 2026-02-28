<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettlementRequest;
use App\Http\Requests\UpdateSettlementRequest;
use App\Models\Settlement;
use App\Models\Expense;
use App\Models\Colocation;
use App\Models\User;

class SettlementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create(){

    }

    /**
     * Show the form for creating a new resource.
     */
    public function calculate()
    {
        $colocation = auth()->user()->colocation;
        $usersList = $colocation->users;
        $usersCount = $usersList->count();

        if ($usersCount === 0) {
            return redirect()->back();
        }
        
        $balances = [];
        
        // Loop through users and calculate their exact standing balance
        foreach ($usersList as $user) {
            
            // 1. Calculate how much this specific user should have paid (Fair Share)
            // If somehow joined_at is null, we use created_at as a fallback to avoid errors.
            $joinDate = $user->joined_at ?? $user->created_at;

            $relevantExpenses = Expense::where('colocation_id', $colocation->id)
                                       ->where('created_at', '>=', $joinDate)
                                       ->get();

            $userFairShare = 0;
            foreach ($relevantExpenses as $expense) {
                // How many people were in the colocation at the time of THIS expense?
                // We exclude users who joined total-null but use created_at as a fallback check
                $peoplePresentCount = User::where('colocation_id', $colocation->id)
                                          ->where(function($q) use ($expense) {
                                              $q->where('joined_at', '<=', $expense->created_at)
                                                ->orWhereNull('joined_at');
                                          })
                                          ->count();
                
                if ($peoplePresentCount > 0) {
                    $userFairShare += $expense->amount / $peoplePresentCount;
                }
            }

            // 2. How much did this user actually pay?
            $userPaid = $user->expenses()
                             ->where('colocation_id', $colocation->id)
                             ->where('created_at', '>=', $joinDate)
                             ->sum('amount');

            // Factor in money they've ALREADY paid back via old Settlements
            $settlementsPaid = Settlement::where('colocation_id', $colocation->id)
                ->where('debtor_id', $user->id)
                ->where('is_paid', true)
                ->sum('amount');

            // Factor in money they've ALREADY received back via old Settlements
            $settlementsReceived = Settlement::where('colocation_id', $colocation->id)
                ->where('creditor_id', $user->id)
                ->where('is_paid', true)
                ->sum('amount');

            $effectiveTotal = $userPaid + $settlementsPaid - $settlementsReceived;
            
            // standing = actually_paid - should_have_paid
            $balances[$user->id] = round($effectiveTotal - $userFairShare, 2);
        }

        //Separate into Creditors (owed money) and Debtors (owe money)
        $creditors = [];
        $debtors = [];
        
        foreach ($balances as $userId => $balance) {
            if ($balance > 0.01) {
                $creditors[$userId] = $balance;
            } elseif ($balance < -0.01) {
                $debtors[$userId] = abs($balance);
            }
        }

        //Wipe out any old UNPAID settlements, as we are recalculating them based on new expenses!
        Settlement::where('colocation_id', $colocation->id)->where('is_paid', false)->delete();

        // Match Debtors with Creditors to generate new Settlements
        foreach ($debtors as $debtorId => &$debt) {
            foreach ($creditors as $creditorId => &$credit) {
                if ($debt <= 0.01) break; // Debtor is fully paid off in the algorithm
                if ($credit <= 0.01) continue; // Creditor is fully paid back in the algorithm
                
                $amountToSettle = min($debt, $credit);
                
                // Create the newly calculated Settlement!
                Settlement::create([
                    'colocation_id' => $colocation->id,
                    'debtor_id' => $debtorId,
                    'creditor_id' => $creditorId,
                    'amount' => $amountToSettle,
                    'is_paid' => false
                ]);
                
                $debt -= $amountToSettle;
                $credit -= $amountToSettle;
            }
        }

        return redirect()->back()->with('success', 'Règlements recalculés avec succès !');
    }

    /**
     * Mark a settlement as paid.
     */
    public function markAsPaid(Settlement $settlement)
    {
        // Security check: Only the debtor can mark it as paid (or a global admin)
        if (auth()->id() !== $settlement->debtor_id && !auth()->user()->is_global_admin) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à valider ce règlement.');
        }

        $settlement->update([
            'is_paid' => true,
            'paid_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Règlement marqué comme payé !');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettlementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Settlement $settlement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Settlement $settlement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettlementRequest $request, Settlement $settlement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Settlement $settlement)
    {
        //
    }
}
