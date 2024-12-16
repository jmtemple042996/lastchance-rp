<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'abbreviation',
        'parent_id',
        'primary_identifier',
        'secondary_identifier',
        'department_profile_id',
        'is_recruiting',
        'max_full_time',
        'max_part_time',
    ];

    protected $with = ['parent', 'profile'];
    
    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    public function profile()
    {
        return $this->belongsTo(DepartmentProfile::class, 'department_profile_id');
    }
}
