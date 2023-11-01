<?php

namespace App\Http\Controllers\Holiday;

use Carbon\Carbon;
use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $holidays = Holiday::all();
        return view('holidays.create', compact('holidays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $holiday = new Holiday;
        $holiday->holiday_date = $request->holiday_date;
        $holiday->holiday_name = $request->holiday_name;
        $holiday->save();
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
        $holidays = Holiday::find($id);
        return view('holidays.edit', compact('holidays'));
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
        return $id;
        try {
            $holiday = Holiday::where('id', $id)->first();
            $holiday->holiday_date = $request->holiday_date;
            $holiday->holiday_name = $request->holiday_name;
            $holiday->update();

        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => "something Went Wrong"]);
            // return $th->getMessage();
        }
        return redirect()->back()->with(['success' => "Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Holiday::find($id);
        $data->delete();
        return redirect()->back()->with(['success' => "Deleted successsfully"]);
    }
}
