<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Colocation;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = ['name' ,'colocation_id'];


    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }
}
