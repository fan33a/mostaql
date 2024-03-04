<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $request->validate([
            'name_en' => 'required|unique:categories,name',
            'name_ar' => 'required'
        ]);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
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
