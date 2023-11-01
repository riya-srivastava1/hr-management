<?php

namespace App\Http\Controllers\Request;

use Illuminate\Http\Request;
use App\Models\Leave_request;
use App\Http\Controllers\Controller;
use App\Models\EmployeeRecord;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
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
            $leaveApprovals = Leave_request::whereIn('requested_by', $employees)->orderBy('created_at', 'DESC')->get();
        } else {
            $leaveApprovals = Leave_request::orderBy('created_at', 'DESC')->get();
        }
        return view('request.leave-request.hr-leave-approval', compact('leaveApprovals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leaveRequests = Leave_request::where('requested_by', Auth::user()->name)->orderBy('created_at', 'DESC')->get();
        $employee = EmployeeRecord::all();
        return view('request.leave-request.create', compact('leaveRequests', 'employee'));
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
            'reason' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        try {
            $leaveRequest = new Leave_request;
            $leaveRequest->start_date = $request->start_date;
            $leaveRequest->end_date = $request->end_date;
            $leaveRequest->reason = $request->reason;
            $leaveRequest->leave_type = $request->leave_type;
            $leaveRequest->requested_by = Auth::user()->name;
            $leaveRequest->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => "Something Went Wrong"]);
        }
        return redirect()->back()->with(['success' => 'Added Successfully']);
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
        $approve = Leave_request::findOrFail($id);
        $approve->status = 'approved';
        $approve->approved_by = Auth::user()->name;
        $approve->save();
        return redirect()->back()->with('success', 'Leave request approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $reject = Leave_request::findOrFail($id);
        $reject->status = 'rejected';
        $reject->approved_by = Auth::user()->name;
        $reject->save();
        return redirect()->back()->with('success', 'Leave request rejected successfully.');
    }
}
