<?php

namespace App\Exports;

use App\Models\Phase3;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPhase3 implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Phase3::all();
    }
    public function headings(): array
    {
        // Replace these headings with your desired field titles
        return [
            'Candidate Name',
            'HR Round',
            'Background Verification',
            'Offer Letter',
            'CTC(As mentioned in the offer letter)',
            'Date of Joining',
            'Reporting Manager',
        ];
    }
}
