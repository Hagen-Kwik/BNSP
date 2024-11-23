<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //read Member
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    // create member page
    public function create()
    {
        return view('members.create');
    }

    // create member
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        Member::create($request->all());
        return redirect()->route('members.index');
    }

    // update member page
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    // update member
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $member->update($request->all());
        return redirect()->route('members.index');
    }

    // delete member 
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index');
    }
}
