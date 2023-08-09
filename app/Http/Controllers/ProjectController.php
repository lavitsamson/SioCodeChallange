<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $projects = auth()->user()->project;

        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return  view('project.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validation = $request->validate(
            ['project_name' => 'required|min:2']
        );

        Project::create([
            'project_name' => $request->project_name,
            'project_description' => $request->project_description,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $project = Project::find($id);

        return view('project.edit', compact('project', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validation = $request->validate(
            ['project_name' => 'required|min:2']
        );

        $project = Project::find($id);

        $project->project_name = $request->project_name;
        $project->project_description = $request->project_description;
        $project->save();

        return redirect()->route('project.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $project = Project::find($id);
        $project->delete();

        return redirect()->route('project.index');
    }
}
