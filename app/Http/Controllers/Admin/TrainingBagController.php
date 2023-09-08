<?php

namespace App\Http\Controllers\Admin;

use App\Models\TrainingBag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TrainingBagRequest;
use App\Http\Resources\TrainingBagResource;

class TrainingBagController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TrainingBag::class, 'file');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $files = TrainingBag::filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/TrainingBag/Index', [
            'files' => TrainingBagResource::collection($files)->additional([
                'can_create' => request()->user()->can('create', TrainingBag::class),
            ]),
            'filters' => request()->only(['perPage', 'search', 'order', 'dir'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/TrainingBag/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrainingBagRequest $request)
    {
        $data = $request->validated();

        // Store it
        $data['path'] = $data['file']->store("training-bag");

        // Create file
        $file = TrainingBag::create($data);

        // Redirect
        return redirect()->route('admin.training-bag.index')->with('message', __('File created successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingBag $file)
    {
        // Delete files
        Storage::delete($file->path ?? '');
        $file->delete();
        return redirect()->back()->with('message', __('File deleted successfully'));
    }
}
