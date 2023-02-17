<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use Illuminate\Http\Request;
use App\Http\Requests\AdRequest;
use App\Http\Resources\AdResource;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Ad::class, 'ad');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::orderBy('id', 'DESC')->get();
        return inertia('Admin/Ads/Index', [
            'ads' => AdResource::collection($ads)->additional([
                'can_create' => request()->user()->can('create', Ad::class),
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
        return inertia('Admin/Ads/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AdRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $data['image']->store("ads");
        }
        Ad::create($data);

        return redirect()->route('admin.ads.index')->with('message', __('Ad created successfully'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        return inertia('Admin/Ads/Edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AdRequest  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(AdRequest $request, Ad $ad)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $data['image']->store("ads");
        } else {
            $data['image'] = $ad->image;
        }
        $ad->update($data);

        return redirect()->route('admin.ads.index')->with('message', __('Ad updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->route('admin.ads.index')->with('message', __('Ad deleted successfully'));
    }

    /**
     * toggle status of the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function toggle(Ad $ad)
    {
        $ad->update(['status' => !$ad->status]);
        return redirect()->route('admin.ads.index')->with('message', __('Ad updated successfully'));
    }
}
