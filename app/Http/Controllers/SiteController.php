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

        }

        // Return Top 3 Categories Based on projects count in this category
        $top_cats = Category::with('projects')->withCount('projects')->orderBy('projects_count', 'desc')->take(3)->get();

        $latest_projects = Project::latest()->paginate(2);

        return view('site.index', compact('top_cats','latest_projects'));
    }
}
