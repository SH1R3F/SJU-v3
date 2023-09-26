<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\InvoiceResource;
use App\Models\Subscription;

class InvoiceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Invoice::class);

        $invoices = Invoice::with('member', 'member.subscription')
            ->when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->whereHas('member', fn ($builder) => $builder->where('member_id', Auth::guard('admin')->user()->branch_id)))
            ->filter($request)
            ->order($request)
            ->paginate($request->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Invoices/Index', [
            'invoices' => InvoiceResource::collection($invoices),
            'filters'  => request()->only(['perPage', 'name', 'national_id', 'membership_number', 'order', 'dir'])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        $invoice->load('subscription', 'member', 'member.branch');
        return inertia('Admin/Invoices/View', [
            'invoice' => new InvoiceResource($invoice),
            'types' => config('sju.memberships')
        ]);
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
