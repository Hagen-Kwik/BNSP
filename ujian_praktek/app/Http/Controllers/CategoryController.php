<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    // Display a listing of the categories
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('categories.create');
    }

    // Store a newly created category in the database
    // Store new category
    public function store(Request $request)
    {
        // Validate that category name is unique
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',  // Ensures no duplicate names
        ]);

        // Create new category
        Category::create($request->only('name'));

        // Redirect back to the categories list
        return redirect()->route('categories.index');
    }

    // Show the form for editing an existing category
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update the specified category in the database
    public function update(Request $request, Category $category)
    {
        // Validate that category name is unique, except for the current category
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,  // Ensures no duplicate names, except the current one
        ]);

        // Update the category
        $category->update($request->only('name'));

        // Redirect back to the categories list
        return redirect()->route('categories.index');
    }

    // Delete the specified category from the database
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
