<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Colocation;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;

    protected $fillable = ['colocation_id' , 'user_id' , 'category_id' , 'amount'];

    public function colocation() {
        return $this->belongsTo(Colocation::class);
    }
}
