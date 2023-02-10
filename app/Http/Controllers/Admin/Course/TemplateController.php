<?php

namespace App\Http\Controllers\Admin\Course;

use Illuminate\Http\Request;
use App\Models\Course\Template;
use App\Services\TemplateService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\TemplateResource;
use App\Http\Requests\Course\TemplateRequest;

class TemplateController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Template::class, 'template');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Courses/Templates/Index', [
            'templates' => TemplateResource::collection($templates)
                ->additional([
                    'can_create' => request()->user()->can('create', Template::class),
                ]),
            'filters' => request()->only(['perPage', 'search', 'order', 'dir'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Admin/Courses/Templates/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Course\TemplateRequest  $request
     * @param  \App\Services\TemplateService  $service
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateRequest $request, TemplateService $service)
    {
        // Store it
        $template = $service->create($request->validated());

        // Redirect to edit template.
        return redirect()->route('admin.templates.edit', $template->id)->with('message', __('Template created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        return inertia('Admin/Courses/Templates/Edit', [
            'template' => new TemplateResource($template)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Course\TemplateRequest  $request
     * @param  \App\Models\Course\Template  $template
     * @param  \App\Services\TemplateService  $service
     * @return \Illuminate\Http\Response
     */
    public function update(TemplateRequest $request, Template $template, TemplateService $service)
    {
        // Update changes
        $service->update($request->validated(), $template);

        // Redirect to edit template.
        return redirect()->route('admin.templates.edit', $template->id)->with('message', __('Template updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        // Delete files
        Storage::delete($template->file ?? '', $template->preview ?? '');
        $template->delete();
        return redirect()->back()->with('message', __('Template deleted successfully'));
    }
}
