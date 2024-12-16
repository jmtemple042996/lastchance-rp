<?php

namespace App\Http\Controllers;

use App\Models\DepartmentProfile;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = cache()->tags('departments')->remember('list', 10080, function() {
            return Department::paginate(10);
        });

        return Inertia::render('Departments/Index', [
            'departments' => $departments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profiles = cache()->tags('department_profiles')->remember('all', 10080, function() {
            return DepartmentProfile::all();
        });

        $departments = cache()->tags('departments')->remember('all', 10080, function() {
            return Department::all();
        });

        return Inertia::render('Departments/Create',[
            'department_profiles' => $profiles,
            'departments' => $departments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'abbreviation' => 'required',
            'parent_id' => 'required',
            'primary_identifier' => 'required',
            'secondary_identifier' => 'required',
            'department_profile_id' => 'required',
        ]);

        $attributes['parent_id'] = $request->parent_id == 0 ? null : $request->parent_id;

        $department = Department::create($attributes);

                         
    
        cache()->tags('departments')->flush();


        return redirect(route('departments.index'))
            ->with('flash.banner', 'Department created.');
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
    public function edit($department)
    {

        $profiles = cache()->tags('department_profiles')->remember('all', 10080, function() {
            return DepartmentProfile::all();
        });

        $departments = cache()->tags('departments')->remember('all', 10080, function() {
            return Department::all();
        });

        $department = cache()->tags('departments')->remember($department, 10080, function() use ($department) {
            return Department::find($department);
        });

        return Inertia::render('Departments/Edit', [
            'department_profiles' => $profiles,
            'departments' => $departments,
            'department' => $department,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $department)
    {
        $department = cache()->tags('department_profiles')->remember($department, 10080, function() use ($department) {
            return Department::find($department);
        });

        $attributes = $request->validate([
            'name' => 'required',
            'abbreviation' => 'required',
            'parent_id' => 'required',
            'primary_identifier' => 'required',
            'secondary_identifier' => 'required',
            'department_profile_id' => 'required',
        ]);

        $attributes['parent_id'] = $request->parent_id == 0 ? null : $request->parent_id;

        $department->update($attributes);

        cache()->tags('departments')->flush();

        return redirect(route('departments.index'))
            ->with('flash.banner', 'Department edited.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($department)
    {
        $department = cache()->tags('departments')->remember($department, 10080, function() use ($department) {
            return Department::find($department);
        });

        $department->delete();

        cache()->tags('departments')->flush();


        return redirect(route('departments.index'))
            ->with('flash.banner', 'Department deleted.');
    }
}
