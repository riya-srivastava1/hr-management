<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    // use SoftDeletes;

    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'id',
        'intmode',
        'inttype',
        'date',
        'intname',
        'intstatus',
        'reschedule',
        'rdate',
        'intlink',
        'feedback'
    ];

    public function showI(){
        return $this->belongsTo(Member::class,'id','id');

      }

}
