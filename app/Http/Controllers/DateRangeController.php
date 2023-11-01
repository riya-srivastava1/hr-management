<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\EmployeeRecord;

class DateRangeController extends Controller
{
    public function show(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if ($request->qualification == 'Screening Candidate') {
            $employees = EmployeeRecord::get(['id', 'employee_name']);
            $members = Member::orderBy('created_at', 'DESC')->whereBetween('created_at', [$fromDate, $toDate])->get();
            $birthdays = "";
            $attendances = "";
            return view('report_date_range', compact('employees', 'members', 'birthdays', 'attendances'));
        } elseif ($request->qualification == 'birthday') {
            $members = [];
            $employees = [];
            $attendances = [];
            $birthdays = EmployeeRecord::orderBy('created_at', 'DESC')->whereBetween('date_of_birth', [$fromDate, $toDate])->get();
            return view('report_date_range', compact('birthdays','members','employees','attendances'));
        } else {
            $employees = EmployeeRecord::get(['id', 'employee_name','designation']);
            $members = [];
            $birthdays = [];
            $attendances = EmployeeRecord::with([
                'AllAttendace' => function ($query) use ($fromDate,  $toDate) {
                    $query->whereBetween('attendance_date', [$fromDate,  $toDate]);
                },
                'AllLeave' => function ($query) use ($fromDate,  $toDate) {
                    $query->whereBetween('leave_date', [$fromDate,  $toDate]);
                },
                'AllPaidLeave' => function ($query) use ($fromDate,  $toDate) {
                    $query->whereBetween('paid_leave_date', [$fromDate,  $toDate]);
                },
                'AllSickLeave' => function ($query) use ($fromDate,  $toDate) {
                    $query->whereBetween('sick_leave_date', [$fromDate,  $toDate]);
                }
            ])
                ->where('id', $request->emp_id)
                ->get();
            return view('report_date_range', compact('employees', 'members', 'birthdays', 'attendances'));
        }
    }
    public function dateRange(){
        $employees = EmployeeRecord::get(['id', 'employee_name','designation']);
        return view('report_date_range',compact('employees'));
    }
}
