<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboPlan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'combo_plan_plan');
    }
}

