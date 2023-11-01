<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\postanddep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CentralController extends Controller
{
    /**
     *@method
     *@param
     *@return
     */
    function insert(Request $request)
    {
        $request->validate([
            'fullname' => 'required|max:40|string|regex:/^[^\d]+$/',
            'number' => 'required|min:10',
            'email' => 'required|unique:members|email',
            'doc' => 'mimes:pdf',
            'address' => 'max:30',
            'dob' => 'nullable|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        ]);
        $prod = new member();
        $prod->fullname = $request->get('fullname');
        $prod->number = $request->get('number');
        $prod->email = $request->get('email');
        $prod->corg = $request->get('corg');
        $prod->ectc = $request->get('ectc');
        $prod->ctc = $request->get('ctc');
        $prod->dob = $request->get('dob');
        $prod->date = $request->get('date');
        $prod->address = $request->get('address');
        $prod->message = $request->get('message');
        $prod->created_by = Auth::user()->name;

        if ($request->hasFile('doc')) {
            $doc = date('ymdHis') . '-' . $request->file('doc')->GetClientOriginalName();
            $request->doc->move('doc/', $doc);
            $prod->doc = $doc;
        }
        $prod->save();
        return redirect()->back()->with(['success' => "Added Successfully!"]);
    }
    /**
     *@method
     *@param
     *@return
     */
    function insert2(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:postanddeps',
            'title' => 'required',
            'department' => 'required|max:15',
        ]);
        $prod = new postanddep();
        $prod->id = $request->id;
        $prod->title = $request->title;
        $prod->department = $request->department;
        $prod->save();
        return redirect()->back()->with(['success' => "Added Successfully!"]);
    }
    /**
     *@method
     *@param
     *@return
     */
    public function interview1(Request $request)
    {
        return view('phase_1.candidate.create');
    }
    /**
     *@method
     *@param
     *@return
     */
    public function dep(Request $request)
    {
        $members = Member::all();
        return view('phase_1.post_and_department.create', compact('members'));
    }
    /**
     *@method
     *@param
     *@return
     */
    public function edit2(Request $request)
    {
        return view('phase_1.post_and_department.edit');
    }
    /**
     *@method
     *@param
     *@return
     */
    function showviewdetail(Request $request)
    {
        $itemsPerPage = $request->query('itemsPerPage', 10);
        $members = Member::orderBy('created_at', 'DESC')->paginate($itemsPerPage);
        return view('phase_1.candidate.index', compact('members', 'itemsPerPage'));
    }
    /**
     *@method
     *@param
     *@return
     */
    function showviewdetail2(Request $request)
    {
        $itemsPerPage = $request->query('itemsPerPage', 10);
        $postanddeps = postanddep::with('getMember')->orderBy('created_at', 'DESC')->paginate($itemsPerPage);
        return view('phase_1.post_and_department.index', compact('postanddeps', 'itemsPerPage'));
    }
    /**
     *@method
     *@param
     *@return
     */
    public function viewpage(Request $request, $id)
    {
        $data = Member::where('id', $id)->first();
        return view('phase_1.candidate.view', compact('data'));
    }
    /**
     *@method
     *@param
     *@return
     */
    public function viewpage2(Request $request, $id)
    {
        $data = postanddep::where('id', $id)->first();
        return view('phase_1.post_and_department.view', compact('data'));
    }

    /**
     *@method
     *@param
     *@return
     */
    function delete($id)
    {
        $data = Member::find($id);
        $data->delete();

        return redirect()->back()->with(['success' => " Deleted Successfully!"]);
    }
    function deleteAllCandidate(Request $request, $id)
    {
        if ($request->ajax()) {
            $ids = $request->ids;
            Member::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Selected records deleted successfully.']);
        }
    }
    /**
     *@method
     *@param
     *@return
     */
    function delete2($id)
    {
        $data = postanddep::find($id);
        $data->delete();
        return redirect()->back()->with(['success' => " Deleted Successfully!"]);
    }

    /**
     *@method
     *@param
     *@return
     */
    // function showdata($id)
    // {
    //     $data = Member::find($id);
    //     return view('phase_1.candidate.edit', compact('data'));
    // }

    function edit($id)
    {

        $data = Member::find($id);
        return view('phase_1.candidate.edit',  compact('data'));
    }

    /**
     *@method
     *@param
     *@return
     */
    function showdata2($id)
    {
        $data = postanddep::find($id);
        return view('phase_1.post_and_department.edit', ['data' => $data]);
    }
    /**
     *@method
     *@param
     *@return
     */
    function update(Request $request)
    {
        $request->validate([
            'fullname' => 'required|max:30|string|regex:/^[^\d]+$/',
            'number' => 'required|min:10',
            'email' => 'required|max:40|email',
            'corg' => 'required|max:70',
            'doc' => 'mimes:pdf',
            'address' => 'max:30',
            'dob' => ['before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'message' => 'max:50'
        ]);
        $data = Member::find($request->id);
        $data->fullname = $request->fullname;
        $data->number = $request->number;
        $data->email = $request->email;
        $data->corg = $request->corg;
        $data->ectc = $request->ectc;
        $data->dob = $request->dob;
        $data->ctc = $request->ctc;
        $data->address = $request->address;
        if ($request->hasfile('doc')) {
            $doc = $request->file('doc')->GetClientOriginalName();
            $request->doc->move('doc/', $doc);
            $data->doc = $doc;
        }
        $data->message = $request->message;
        $data->save();
        return redirect()->back()->with(['success' => " Updated Successfully!"]);
    }

    /**
     *@method
     *@param
     *@return
     */
    function update2(Request $request)
    {
        $data = postanddep::find($request->id);
        $data->title = $request->title;
        $data->department = $request->department;
        $data->save();
        return redirect()->back()->with(['success' => " Updated Successfully!"]);
    }

    public function changeStatus($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->status == 'Active') {
            $user->status = 'InActive';
        } else {
            $user->status = 'Active';
        }
        try {
            //update
            $user->update();
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'something went wrong ']);
        }
        return redirect()->back()->with(['success' => " Status Changed Successfully!"]);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $counter = 1;
            $Memebers = Member::where('fullname', 'LIKE', '%' . $request->search . '%')
                ->get();

            foreach ($Memebers as  $member) {
                $output .= '<tr>
                  <td width="1%" class="fw-bold text-dark">' . $counter++ . '</td>
                  <td>' . $member->fullname . '</td>
                  <td>' . $member->number . '</td>
                  <td>' . $member->email . '</td>
                  <td>' . $member->ectc . '</td>
                  <td><a href="edit/' . $member->id . '"  class="far fa-edit" style="margin-right: 6px;"></a>
                  <a href="viewdetail/' . $member->id . '" class="far fa-eye" style="margin-right: 6px;"></a>
                  <a href="interview/delete/' . $member->id . '" input onclick="return confirm(`Are you sure you want to delete this field?`);" type="submit" value="Delete" class="far fa-trash-alt" style="margin-right: 6px;"></a></td>
              </tr>';
            }
            if (!$output) {
                $output .= '<h6 class="position-absolute w-100 text-center top-0 left-0 p-2">No results found</h6>';
            }
        }
        return Response($output);
    }

    public function searchAll(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $counter = 1;
            $Memebers = Member::get();

            foreach ($Memebers as  $member) {
                $output .= '<tr>
                <td width="1%" class="fw-bold text-dark">' . $counter++ . '</td>
                <td>' . $member->fullname . '</td>
                <td>' . $member->number . '</td>
                <td>' . $member->email . '</td>
                <td>' . $member->ectc . '</td>
                <td><a href="edit/' . $member->id . '"  class="far fa-edit" style="margin-right: 6px;"></a>
                <a href="viewdetail/' . $member->id . '" class="far fa-eye" style="margin-right: 6px;"></a>
                <a href="interview/delete/' . $member->id . '" input onclick="return confirm(`Are you sure you want to delete this field?`);" type="submit" value="Delete" class="far fa-trash-alt" style="margin-right: 6px;"></a></td>
                    </tr>';
            }
        }
        return Response($output);
    }


    public function searchPost(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $counter = 1;
            $Posts = postanddep::where('id', 'LIKE', '%' . $request->search . "%")
                ->orWhere('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('department', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('getMember', function ($query) use ($request) {
                    $query->where('fullname', 'like', '%' . $request->search . '%');
                })->with('getMember')
                ->get();

            foreach ($Posts as  $postanddep) {
                $fullname = $postanddep->getMember->fullname ?? '';
                $output .= '<tr>
                <td width="1%" class="fw-bold text-dark">' . $counter++ . '</td>
                          <td>' . $fullname . '</td>
                          <td>' . $postanddep->title . '</td>
                          <td>' . $postanddep->department . '</td>
                          <td><a href="edit2/' . $postanddep->id . '" class="far fa-edit" style="margin-right: 6px;"></a>
                          <a href="viewdetail2/' . $postanddep->id . '" class="far fa-eye" style="margin-right: 6px;"></a>
                          <a href="interview/delete2/' . $postanddep->id . '" input onclick="return confirm(`Are you sure you want to delete this field?`);" type="submit" value="Delete" class="far fa-trash-alt" style="margin-right: 6px;"></a></td>
                      </tr>';
            }
            if (!$output) {
                $output .= '<h6 class="position-absolute w-100 text-center top-0 left-0 p-2">No results found</h6>';
            }
        }
        return Response($output);
    }

    public function searchAllPost(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $counter = 1;
            $Posts = postanddep::get();

            foreach ($Posts as  $postanddep) {
                $fullname = $postanddep->getMember->fullname ?? '';
                $output .= '<tr>
                                <td width="1%" class="fw-bold text-dark">' . $counter++ . '</td>
                                <td>' . $fullname . '</td>
                                <td>' . $postanddep->title . '</td>
                          <td>' . $postanddep->department . '</td>
                          <td><a href="edit2/' . $postanddep->id . '" class="far fa-edit" style="margin-right: 6px;"></a>
                          <a href="viewdetail2/' . $postanddep->id . '" class="far fa-eye" style="margin-right: 6px;"></a>
                          <a href="interview/delete2/' . $postanddep->id . '" input onclick="return confirm(`Are you sure you want to delete this field?`);" type="submit" value="Delete" class="far fa-trash-alt" style="margin-right: 6px;"></a></td>
                        </tr>';
            }
        }
        return Response($output);
    }
}
