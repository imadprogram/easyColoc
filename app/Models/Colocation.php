<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expense;
use App\Models\Category;
use App\Models\User;

class Colocation extends Model
{
    /** @use HasFactory<\Database\Factories\ColocationFactory> */
    use HasFactory;

    protected $fillable = ['name', 'owner_id', 'invite_token', 'status'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function expenses(){
        return $this->hasMany(Expense::class);
    }
    public function categories(){
        return $this->hasMany(Category::class);
    }
    public function owner(){
        return $this->belongsTo(User::class , 'owner_id');
    }
}
