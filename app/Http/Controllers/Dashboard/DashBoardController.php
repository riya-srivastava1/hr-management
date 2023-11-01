<?php

namespace App\Http\Controllers\Dashboard;

use DateTime;
use App\Models\User;
use App\Models\Leave;
use App\Models\Member;
use App\Models\Phase3;
use App\Models\Student;
use App\Models\PaidLeave;
use App\Models\SickLeave;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\EmployeeRecord;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Leave_request;
use App\Models\Mark_attendance;
use App\Models\Reimbursement_request;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    /**
     * @method
     * @param
     * @return
     */
    public function index()
    {
        $todaysinter = Student::whereDate('date', '=', (new DateTime)->format('Y-m-d'))->count();
        $ApperCandid = Member::count();
        $phase2 = Student::count();
        $phase3 = Phase3::count();
        $teamLead = EmployeeRecord::where('reporting_manager', Auth::user()->name)->get();
        $teamLead = Attendance::where('attendance_date', now()->format('Y-m-d'))->count();


        $leav = leave::where('leave_date', now()->format('Y-m-d'))->count();
        $sick = SickLeave::where('sick_leave_date', now()->format('Y-m-d'))->count();
        $paid = PaidLeave::where('paid_leave_date', now()->format('Y-m-d'))->count();
        $leaves = $leav + $sick + $paid;

        $totalleaves = EmployeeRecord::with('showA')->where('email', Auth::user()->email)->sum('total_leaves');
        $employees = EmployeeRecord::where('status', 'active')->count();
        $present = Attendance::where('attendance_date', now()->format('Y-m-d'))->count();

        //request section

        $reportingMan = EmployeeRecord::where('reporting_manager', Auth()->user()->name)->get('employee_name');


        $leaveReq = Leave_request::where('status' , 'Pending')->whereIn('requested_by', $reportingMan)->count();
        $markAttendance = Mark_attendance::where('status' , 'Pending')->whereIn('requested_by', $reportingMan)->count();
        $reimbursment = Reimbursement_request::where('status' , 'Pending')->whereIn('requested_by', $reportingMan)->count();

        $emp = EmployeeRecord::with('userAll')->where('email',Auth::user()->email)->first();
        $empAttendance = Attendance::with('employee')->where('attendance_date',$emp)->pluck('id')->count();

        return view('dashboard.home', compact(['empAttendance','reimbursment','markAttendance','leaveReq','ApperCandid', 'todaysinter', 'phase2', 'phase3', 'teamLead', 'employees', 'leaves', 'present', 'totalleaves']));
    }
    public function showAll()
    {
        $data = [];
        $AllEmp = Student::where('intstatus', 'Selected')->with('showI')->get();
        foreach ($AllEmp as $Emps) {
            foreach ($Emps['showI'] as $Emp) {
                $datas[] =    $Emp;
            }
        }
        return view('dashboard.SelectedEmployee', compact('datas'));
    }

    public function todaysInterview()
    {
        $data = [];
        $AllEmps = Student::whereDate('date', '=', (new DateTime)->format('Y-m-d'))->get();
        return view('dashboard.todaysInterview', compact('AllEmps'));
    }
    public function attendence()
    {
        $datas = Attendance::get();
        return view('dashboard.attendence', compact('datas'));
    }

    public function teamLead(Request $request)
    {
        $employes = EmployeeRecord::where('reporting_manager', Auth::user()->name)->with('getAttendace', 'getLeave', 'getSickLeave', 'getPaidLeave')->get();
        return view('dashboard.teamLead', compact('employes'));
    }
}
