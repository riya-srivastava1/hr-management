<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use App\Models\Leave;
use App\Models\PaidLeave;
use App\Models\SickLeave;
use App\Models\Attendance;
use App\Models\ClockRecord;
use App\Models\Reimbursement_request;
use App\Models\Mark_attendance;
use Illuminate\Http\Request;
use App\Models\Leave_request;
use App\Models\EmployeeRecord;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendenceController extends Controller
{

    public function reason_view()
    {
        return view('attendance_change_reason.reason_view');
    }
    public function Leaves()
    {
        $employes = SickLeave::where('sick_leave_date', now()->format('Y-m-d'))->select('sick_leave_date')->get();
        return view('dashboard.allleave', compact('employes'))->with(['employes' => EmployeeRecord::all()]);
    }

    public function present()
    {
        $employes = Attendance::where('attendance_date', now()->format('Y-m-d'))->select('attendance_date')->get();
        return view('dashboard.present', compact('employes'))->with(['employes' => EmployeeRecord::all()]);
    }


    public function index()
    {
        $totalleaves = EmployeeRecord::with('showA')->where('email', Auth::user()->email)->sum('total_leaves');
        return view('attendance.attendence', compact('totalleaves'))->with(['employes' => EmployeeRecord::where('status', 'Active')->get()]);
    }

    public function sheetReport()
    {
        return view('dashboard.sheet-report')->with(['employes' => EmployeeRecord::all()]);
    }

    public function CheckStore(Request $request)
    {

        $attdArray = $request->input('attd');

        if (is_array($attdArray)) {
            foreach ($attdArray as $date => $employees) {

                foreach ($employees as $employeeId => $attributeValue) {
                    $attendance = Attendance::where('emp_id', $employeeId)
                        ->where('attendance_date', $date)
                        ->first();
                    if ($attendance) {
                        $attendance->delete();
                    }
                    $leave = Leave::where('emp_id', $employeeId)
                        ->where('leave_date', $date)
                        ->first();

                    if ($leave) {
                        $leave->delete();
                    }
                    $sickleave = SickLeave::where('emp_id', $employeeId)
                        ->where('sick_leave_date', $date)
                        ->first();
                    if ($sickleave) {
                        $sickleave->delete();
                    }
                    $paidleave = PaidLeave::where('emp_id', $employeeId)
                        ->where('paid_leave_date', $date)
                        ->first();
                    if ($paidleave) {
                        $paidleave->delete();
                    }
                    switch ($attributeValue) {
                        case 'P':
                            // Store the "Present" value in PresentTable
                            $presentData = new Attendance;
                            $presentData->emp_id = $employeeId;
                            $presentData->attendance_date = $date;
                            $presentData->attendance_change_reason = $request->reason ?? '';
                            $presentData->created_by = Auth::user()->name;
                            $presentData->save();

                            break;

                        case 'A':
                            // Store the "Absent" value in AbsentTable
                            $absentData = new Leave();
                            $absentData->emp_id = $employeeId;
                            $absentData->leave_date = $date;
                            $absentData->leave_change_reason = $request->reason ?? '';
                            $absentData->created_by = Auth::user()->name;
                            $absentData->save();

                            break;

                        case 'SL':
                            // Store the "Sick Leave" value in SickLeaveTable
                            $sickLeaveData = new SickLeave;
                            $sickLeaveData->emp_id = $employeeId;
                            $sickLeaveData->sick_leave_date = $date;
                            $sickLeaveData->sick_change_reason = $request->reason ?? '';
                            $sickLeaveData->created_by = Auth::user()->name;
                            $sickLeaveData->save();
                            break;

                        case 'PL':
                            // Store the "Paid Leave" value in PaidLeaveTable
                            $paidLeaveData = new PaidLeave;
                            $paidLeaveData->emp_id = $employeeId;
                            $paidLeaveData->paid_leave_date = $date;
                            $paidLeaveData->paid_change_reason = $request->reason ?? '';
                            $paidLeaveData->created_by = Auth::user()->name;
                            $paidLeaveData->save();
                            break;
                    }
                }
            }
        }
        return redirect()->back()->with('Success', 'You have successfully submited the attendance !');
    }

    public function attendance_reason(Request $request)
    {
        $attendance = Attendance::where('emp_id', $request->emp_id)
            ->where('attendance_date', $request->attendance_date)
            ->first();
        if ($attendance) {
            $attendance->delete();
        }
        $leave = Leave::where('emp_id', $request->emp_id)
            ->where('leave_date', $request->attendance_date)
            ->first();

        if ($leave) {
            $leave->delete();
        }
        $sickleave = SickLeave::where('emp_id', $request->emp_id)
            ->where('sick_leave_date', $request->attendance_date)
            ->first();
        if ($sickleave) {
            $sickleave->delete();
        }
        $paidleave = PaidLeave::where('emp_id', $request->emp_id)
            ->where('paid_leave_date', $request->attendance_date)
            ->first();
        if ($paidleave) {
            $paidleave->delete();
        }
        switch ($request->attendance_type) {
            case 'P':
                // Store the "Present" value in PresentTable
                $presentData = new Attendance;
                $presentData->emp_id = $request->emp_id;
                $presentData->attendance_date = $request->attendance_date;
                $presentData->attendance_change_reason = $request->reason ?? '';
                $presentData->created_by = Auth::user()->name;
                $presentData->save();

                break;

            case 'A':
                // Store the "Absent" value in AbsentTable
                $absentData = new Leave();
                $absentData->emp_id = $request->emp_id;
                $absentData->leave_date = $request->attendance_date;
                $absentData->leave_change_reason = $request->reason ?? '';
                $absentData->created_by = Auth::user()->name;
                $absentData->save();

                break;

            case 'SL':
                // Store the "Sick Leave" value in SickLeaveTable
                $sickLeaveData = new SickLeave;
                $sickLeaveData->emp_id = $request->emp_id;
                $sickLeaveData->sick_leave_date = $request->attendance_date;
                $sickLeaveData->sick_change_reason = $request->reason ?? '';
                $sickLeaveData->created_by = Auth::user()->name;
                $sickLeaveData->save();
                break;

            case 'PL':
                // Store the "Paid Leave" value in PaidLeaveTable
                $paidLeaveData = new PaidLeave;
                $paidLeaveData->emp_id = $request->emp_id;
                $paidLeaveData->paid_leave_date = $request->attendance_date;
                $paidLeaveData->paid_change_reason = $request->reason ?? '';
                $paidLeaveData->created_by = Auth::user()->name;
                $paidLeaveData->save();
                break;
        }

        return redirect()->back()->with('Success', 'You have successfully submited the attendance !');
    }
    public function teamLeadAttendence(Request $request)
    {
        if ($request->ajax()) {
            $leave = Leave::where('emp_id', $request->id)
                ->where('leave_date', now()->format('Y-m-d'))
                ->first();
            if ($leave) {
                $leave->delete();
            }
            $sickleave = SickLeave::where('emp_id', $request->id)
                ->where('sick_leave_date', now()->format('Y-m-d'))
                ->first();
            if ($sickleave) {
                $sickleave->delete();
            }
            $paidleave = PaidLeave::where('emp_id', $request->id)
                ->where('paid_leave_date', now()->format('Y-m-d'))
                ->first();
            if ($paidleave) {
                $paidleave->delete();
            }
            $attendance = new Attendance;
            $attendance->emp_id = $request->id;
            $attendance->attendance_date = now()->format('Y-m-d');
            $attendance->save();
            return response()->with('present');
        }
    }
    public function teamLeadLeave(Request $request)
    {
        if ($request->ajax()) {
            $attendance = Attendance::where('emp_id', $request->id)
                ->where('attendance_date', now()->format('Y-m-d'))
                ->first();
            if ($attendance) {
                $attendance->delete();
            }
            $sickleave = SickLeave::where('emp_id', $request->id)
                ->where('sick_leave_date', now()->format('Y-m-d'))
                ->first();
            if ($sickleave) {
                $sickleave->delete();
            }
            $paidleave = PaidLeave::where('emp_id', $request->id)
                ->where('paid_leave_date', now()->format('Y-m-d'))
                ->first();
            if ($paidleave) {
                $paidleave->delete();
            }
            $leave = new Leave;
            $leave->emp_id = $request->id;
            $leave->leave_date = now()->format('Y-m-d');
            $leave->save();
            return response()->with('Absent');
        }
    }
    public function teamLeadSickLeave(Request $request)
    {
        if ($request->ajax()) {
            $attendance = Attendance::where('emp_id', $request->id)
                ->where('attendance_date', now()->format('Y-m-d'))
                ->first();
            if ($attendance) {
                $attendance->delete();
            }
            $leave = Leave::where('emp_id', $request->id)
                ->where('leave_date', now()->format('Y-m-d'))
                ->first();
            if ($leave) {
                $leave->delete();
            }
            $paidleave = PaidLeave::where('emp_id', $request->id)
                ->where('paid_leave_date', now()->format('Y-m-d'))
                ->first();
            if ($paidleave) {
                $paidleave->delete();
            }
            $leave = new SickLeave;
            $leave->emp_id = $request->id;
            $leave->sick_leave_date = now()->format('Y-m-d');
            $leave->save();
            return response()->with('Sick Leave');
        }
    }
    public function teamLeadPaidLeave(Request $request)
    {

        if ($request->ajax()) {
            $attendance = Attendance::where('emp_id', $request->id)
                ->where('attendance_date', now()->format('Y-m-d'))
                ->first();
            if ($attendance) {
                $attendance->delete();
            }
            $leave = Leave::where('emp_id', $request->id)
                ->where('leave_date', now()->format('Y-m-d'))
                ->first();
            if ($leave) {
                $leave->delete();
            }
            $sickleave = SickLeave::where('emp_id', $request->id)
                ->where('sick_leave_date', now()->format('Y-m-d'))
                ->first();
            if ($sickleave) {
                $sickleave->delete();
            }
            $leave = new PaidLeave;
            $leave->emp_id = $request->id;
            $leave->paid_leave_date = now()->format('Y-m-d');
            $leave->save();
            return response()->with('Paid Leave');
        }
    }

    //for team lead
    public function Destroyattendence(Request $request)
    {
        $attendance = Attendance::where('emp_id', $request->id)
            ->where('attendance_date', now()->format('Y-m-d'))
            ->first();

        $attendance->delete();
    }
    public function DestroyLeave(Request $request)
    {
        $leave = Leave::where('emp_id', $request->id)
            ->where('leave_date', now()->format('Y-m-d'))
            ->first();

        $leave->delete();
    }
    public function DestroySickLeave(Request $request)
    {
        $leave = SickLeave::where('emp_id', $request->id)
            ->where('sick_leave_date', now()->format('Y-m-d'))
            ->first();

        $leave->delete();
    }
    public function DestroyPaidLeave(Request $request)
    {
        $leave = PaidLeave::where('emp_id', $request->id)
            ->where('paid_leave_date', now()->format('Y-m-d'))
            ->first();

        $leave->delete();
    }

    public function employee_attendance(Request $request)
    {
        $empEmail =  EmployeeRecord::where('email', Auth::user()->email)->pluck('email')->first();
        $user_id = User::where('email', $empEmail)->pluck('id')->first();

        $totalleaves = EmployeeRecord::with('showA')->where('email', Auth::user()->email)->sum('total_leaves');
        $employees = EmployeeRecord::with('showA', 'userAll')->where('email', $empEmail)->select('id', 'email', 'employee_name', 'designation')->get();

        $clockRecords = ClockRecord::where('user_id',  $user_id)->get();
        // $present = Attendance::where('attendance_date',$clockRecords)->count();
        $present = Attendance::count();
        $leave = Leave::count();
        $sickleave = SickLeave::count();
        $paidleave = PaidLeave::count();
        $sickpaid = $sickleave + $paidleave;
        $usedleaves = Leave_request::count();
        $timesheets = ClockRecord::all();
        return view('attendance.employee-attendance', compact('clockRecords', 'timesheets', 'leave', 'sickpaid', 'present', 'employees', 'totalleaves', 'usedleaves'))->with(['employes' => EmployeeRecord::where('status', 'Active')->get()]);
    }



    public function notification(Request $request)
    {
        if ($request->ajax()) {
            $leavescount = Leave_request::where('status', 'Pending')->count();
            $reimburscount = Reimbursement_request::where('status', 'Pending')->count();
            $markAttendancescount = Mark_attendance::where('status', 'Pending')->count();
            $total = $leavescount + $reimburscount + $markAttendancescount;
            return response()->json($total);
        }
    }
}
