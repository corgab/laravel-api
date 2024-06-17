<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // $projects = Project::all();

        $per_page = $request->perPage ?? 12;

        $results = Project::with('technologies', 'type')->paginate($per_page);
        
        return response()->json([
            'result' => $results
        ]);
    }

    public function show(Project $project)
    {
        $project->load('technologies', 'type');

        return response()->json([
            'project' => $project
        ]);
    }


}
