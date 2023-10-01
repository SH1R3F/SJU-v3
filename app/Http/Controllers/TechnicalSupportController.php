<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\TechnicalSupportTicket;
use App\Http\Resources\TechnicalSupportTicketResource;

class TechnicalSupportController extends Controller
{

    private $auth;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::guard('member')->check()) {
                $this->auth = Auth::guard('member')->user();
            } else if (Auth::guard('subscriber')->check()) {
                $this->auth = Auth::guard('subscriber')->user();
            } else if (Auth::guard('volunteer')->check()) {
                $this->auth = Auth::guard('volunteer')->user();
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = $this->auth->tickets()->orderBy('id', 'DESC')->get();
        return inertia('TechnicalSupport/Index', [
            'tickets' => TechnicalSupportTicketResource::collection($tickets)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('TechnicalSupport/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'attachment' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048']
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store("support/attachments");
        }

        $ticket = $this->auth->tickets()->create($data);

        $ticket->messages()->create([
            'body' => $data['body'],
            'attachment' => $data['attachment'] ?? null,
            'sender' => TechnicalSupportTicket::SENDER_USER
        ]);

        return redirect()->route('support.show', $ticket->id)->with('message', __('Ticket created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(TechnicalSupportTicket $ticket)
    {
        abort_if(!$ticket->supportable->is($this->auth), Response::HTTP_FORBIDDEN);

        return inertia('TechnicalSupport/Show', [
            'ticket' => new TechnicalSupportTicketResource($ticket->load('messages'))
        ]);
    }


    /**
     * Store a new message to the ticket.
     */
    public function message(Request $request, TechnicalSupportTicket $ticket)
    {
        abort_if(!$ticket->supportable->is($this->auth), Response::HTTP_FORBIDDEN);

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

        return redirect()->back()->with('message', __('Message sent successfully'));
    }

    /**
     * toggle status of a ticket.
     */
    public function toggle(Request $request, TechnicalSupportTicket $ticket)
    {
        abort_if(!$ticket->supportable->is($this->auth), Response::HTTP_FORBIDDEN);

        $ticket->update(['status' => !$ticket->status]);
        $ticket->touch();

        return redirect()->back()->with('message', __('ticket updated successfully'));
    }
}
