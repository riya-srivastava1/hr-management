<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeRecord extends Model
{
    // use SoftDeletes;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_name',
        'qualification',
        'employment_type',
        'ctc',
        'total_leaves',
        'date_of_birth',
        'address',
        'aadhar_no',
        'pan_no',
        'employment_code',
        'contact_no',
        'email',
        'status',
        'departname',
        'designation',
        'date_of_joining',
        'location',
        'reporting_manager',
        'shift',
        'blood_group',
        'account_no',
        'bank_name',
        'ifsc',
        'uan',
    ];

    public function showA()
    {
        return $this->hasOne(Member::class, 'id', 'id');
    }
    public function getAttendace()
    {
        return $this->belongsTo(Attendance::class, 'id', 'emp_id')->where('attendance_date', now()->format('Y-m-d'));
    }
    public function getLeave()
    {
        return $this->belongsTo(Leave::class, 'id', 'emp_id')->where('leave_date', now()->format('Y-m-d'));
    }
    public function getSickLeave()
    {
        return $this->belongsTo(SickLeave::class, 'id', 'emp_id')->where('sick_leave_date', now()->format('Y-m-d'));
    }
    public function getPaidLeave()
    {
        return $this->belongsTo(PaidLeave::class, 'id', 'emp_id')->where('paid_leave_date', now()->format('Y-m-d'));
    }

    public function getMonthlyAttendance($month, $year)
    {
        // return $month;
        // return $this->belongsTo(Attendance::class, 'id');
    }

    public function AllAttendace()
    {
        return $this->hasMany(Attendance::class, 'emp_id', 'id');
    }
    public function AllLeave()
    {
        return $this->hasMany(Leave::class, 'emp_id', 'id');
    }
    public function AllPaidLeave()
    {
        return $this->hasMany(PaidLeave::class, 'emp_id',  'id');
    }
    public function AllSickLeave()
    {
        return $this->hasMany(SickLeave::class, 'emp_id', 'id');
    }
    public function userAll()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
