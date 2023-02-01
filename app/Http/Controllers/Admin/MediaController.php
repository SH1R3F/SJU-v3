<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Media::class, 'media');
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $type
     * @return \Illuminate\Http\Response
     */
    public function index($type = 'photo')
    {
        $media = Media::where('type', $type)->orderBy('id', 'DESC')->get();
        return inertia('Admin/Media/Index', [
            'media' => MediaResource::collection($media)->additional([
                'can_create' => request()->user()->can('create', Template::class),
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Admin/Media/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            $data['path'] = $data['file']->store("media");
        } else {
            $data['path'] = $data['link'];
        }
        Media::create($data);

        return redirect()->route('admin.media.index')->with('message', __('Media uploaded successfully'));
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
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        $media->delete();
        return redirect()->route('admin.media.index')->with('message', __('Media deleted successfully'));
    }
}
