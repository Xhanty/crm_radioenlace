<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'order',
    ];

    public $timestamps = false;

    public function tasks()
    {
        return $this->hasMany(TaskProject::class)->orderBy('order');
    }
}
