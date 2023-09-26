<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\MembershipTransfer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MembershipTransferRequest;
use App\Http\Resources\MembershipTransferResource;

class MembershipTransferController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(MembershipTransfer::class, 'transfer');
    }

    /**
     * Display accepted members.
     */
    public function index()
    {
        $subscribers = MembershipTransfer::with('member', 'branchFrom', 'branchTo', 'requester')
            ->when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('transfer_from', Auth::guard('admin')->user()->branch_id)->orWhere('transfer_to', Auth::guard('admin')->user()->branch_id))
            ->filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Transfers/Index', [
            'transfers' => MembershipTransferResource::collection($subscribers)->additional([
                'can_create' => request()->user()->can('create', MembershipTransfer::class),
            ]),
            'filters' => request()->only(['perPage', 'national_id', 'order', 'dir'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Transfers/Create', [
            'branches' => Branch::orderBy('id')->get(['id', 'name'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MembershipTransferRequest $request)
    {
        $member = Member::where('national_id', $request->national_id)->first();

        MembershipTransfer::create([
            'member_id' => $member->id,
            'transfer_from' => $member->branch_id,
            'transfer_to' => (Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee')) ? Auth::guard('admin')->user()->branch_id : $request->transfer_to,
            'status' => MembershipTransfer::STATUS_PENDING,
            'request_by' => request()->user()->id,
        ]);

        return redirect()->route('admin.members.transfers')->with('message', __('Member transfer request created successfully'));
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
     * Approve the specified resource in storage.
     */
    public function approve(Request $request, MembershipTransfer $transfer)
    {
        $transfer->member->update(['branch_id' => $transfer->transfer_to]);
        $transfer->update(['status' => MembershipTransfer::STATUS_APPROVED]);
        return redirect()->route('admin.members.transfers')->with('message', __('Member transfer request approved successfully'));
    }

    /**
     * Disapprove the specified resource in storage.
     */
    public function disapprove(Request $request, MembershipTransfer $transfer)
    {
        $transfer->update(['status' => MembershipTransfer::STATUS_DISAPPROVED]);
        return redirect()->route('admin.members.transfers')->with('message', __('Member transfer request disapproved successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MembershipTransfer $transfer)
    {
        $transfer->delete();
        return redirect()->route('admin.members.transfers')->with('message', __('Member transfer request deleted successfully'));
    }
}
