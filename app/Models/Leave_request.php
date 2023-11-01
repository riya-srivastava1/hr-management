<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave_request extends Model
{
    use HasFactory;
    protected $fillable = ([
        'start-date',
        'end-date',
        'requested_by',
        'reason',
        'status',
    ]);
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
