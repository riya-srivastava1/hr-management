<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaidLeave extends Model
{

    public function employee()
    {
        return $this->belongsTo(EmployeeReord::class, 'id');
    }
}
