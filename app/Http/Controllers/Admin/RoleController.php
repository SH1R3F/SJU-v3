<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Services\RoleService;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::whereNot('name', 'Employee')->with('users:id,fname_ar,lname_ar', 'permissions:id,name')->withCount('users')->get();

        return inertia('Admin/Roles/Index', [
            'roles' => RoleResource::collection($roles)->additional([
                'can_create' => request()->user()->can('create', Role::class)
            ])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request, RoleService $service)
    {
        $service->store($request->validated());
        return redirect()->back()->with('message', __('Role created successfully'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role, RoleService $service)
    {
        $service->update($request->validated(), $role);
        return redirect()->back()->with('message', __('Role updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('message', __('Role deleted successfully'));
    }
}
