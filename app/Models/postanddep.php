<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class postanddep extends Model
{
    // use SoftDeletes;

    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'department'
    ];
    public function getMember()
    {
        return $this->belongsTo(Member::class,'id','id');
    }

}

