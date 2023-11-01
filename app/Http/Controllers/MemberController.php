<?php

namespace App\Http\Controllers;

use App\Models\Student;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     *@method
     *@param
     *@return
     */
    function showtemplist(Request $request)
    {
        $itemsPerPage = $request->query('itemsPerPage', 10);
        $students = Student::with('showI')->orderBy('created_at', 'DESC')->paginate($itemsPerPage);
        return view('phase_2.index', compact('students','itemsPerPage'));
    }

    /**
     *@method
     *@param
     *@return
     */
    function delete($id)
    {
        $data = Student::find($id);
        $data->delete();
        return redirect()->back()->with(['success' => "Data Deleted Successfully"]);
    }

    /**
     *@method
     *@param
     *@return
     */
    function showdata($id)
    {
        $data = Student::with('showI')->where('id', $id)->first();
        return view('phase_2.edit', compact('data'));

    }

    /**
     *@method
     *@param
     *@return
     */
    public function show($id)
    {
        $data = Student::with('showI')->where('id', $id)->first();
        return view('phase_2.view', compact('data'));
    }

    /**
     *@method
     *@param
     *@return
     */
    function update(Request $request, $id)
    {
        $data = Student::where('id', $id)->first();
        $data->intmode = $request->intmode;
        $data->inttype = $request->inttype;
        $data->date = $request->date;
        $data->intname = $request->intname;
        $data->intstatus = $request->intstatus;
        $data->reschedule = $request->reschedule;
        $data->rdate = $request->rdate;
        $data->intlink = $request->intlink;
        $data->feedback = $request->feedback;
        $data->save();
        return redirect()->back()->with(['success' => "Updated Successfully!!"]);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $counter =1;
            $Students = Student::with('showI')->Where('intstatus', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('showI', function ($query) use ($request) {
                    $query->where('fullname', 'like', '%' . $request->search . '%');
                })->with('showI')
                ->get();

            foreach ($Students as $student) {
                $fullname = $student->showI->fullname ?? '';
                $output .= '<tr>
                    <td width="1%" class="fw-bold text-dark">' . $counter++ . '</td>' .
                    '<td>' . $fullname . '</td>' .
                    '<td>' . $student->intmode . '</td>' .
                    '<td>' . $student->date . '</td>' .
                    '<td>' . $student->intname . '</td>' .
                    '<td>' . $student->intstatus . '</td>' .
                    '<td>' . $student->reschedule . '</td>' .
                    '<td><a href="view1/' . $student->id . '" class="far fa-edit" style="margin-right: 6px;" ></a>
                    <a href="update1/' . $student->id . '" class="far fa-eye" style="margin-right: 6px;" ></a>
                    <a onclick="return confirm(`Are you sure you want to delete this field?`);" href="delete1/' . $student->id . '" class="far fa-trash-alt" style="margin-right: 6px;"></a></td>
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
            $counter =1;
            $Students = Student::with('showI')->get();

            foreach ($Students as $student) {
                $fullname = $student->showI->fullname ?? '';
                $output .= '<tr>
                    <td width="1%" class="fw-bold text-dark">' . $counter++ . '</td>' .
                    '<td>' . $fullname . '</td>' .
                    '<td>' . $student->intmode . '</td>' .
                    '<td>' . $student->date . '</td>' .
                    '<td>' . $student->intname . '</td>' .
                    '<td>' . $student->intstatus . '</td>' .
                    '<td>' . $student->reschedule . '</td>' .
                    '<td><a href="view1/' . $student->id . '" class="far fa-edit" style="margin-right: 6px;" ></a>
                    <a href="update1/' . $student->id . '" class="far fa-eye" style="margin-right: 6px;" ></a>
                    <a onclick="return confirm(`Are you sure you want to delete this field?`);" href="delete1/' . $student->id . '" class="far fa-trash-alt" style="margin-right: 6px;"></a></td>
                     </tr>';
            }
        }
        return Response($output);
    }
}
