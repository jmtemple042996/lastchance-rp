<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Inertia\Inertia;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($currentDepartment)
    {
        $permissions = cache()->tags('permissions')->remember('list', 10080, function() {
            return Permission::paginate(10);
        });

        return Inertia::render('Permissions/Index', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($currentDepartment)
    {
        return Inertia::render('Permissions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $currentDepartment)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'scope' => 'required',
            'slug' => 'required|unique:permissions',
        ]);

        $permission = Permission::create($attributes);

        cache()->tags('permissions')->flush();


        return redirect(route('permissions.index', ['currentDepartment' => $currentDepartment]))
            ->with('flash.banner', 'Permission created.');
    }

    /**
     * Display the specified resource.
     */
    public function show($currentDepartment, $permission)
    {
        $permission = cache()->tags('permissions')->remember($permission, 10080, function() use ($permission) {
            return Permission::find($permission);
        });
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($currentDepartment, $permission)
    {
        $permission = cache()->tags('permissions')->remember($permission, 10080, function() use ($permission) {
            return Permission::find($permission);
        });

        return Inertia::render('Permissions/Edit', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $currentDepartment, $permission)
    {
        $permission = cache()->tags('permissions')->remember($permission, 10080, function() use ($permission) {
            return Permission::find($permission);
        });

        $attributes = $request->validate([
            'name' => 'required',
            'scope' => 'required',
            'slug' => 'required|unique:permissions,slug,' . $permission->id,
        ]);

        $permission->update($attributes);

        cache()->tags('permissions')->flush();


        return redirect(route('permissions.index', ['currentDepartment' => $currentDepartment]))
            ->with('flash.banner', 'Permission edited.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($currentDepartment, $permission)
    {
        $permission = cache()->tags('permissions')->remember($permission, 10080, function() use ($permission) {
            return Permission::find($permission);
        });

        $permission->delete();

        cache()->tags('permissions')->flush();


        return redirect(route('permissions.index', ['currentDepartment' => $currentDepartment]))
            ->with('flash.banner', 'Permission deleted.');
    }
}
