<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('superadmin.projects.all', ['projects' => $projects]);
    }

    public function create()
    {
        return view('superadmin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_description' => 'required|string',
            'project_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('project_image')->store('project_images', 'public');

        Project::create([
            'project_name' => $request->input('project_name'),
            'project_description' => $request->input('project_description'),
            'project_image' => $imagePath,
        ]);

        return redirect()->route('projects.all')->with('success', 'Project created successfully.');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('superadmin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'project_name' => 'required',
            'project_description' => 'required',
            'project_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('project_image')) {
            $imagePath = $request->file('project_image')->store('project_images', 'public');
            $project->project_image = $imagePath;
        }

        $project->project_name = $request->input('project_name');
        $project->project_description = $request->input('project_description');
        $project->save();

        return redirect()->route('projects.all')->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        // Delete the project image
        Storage::disk('public')->delete($project->project_image);
        $project->delete();

        return redirect()->route('projects.all')->with('success', 'Project deleted successfully.');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $inventories = Inventory::with('priceChange')->where('project_id', $project->id)->get();
        return view('superadmin.projects.show', compact('project', 'inventories'));
    }


}
