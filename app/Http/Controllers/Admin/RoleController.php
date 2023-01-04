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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('users:id,fname,lname', 'permissions:id,name')->withCount('users')->get();

        return inertia('Admin/Roles/Index', [
            'roles' => RoleResource::collection($roles->append('can'))->additional([
                'can_create' => request()->user()->can('create', Role::class)
            ])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @param  \App\Services\RoleService  $service
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request, RoleService $service)
    {
        $service->store($request->validated());
        return redirect()->back()->with('message', __('Role created successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @param  \App\Services\RoleService  $service
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role, RoleService $service)
    {
        $service->update($request->validated(), $role);
        return redirect()->back()->with('message', __('Role updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('message', __('Role deleted successfully'));
    }
}
