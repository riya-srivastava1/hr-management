<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\postanddep;
use App\Exports\ExportPost;
use Illuminate\Http\Request;
use App\Exports\ExportMember;
use App\Exports\ExportPhase2;
use App\Exports\ExportPhase3;
use App\Imports\MemberImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportEmployeeRecord;

class ExcelController extends Controller
{

    public function show()
    {
        return view('excel.excel_import');
    }

    public function excelviewpage(Request $request)
    {

       $request->file('accept_excel_format')->getClientOriginalName();

        try {
            Excel::import(new MemberImport, $request->file('accept_excel_format'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        return redirect()->back()->with(['success' => 'Imported Successfully']);
    }

    public function exportMembersToExcel()
    {
        return Excel::download(new ExportMember(), 'members.xlsx');
    }
    public function exportPost_dep()
    {

         $postanddeps = postanddep::with('getMember')->get(['id', 'title', 'department']);

        return Excel::download(new ExportPost(), 'postanddeps.xlsx');
    }
    public function exportPhase2()
    {
        return Excel::download(new ExportPhase2(), 'students.xlsx');
    }
    public function exportPhase3()
    {
        return Excel::download(new ExportPhase3(), 'phase3s.xlsx');
    }
    public function exportEmployeeRecord()
    {
        return Excel::download(new ExportEmployeeRecord(), 'employee-record.xlsx');
    }
}
