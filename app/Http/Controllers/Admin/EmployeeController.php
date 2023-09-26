<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use App\Http\Resources\BranchResource;

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
        $admins = Employee::with('branch')
            ->filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Employees/Index', [
            'employees' => AdminResource::collection($admins)
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
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
