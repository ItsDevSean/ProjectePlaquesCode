<?php

namespace App\Models;

use App\Http\Controllers\InversoresController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    use HasFactory;

    protected $table = 'fabricantes';

    protected $fillable = [
        'nombre',
        'user_id', 
    ];

    public function inversores()
    {
        return $this->hasMany(Inversores::class, 'fabricante_id');
    }

    public function baterias()
    {
        return $this->hasMany(Baterias::class, 'fabricante_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}