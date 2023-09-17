<?php

namespace App\Http\Controllers\Admin;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompetitionResource;

class CompetitionController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Competition::class, 'competition');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $competitions = Competition::filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Competitions/Index', [
            'competitions' => CompetitionResource::collection($competitions)
                ->additional([
                    'can_create' => request()->user()->can('create', Competition::class),
                ]),
            'filters' => request()->only(['perPage', 'name', 'order', 'dir'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Competitions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
