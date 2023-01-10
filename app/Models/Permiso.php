<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    public $table = 'permisos_new';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'empleado',
        'modulo',
        'administrador',
        'fecha'
    ];

    public function empleado()
    {
        return $this->belongsTo(User::class);
    }
}
