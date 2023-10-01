<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Exports\AdminsExport;
use App\Services\AdminService;
use Spatie\Permission\Models\Role;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\AdminResource;
use App\Http\Resources\BranchResource;
use App\Http\Requests\NotifyAdminsRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PushNotificationToUsers;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Admin::class, 'admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with('branch', 'roles')
            ->whereHas('roles', fn($query) => $query->whereNot('name', 'Employee'))
            ->filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Admins/Index', [
            'admins' => AdminResource::collection($admins)
                ->additional([
                    'roles' => RoleResource::collection(
                        Role::withCount('users')->whereNot('name', 'Employee')->orderBy('id')->get(['id', 'name'])
                    ),
                    'branches' => BranchResource::collection(
                        Branch::orderBy('id')->get(['id', 'name'])
                    ),
                    'can_create' => request()->user()->can('create', Admin::class),
                    'can_notify' => request()->user()->can('notify', Admin::class),
                ]),
            'filters' => request()->only(['perPage', 'search', 'role', 'branch', 'order', 'dir'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $roles   = Role::whereNot('name', 'Employee')->orderBy('id')->get();
        $branches = Branch::orderBy('id')->get();

        return inertia('Admin/Admins/Create', [
            'roles' => RoleResource::collection($roles),
            'branches' => BranchResource::collection($branches),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request, AdminService $service)
    {
        $service->store($request->validated());

        return redirect()->route('admin.admins.index')->with('message', __('Moderator created successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $roles   = Role::whereNot('name', 'Employee')->orderBy('id')->get();
        $branches = Branch::orderBy('id')->get();

        return inertia('Admin/Admins/Edit', [
            'admin' => new AdminResource($admin),
            'roles' => RoleResource::collection($roles),
            'branches' => BranchResource::collection($branches),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $admin, AdminService $service)
    {
        $service->update($request->validated(), $admin);
        return redirect()->route('admin.admins.index')->with('message', __('Moderator updated successfully'));
    }

    /**
     * Toggle active status for a resource.
     */
    public function toggle(Request $request, Admin $admin)
    {
        $this->authorize('toggle', $admin);

        $admin->update(['active' => $state = !$admin->active]);
        return redirect()->back()->with('message', __($state ? 'Moderator enabled successfully' : 'Moderator disabled successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->back()->with('message', __('Moderator deleted successfully'));
    }

    /**
     * Export a listing of the resource.
     */
    public function export()
    {
        $this->authorize('viewAny', Admin::class);

        return Excel::download(new AdminsExport, 'moderators.xlsx');
    }

    /**
     * Show the form to send a notification to admins.
     */
    public function showNotifyForm()
    {
        $this->authorize('notify', Admin::class);

        $admins = Admin::orderBy('id')->whereHas('roles', fn($query) => $query->whereNot('name', 'Employee'))->get(['id', 'fname_ar', 'lname_ar']);

        return inertia('Admin/Admins/Notifications/Create', [
            'admins' => AdminResource::collection($admins)
        ]);
    }

    /**
     * Send the notification to specified users.
     */
    public function notify(NotifyAdminsRequest $request, AdminService $service)
    {
        $this->authorize('notify', Admin::class);

        $recipients = $service->prepareRecipients($request->validated());

        Notification::send($recipients, new PushNotificationToUsers($request->validated()));

        return redirect()->route('admin.admins.index')->with('message', __('Notification is being sent'));
    }
}
