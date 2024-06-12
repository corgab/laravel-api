<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Type::orderBy('title','asc')->get();

        $technologies = Technology::orderBy('title','asc')->get();

        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:150|string',
            'description'=>'max:65000',
            'start_date'=>'date',
            'end_date'=>'date',
            'project_url'=>'required|url|unique:projects',
            'type_id'=>'required|exists:types,id',
            'technologies'=>'required',
            
        ]);

        $form_data = $request->all();
        $base_slug = Str::slug($form_data['title']);
        $slug = $base_slug;

        $n = 0;

        do {

            $find = Project::where('slug', $slug)->first();

            if($find !== null) {
                $n++;
                $slug = $base_slug . '-'.$n;
            }

        } while($find !== null);

        $form_data['slug'] = $slug;

        $new_project = Project::create($form_data);

        $new_project->technologies()->sync($form_data['technologies']);

        return to_route('admin.projects.index', $new_project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        $types = Type::orderBy('title','asc')->get();

        $technologies = Technology::orderBy('title','asc')->get();

        return view('admin.projects.edit',compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title'=>'required|max:255',
            'slug'=>['required', Rule::unique('projects')->ignore($project->id)],
            'description'=>'max:65000',
            'start_date'=>'date',
            'end_date'=>'date',
            'project_url'=>'required|url',
            'type_id'=>'required|exists:types,id',
            'technologies'=>'required',
        ]);

        $form_data = $request->all();

        $project->update($form_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            // l'utente non ha selezionato niente eliminiamo i collegamenti con i tags
            $project->technologies()->detach();
            // $post->tags()->sync([]); // fa la stessa cosa
        }

        return to_route('admin.projects.index', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index');
    }
}
