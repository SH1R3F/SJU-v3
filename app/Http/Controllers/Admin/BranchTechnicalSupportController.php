<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\TechnicalSupportTicket;
use App\Http\Requests\BranchSupportTicketRequest;
use App\Http\Resources\TechnicalSupportTicketResource;

class BranchTechnicalSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tickets = TechnicalSupportTicket::where('supportable_id', Auth::user()->id)
            ->where('supportable_type', Admin::class)
            ->filter($request)
            ->order($request)
            ->paginate($request->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/BranchTechnicalSupport/Index', [
            'tickets' => TechnicalSupportTicketResource::collection($tickets),
            'filters'  => request()->only(['perPage', 'order', 'dir'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/BranchTechnicalSupport/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchSupportTicketRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store("support/attachments");
        }

        $ticket = TechnicalSupportTicket::create(array_merge(
            $data,
            [
                'supportable_type' => Admin::class,
                'supportable_id' => Auth::user()->id,
            ]
        ));
        $ticket->messages()->create([
            'body' => $data['body'],
            'attachment' => $data['attachment'] ?? null,
            'sender' => TechnicalSupportTicket::SENDER_USER
        ]);

        return redirect()->route('admin.branch-issues.show', $ticket->id)->with('message', __('Ticket created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(TechnicalSupportTicket $ticket)
    {
        abort_if(!$ticket->supportable->is(Auth::user()), Response::HTTP_FORBIDDEN);

        return inertia('Admin/BranchTechnicalSupport/View', [
            'ticket' => new TechnicalSupportTicketResource($ticket->load('messages'))
        ]);
    }

    /**
     * Update the specified resource state in storage.
     */
    public function toggle(TechnicalSupportTicket $ticket)
    {
        abort_if(!$ticket->supportable->is(Auth::user()), Response::HTTP_FORBIDDEN);

        $ticket->update(['status' => !$ticket->status]);
        $ticket->touch();

        return redirect()->back()->with('message', __('ticket updated successfully'));
    }

    /**
     * Send new message in the ticket.
     */
    public function message(Request $request, TechnicalSupportTicket $ticket)
    {
        abort_if(!$ticket->supportable->is(Auth::user()), Response::HTTP_FORBIDDEN);

        if (!$request->body && !$request->attachment) return;

        $data = $request->validate([
            'body' => ['nullable', 'string'],
            'attachment' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048']
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store("support/attachments");
        }

        $ticket->messages()->create([
            'body' => $data['body'],
            'attachment' => $data['attachment'],
            'sender' => TechnicalSupportTicket::SENDER_USER
        ]);
        $ticket->update(['status' => TechnicalSupportTicket::STATUS_OPEN]);
        $ticket->touch();

        return Inertia::location(redirect()->route('admin.branch-issues.show', $ticket->id)->with('message', __('Message sent successfully')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TechnicalSupportTicket $ticket)
    {
        abort_if(!$ticket->supportable->is(Auth::user()), Response::HTTP_FORBIDDEN);

        $ticket->delete();

        return redirect()->back()->with('message', __('ticket deleted successfully'));
    }
}
