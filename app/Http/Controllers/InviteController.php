<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use ArPHP\I18N\Arabic;
use App\Models\Invitation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\InvitationResource;
use App\Services\InvitationService;

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

        $request->validate(['name' => 'required', 'string', 'max:255']);

        $path = $service->create($request->name, $invitation);

        // Insert in DB
        $invitation->invites()->create([
            'name'       => $request->name,
            'invitation' => $path
        ]);

        return Inertia::location(Storage::url($path));
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
