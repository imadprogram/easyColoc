<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Colocation;

class Settlement extends Model
{
    /** @use HasFactory<\Database\Factories\SettlementFactory> */
    use HasFactory;


    protected $fillable = ['colocation_id' , 'debtor_id' , 'creditor_id' , 'amount' , 'is_paid'];




    public function debtor(){
        return $this->belongsTo(User::class , 'debtor_id');
    }

    public function creditor(){
        return $this->belongsTo(User::class , 'creditor_id');
    }
    
    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }
}
