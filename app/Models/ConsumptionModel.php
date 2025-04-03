<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumptionModel extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 'year', 'month', 'electric_consumption', 'bill', 
    ];
}
