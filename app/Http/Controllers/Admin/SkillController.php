<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::latest('id')->paginate(10);

        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skills.create');
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
        $exists = Skill::where('name', 'like', '%' . $request->name_en . '%')
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
        

        Skill::create([
            'name' => $name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.skills.index')->with('msg', 'Skill Created Successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name_en' => 'required|unique:skills,name',
            'name_ar' => 'required'
        ]);

        // return english name and arabic name as JSON format
        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ], JSON_UNESCAPED_UNICODE);
        

        $skill->update([
            'name' => $name,
            // 'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.skills.index')->with('msg', 'Cateory Updated Successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        // $skill is a object from skill class, have the skill information
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('msg', 'skill deleted successfully')->with('type', 'danger');
    }
}
