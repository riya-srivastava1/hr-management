<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportMember implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Member::select('fullname','number','email','dob','corg','ectc','ctc','address','doc','message')->orderBy('created_at','DESC')->get();
    }
    public function headings(): array
    {
        // Replace these headings with your desired field titles
        return [
            'Full Name',
            'Member Number',
            'Email Address',
            'Date of Birth',
            'Current Orgnization',
            'Expected CTC',
            'Current CTC',
            'Address',
            'Resume',
            'Additional Information'
        ];
    }
}
