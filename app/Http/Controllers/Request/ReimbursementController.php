<?php

namespace App\Http\Controllers\Request;

use Illuminate\Http\Request;
use App\Models\EmployeeRecord;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Reimbursement_request;

class ReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->user()->role == 0) {
            $employees = EmployeeRecord::where('reporting_manager', Auth()->user()->name)->get('employee_name');
            $reimbursments = Reimbursement_request::whereIn('requested_by', $employees)->orderBy('created_at', 'DESC')->get();
        } else {
            $reimbursments = Reimbursement_request::orderBy('created_at', 'DESC')->get();
        }
        return view('request.reimbursement.approval-reimbursement',compact('reimbursments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reimbursments = Reimbursement_request::orderBy('created_at', 'DESC')->get();
        return view('request.reimbursement.create',compact('reimbursments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'request_date' => 'required',
            'expense_month' => 'required',
            'expense_category' => 'required',
            'amount' => 'required',
        ]);
        $reimbursement = new Reimbursement_request;
        $reimbursement->request_date = $request->request_date;
        $reimbursement->expense_month = $request->expense_month;
        $reimbursement->expense_category = $request->expense_category;
        $reimbursement->expense_description = $request->expense_description;
        $reimbursement->amount = $request->amount;
        $reimbursement->support_documents = $request->support_documents;
        $reimbursement->payment_status = $request->payment_status;
        $reimbursement->requested_by = Auth::user()->name;
        $reimbursement->save();
        return redirect()->back()->with(['success' => 'Added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function approve(Request $request,$id)
    {
        $approve = Reimbursement_request::findOrFail($id);
        $approve->status = 'approved';
        $approve->approved_by = Auth::user()->name;
        $approve->save();
        return redirect()->back()->with('success', 'Reimbursement request approved successfully.');
    }

    public function reject(Request $request,$id)
    {
        $reject = Reimbursement_request::findOrFail($id);
        $reject->status = 'rejected';
        $reject->approved_by = Auth::user()->name;
        $reject->save();
        return redirect()->back()->with('success', 'Reimbursement request rejected successfully.');
    }
}
