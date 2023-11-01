<?php

namespace App\Exports;

use App\Models\EmployeeRecord;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportEmployeeRecord implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return EmployeeRecord::select('employee_name', 'qualification', 'employment_type', 'photo', 'ctc', 'total_leaves', 'date_of_birth', 'address', 'aadhar_no', 'pan_no', 'employment_code', 'contact_no', 'email', 'status', 'departname', 'designation', 'date_of_joining', 'location', 'reporting_manager', 'shift', 'blood_group', 'account_no', 'bank_name', 'ifsc', 'uan')->get();
    }
    public function headings(): array
    {
        // Replace these headings with your desired field titles
        return [
            'Employee Name',
            'Highest Qualification',
            'Employement Typee',
            'photo',
            'CTC',
            'Total leaves',
            'Date Of Birth',
            'Address',
            'Aadhar Number',
            'Pan Number',
            'Employee Code',
            'Contact Number',
            'Official Email Id',
            'Status',
            'Department Name',
            'Designation',
            'Date Of Joining',
            'Work Location',
            'Reporting Manager ',
            'Shift',
            'Blood Group',
            'Account Number',
            'Bank Name',
            'IFSC Code',
            'UAN Number (if Exist)',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
