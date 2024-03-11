<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\Proposale;
use Illuminate\Http\Request;
use App\Notifications\NewProposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

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
        $projects = $category->projects()->latest()->paginate(2);
        return view('site.jobs', compact('category', 'projects'));
    }

    function project(Project $project) {
        // dd($project);
        return view('site.project', compact('project'));
    }

    function apply_now(Project $project) {
        // Send Notification To Project Owner
        $user = $project->user; // Hit: ->user the project relation name 
        if($user->channel_type){
            $msg = "There is new Proposal Submmitted to: $project->trans_name!";
            $url = route('site.project', $project->slug);
            $user->notify(new NewProposal($msg, $url));
        }
        return view('site.apply_now', compact('project'));
    }

    function apply_now_data(Request $request, Project $project) {
        $request->validate([
            'cost' => 'required',
            'time' => 'required',
            'content' => 'required',
        ]);

        Proposale::create([
            'employee_id' => $request->employee_id,
            'project_id' => $request->project_id,
            'content' => $request->content,
            'time' => $request->time,
            'cost' => str_replace('$', '', $request->cost),
        ]);

        return redirect()->route('site.project', $project->slug);
    }

    function delete_proposal($id) {
        Proposale::destroy($id);

        return redirect()->back(); 
    }

    function user_profile() {
        return view('site.user_profile');
    }

    function read_notify($id) {
        // dd(Auth::user()->notifications->find($id));
        // dd(DatabaseNotification::find($id));
        // DatabaseNotification::find($id)->update([
        //     'read_at' => now(),
        // ]);
        $notify = DatabaseNotification::find($id);
        $notify->markAsRead();

        return redirect($notify->data['url']);
    }
}
