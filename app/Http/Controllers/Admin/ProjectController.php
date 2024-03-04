<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = project::latest('id')->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required'
        ]);

        // Check if the name repeted or not
        $exists = project::where('name', 'like', '%' . $request->name_en . '%')
        ->orWhere('name', 'like', '%' . $request->name_ar . '%')
        ->exists();
        
        if($exists){
            $validator->after(function ($validator) {
                $validator->errors()->add('name_en', 'The name is already exists');
                $validator->errors()->add('name_ar', 'The name is already exists');
            });
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // return english name and arabic name as JSON format
        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ], JSON_UNESCAPED_UNICODE);
        

        project::create([
            'name' => $name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.projects.index')->with('msg', 'project Created Successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name_en' => 'required|unique:projects,name',
            'name_ar' => 'required'
        ]);

        // return english name and arabic name as JSON format
        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ], JSON_UNESCAPED_UNICODE);
        

        $project->update([
            'name' => $name,
            // 'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.projects.index')->with('msg', 'Cateory Updated Successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // $project is a object from project class, have the project information
        $project->delete();

        return redirect()->route('admin.projects.index')->with('msg', 'project deleted successfully')->with('type', 'danger');
    }
}
