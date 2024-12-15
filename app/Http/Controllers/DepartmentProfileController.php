<?php

namespace App\Http\Controllers;

use App\Models\DepartmentProfile;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Permission;

class DepartmentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department_profiles = cache()->tags('department_profiles')->remember('list', 10080, function() {
            return DepartmentProfile::paginate(10);
        });

        return Inertia::render('DepartmentProfiles/Index', [
            'department_profiles' => $department_profiles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = cache()->tags('permissions')->remember('all', 10080, function() {
            return Permission::all();
        });

        return Inertia::render('DepartmentProfiles/Create',[
            'permissions' => $permissions->groupBy('scope'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $currentDepartment)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'all_permissions' => 'required|int',
        ]);

        $department_profile = DepartmentProfile::create($attributes);

                
        $perms = $request->permissions;
         
        if($request->all_permissions == 1) {
            $perms = Permission::all()->pluck('id');
        }


        $department_profile->permissions()->sync($perms);

        cache()->tags('department_profiles')->flush();


        return redirect(route('department_profiles.index', ['currentDept' => $currentDepartment]))
            ->with('flash.banner', 'Department Profile created.');
    }

    /**
     * Display the specified resource.
     */
    public function show($currentDept, $departmentProfile)
    {
        $departmentProfile = cache()->tags('department_profiles')->remember($departmentProfile, 10080, function() use ($departmentProfile) {
            return DepartmentProfile::find($departmentProfile);
        });
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($currentDept, $departmentProfile)
    {
        $departmentProfile = cache()->tags('department_profiles')->remember($departmentProfile, 10080, function() use ($departmentProfile) {
            return DepartmentProfile::find($departmentProfile);
        });

        $permissions = cache()->tags('permissions')->remember('all', 10080, function() {
            return Permission::all();
        });

        return Inertia::render('DepartmentProfiles/Edit', [
            'departmentProfile' => $departmentProfile,
            'permissions' => $permissions->groupBy('scope'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $currentDept, $departmentProfile)
    {
        $departmentProfile = cache()->tags('department_profiles')->remember($departmentProfile, 10080, function() use ($departmentProfile) {
            return DepartmentProfile::find($departmentProfile);
        });

        $attributes = $request->validate([
            'name' => 'required',
            'all_permimssions' => 'required|int',
        ]);

        $departmentProfile->update($attributes);

                
        $perms = $request->permissions;
         
        if($request->all_permissions == 1) {
            $perms = Permission::all()->pluck('id');
        }

        $department_profile->permissions()->sync($perms);


        cache()->tags('department_profiles')->flush();


        return redirect(route('department_profiles.index', ['currentDept' => $currentDepartment]))
            ->with('flash.banner', 'Department Profile edited.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($currentDepartment, $departmentProfile)
    {
        $departmentProfile = cache()->tags('department_profiles')->remember($departmentProfile, 10080, function() use ($departmentProfile) {
            return DepartmentProfile::find($departmentProfile);
        });

        $departmentProfile->delete();

        cache()->tags('department_profiles')->flush();


        return redirect(route('department_profiles.index', ['currentDept' => $currentDepartment]))
            ->with('flash.banner', 'Department Profile deleted.');
    }
}
