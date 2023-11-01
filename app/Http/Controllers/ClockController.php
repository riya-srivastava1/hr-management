<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ClockRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClockController extends Controller
{
    public function  clockIn(Request $request)
    {
        try {
            $userId = auth()->id();
            $clockRecord = new ClockRecord();
            $clockRecord->user_id = $userId;
            $clockRecord->clock_in = Carbon::now();
            $clockRecord->created_by = Auth::user()->name;
            $clockRecord->date = today()->format('Y-m-d');
            $clockRecord->save();
            return redirect()->back()->with(['message' => 'Clocked-In successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return redirect()->back()->with(['error' => 'Something went wrong']);
    }
    public function clockOut(Request $request)
    {
        try {
            $userId = auth()->id();
            $clockRecord = ClockRecord::where('user_id', $userId)
                ->whereNull('clock_out')
                ->latest()
                ->first();

            if ($clockRecord) {
                $clockRecord->clock_out = Carbon::now();
                $clockRecord->created_by = Auth::user()->name;
                $clockRecord->save();

                return redirect()->back()->with(['message' => 'Clock-Out successful']);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return redirect()->back()->with(['error' => 'You have not clocked-in yet, Please clock-in first.']);
    }
    public function timeSheet()
    {
        $timesheets = ClockRecord::orderBy('created_at', 'DESC')->select('clock_in','clock_out','created_by')->get();
        return view('clock-management.clock_timesheet', compact('timesheets'));
    }
    public function resetClockOut()
    {
        try {
            $userId = auth()->id();
            $clockRecord = ClockRecord::where('user_id', $userId)
                ->whereNotNull('clock_out')
                ->latest()
                ->first();

            if ($clockRecord) {
                $clockRecord->clock_out = null; // Set clock_out to null
                $clockRecord->save();
                return redirect()->back()->with(['message' => 'Clock Out Data Reset']);
            }

            return redirect()->back()->with(['message' => 'No clock-out data found']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong']);
        }
    }
    // public function store(Request $request)
    // {
    //     // Retrieve the start time and user ID from the request
    //     $startTime = $request->input('start_time');
    //     $userId = auth()->user()->id;

    //     // Store the timer data in the database
    //     ClockRecord::create([
    //         'user_id' => $userId,
    //         'start_time' => $startTime,
    //     ]);

    //     return response()->json(['success' => true]);
    // }
    public function getElapsedTime(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $clockRecord = ClockRecord::where('user_id', $userId)
                ->whereNotNull('clock_out')
                ->latest()
                ->first();

            $elapsedTime = 0;
            if ($clockRecord) {
                $elapsedTime = $clockRecord->clock_out->diffInSeconds($clockRecord->clock_in);
            }

            return response()->json(['elapsed_time' => $elapsedTime]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
