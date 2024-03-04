<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name_en' => 'required',
        //     'name_ar' => 'required'
        // ]);

        $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required'
        ]);

        // Check if the name repeted or not
        $exists = Category::where('name', 'like', '%' . $request->name_en . '%')
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
        

        Category::create([
            'name' => $name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')->with('msg', 'Cateory Created Successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('Admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_en' => 'required|unique:categories,name',
            'name_ar' => 'required'
        ]);

        // return english name and arabic name as JSON format
        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ], JSON_UNESCAPED_UNICODE);
        

        $category->update([
            'name' => $name,
            // 'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')->with('msg', 'Cateory Updated Successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // $category is a object from Category class, have the category information
        $category->delete();

        return redirect()->route('admin.categories.index')->with('msg', 'Category deleted successfully')->with('type', 'danger');
    }
}
