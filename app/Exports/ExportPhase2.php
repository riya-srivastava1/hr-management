<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPhase2 implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::all();
    }
    public function headings(): array
    {
        // Replace these headings with your desired field titles
        return [
            'Candidate Name',
            'Interview Mode',
            'Interview Type',
            'Interview Date',
            'Interviewers Name ',
            'Interview Status',
            'Reschedule',
            'Interview Link',
            'Feedback From Interviwer',
        ];
    }
}
