<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectLearning;
use App\Models\ScheduleTime;
use Auth;
class ScheduleTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $scheduletime  = ScheduleTime::join('subject_learnings','schedule_time.schedule_subject','=','subject_learnings.id')->where('teacher_id',Auth::user()->id)->get();
      return view('schedule_time.index',['scheduletime' => $scheduletime]);
    }
    public function ShowTimeTable()
    {
      $scheduletime  = ScheduleTime::join('subject_learnings','schedule_time.schedule_subject','=','subject_learnings.id')->where('teacher_id',Auth::user()->id)->get();
      return view('schedule_time.showtime_table',['scheduletime' => $scheduletime]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $subjectLearning = SubjectLearning::all();
      $scheduletime  = ScheduleTime::join('subject_learnings','schedule_time.schedule_subject','=','subject_learnings.id')->where('teacher_id',Auth::user()->id)->get();
      return view('schedule_time.create',['subjectLearning' => $subjectLearning,'scheduletime' => $scheduletime]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $input['schedule_subject'] = $request->schedule_subject;
      $input['schedule_place'] = $request->schedule_place;
      if (!empty($request->schedule_startdate)) {
        list($d,$m,$y) = explode('/',$request->schedule_startdate);
        $input['schedule_startdate'] = ($y-543).'-'.$m.'-'.$d;
      }else {
        $input['schedule_startdate'] = null;
      }
      if (!empty($request->schedule_enddate)) {
        list($d,$m,$y) = explode('/',$request->schedule_enddate);
        $input['schedule_enddate'] = ($y-543).'-'.$m.'-'.$d;
      }else {
        $input['schedule_enddate'] = null;
      }
      if (!empty($request->schedule_starttime)) {
        $input['schedule_starttime'] = $request->schedule_starttime;
      }else {
        $input['schedule_starttime'] = null;
      }
      if (!empty($request->schedule_endtime)) {
        $input['schedule_endtime'] = $request->schedule_endtime;
      }else {
        $input['schedule_endtime'] = null;
      }
      $input['teacher_id'] = Auth::user()->id;
      $schedule = ScheduleTime::create($input);
      return redirect('/schedule_time')->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $scheduleTime  = ScheduleTime::join('subject_learnings','schedule_time.schedule_subject','=','subject_learnings.id')->where('schedule_id',$id)->first();
      return view('schedule_time.show',['scheduleTime' => $scheduleTime]);
    }
    public function showdata_time()
    {
      $scheduletime  = ScheduleTime::join('subject_learnings','schedule_time.schedule_subject','=','subject_learnings.id')->where('teacher_id',Auth::user()->id)->get();
      foreach ($scheduletime as $key => $value) {
      $data[] = array(
        'title' => $value->subjectName,
        'start' => $value->schedule_startdate.'T'.$value->schedule_starttime,
      );
      }
       return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = '')
    {
      $subjectLearning = SubjectLearning::all();
      $scheduleTime  = ScheduleTime::where('schedule_id',$id)->first();
      return view('schedule_time.edit',['subjectLearning' => $subjectLearning,'scheduleTime' => $scheduleTime]);
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
      $input['schedule_subject'] = $request->schedule_subject;
      $input['schedule_place'] = $request->schedule_place;
      if (!empty($request->schedule_startdate)) {
        list($d,$m,$y) = explode('/',$request->schedule_startdate);
        $input['schedule_startdate'] = ($y-543).'-'.$m.'-'.$d;
      }else {
        $input['schedule_startdate'] = null;
      }
      if (!empty($request->schedule_enddate)) {
        list($d,$m,$y) = explode('/',$request->schedule_enddate);
        $input['schedule_enddate'] = ($y-543).'-'.$m.'-'.$d;
      }else {
        $input['schedule_enddate'] = null;
      }
      if (!empty($request->schedule_starttime)) {
        $input['schedule_starttime'] = $request->schedule_starttime;
      }else {
        $input['schedule_starttime'] = null;
      }
      if (!empty($request->schedule_endtime)) {
        $input['schedule_endtime'] = $request->schedule_endtime;
      }else {
        $input['schedule_endtime'] = null;
      }
      $input['teacher_id'] = Auth::user()->id;
      $scheduleTime  = ScheduleTime::where('schedule_id',$id);
      $scheduleTime->update($input);
      return redirect('/schedule_time')->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $scheduleTime = ScheduleTime::where('schedule_id',$id);
      $scheduleTime->delete();
      return redirect('/schedule_time')->with('success', 'ได้ทำการลบข้อมูลเรียบร้อยแล้ว');
    }
}
