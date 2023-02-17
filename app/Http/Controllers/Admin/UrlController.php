<?php

namespace App\Http\Controllers\Admin;

use App\Models\Url;
use Illuminate\Http\Request;
use App\Http\Requests\UrlRequest;
use App\Http\Resources\UrlResource;
use App\Http\Controllers\Controller;

class UrlController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Url::class, 'url');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urls = Url::orderBy('id', 'DESC')->get();
        return inertia('Admin/Urls/Index', [
            'urls' => UrlResource::collection($urls)->additional([
                'can_create' => request()->user()->can('create', Url::class),
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
        return inertia('Admin/Urls/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UrlRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UrlRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $data['image']->store("urls");
        }
        Url::create($data);

        return redirect()->route('admin.urls.index')->with('message', __('Url created successfully'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function edit(Url $url)
    {
        return inertia('Admin/Urls/Edit', compact('url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UrlRequest  $request
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(UrlRequest $request, Url $url)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $data['image']->store("urls");
        } else {
            $data['image'] = $url->image;
        }
        $url->update($data);

        return redirect()->route('admin.urls.index')->with('message', __('Url updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        $url->delete();
        return redirect()->route('admin.urls.index')->with('message', __('Url deleted successfully'));
    }

    /**
     * toggle status of the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function toggle(Url $url)
    {
        $url->update(['status' => !$url->status]);
        return redirect()->route('admin.urls.index')->with('message', __('Url updated successfully'));
    }
}
