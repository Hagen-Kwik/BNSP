<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display a list of the books
    public function index()
    {
        $books = Book::with('member', 'categories')->get();
        return view('books.index', compact('books'));
    }

    // Show the page for creating a new book
    public function create()
    {
        $categories = Category::all();
        $members = Member::all();
        return view('books.create', compact('categories', 'members'));
    }

    // Store a newly created book
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'member_id' => 'nullable|exists:members,id',
        ]);

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'member_id' => $request->member_id,
        ]);

        $book->categories()->sync($request->category_ids);

        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }

    // Show the page for editing an existing book
    public function edit(Book $book)
    {
        $categories = Category::all();
        $members = Member::all();
        return view('books.edit', compact('book', 'categories', 'members'));
    }

    // Update the specified book
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'member_id' => 'nullable|exists:members,id',
        ]);

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'member_id' => $request->member_id,
        ]);

        $book->categories()->sync($request->category_ids);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    // Delete the specified book
    public function destroy(Book $book)
    {
        $book->categories()->detach();
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
    
}
