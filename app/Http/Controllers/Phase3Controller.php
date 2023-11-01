<?php

namespace App\Http\Controllers;

use App\Models\Phase3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Phase3Controller extends Controller
{
    /**
     *@method
     *@param
     *@return
     */
    function pthree(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|unique:phase3s',
            'hrround' => 'required',
            'bgv' => 'required',
            'offerletter' => 'required',
            'ctc' => 'required|max:5',
            'repomanager' => 'required|max:10',
            'jdate' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
        $phase3 = new Phase3;
        $phase3->member_id = $request->id;
        $phase3->hrround = $request->hrround;
        $phase3->bgv = $request->bgv;
        $phase3->offerletter = $request->offerletter;
        $phase3->ctc = $request->ctc;
        $phase3->jdate = $request->jdate;
        $phase3->repomanager = $request->repomanager;
        $phase3->created_by = Auth::user()->name;
        $phase3->save();
        return redirect()->back()->with(['success' => "Added Successfully !!"]);
    }

    /**
     *@method
     *@param
     *@return
     */
    function showphase3(Request $request)
    {
        $itemsPerPage = $request->query('itemsPerPage', 10);
        $phase3s = Phase3::with('getPhase3')->orderBy('created_at', 'DESC')->paginate($itemsPerPage);
        return view('phase_3.index', compact('phase3s', 'itemsPerPage'));
    }
    /**
     *@method
     *@param
     *@return
     */
    function delete($id)
    {
        $data = Phase3::find($id);
        $data->delete();
        return redirect()->back()->with(['success' => "Deleted Successfully"]);
    }

    /**
     *@method
     *@param
     *@return
     */
    function showdata($id)
    {
        $data = Phase3::with('getPhase3')->where('id', $id)->first();
        return view('phase_3.edit', ['data' => $data]);
    }

    /**
     *@method
     *@param
     *@return
     */
    public function show($id)
    {
        $data = Phase3::with('getPhase3')->where('id', $id)->first();
        return view('phase_3.view', compact('data'));
    }

    /**
     *@method
     *@param
     *@return
     */
    function update(Request $request, $id)
    {
        $data = Phase3::where('id', $id)->first();
        $data->hrround = $request->hrround;
        $data->bgv = $request->bgv;
        $data->offerletter = $request->offerletter;
        $data->ctc = $request->ctc;
        $data->jdate = $request->jdate;
        $data->repomanager = $request->repomanager;
        $data->save();
        return redirect()->back()->with(['success' => "Updated Successfully!!"]);
    }

    /**
     *@method
     *@param
     *@return
     */
    public function searchPhase(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $counter = 1;
            $phase3s = Phase3::with('getPhase3')->where('id', 'LIKE', '%' . $request->search . "%")
                ->orWhere('hrround', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('getPhase3', function ($query) use ($request) {
                    $query->where('fullname', 'like', '%' . $request->search . '%');
                })->with('getPhase3')
                ->get();

            foreach ($phase3s as $phase3) {
                $fullname = $phase3->getPhase3->fullname ?? '';
                $output .=
                    '<tr>
                    <td width="1%" class="fw-bold text-dark">' . $counter++ . '</td>' .
                    '<td>' . $fullname . '</td>' .
                    '<td>' . $phase3->hrround . '</td>' .
                    '<td>' . $phase3->bgv . '</td>' .
                    '<td>' . $phase3->offerletter . '</td>' .
                    '<td>' . $phase3->ctc . '</td>' .
                    '<td>' . $phase3->jdate . '</td>' .
                    '<td>' . $phase3->repomanager . '</td>' .
                    '<td><a href="view/' . $phase3->id . '" type="submit" class="far fa-eye" style="margin-right: 6px;"></a>
                    <a href="update2/' . $phase3->id . '" type="submit" class="far fa-edit" style="margin-right: 6px;"></a>
                    <a href="delete/' . $phase3->id . '" type="submit" class="far fa-trash-alt" style="margin-right: 6px;" onclick="return confirm(`Are you sure you want to delete this field?`);"></a></td> </tr>';
            }

            if (!$output) {
                $output .= '<h6 class="position-absolute w-100 text-center top-0 left-0 p-2">No results found</h6>';
            }
        }
        return Response($output);
    }

    public function showall(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $counter = 1;
            $phase3s = Phase3::with('getPhase3')->get();
            foreach ($phase3s as $key => $phase3) {
                $fullname = $phase3->getPhase3->fullname ?? '';
                $output .= '<tr>
                    <td width="1%" class="fw-bold text-dark">' . $counter++ . '</td>' .
                    '<td>' . $fullname . '</td>' .
                    '<td>' . $phase3->hrround . '</td>' .
                    '<td>' . $phase3->bgv . '</td>' .
                    '<td>' . $phase3->offerletter . '</td>' .
                    '<td>' . $phase3->ctc . '</td>' .
                    '<td>' . $phase3->jdate . '</td>' .
                    '<td>' . $phase3->repomanager . '</td>' .
                    '<td><a href="view/' . $phase3->id . '" type="submit" class="far fa-eye" style="margin-right: 6px;"></a>
                    <a href="update2/' . $phase3->id . '" type="submit" class="far fa-edit" style="margin-right: 6px;"></a>
                    <a href="delete/' . $phase3->id . '" type="submit" class="far fa-trash-alt" style="margin-right: 6px;" onclick="return confirm(`Are you sure you want to delete this field?`);"></a></td></tr>';
            }
        }
        return Response($output);
    }
}
