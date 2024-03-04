<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = project::with('category', 'user')->latest('id')->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'budget' => 'required',
            'time' => 'required',
            'category_id' => 'required',
        ]);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
       }

        // Check if the name repeted or not
        $count = project::where('name', 'like', '%' . $request->name_en . '%')
        ->orWhere('name', 'like', '%' . $request->name_ar . '%')
        ->count();
        
        $slug = Str::slug($request->name);
        if($count >= 1){
            $slug = $slug . '-' . $count;
        }

        // return english name and arabic name as JSON format
        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ], JSON_UNESCAPED_UNICODE);

        $description = json_encode([
            'en' => $request->description_en,
            'ar' => $request->description_ar
        ], JSON_UNESCAPED_UNICODE);
        

        project::create([
            'name' => $name,
            'slug' => $slug,
            'status' => 1,
            'user_id' => Auth::id(),
            'description' => $description,
            'budget' => $request->budget,
            'time' => $request->time,
            'category_id' => $request->category_id,
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
        $categories = Category::all();
        return view('admin.projects.edit', compact('project','categories'));
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
