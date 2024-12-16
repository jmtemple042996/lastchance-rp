<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentProfile extends Model
{
    protected $fillable = ['name', 'all_permissions'];

    protected $appends = ['permission_ids'];

    protected $with = ['permissions'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function getPermissionIdsAttribute()
    {
        return $this->permissions()->pluck('id');
    }
}
