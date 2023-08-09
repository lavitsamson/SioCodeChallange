<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TimeLog;
use App\Charts\UserHoursChart;

class TimeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserHoursChart $hour_chart, $project_id = "all", $type = "Month")
    {
        //
        if($project_id == 'all') $timelogs = auth()->user()->timelog;
        else $timelogs = auth()->user()->timelog->where('project_id', $project_id)->get();

        $chart = $hour_chart->build($timelogs, $type);

        return view('timelog.index', compact('timelogs', 'chart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $projects = auth()->user()->project;
        
        if($projects->count() == 0) return back()->withErrors(['error' => 'Please add a project first']);

        return view('timelog.add', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation of required fields
        $request->validate([
            'project_id' => 'required',
            'work_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        // timlog creation
        TimeLog::create([
            'project_id' => $request->project_id,
            'work_date' => Carbon::parse($request->work_date)->format('Y-m-d'),
            'start_time' => Carbon::parse(now())->format('Y-m-d'). ' '. $request->start_time.':00',
            'end_time' => Carbon::parse(now())->format('Y-m-d'). ' '. $request->end_time.':00',
            'user_id' => auth()->id()
        ]);

        return redirect()->route('timelog.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $timelog = TimeLog::find($id);
        $projects = auth()->user()->project;

        return view('timelog.edit', compact('timelog', 'projects', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validation of required fields
        $request->validate([
            'project_id' => 'required',
            'work_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $timelog = TimeLog::find($id);

        // timlog updation
        $timelog->project_id = $request->project_id;
        $timelog->work_date = Carbon::parse($request->work_date)->format('Y-m-d');
        $timelog->start_time = Carbon::parse(now())->format('Y-m-d'). ' '. $request->start_time.':00';
        $timelog->end_time = Carbon::parse(now())->format('Y-m-d'). ' '. $request->end_time.':00';
        
        $timelog->save();

        return redirect()->route('timelog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $timelog = TimeLog::find($id);
        $timelog->delete();

        return redirect()->route('timelog.index');
    }
}
