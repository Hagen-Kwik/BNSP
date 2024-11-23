<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:members,name|max:255', 
        ]);

        Member::create([
            'name' => $request->name,
        ]);

        return redirect()->route('members.index')->with('success', 'Member created successfully!');
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|unique:members,name,' . $member->id . '|max:255', 
        ]);

        $member->update([
            'name' => $request->name,
        ]);

        return redirect()->route('members.index')->with('success', 'Member updated successfully!');
    }

    public function destroy($id)
    {
        $member = Member::find($id);

        if ($member->books()->count() > 0) {
            return redirect()->route('members.index')->with('error', "Member cannot be deleted as they are associated with one or more books.");
        }

        $member->delete();

        return redirect()->route('members.index')->with('success', "Member deleted successfully.");
    }
}
