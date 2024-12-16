<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavLink extends Model
{
    protected $fillable = ['name', 'route', 'params', 'module'];

    protected $casts = [
        'params' => 'array',
    ];
}
