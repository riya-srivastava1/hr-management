<?php

namespace App\Exports;

use App\Models\Member;
use App\Models\postanddep;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPost implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $data = postanddep::with('getMember:id,fullname')->get(['id', 'title', 'department']);
        return $data;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Department',
            'Full Name',
        ];
    }








}
