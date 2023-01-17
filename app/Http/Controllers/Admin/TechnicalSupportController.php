<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TechnicalSupportTicket;
use App\Http\Resources\TechnicalSupportTicketResource;

class TechnicalSupportController extends Controller
{

    /**
     * Display members tickets.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewMembers', TechnicalSupportTicket::class);

        $tickets = TechnicalSupportTicket::with('supportable')
            ->filter($request)
            ->orderBy('updated_at', 'DESC')
            ->paginate($request->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/TechnicalSupport/Members', [
            'tickets' => TechnicalSupportTicketResource::collection($tickets),
            'filters'  => request()->only(['perPage', 'title', 'name', 'status', 'mobile', 'email'])
        ]);
    }

    /**
     * Display subscribers tickets.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribers(Request $request)
    {
        $this->authorize('viewSubscribers', TechnicalSupportTicket::class);
    }

    /**
     * Display volunteers tickets.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function volunteers(Request $request)
    {
        $this->authorize('viewVolunteers', TechnicalSupportTicket::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TechnicalSupportTicket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(TechnicalSupportTicket $ticket)
    {
        $this->authorize('view', $ticket);

        $ticket->load('supportable', 'messages');

        return inertia('Admin/TechnicalSupport/View', [
            'ticket' => new TechnicalSupportTicketResource($ticket)
        ]);
    }

    /**
     * Toggle status for a ticket.
     *
     * @param  \App\Models\TechnicalSupportTicket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function toggle(TechnicalSupportTicket $ticket)
    {
        $this->authorize('view', $ticket);

        $ticket->update(['status' => !$ticket->status]);

        return redirect()->back()->with('message', __('ticket updated successfully'));
    }

    /**
     * Toggle status for a ticket.
     *
     * @param \Illuminate\Http\Request  $request
     * @param  \App\Models\TechnicalSupportTicket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function message(Request $request, TechnicalSupportTicket $ticket)
    {
        $this->authorize('view', $ticket);
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
            'sender' => TechnicalSupportTicket::SENDER_ADMIN
        ]);
        $ticket->update(['status' => TechnicalSupportTicket::STATUS_OPEN]);
        $ticket->touch();

        return Inertia::location(redirect()->route('admin.tickets.show', $ticket->id)->with('message', __('Message sent successfully')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TechnicalSupportTicket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(TechnicalSupportTicket $ticket)
    {
        $this->authorize('delete', $ticket);
        // Delete data from storage

        $ticket->delete();

        return redirect()->back()->with('message', __('ticket deleted successfully'));
    }
}
