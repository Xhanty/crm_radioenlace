<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'empleados';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo_empleado',
        'nombre',
        'cargo',
        'rol',
        'email',
        'telefono_fijo',
        'telefono_celular',
        'direccion',
        'fecha_ingreso',
        'fecha_retiro',
        'avatar',
        'fecha_nacimiento',
        'eps',
        'caja_compensacion',
        'arl',
        'fondo_pension',
        'periodo_vacaciones',
        'observaciones',
        'prestamo',
        'periodo_dotacion',
        'numero_licencia_conduccion',
        'vencimiento_licencia_conduccion',
        'multas_transito_pendiente',
        'implementos_seguridad',
        'riesgos_profesionales',
        'culminacion_contrato',
        'status',
        'licencia_conduccion_moto',
        'vencimiento_licencia_moto',
        'puntos',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function tasks()
    {
        return $this->hasMany(TaskProject::class);
    }

    public function statuses()
    {
        return $this->hasMany(Status::class)->orderBy('order');
    }

    protected static function booted()
    {
        static::created(function ($user) {
            // Create default statuses
            $user->statuses()->createMany([
                [
                    'title' => 'Asignado',
                    'slug' => 'assigned',
                    'order' => 1
                ],
                [
                    'title' => 'En Proceso',
                    'slug' => 'in-progress',
                    'order' => 2
                ],
                [
                    'title' => 'En Revisión',
                    'slug' => 'in-review',
                    'order' => 3
                ],
                [
                    'title' => 'Culminado',
                    'slug' => 'completed',
                    'order' => 4
                ]
            ]);
        });
    }
}
