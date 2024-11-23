<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // reads Category
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // create category page
    public function create()
    {
        return view('categories.create');
    }

    // create category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index');
    }

    // update category page
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // update category 
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    // delete category 
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
