<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Exports\InvitesExport;
use Illuminate\Http\UploadedFile;
use App\Services\InvitationService;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\InvitationRequest;
use App\Http\Resources\InvitationResource;

class InvitationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Invitation::class, 'invitation');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invitations = Invitation::query()
            ->filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 20)
            ->withQueryString();

        return inertia('Admin/Invitations/Index', [
            'invitations' => InvitationResource::collection($invitations)
                ->additional([
                    'can_create' => request()->user()->can('create', Invitation::class),
                ]),
            'filters' => request()->only(['perPage', 'name', 'order', 'dir'])
        ]);
    }

    /**
     * Export a listing of the resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function export(Invitation $invitation)
    {
        $this->authorize('view', $invitation);

        return Excel::download(new InvitesExport($invitation->invites), 'Invitations.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Admin/Invitations/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InvitationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvitationRequest $request, InvitationService $service)
    {
        $data = $request->validated();

        // Store it
        $path = $data['file']->store("invitations/templates");
        $data['preview'] = $data['file']->store("invitations/templates/previews");
        $data['file'] = $path;

        // Create invitation
        $invitation = Invitation::create($data);

        // Prepare the preview
        $service->preview($invitation);

        // Redirect to edit invitation.
        return redirect()->route('admin.invitations.edit', $invitation->id)->with('message', __('Invitation created successfully'));
    }

    /**
     * Show the specified resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation)
    {
        return inertia('Admin/Invitations/View', [
            'invitation' => new InvitationResource($invitation->load('invites'))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation)
    {
        return inertia('Admin/Invitations/Edit', [
            'invitation' => new InvitationResource($invitation)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InvitationRequest  $request
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function update(InvitationRequest $request, Invitation $invitation, InvitationService $service)
    {
        $data = $request->validated();
        // Delete old files and update new ones.
        if ($data['file'] instanceof UploadedFile) {
            Storage::delete($invitation->file ?? '', $invitation->preview ?? '');
            $data['preview'] = $data['file']->store("invitations/templates/previews");
            $data['file'] = $data['file']->store("invitations/templates");
        } else {
            Storage::delete($invitation->preview ?? '');
            Storage::copy($invitation->file, $data['preview'] = str_replace("invitations/templates", "invitations/templates/previews", $invitation->file));
            $data['file'] = $invitation->file;
        }

        // Update invitation
        $invitation->update($data);

        // Prepare the preview
        $service->preview($invitation);

        // Redirect to edit invitation.
        return redirect()->route('admin.invitations.edit', $invitation->id)->with('message', __('Invitation updated successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function toggle(Request $request, Invitation $invitation)
    {
        $this->authorize('toggle', $invitation);

        $invitation->update(['status' => !$invitation->status]);

        // Redirect to edit invitation.
        return redirect()->route('admin.invitations.index')->with('message', __('Invitation updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitation $invitation)
    {
        // Delete files
        Storage::delete($invitation->file ?? '', $invitation->preview ?? '');
        $invitation->delete();
        return redirect()->back()->with('message', __('Invitation deleted successfully'));
    }
}
