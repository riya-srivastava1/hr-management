<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Phase3Controller;
use App\Http\Controllers\CentralController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DashBoardController;
use App\Http\Controllers\Dashboard\AttendenceController;
use App\Http\Controllers\Dashboard\EmployeeRecordController;
use App\Http\Controllers\Dashboard\AttendenceMonthController;
use App\Http\Controllers\DateRangeController;
use App\Http\Controllers\Holiday\HolidayController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Request\HalfDayController;
use App\Http\Controllers\Request\LeaveRequestController;
use App\Http\Controllers\Request\MarkAttendanceController;
use App\Http\Controllers\Request\ReimbursementController;
use App\Providers\AppServiceProvider;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
// |
*/

Route::group(['middleware' => 'UserCheck'], function () {

    //profile Route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Employee Route
    Route::resource('/dashboard/employee', EmployeeRecordController::class);

    //Interview Phase 1 Candidate
    Route::get('/viewdetail', [CentralController::class, 'showviewdetail'])->name('viewdetail');
    Route::get('/viewdetail/{id}', [CentralController::class, 'viewpage'])->name('viewpage');
    Route::get('/interview1', [CentralController::class, 'interview1'])->name('interview1');
   // Route::get('/edit/{id}', [CentralController::class, 'showData']);
     Route::get('phase1/edit/{id}', [CentralController::class, 'edit']);
    Route::get('/interview/delete/{id}', [CentralController::class, 'delete']);
    Route::post('/edit', [CentralController::class, 'update'])->name('edit');


    //Interview Phase 2 post and department
    Route::post('/member', [CentralController::class, 'insert'])->name('member');
    Route::get('/dep', [CentralController::class, 'dep'])->name('dep');
    Route::post('/postanddep', [CentralController::class, 'insert2'])->name('postanddep');
    Route::get('/viewdetail2', [CentralController::class, 'showviewdetail2'])->name('viewdetail2');
    Route::get('/viewdetail2/{id}', [CentralController::class, 'viewpage2']);
    Route::get('/edit2', [CentralController::class, 'edit2'])->name('edit2');
    Route::get('/edit2/{id}', [CentralController::class, 'showData2']);
    Route::get('/interview/delete2/{id}', [CentralController::class, 'delete2']);
    Route::post('/edit2', [CentralController::class, 'update2']);

    //Interview Phase 2 Controller
    Route::get('/templist', [MemberController::class, 'showtemplist'])->name('templist');
    Route::get('/phase2form', [UserController::class, 'showPhase2From'])->name('phase2form');
    Route::post('/phase2form', [UserController::class, 'insert']);
    Route::get('/view1/{id}', [MemberController::class, 'show'])->name('view1');
    Route::get('/update1/{id}', [MemberController::class, 'showdata']);
    Route::post('/update', [UserController::class, 'update'])->name('update');
    Route::get('/delete1/{id}', [MemberController::class, 'delete'])->name('delete1');
    Route::post('/update1/{id}', [MemberController::class, 'update'])->name('update1');
    /************************************************************************************************* */

    // Route for interview phase 3
    /************************************************************************************************* */

    Route::post('/phase3form', [Phase3Controller::class, 'pthree'])->name('phase3form');
    Route::get('/phase3form', [UserController::class, 'showPhase3From']);
    Route::get('/phase3', [Phase3Controller::class, 'showphase3'])->name('phase3');
    Route::get('/view/{id}', [Phase3Controller::class, 'show'])->name('view');
    Route::get('/update2/{id}', [Phase3Controller::class, 'showdata']);
    Route::get('/delete/{id}', [Phase3Controller::class, 'delete'])->name('delete');
    Route::post('/update2/{id}', [Phase3Controller::class, 'update'])->name('update2');


    Route::get('/status1/{id}', [EmployeeRecordController::class, 'changeStatus'])->name('status.employee');
    Route::get('/search/phase/3', [Phase3Controller::class, 'searchPhase'])->name('search.phase3');
    Route::get('/search/phase', [Phase3Controller::class, 'showall'])->name('searchPhase3');
    Route::get('/search', [EmployeeRecordController::class, 'search'])->name('search');
    Route::get('/search/emp', [EmployeeRecordController::class, 'showall'])->name('emp.search');

    Route::get('/search/phase/1', [CentralController::class, 'search'])->name('search.phase.one');
    Route::get('/search/phase1', [CentralController::class, 'searchAll'])->name('search.phase1');

    Route::get('/search/phase/2', [MemberController::class, 'search'])->name('phase2.search');
    Route::get('/search/phase2', [MemberController::class, 'searchAll'])->name('phase2.search2');
    Route::get('/search/phase1/post', [CentralController::class, 'searchPost'])->name('post.dep.search');
    Route::get('/search/phase1/All', [CentralController::class, 'searchAllPost'])->name('post.search2');

    //   detail by id of every create page
    Route::get('/emp/detail', [EmployeeRecordController::class, 'empDetail'])->name('detail');
    Route::get('/AllEmployee', [DashBoardController::class, 'showAll'])->name('AllEmployee');
    Route::get('/ActiveEmployee', [DashBoardController::class, 'showActive'])->name('ActiveEmployee');
    Route::get('/InActiveEmployee', [DashBoardController::class, 'showInActive'])->name('InActiveEmployee');
    Route::get('/InterviewCand', [DashBoardController::class, 'showCandid'])->name('InterviewCand');
    Route::get('/employee-list', [EmployeeRecordController::class, 'employeeList'])->name('employee.list');


    Route::get('/leave', [DashBoardController::class, 'leave'])->name('leave');
    Route::get('/leaves', [AttendenceController::class, 'leaves'])->name('leaves');
    Route::get('/leave', [AttendenceController::class, 'leave'])->name('leave');
    Route::get('/present', [AttendenceController::class, 'present'])->name('present');
    Route::get('/attendence', [AttendenceController::class, 'index'])->name('attendence');
    Route::get('/sheet-report', [DashBoardController::class, 'sheetReport'])->name('sheet-report');
    Route::get('/todaysInterview', [DashBoardController::class, 'todaysInterview'])->name('todaysInterview');
    Route::get('/sheet-report', [AttendenceController::class, 'sheetReport'])->name('sheet-report');


    //userListing
    Route::get('/userlist', [UserController::class, 'userlist'])->name('userlist');
    Route::get('/status/{id}', [CentralController::class, 'changeStatus'])->name('user.status');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('update-profile/{id}', [UserController::class, 'update'])->name('users.update');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    //Attendances
    Route::get('/attendance_log/{id}', [AttendenceMonthController::class, 'attendance_log'])->name('attendance.log');
    Route::get('/attendance/view', [AttendenceMonthController::class, 'attendanceView'])->name('attendance.view');
    Route::get('/attendance_month', [AttendenceMonthController::class, 'attendance_month'])->name('attendance.month');
    Route::get('/attendance/yearly/{month}/{year}',  [AttendenceMonthController::class, 'yearlyAttendance'])->name('yearly.attendance');
    Route::get('/attendance/employee/{id}',  [AttendenceMonthController::class, 'employee_attendance'])->name('attendance.employee');
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
    Route::get('/teamLead', [DashBoardController::class, 'teamLead'])->name('teamLead');

    //TL Attendence
    Route::get('/tlattendence', [AttendenceController::class, 'teamLeadAttendence']);
    Route::get('/leave', [AttendenceController::class, 'teamLeadLeave']);
    Route::get('/sickleave', [AttendenceController::class, 'teamLeadSickLeave']);
    Route::get('/paidleave', [AttendenceController::class, 'teamLeadPaidLeave']);
    Route::get('/employee/attendance', [AttendenceController::class, 'employee_attendance'])->name('employee.attendance');

    //TL attendence Delete
    Route::get('/attendencedelete', [AttendenceController::class, 'Destroyattendence']);
    Route::get('/leavedelete', [AttendenceController::class, 'DestroyLeave']);
    Route::get('/sickleavedelete', [AttendenceController::class, 'DestroySickLeave']);
    Route::get('/paidleavedelete', [AttendenceController::class, 'DestroyPaidLeave']);

    // attendence delete
    Route::post('/check-store', [AttendenceController::class, 'CheckStore'])->name('check_store');
    Route::post('/today_attendance', [AttendenceController::class, 'today_attendance'])->name('today_attendance');
    Route::get('/presentdel', [AttendenceController::class, 'attendencedelete']);
    Route::get('/leavedel', [AttendenceController::class, 'Leavedelete']);
    Route::get('/SickLeavedel', [AttendenceController::class, 'SickLeavedelete']);
    Route::get('/PaidLeavedel', [AttendenceController::class, 'PaidLeavedelete']);

    //Excel Sheet
    Route::get('/excel_import', [ExcelController::class, 'show']);
    Route::post('/excel_import', [ExcelController::class, 'excelviewpage'])->name('excel.import');
    Route::post('/attendance-reason', [AttendenceController::class, 'attendance_reason'])->name('attendance-reason');
    Route::get('/reason_view', [AttendenceController::class, 'reason_view'])->name('reason_view');
    Route::get('/export/candidate', [ExcelController::class, 'exportMembersToExcel'])->name('export.candidate');
    Route::get('/export/post/dep', [ExcelController::class, 'exportPost_dep'])->name('export.post.dep');
    Route::get('/export/phase2', [ExcelController::class, 'exportPhase2'])->name('export.phase2');
    Route::get('/export/phase3', [ExcelController::class, 'exportPhase3'])->name('export.phase3');
    Route::get('/export/employee/record', [ExcelController::class, 'exportEmployeeRecord'])->name('export.employee.record');

    //clock Management
    Route::get('/clock-in', [ClockController::class, 'clockIn'])->name('clock.in');
    Route::get('/clock-out', [ClockController::class, 'clockOut'])->name('clock.out');
    Route::get('/clock-timesheet', [ClockController::class, 'timeSheet'])->name('clock.timesheet');
    Route::get('/clock/reset', [ClockController::class, 'resetClockOut'])->name('reset.clock.out');


    //request section
    Route::resource('/request/leave', LeaveRequestController::class);
    Route::resource('/request/mark', MarkAttendanceController::class);
    Route::resource('/request/reimbursement', ReimbursementController::class);

    Route::get('/leave-requests/approve/{id}', [LeaveRequestController::class, 'approve'])->name('leave-requests.approve');
    Route::get('/leave-requests/reject/{id}', [LeaveRequestController::class, 'reject'])->name('leave-requests.reject');

    Route::get('/mark-requests/approve/{id}', [MarkAttendanceController::class, 'approve'])->name('mark-requests.approve');
    Route::get('/mark-requests/reject/{id}', [MarkAttendanceController::class, 'reject'])->name('mark-requests.reject');

    Route::get('/reimbursement-requests/approve/{id}', [ReimbursementController::class, 'approve'])->name('reimbursement-requests.approve');
    Route::get('/reimbursement-requests/reject/{id}', [ReimbursementController::class, 'reject'])->name('reimbursement-requests.reject');

    //HOLIDAY
    Route::resource('/holiday', HolidayController::class);
    Route::post('/leave/notify', [NotificationController::class, 'notify'])->name('leave.notify');
    Route::post('/increment/count', [AttendenceController::class, 'notification'])->name('count.increment');

    //reporting with date range
    Route::get('date/range', [DateRangeController::class, 'dateRange'])->name('date.range');
    Route::post('date/range', [DateRangeController::class, 'show']);
    Route::post('delete/all/candidate', [CentralController::class, 'deleteAllCandidate'])->name('delete.all.candidate');
});
