<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        $types = Type::all();

        return view('pages.dashboard.index', compact('projects','types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        return view('pages.dashboard.create' , compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        $val_data = $request->validated();

        //generiamo lo slug in modo dinamico
        $slug = Project::generateSlug($request->title);
        $val_data['slug'] = $slug;

        //gestione immagine
        if( $request->hasFile('cover_image') ){

            $path = Storage::disk('public')->put( 'project_images', $request->cover_image );


            $val_data['cover_image'] = $path;
        }

        $new_project = Project::create($val_data);

        return redirect()->route('dashboard.project.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('pages.dashboard.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projects = Project::findOrFail($id);

        $types = Type::all();

        return view('pages.dashboard.edit', compact('projects', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id)
    {
        $formData = $request->all();

        $projects = Project::find($id);

        if( $request->hasFile('cover_image') ){
            if( $projects->cover_image ){
                Storage::delete($projects->cover_image);
            }

            $path = Storage::disk('public')->put('projects_images', $request->cover_image);

            $formData['cover_image'] = $path;
        }

        $projects->update($formData);

        return redirect()->route('dashboard.project.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projects = Project::find($id);

        if( $projects->cover_image ){
            Storage::delete($projects->cover_image);
        }

        $projects->delete();

        return redirect()->route('dashboard.project.index');
    }
}
