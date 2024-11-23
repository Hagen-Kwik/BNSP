<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // reads Book
    public function index()
    {
        $books = Book::with('categories')->get();
        return view('books.index', compact('books'));
    }

    // create Book page
    public function create()
    {
        $categories = Category::all();
        $members = Member::all();
        return view('books.create', compact('categories', 'members'));
    }

    // create Book
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
        ]);

        $book = Book::create($request->only('title', 'author', 'member_id'));
        $book->categories()->sync($request->category_ids); // Sync categories

        return redirect()->route('books.index');
    }

    // update Book page
    public function edit(Book $book)
    {
        $categories = Category::all();
        $members = Member::all();
        return view('books.edit', compact('book', 'categories', 'members'));
    }

    // update Book 
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
        ]);

        $book->update($request->only('title', 'author', 'member_id'));
        $book->categories()->sync($request->category_ids);

        return redirect()->route('books.index');
    }

    // delete Book 
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}
