<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use App\Models\PaidLeave;
use App\Models\SickLeave;
use App\Models\Attendance;
use App\Models\ClockRecord;
use Illuminate\Http\Request;
use App\Models\Leave_request;
use App\Models\EmployeeRecord;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendenceMonthController extends Controller
{
    public function attendance_month()
    {

        $months = [];

        // Get the current year
        $year = date('Y');

        // Generate the months array for the current year
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 1, $year));
        }
        return view('month_sheet.attendance_month',  compact('months', 'year'));
    }

    public function yearlyAttendance($month, $year)
    {
        $month1 = date('m', strtotime($month)); // Assuming you are retrieving the month from the frontend
        $year1 = $year;
        // Get the current year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // // Generate an array of dates in the current month
        $dates = [];
        $daysInMonth = Carbon::now()->daysInMonth;
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dates[] = Carbon::createFromDate($currentYear, $currentMonth, $i)->format('d-m-Y');
        }
        // Get all employees (this is just a sample data)

        $employees = EmployeeRecord::with(['AllAttendace' => function ($query) use ($month1, $year1) {
            $query->whereYear('attendance_date', $year1)
                ->whereMonth('attendance_date', $month1);
        }, 'AllLeave' => function ($query) use ($month1, $year1) {
            $query->whereYear('leave_date', $year1)
                ->whereMonth('leave_date', $month1);
        }, 'AllSickLeave' => function ($query) use ($month1, $year1) {
            $query->whereYear('sick_leave_date', $year1)
                ->whereMonth('sick_leave_date', $month1);
        }, 'AllPaidLeave' => function ($query) use ($month1, $year1) {
            $query->whereYear('paid_leave_date', $year1)
                ->whereMonth('paid_leave_date', $month1);
        }])->get();

        // Pass the dates and employees arrays to the view
        return view('month_sheet.yearly', compact('dates', 'employees', 'month1', 'year1'));
    }


    public function employee_attendance()
    {
        return view('month_sheet.yearly');
    }

    public function attendance_log(Request $request, $id)
    {
        $present = Attendance::count();
        $leave = Leave::count();
        $sickleave = SickLeave::count();
        $paidleave = PaidLeave::count();
        $sickpaid = $sickleave + $paidleave;
        $usedleaves = Leave_request::count();
        $timesheets = ClockRecord::all();
        $employees = EmployeeRecord::with('showA', 'userAll')->where('id', $id)->get();
        $totalleaves = EmployeeRecord::with('showA')->where('email', Auth::user()->email)->sum('total_leaves');
        $empEmail =  EmployeeRecord::where('id',$id)->pluck('email')->first();
        $user_id = User::where('email',$empEmail)->pluck('id')->first();

        $clockRecords = ClockRecord::where('user_id',  $user_id)->get();
        return view('attendance.attendance-log', compact('clockRecords', 'timesheets', 'leave', 'sickpaid', 'present', 'employees', 'totalleaves', 'usedleaves'))->with(['employes' => EmployeeRecord::where('status', 'Active')->get()]);
    }
}
