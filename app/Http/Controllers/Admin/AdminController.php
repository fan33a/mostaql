<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function freelancers(){
        $users = User::whereType('employee')->get();
        return view('admin.freelancers', compact('users'));
    }

    function freelancers_destroy($id) {
        User::destroy($id);

        return redirect()->back()->with('msg', 'Freelancer Deleted Successfully!')->with('type', 'danger');
    }
}
