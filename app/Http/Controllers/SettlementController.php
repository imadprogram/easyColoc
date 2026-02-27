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

        // 1. Calculate how much each user should have paid (Average)
        $totalExpenses = Expense::where('colocation_id', $colocation->id)->sum('amount');
        $average = $totalExpenses / $usersCount;

        $balances = [];

        // 2. Loop through users and calculate their exact standing balance
        foreach ($usersList as $user) {
            $userPaid = $user->expenses()->where('colocation_id', $colocation->id)->sum('amount');

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
            
            // Positive = someone owes them. Negative = they owe someone.
            $balances[$user->id] = round($effectiveTotal - $average, 2);
        }

        // 3. Separate into Creditors (owed money) and Debtors (owe money)
        $creditors = [];
        $debtors = [];
        
        foreach ($balances as $userId => $balance) {
            if ($balance > 0.01) {
                $creditors[$userId] = $balance;
            } elseif ($balance < -0.01) {
                $debtors[$userId] = abs($balance);
            }
        }

        // 4. Wipe out any old UNPAID settlements, as we are recalculating them based on new expenses!
        Settlement::where('colocation_id', $colocation->id)->where('is_paid', false)->delete();

        // 5. Match Debtors with Creditors to generate new Settlements
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
