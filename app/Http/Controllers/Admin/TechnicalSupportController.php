<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Admin;
use App\Models\Member;
use App\Models\Volunteer;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SupportTicketsExport;
use App\Models\TechnicalSupportTicket;
use App\Http\Resources\TechnicalSupportTicketResource;

class TechnicalSupportController extends Controller
{

    /**
     * Display members tickets.
     */
    public function index(Request $request)
    {
        $this->authorize('viewMembers', TechnicalSupportTicket::class);

        $tickets = TechnicalSupportTicket::with('supportable')
            ->whereHas('supportable', fn ($query) => $query->whereNotNull('id'))
            ->where('supportable_type', Member::class)
            ->filter($request)
            ->order($request)
            ->paginate($request->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/TechnicalSupport/Members', [
            'tickets' => TechnicalSupportTicketResource::collection($tickets),
            'filters'  => request()->only(['perPage', 'title', 'name', 'status', 'mobile', 'email', 'order', 'dir'])
        ]);
    }

    /**
     * Display subscribers tickets.
     */
    public function subscribers(Request $request)
    {
        $this->authorize('viewSubscribers', TechnicalSupportTicket::class);

        $tickets = TechnicalSupportTicket::with('supportable')
            ->where('supportable_type', Subscriber::class)
            ->whereHas('supportable', fn ($query) => $query->whereNotNull('id'))
            ->filter($request)
            ->order($request)
            ->paginate($request->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/TechnicalSupport/Subscribers', [
            'tickets' => TechnicalSupportTicketResource::collection($tickets),
            'filters'  => request()->only(['perPage', 'title', 'name', 'status', 'mobile', 'email', 'order', 'dir'])
        ]);
    }

    /**
     * Display volunteers tickets.
     */
    public function volunteers(Request $request)
    {
        $this->authorize('viewVolunteers', TechnicalSupportTicket::class);

        $tickets = TechnicalSupportTicket::with('supportable')
            ->whereHas('supportable', fn ($query) => $query->whereNotNull('id'))
            ->where('supportable_type', Volunteer::class)
            ->filter($request)
            ->order($request)
            ->paginate($request->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/TechnicalSupport/Volunteers', [
            'tickets' => TechnicalSupportTicketResource::collection($tickets),
            'filters'  => request()->only(['perPage', 'title', 'name', 'status', 'mobile', 'email', 'order', 'dir'])
        ]);
    }

    /**
     * Display branch managers tickets.
     */
    public function managers(Request $request)
    {
        $this->authorize('viewManagers', TechnicalSupportTicket::class);

        $tickets = TechnicalSupportTicket::with('supportable')
            ->where('supportable_type', Admin::class)
            ->whereHas('supportable', fn ($query) => $query->whereNotNull('id'))
            ->filter($request)
            ->order($request)
            ->paginate($request->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/TechnicalSupport/Managers', [
            'tickets' => TechnicalSupportTicketResource::collection($tickets),
            'filters'  => request()->only(['perPage', 'title', 'name', 'status', 'mobile', 'email', 'order', 'dir'])
        ]);
    }

    /**
     * Export tickets.
     */
    public function export($type = 'members')
    {
        switch ($type) {
            case 'members':
                $this->authorize('viewMembers', TechnicalSupportTicket::class);
                $class = Member::class;
                break;
            case 'subscribers':
                $this->authorize('viewSubscribers', TechnicalSupportTicket::class);
                $class = Subscriber::class;
                break;
            case 'volunteers':
                $this->authorize('viewVolunteers', TechnicalSupportTicket::class);
                $class = Volunteer::class;
                break;
            case 'managers':
                $this->authorize('viewManagers', TechnicalSupportTicket::class);
                $class = Admin::class;
                break;
        }

        $tickets = TechnicalSupportTicket::with('supportable')
            ->whereHas('supportable', fn ($query) => $query->whereNotNull('id'))
            ->where('supportable_type', $class)
            ->filter(request())
            ->order(request())
            ->get();

        return Excel::download(new SupportTicketsExport($tickets), 'Technical support tickets.xlsx');
    }

    /**
     * Display the specified resource.
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
     */
    public function toggle(TechnicalSupportTicket $ticket)
    {
        $this->authorize('view', $ticket);

        $ticket->update(['status' => !$ticket->status]);

        return redirect()->back()->with('message', __('ticket updated successfully'));
    }

    /**
     * Toggle status for a ticket.
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
     */
    public function destroy(TechnicalSupportTicket $ticket)
    {
        $this->authorize('delete', $ticket);
        // Delete data from storage

        $ticket->delete();

        return redirect()->back()->with('message', __('ticket deleted successfully'));
    }
}
