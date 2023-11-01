<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MemberImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Member([
            'fullname' => $row[0] ?? '',
            'number' => $row[1] ?? '',
            'email' => $row[2] ?? '',
            'dob' => $row[3] ?? '',
            'date' => $row[4] ?? '',
            'corg' => $row[5] ?? '',
            'ectc' => $row[6] ?? '',
            'ctc' => $row[7] ?? '',
            'address' => $row[8] ?? '',
            'doc' => $row[9] ?? '',
        ]);
    }
}
