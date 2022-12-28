<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'description',
        'order',
        'project_id',
        'user_id',
        'status_id',
        'init_date',
        'end_date',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
