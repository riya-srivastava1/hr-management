<?php

namespace App\Http\Controllers\Request;

use Illuminate\Http\Request;
use App\Models\EmployeeRecord;
use App\Models\Mark_attendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MarkAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->user()->role == 0) {
            $employees = EmployeeRecord::where('reporting_manager', Auth()->user()->name)->get('employee_name');
            $markApprovals = Mark_attendance::whereIn('requested_by', $employees)->orderBy('created_at', 'DESC')->get();
        } else {
            $markApprovals = Mark_attendance::orderBy('created_at', 'DESC')->get();
        }
        return view('request.mark-attendance.approval-mark-attendance', compact('markApprovals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $markAttendances = Mark_attendance::where('requested_by', Auth::user()->name)->orderBy('created_at', 'DESC')->get();
        return view('request.mark-attendance.create', compact('markAttendances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|max:15',
            'reason' => 'required|min:10',
        ]);
        $markAttendance = new Mark_attendance;
        $markAttendance->date = $request->date;
        $markAttendance->reason = $request->reason;
        $markAttendance->requested_by = Auth::user()->name;
        $markAttendance->save();
        return redirect()->back()->with(['success' => 'added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function approve(Request $request, $id)
    {
        $approve = Mark_attendance::findOrFail($id);
        $approve->status = 'approved';
        $approve->approved_by = Auth::user()->name;
        $approve->save();
        return redirect()->back()->with('success', 'Attendance request approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $reject = Mark_attendance::findOrFail($id);
        $reject->status = 'rejected';
        $reject->approved_by = Auth::user()->name;
        $reject->save();
        return redirect()->back()->with('success', 'Attendance request rejected successfully.');
    }
}
