<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phase3 extends Model
{
    use HasFactory;
    protected $table = 'phase3s';
    protected $fillable = [
        'id',
        'hrround',
        'bgv',
        'offerletter',
        'ctc',
        'jdate',
        'repomanager'
    ];
    public function getPhase3()
    {
        return $this->belongsTo(Member::class,'member_id','id');
    }

}
