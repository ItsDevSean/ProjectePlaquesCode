<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = ['nombre', 'user_id', 'estado_id'];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dadesClient()
{
    return $this->hasOne(DadesClient::class, 'proyecto_id');
}
}