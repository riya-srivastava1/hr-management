<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';


    public function employee()
    {
        return $this->belongsTo(EmployeeReord::class, 'id');
    }
}
