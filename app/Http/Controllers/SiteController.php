<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    function index(Request $request) {

        // check if the requst type ajax?
        if($request->ajax()){
            $latest_projects = Project::latest()->paginate(2);
            
            return view('site.parts.latest_projects', compact('latest_projects'))->render();
        }

        // Return Top 3 Categories Based on projects count in this category
        $top_cats = Category::with('projects')->withCount('projects')->orderBy('projects_count', 'desc')->take(3)->get();

        $latest_projects = Project::latest()->paginate(2);

        return view('site.index', compact('top_cats','latest_projects'));
    }


    // function category($slug) {
    //     $category = Category::where('slug', $slug)->findOrFail(); 
    //     dd($category)
    // }

    // the same code
    function category(Category $category) {
        // dd($category);
        
        $category->load('projects'); // ->load for the relation between category and project

        // when use () with ->projects() example, he alowd to run the next method for relation
        $projects = $category->projects()->paginate(2);
        return view('site.jobs', compact('category', 'projects'));
    }

    function project(Project $project) {
        // dd($project);
        return view('site.project', compact('project'));
    }
}
