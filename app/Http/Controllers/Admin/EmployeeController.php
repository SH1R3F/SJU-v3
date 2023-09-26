<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\BranchResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\EmployeePermissionRequest;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Employee::class, 'employee');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('branch')
            ->when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
            ->filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Employees/Index', [
            'employees' => EmployeeResource::collection($employees)
                ->additional([
                    'branches' => BranchResource::collection(
                        Branch::orderBy('id')->get(['id', 'name'])
                    ),
                    'can_create' => request()->user()->can('create', Employee::class),
                    'can_notify' => request()->user()->can('notify', Employee::class),
                ]),
            'filters' => request()->only(['perPage', 'search', 'branch', 'order', 'dir'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::orderBy('id')->get();

        return inertia('Admin/Employees/Create', [
            'branches' => BranchResource::collection($branches),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        if (Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee')) {
            $data['branch_id'] = Auth::guard('admin')->user()->branch_id;
        }

        $employee = Employee::create($data);
        $employee->assignRole('Employee');
        return redirect()->route('admin.employees.index')->with('message', __('Employee created successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $branches = Branch::orderBy('id')->get();

        return inertia('Admin/Employees/Edit', [
            'employee' => new EmployeeResource($employee),
            'branches' => BranchResource::collection($branches),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $employee->update($data);

        return redirect()->route('admin.employees.index')->with('message', __('Employee updated successfully'));
    }

    /**
     * Update permissions of the specified resource.
     */
    public function permissions(EmployeePermissionRequest $request, Employee $employee)
    {
        $data = $request->validated();

        $employee->syncPermissions($data['permissions']);

        return redirect()->back()->with('message', __('Employee updated successfully'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->back()->with('message', __('Employee deleted successfully'));
    }
}
