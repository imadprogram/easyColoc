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
            'invite_token' => Str::random(20),
        ]);

        $user = auth()->user();
        $user->colocation_id = $colocation->id;
        $user->save();


        return redirect()->route('dashboard')->with('success' , 'Colocation created succussfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $colocation = auth()->user()->colocation;

        if (!$colocation) {
            return redirect()->route('dashboard');
        }

        $categories = Category::where('colocation_id' , $colocation->id)->get();
        $expenses = Expense::where('colocation_id' , $colocation->id)->get();

        $members = User::where('colocation_id' , $colocation->id)->get();

        return view('colocation', compact('colocation','categories', 'expenses', 'members'));
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
