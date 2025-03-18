<?php

namespace App\Models;

use App\Http\Controllers\InversoresController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    use HasFactory;

    protected $table = 'fabricantes';

    protected $fillable = ['nombre'];

    public function inversores()
    {
        return $this->hasMany(Inversores::class, 'fabricante');
    }
}
