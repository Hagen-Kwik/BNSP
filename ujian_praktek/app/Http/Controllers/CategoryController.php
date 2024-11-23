<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    // Display a list of the categories
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Show the page for creating a new category
    public function create()
    {
        return view('categories.create');
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name', 
        ]);

        Category::create($request->only('name'));
        return redirect()->route('categories.index');
    }

    // Show the page for editing an existing category
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update the specified category 
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,  // Ensures no duplicate names, except the current one
        ]);

        $category->update($request->only('name'));

        return redirect()->route('categories.index');
    }

    // Delete the specified category
    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category->books()->count() > 0) {
            return redirect()->route('categories.index')->with('error', "Category cannot be deleted as it is associated with one or more books.");
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', "Category deleted successfully.");
    }
}
