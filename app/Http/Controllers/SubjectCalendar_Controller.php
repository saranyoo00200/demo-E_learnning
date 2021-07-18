<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectLearning;
use App\Models\LessonContent;
use App\Models\User;
use App\Models\ClassStudent;
use App\Models\LessonSynch;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
class SubjectCalendar_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $subjectLearning = SubjectLearning::all();
        return view('subject_calendar/index',compact('subjectLearning'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    }
    public function manage_lesson($type,$subject_id)
    {
     $subjectLearning = SubjectLearning::find($subject_id);
     $LessonSynch = LessonSynch::join('lesson_contents','lesson_synch.lesson_id','=','lesson_contents.id')
     ->join('users','users.id', '=', 'lesson_synch.teacher_id','left')->where('subject_id',$subject_id)->get();
     return view('subject_calendar.manage_lesson',['subjectLearning' => $subjectLearning,'LessonSynch' => $LessonSynch]);
    }
    public function manage_lesson_type2($subject_id)
    {
      $subjectLearning = SubjectLearning::find($subject_id);
      $LessonSynch = LessonContent::join('lesson_synch','lesson_synch.lesson_id','=','lesson_contents.id','left')->whereNull('sync_id')->where('subject_id',$subject_id)->get();
      return view('subject_calendar.manage_lesson_type2',['subjectLearning' => $subjectLearning,'LessonSynch' => $LessonSynch]);
    }
    public function manage_student($type,$id)
    {
      $subjectLearning = SubjectLearning::join('lesson_contents','lesson_contents.subject_id','=','subject_learnings.id')
      ->join('lesson_synch','lesson_contents.id','=','lesson_synch.lesson_id')->join('users','users.id','=','lesson_synch.teacher_id')->where('sync_id',$id)->where('lesson_contents.id',$type)->get();
      return view('subject_calendar.manage_student',['subjectLearning' => $subjectLearning,'type'=>$type]);
    }
    public function create_lesson($type,$id)
    {
      $LessonContent = LessonContent::where('subject_id',$id)->get();
      $subjectLearning = SubjectLearning::find($type);
      $User = User::where('user_type',3)->get();
      return view('subject_calendar.create_lesson',['subjectLearning' => $subjectLearning,'LessonContent' => $LessonContent,'User' => $User,'type' => $id]);
    }
    public function edit_lesson($subject_id,$id)
    {
      $LessonContent = LessonContent::where('subject_id',$subject_id)->get();
      $subjectLearning = SubjectLearning::find($subject_id);
      $User = User::where('user_type',3)->get();
      $LessonSynch = LessonSynch::where('sync_id',$id)->get();
      return view('subject_calendar.edit_lesson',['subjectLearning' => $subjectLearning,'LessonContent' => $LessonContent,'User' => $User,'type' => $id,'LessonSynch' => $LessonSynch]);
    }
    public function store_lesson($type,Request $request)
    {
      // dd($request->all());
      $input['lesson_id'] = $request->lesson_id;
      $input['start_date'] = $request->start_date;
      $input['end_date'] = $request->end_date;
      $input['synch_time'] = $request->synch_time;
      $input['synch_amount'] = $request->synch_amount;
      $input['teacher_id'] = $request->teacher_id;
      $input['synch_status'] = $request->synch_status;
      if (!empty($request->start_date)) {
        list($d,$m,$y) = explode('/',$request->start_date);
        $start_date = ($y-543).'-'.$m.'-'.$d;
      }else {
        $start_date = null;
      }
      if (!empty($request->end_date)) {
        list($d,$m,$y) = explode('/',$request->end_date);
        $end_date = ($y-543).'-'.$m.'-'.$d;
      }else {
        $end_date = null;
      }
      LessonSynch::insert([
        'lesson_id' => $request->lesson_id,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'synch_time' => $request->synch_time,
        'synch_amount' => $request->synch_amount,
        'teacher_id' => $request->teacher_id,
        'synch_status' => $request->synch_status,
      ]);
      return redirect('/subject_calendar/manage_lesson/1/'.$type)->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function update_lesson(Request $request,$type,$id)
    {
      $input['lesson_id'] = $request->lesson_id;
      $input['start_date'] = $request->start_date;
      $input['end_date'] = $request->end_date;
      $input['synch_time'] = $request->synch_time;
      $input['synch_amount'] = $request->synch_amount;
      $input['teacher_id'] = $request->teacher_id;
      $input['synch_status'] = $request->synch_status;
      if (!empty($request->start_date)) {
        list($d,$m,$y) = explode('/',$request->start_date);
        $start_date = ($y-543).'-'.$m.'-'.$d;
      }else {
        $start_date = null;
      }
      if (!empty($request->end_date)) {
        list($d,$m,$y) = explode('/',$request->end_date);
        $end_date = ($y-543).'-'.$m.'-'.$d;
      }else {
        $end_date = null;
      }
      DB::table('lesson_synch')->where('sync_id', $id)->update([
        'lesson_id' => $request->lesson_id,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'synch_time' => $request->synch_time,
        'synch_amount' => $request->synch_amount,
        'teacher_id' => $request->teacher_id,
        'synch_status' => $request->synch_status,
     ]);
      return redirect('/subject_calendar/manage_lesson/1/'.$type)->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function update_class(Request $request,$type,$id)
    {
      $user_id = $request->user_id;
      $select_id = $request->select_id;
      $student = ClassStudent::where('sync_id',$id);
      $student->delete();
      foreach ($user_id as $key => $value) {
        if (isset($select_id[$key])) {
            $input['student_id'] = $user_id[$key];
            $input['student_status'] = 1;
            $input['sync_id'] = $id;
           ClassStudent::create($input);
        }
      }
      $subjectLearning = SubjectLearning::join('lesson_contents','lesson_contents.subject_id','=','subject_learnings.id')
      ->join('lesson_synch','lesson_contents.id','=','lesson_synch.lesson_id')->join('users','users.id','=','lesson_synch.teacher_id')->where('sync_id',$id)->where('lesson_contents.id',$type)->get();
      return view('subject_calendar.manage_student',['subjectLearning' => $subjectLearning,'type'=>$type]);
    }
    public function delete_lesson($type,$id='')
    {
       $LessonSynch = LessonSynch::where('sync_id', $id)->delete();
       return redirect('/subject_calendar/manage_lesson/1/'.$type)->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function create_course2()
    {
        return view('subject_calendar.create_course2');
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
    public function destroy($type,$id)
    {

      // $LessonSynch = LessonSynch::where('sync_id', $id)->delete();
      // return redirect('/users')->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }
}
