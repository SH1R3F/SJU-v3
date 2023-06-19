<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Invite;
use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Services\InvitationService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\InvitationResource;
use App\Mail\InvitationSent;

class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation)
    {
        abort_if(!$invitation->status, 404);

        return inertia('Invitation', [
            'invitation' => new InvitationResource($invitation)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invitation  $invitation
     * @param  \App\Services\InvitationService  $service
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Invitation $invitation, InvitationService $service)
    {
        abort_if(!$invitation->status, 404);

        $request->validate(['name' => 'required', 'email' => ['required', 'email'], 'string', 'max:255']);

        // If already exists, Send the already generated one
        $invite = $invitation->invites()->where('email', $request->email)->first();
        if ($invite) {
            return Inertia::location(Storage::url($invite->invitation));
        }

        $data = $service->create($request->name, $invitation);

        // Insert in DB
        $invite = $invitation->invites()->create([
            'name'       => $request->name,
            'email'      => $request->email,
            'invitation' => $data['path'],
            'code'       => $data['code']
        ]);

        Mail::to($request->email)->send(new InvitationSent($invite));

        return Inertia::location(Storage::url($data['path']));
    }

    /**
     * Confirm the user has scanned and attended the invitation.
     *
     * @param  \App\Models\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function attend(Invite $invite)
    {
        $invite->update(['scanned' => 1]);

        return inertia('InvitateConfirmation');
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
