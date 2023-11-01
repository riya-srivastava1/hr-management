<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\EmployeeRecord;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\Leave_request;
use Illuminate\Support\Facades\Auth;

class EmployeeRecordController extends Controller
{

    public function __construct(EmployeeRecord $employee)
    {
        // $this->EmployeeRecord = $employee;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if (Auth::user()->role == 1) {
        //     $itemsPerPage = $request->query('itemsPerPage', 10);
        //     $employes = EmployeeRecord::orderBy('created_at', 'DESC')->paginate($itemsPerPage);
        //     return view('dashboard.EmployeeRecord.index', compact('employes', 'itemsPerPage'));
        // } else {
        //     return redirect()->back()->with(['error' => 'You are not authorized to access this page']);
        // }


        if (Auth::user()->role == 1) {
            $itemsPerPage = $request->query('itemsPerPage', 10);
            $employes = EmployeeRecord::orderBy('created_at', 'DESC')->paginate($itemsPerPage);
            foreach ($employes as $employee) {
                $attdCount = Leave_request::where(['requested_by' => $employee->employee_name, 'status' => 'Approved'])->count();

                if (isset($employee->taken_leaves) && isset($employee->total_leaves)) {
                    $employee->taken_leaves += $attdCount;
                    $employee->available_leaves = $employee->total_leaves - $employee->taken_leaves;
                } else {
                    $employee->available_leaves = null;
                }
            }
            return view('dashboard.EmployeeRecord.index', compact('employes', 'itemsPerPage'));
        } else {
            return redirect()->back()->with(['error' => 'You are not authorized to access this page']);
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', '==', '0')->Select('name')->get();
        $members = Member::all();
        return view('dashboard.EmployeeRecord.create', compact('members', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $employee = new EmployeeRecord;
            // $employee->id = $request->cand_id;
            $employee->employee_name = $request->employee_name;
            $employee->qualification = $request->qualification;
            $employee->email = $request->email;
            $employee->total_leaves = $request->total_leaves;
            $employee->taken_leaves = $request->taken_leaves;
            $employee->employment_type = $request->Emptype;
            $employee->ctc = $request->ctc;
            $employee->date_of_birth = $request->dob;
            $employee->address = $request->address;
            if ($request->hasFile('Aadhar_no')) {
                $Aadhar_no = date('ymdHis') . '-' . $request->file('Aadhar_no')->GetClientOriginalName();
                $request->Aadhar_no->move('Aadhar_no/', $Aadhar_no);

                $employee->Aadhar_no = $Aadhar_no;
            }
            if ($request->hasFile('pan_no')) {
                $pan_no = date('ymdHis') . '-' . $request->file('pan_no')->GetClientOriginalName();
                $request->pan_no->move('pan_no/', $pan_no);

                $employee->pan_no = $pan_no;
            }
            if ($request->hasFile('photo')) {
                $photo = date('ymdHis') . '-' . $request->file('photo')->GetClientOriginalName();
                $request->photo->move('photo/', $photo);

                $employee->photo = $photo;
            }
            $employee->employment_code = $request->employment_code;
            $employee->contact_no = $request->contact_no;
            $employee->departname = $request->departname;
            $employee->designation = $request->designation;
            $employee->date_of_joining = $request->doj;
            $employee->location = $request->location;
            $employee->reporting_manager = $request->reportman;
            $employee->shift = $request->shift;
            $employee->blood_group = $request->Bgroup;
            $employee->account_no = $request->account_no;
            $employee->bank_name = $request->bank;
            $employee->ifsc = $request->ifsc;
            $employee->uan = $request->uan;
            // return $employee;
            $employee->save();
        } catch (\Throwable $th) {

            return redirect()->back()->with(['error' => "Something Went Wrong"]);
        }
        return redirect()->back()->with(['success' => "Empployee Record  Created Successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {

        if ($id === "show") {
            $employe = EmployeeRecord::with('showA')->where('email', Auth::user()->email)->first();
            $attdCount = Leave_request::where(['requested_by' => $employe->employee_name, 'status' => 'Approved'])->count();
            $employe->taken_leaves =  $employe->taken_leaves + $attdCount;
            $employe->avilable_leaves = $employe->total_leaves - $employe->taken_leaves;
        } else {
            $employe = EmployeeRecord::with('showA')->where('id', $id)->first();

            $attdCount = Leave_request::where(['requested_by' => $employe->employee_name, 'status' => 'Approved'])->count();
            $employe->taken_leaves =  $employe->taken_leaves + $attdCount;
            $employe->avilable_leaves = $employe->total_leaves - $employe->taken_leaves;
            // return $employe;

        }
        return view('dashboard.EmployeeRecord.view', compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = EmployeeRecord::with('showA')->where('id', $id)->first();
        $users = User::where('role', '==', '0')->Select('name')->get();

        $attdCount = Leave_request::where(['requested_by' => $employee->employee_name, 'status' => 'Approved'])->count();
        $employee->taken_leaves =  $employee->taken_leaves + $attdCount;
        return view('dashboard.EmployeeRecord.edit', compact('employee', 'users'));
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
        try {
            $employee = EmployeeRecord::where('id', $id)->first();
            $employee->employee_name = $request->employee_name;
            $employee->qualification = $request->qualification;
            $employee->email = $request->email;
            $employee->total_leaves = $request->total_leaves;
            $employee->taken_leaves = $request->taken_leaves;
            $employee->employment_type = $request->Emptype;
            $employee->ctc = $request->ctc;
            $employee->date_of_birth = $request->dob;
            $employee->address = $request->address;
            if ($request->hasFile('Aadhar_no')) {
                $Aadhar_no = date('ymdHis') . '-' . $request->file('Aadhar_no')->GetClientOriginalName();
                $request->Aadhar_no->move('Aadhar_no/', $Aadhar_no);

                $employee->Aadhar_no = $Aadhar_no;
            }
            if ($request->hasFile('pan_no')) {
                $pan_no = date('ymdHis') . '-' . $request->file('pan_no')->GetClientOriginalName();
                $request->pan_no->move('pan_no/', $pan_no);

                $employee->pan_no = $pan_no;
            }
            if ($request->hasFile('photo')) {
                $photo = date('ymdHis') . '-' . $request->file('photo')->GetClientOriginalName();
                $request->photo->move('photo/', $photo);

                $employee->photo = $photo;
            }
            $employee->employment_code = $request->employment_code;
            $employee->contact_no = $request->contactno;
            $employee->departname = $request->departname;
            $employee->designation = $request->designation;
            $employee->date_of_joining = $request->doj;
            $employee->location = $request->location;
            $employee->reporting_manager = $request->reportman;
            $employee->shift = $request->shift;
            $employee->blood_group = $request->Bgroup;
            $employee->account_no = $request->account_no;
            $employee->bank_name = $request->bank;
            $employee->ifsc = $request->ifsc;
            $employee->uan = $request->uan;
            $employee->update();
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => "something Went Wrong"]);
            // return $th->getMessage();
        }
        return redirect()->back()->with(['success' => "Employee Record  Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = EmployeeRecord::where('id', $id)->first();
        $data->delete();
        return redirect()->back()->with(['success' => "Deleted successsfully"]);
    }
    /**
     *@method
     *@param
     *@return
     */
    public function changeStatus($id)
    { {
            $employe = EmployeeRecord::where('id', $id)->first();
            try {
                if ($employe->status == 'Active') {
                    $employe->status = 'InActive';
                } else {
                    $employe->status = 'Active';
                }
                //update
                $employe->save();
                return redirect()->back()->with(['success' => " Status Changed Successfully!"]);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['message' => $th]);
            }
        }
    }
    /**
     *@method
     *@param
     *@return
     */
    public function search(Request $request)
    { {
            if ($request->ajax()) {
                $output = "";
                $counter = 1;
                $employes = EmployeeRecord::where('employee_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('contact_no', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('employment_type', 'LIKE', '%' . $request->search . '%')
                    ->get();

                foreach ($employes as $employe) {
                    $w = '<a href="/status/' . $employe->id . '" style="font-size: 20px; color:red; text-decoration: none;" class="fas fa-toggle-off"></a>';
                    if ($employe->status == "Active") {
                        $w = '<a href="/status/' . $employe->id . '" style="font-size: 20px; color:green; text-decoration: none;" class="fas fa-toggle-on"> </a>';
                    }
                    $output .= '<tr> <td width="1%" class="fw-bold text-dark">' . $counter++ . '</td>' .
                        '<td>' . $employe->employee_name . '</td>' .
                        '<td>' . $employe->contact_no . '</td>' .
                        '<td>' . $employe->designation . '</td>' .
                        '<td>' . $employe->employment_type . '</td>' .
                        '<td>' . $employe->ctc . '</td>' .
                        '<td>' . $w . '
                        </td>' .

                        ' <td class="with-btn" nowrap>' .
                        '<a href="/dashboard/employee/' . $employe->id . '" class="far fa-eye" style="margin-right: 6px;"></a>' .
                        '<a href="/dashboard/employee/' . $employe->id . '/edit" class="far fa-edit" style="margin-right: 6px;"></a>' .
                        '<a onclick="return confirm(`Are you sure you want to delete this field?`);" href="javascript:;" id="route("employee.destroy",' . $employe->id . ')" class="far fa-trash-alt" style="margin-right: 6px;"></a>' .
                        '</td></tr>';
                }
                if (!$output) {
                    $output .= '<h6 class="position-absolute w-100 text-center top-0 left-0 p-2"> No results found</h6>';
                }
                return Response($output);
            }
        }
    }

    /**
     *@method
     *@param
     *@return
     */
    public function showall(Request $request)
    { {
            if ($request->ajax()) {
                $output = "";
                $counter = 1;
                $employes = EmployeeRecord::get();

                foreach ($employes as $employe) {
                    $w = '<a href="/status/' . $employe->id . '" style="font-size: 20px; color:red; text-decoration: none;" class="fas fa-toggle-off"></a>';
                    if ($employe->status == "Active") {
                        $w = '<a href="/status/' . $employe->id . '"style="font-size: 20px; color:green; text-decoration: none;" class="fas fa-toggle-on"> </a>';
                    }
                    $output .= '<tr><td width="1%" class="fw-bold text-dark">' . $counter++ . '</td>' .
                        '<td>' . $employe->employee_name . '</td>' .
                        '<td>' . $employe->contact_no . '</td>' .
                        '<td>' . $employe->designation . '</td>' .
                        '<td>' . $employe->employment_type . '</td>' .
                        '<td>' . $employe->ctc . '</td>' .
                        '<td>' . $w . '</td>' .

                        ' <td class="with-btn" nowrap>' .
                        '<a href="/dashboard/employee/' . $employe->id . '" class="far fa-eye" style="margin-right: 6px;"></a>' .
                        '<a href="/dashboard/employee/' . $employe->id . '/edit" class="far fa-edit" style="margin-right: 6px;"></a>' .
                        '<a onclick="return confirm(`Are you sure you want to delete this field?`);" href="javascript:;" id="route("employee.destroy",' . $employe->id . ')" class="far fa-trash-alt" style="margin-right: 6px;"></a>' .
                        '</td></tr>';
                }
                return Response($output);
            }
        }
    }
    /**
     *@method
     *@param
     *@return
     */
    public function empDetail(Request $request)
    {

        if ($request->ajax()) {
            $empDetial = Member::where('id', $request->id)->first();
            return $empDetial;
        }
    }
}
