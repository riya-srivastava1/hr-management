<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    /**
     *@method
     *@param
     *@return
     */
    function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|unique:students',
            'intmode' => 'required|not_in:0',
            'inttype' => 'required|not_in:0',
            'date' => 'required',
            'intname' => 'required|max:10',
            'intstatus' => 'required|not_in:0',
            'feedback' => 'max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        $student = new Student;
        $student->id = $request->id;
        $student->intmode = $request->intmode;
        $student->inttype = $request->inttype;
        $student->date = $request->date;
        $student->intname = $request->intname;
        $student->intstatus = $request->intstatus;
        $student->reschedule = $request->reschedule;
        $student->rdate = $request->rdate;
        $student->intlink = $request->intlink;
        $student->feedback = $request->feedback;
        $student->created_by = Auth::user()->name;
        $student->save();
        return redirect()->back()->with(['success' => "User Registered Successfully !!"]);
    }

    /**
     *@method
     *@param
     *@return
     */
    public function showPhase2From()
    {

        $members = Member::all();
        return view('phase_2.create', compact('members'));
    }

    /**
     *@method
     *@param
     *@return
     */
    public function showPhase3From()
    {
        $members = Member::all();
        return view('phase_3.create', compact('members'));
    }
    public function userlist()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('userlist', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('editUsers', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->input('role');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
