<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    // use SoftDeletes;

    use HasFactory;

    protected $fillable = [
        'fullname',
        'number',
        'email',
        'dob',
        'corg',
        'ectc',
        'ctc',
        'address',
        'doc',
        'message',
        'accept_excel_format'
    ];

    // public $timestamps = false;

    public function members()
    {
        return $this->hasMany(postanddep::class,'id','id');
    }
}
