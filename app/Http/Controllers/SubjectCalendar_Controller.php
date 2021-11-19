<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectLearning;
use App\Models\LessonContent;
use App\Models\User;
use App\Models\LessonSynch;
use App\Models\SynchRepeatday;
use App\Models\ClassStudent;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use App\Models\ChatRoom;
use App\Models\Access_Subject;
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
        return view('subject_calendar/index', compact('subjectLearning'));
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
    public function manage_synchronous($id = '')
    {
        if ($id == 1) {
            if (auth()->user()->user_type != 1) {
                $subjectLearning = SubjectLearning::join('lesson_synch', 'lesson_synch.subject_id', '=', 'subject_learnings.id')
                    ->join('users', 'users.id', '=', 'lesson_synch.teacher_id')
                    ->where('lesson_synch.teacher_id', auth()->user()->id)
                    ->get();
            } else {
                $subjectLearning = SubjectLearning::join('lesson_synch', 'lesson_synch.subject_id', '=', 'subject_learnings.id')
                    ->join('users', 'users.id', '=', 'lesson_synch.teacher_id')
                    ->get();
            }
        } else {
            $subjectLearning = SubjectLearning::join('lesson_synch', 'lesson_synch.subject_id', '=', 'subject_learnings.id', 'left')
                ->where('lesson_synch.sync_id', null)
                ->where('subject_learnings.show_subject', '=', '1')
                ->select('*')
                ->get();
            // dd($subjectLearning);
        }
        return view('subject_calendar.manage_synchronous', ['subjectLearning' => $subjectLearning, 'id' => $id]);
    }
    public function create_synchronous(Request $request, $type = '')
    {
        // dd($request->all());
        $subjectLearning = SubjectLearning::all()->where('show_subject', '=', '1');
        $User = User::where('user_type', 3)->get();
        return view('subject_calendar.create_synchronous', ['User' => $User, 'subjectLearning' => $subjectLearning, 'type' => $type]);
    }
    public function edit_synchronous($type = '', $id)
    {
        $lesson_synch = LessonSynch::where('sync_id', $id)->first();
        $subjectLearning = SubjectLearning::join('access_subjects', 'subject_learnings.id', '=', 'access_subjects.subject_id')
            ->where('show_subject', '=', '1')
            ->where('user_id', $lesson_synch['teacher_id'])
            ->get();
        if (auth()->user()->user_type != 1) {
            $User = User::where('id', auth()->user()->id)->get();
        } else {
            $User = User::where('user_type', 3)->get();
        }
        $lesson_synch = LessonSynch::where('sync_id', $id)->first();
        $synch_repeatday = SynchRepeatday::where('sync_id', $id)->get();
        $repeat_day = [];
        foreach ($synch_repeatday as $key => $value) {
            $repeat_day[$value->synch_repeatday] = $value->synch_repeatday;
        }

        return view('subject_calendar.edit_synchronous', ['User' => $User, 'subjectLearning' => $subjectLearning, 'type' => $type, 'lesson_synch' => $lesson_synch, 'repeat_day' => $repeat_day]);
    }
    public function manage_class($type = '', $id)
    {
        $subjectLearning = SubjectLearning::join('lesson_synch', 'lesson_synch.subject_id', '=', 'subject_learnings.id')
            ->join('users', 'users.id', '=', 'lesson_synch.teacher_id')
            ->where('sync_id', $id)
            ->first();
        // dd($subjectLearning);
        $User = User::where('user_type', 2)->get();
        $classStudent = ClassStudent::join('users', 'class_student.user_id', '=', 'users.id')
            ->where('sync_id', $id)
            ->get();
        $synch_repeatday = SynchRepeatday::where('sync_id', $id)->get();
        $repeat_day = [];
        foreach ($synch_repeatday as $key => $value) {
            $repeat_day[$value->synch_repeatday] = $value->synch_repeatday;
        }
        return view('subject_calendar.manage_class', ['subjectLearning' => $subjectLearning, 'type' => $type, 'id' => $id, 'User' => $User, 'classStudent' => $classStudent, 'repeat_day' => $repeat_day]);
    }
    public function get_student(Request $request)
    {
        $user_id = $request->user_id;
        $sync_id = $request->sync_id;
        $check_user = DB::table('class_student')
            ->where('user_id', $user_id)
            ->where('sync_id', $sync_id)
            ->count();
        $User = User::where('id', $user_id)->get();
        return response()->json($User);
        // if ($check_user == 0) {
        //     $User = User::where('id', $user_id)->get();
        //     return response()->json($User);
        // } else {
        //     return response()->json($check_user);
        // }
    }
    public function check_student(Request $request)
    {
        $user_id = $request->user_id;
        $sync_id = $request->sync_id;
        $check_user = DB::table('class_student')
            ->where('user_id', $user_id)
            ->where('sync_id', $sync_id)
            ->count();
        if ($check_user == 0) {
            echo 0;
        } else {
            echo 1;
        }
    }
    public function user_exist(Request $request)
    {
        $user_id = $request->user_id;
        $sync_id = $request->sync_id;
        $User = DB::table('class_student')
            ->where('user_id', $user_id)
            ->where('sync_id', $sync_id)
            ->count();
        echo $User;
        // return response()->json($User);
    }
    public function store_synchronous($type = '', Request $request)
    {
        // dd($request->all());
        $input['subject_id'] = $request->subject_id;
        $input['synch_amount'] = $request->synch_amount;
        $input['teacher_id'] = $request->teacher_id;
        if (!empty($request->synch_starttime)) {
            $input['synch_starttime'] = $request->synch_starttime;
        } else {
            $input['synch_starttime'] = null;
        }
        $input['synch_status'] = $request->synch_status;
        if (!empty($request->start_date)) {
            [$d, $m, $y] = explode('/', $request->start_date);
            $input['start_date'] = $y - 543 . '-' . $m . '-' . $d;
        } else {
            $input['start_date'] = null;
        }
        if (!empty($request->end_date)) {
            [$d, $m, $y] = explode('/', $request->end_date);
            $input['end_date'] = $y - 543 . '-' . $m . '-' . $d;
        } else {
            $input['end_date'] = null;
        }
        if (!empty($request->synch_endtime)) {
            $date_end = $input['end_date'];
            $end = "$date_end $request->synch_endtime";
            $input['synch_endtime'] = date('H:i', strtotime('-1 minutes', strtotime($end)));
        } else {
            $input['synch_endtime'] = null;
        }
        $input['synch_url'] = $request->synch_url;
        $input['synch_password'] = $request->synch_password;
        $input['synch_openpost'] = $request->synch_openpost;
        $synch_repeatday = $request->synch_repeatday;
        $lesson_synch = LessonSynch::create($input);
        foreach ($synch_repeatday as $key => $value) {
            SynchRepeatday::create([
                'synch_repeatday' => $value,
                'sync_id' => $lesson_synch->id,
            ]);
        }
        //craete chat room togeter.
        $sync_id = DB::table('lesson_synch')
            ->orderBy('sync_id', 'desc')
            ->first()->sync_id;

        $input['sync_id'] = $sync_id;
        ChatRoom::create($input);
        //enc craete chat room togeter.

        return redirect('subject_calendar/manage_synchronous/1')->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function update_synchronous($type = '', $id, Request $request)
    {
        $input['subject_id'] = $request->subject_id;
        $input['synch_amount'] = $request->synch_amount;
        $input['teacher_id'] = $request->teacher_id;
        if (!empty($request->synch_starttime)) {
            $input['synch_starttime'] = $request->synch_starttime;
        } else {
            $input['synch_starttime'] = null;
        }
        $input['synch_status'] = $request->synch_status;
        if (!empty($request->start_date)) {
            [$d, $m, $y] = explode('/', $request->start_date);
            $input['start_date'] = $y - 543 . '-' . $m . '-' . $d;
        } else {
            $input['start_date'] = null;
        }
        if (!empty($request->end_date)) {
            [$d, $m, $y] = explode('/', $request->end_date);
            $input['end_date'] = $y - 543 . '-' . $m . '-' . $d;
        } else {
            $input['end_date'] = null;
        }
        if (!empty($request->synch_endtime)) {
            $date_end = $input['end_date'];
            $end = "$date_end $request->synch_endtime";
            $input['synch_endtime'] = date('H:i', strtotime('-1 minutes', strtotime($end)));
        } else {
            $input['synch_endtime'] = null;
        }
        $input['synch_url'] = $request->synch_url;
        $input['synch_password'] = $request->synch_password;
        $input['synch_openpost'] = $request->synch_openpost;
        $LessonSynch = LessonSynch::where('sync_id', $id);
        $LessonSynch->update($input);
        $ClassStudent = ClassStudent::where('sync_id', $id)->update(['subject_id' => $input['subject_id']]);
        $synch_repeatday = $request->synch_repeatday;
        SynchRepeatday::where('sync_id', $id)->delete();
        foreach ($synch_repeatday as $key => $value) {
            SynchRepeatday::create([
                'synch_repeatday' => $value,
                'sync_id' => $id,
            ]);
        }
        return redirect('subject_calendar/manage_synchronous/1')->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function delete_subject($type, $id = '')
    {
        $LessonSynch = LessonSynch::where('sync_id', $id)->delete();
        $SynchRepeatday = SynchRepeatday::where('sync_id', $id)->delete();
        $ClassStudent = ClassStudent::where('sync_id', $id)->delete();

        // delete chat room togerther
        ChatRoom::where('sync_id', '=', $id)->delete();
        // end delete chat room togerther

        return redirect('subject_calendar/manage_synchronous/' . $type)->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function showcalendar_time($teacher_id)
    {
        $schedule_time = LessonSynch::join('synch_repeatday', 'lesson_synch.sync_id', '=', 'synch_repeatday.sync_id')
            ->join('subject_learnings', 'subject_learnings.id', '=', 'lesson_synch.subject_id')
            ->where('lesson_synch.teacher_id', $teacher_id)
            ->orderBy('lesson_synch.end_date', 'desc')
            ->get();
        foreach ($schedule_time as $key => $value) {
            $startDate = new \DateTime($value->start_date);
            $enddate_convert = date_create($value->end_date);
            date_add($enddate_convert, date_interval_create_from_date_string('1 days'));
            $endDate = new \DateTime(date_format($enddate_convert, 'Y-m-d'));
            $time = strtotime($value->synch_endtime);
            $endTime = date('H:i', strtotime('+1 minutes', $time));
            $datePeriod = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);
            foreach ($datePeriod as $date) {
                if ($value->synch_repeatday == 1) {
                    if ($date->format('N') === '1') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
                if ($value->synch_repeatday == 2) {
                    if ($date->format('N') === '2') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
                if ($value->synch_repeatday == 3) {
                    if ($date->format('N') === '3') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
                if ($value->synch_repeatday == 4) {
                    if ($date->format('N') === '4') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
                if ($value->synch_repeatday == 5) {
                    if ($date->format('N') === '5') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
                if ($value->synch_repeatday == 6) {
                    if ($date->format('N') === '6') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
                if ($value->synch_repeatday == 7) {
                    if ($date->format('N') === '7') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
            }
        }
        return json_encode($data);
    }
    public function check_synchtime(Request $request)
    {
        $input['start_date'] = $request->start_date;
        if (!empty($input['start_date'])) {
            [$d, $m, $y] = explode('/', $input['start_date']);
            $start_date = $y - 543 . '-' . $m . '-' . $d;
        }
        $input['end_date'] = $request->end_date;
        if (!empty($input['end_date'])) {
            [$d, $m, $y] = explode('/', $input['end_date']);
            $end_date = $y - 543 . '-' . $m . '-' . $d;
        }
        $input['synch_starttime'] = $request->synch_starttime;
        if (!empty($input['synch_starttime'])) {
            $synch_starttime = $input['synch_starttime'];
        }
        $input['synch_endtime'] = $request->synch_endtime;
        if (!empty($input['synch_endtime'])) {
            $synch_endtime = $input['synch_endtime'];
            $end = "$end_date $synch_endtime";
            $endtime = date('H:i', strtotime('-1 minutes', strtotime($end)));
        }
        $input['select_day'] = $request->select_day;
        $teacher_id = $request->teacher_id;
        $subject_id = $request->subject_id;
        $check_repeat = LessonSynch::where('teacher_id', $teacher_id)
            ->where('subject_id', $subject_id)
            ->count();
        if ($check_repeat > 0) {
            echo 'repeat';
        } else {
            $data = DB::select(
                "select count(*) as count_time from lesson_synch  inner join synch_repeatday on lesson_synch.sync_id = synch_repeatday.sync_id
        where teacher_id= '" .
                    $teacher_id .
                    "' and ( '" .
                    $start_date .
                    "' between start_date and end_date
        or '" .
                    $end_date .
                    "' between start_date and end_date)  and (synch_starttime between '" .
                    $synch_starttime .
                    "' and '$endtime'
        or synch_endtime between '" .
                    $synch_starttime .
                    "' and '$endtime')
        and synch_repeatday in (" .
                    implode(',', $input['select_day']) .
                    ")
        ",
            );
            echo $data[0]->count_time;
        }
    }

    public function checkedit_synchtime(Request $request)
    {
        $input['start_date'] = $request->start_date;
        if (!empty($input['start_date'])) {
            [$d, $m, $y] = explode('/', $input['start_date']);
            $start_date = $y - 543 . '-' . $m . '-' . $d;
        }
        $input['end_date'] = $request->end_date;
        if (!empty($input['end_date'])) {
            [$d, $m, $y] = explode('/', $input['end_date']);
            $end_date = $y - 543 . '-' . $m . '-' . $d;
        }
        $input['synch_starttime'] = $request->synch_starttime;
        if (!empty($input['synch_starttime'])) {
            $synch_starttime = $input['synch_starttime'];
        }
        $input['synch_endtime'] = $request->synch_endtime;
        if (!empty($input['synch_endtime'])) {
            $synch_endtime = $input['synch_endtime'];
            $end = "$end_date $synch_endtime";
            $endtime = date('H:i', strtotime('-1 minutes', strtotime($end)));
        }
        $select_day = $request->select_day;
        $teacher_id = $request->teacher_id;
        $subject_id = $request->subject_id;
        $sync_id = $request->sync_id;
        $old_data = LessonSynch::join('synch_repeatday', 'lesson_synch.sync_id', '=', 'synch_repeatday.sync_id')
            ->where('lesson_synch.sync_id', $sync_id)
            ->where('lesson_synch.start_date', $start_date)
            ->where('lesson_synch.end_date', $end_date)
            ->where('lesson_synch.synch_starttime', $synch_starttime)
            ->where('lesson_synch.synch_endtime', $endtime)
            ->where('lesson_synch.teacher_id', $teacher_id)
            ->where('lesson_synch.subject_id', $subject_id)
            ->get();
        if (count($old_data) > 0) {
            $data = [];
            $empty_select = [];
            foreach ($old_data as $key => $value) {
                $data[$value['synch_repeatday']] = $value['synch_repeatday'];
            }
            $sum_repeatday = 0;
            foreach ($select_day as $key => $select) {
                if (empty($data[$select])) {
                    $result = DB::select(
                        "select count(*) as count_time from lesson_synch  inner join synch_repeatday on lesson_synch.sync_id = synch_repeatday.sync_id
            where teacher_id= '" .
                            $teacher_id .
                            "' and ( '" .
                            $start_date .
                            "' between start_date and end_date
            or '" .
                            $end_date .
                            "' between start_date and end_date)  and (synch_starttime between '" .
                            $synch_starttime .
                            "' and '$endtime'
            or synch_endtime between '" .
                            $synch_starttime .
                            "' and '$endtime')
            and synch_repeatday = '" .
                            $select .
                            "'
            ",
                    );
                    $sum_repeatday += $result[0]->count_time;
                }
            }
            if ($sum_repeatday > 0) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            $dt = Carbon::now('Asia/Bangkok');
            $d = $dt->format('Y-m-d');

            $check_repeat = LessonSynch::where('teacher_id', $teacher_id)
                ->where('subject_id', $subject_id)
                ->where('start_date', '<=', $d)
                ->where('end_date', '>=', $d)
                ->count();

            if ($check_repeat > 0) {
                echo 'repeat';
            } else {
                $data = DB::select(
                    "select * from lesson_synch  inner join synch_repeatday on lesson_synch.sync_id = synch_repeatday.sync_id
          where teacher_id= '" .
                        $teacher_id .
                        "' and ( '" .
                        $start_date .
                        "' between start_date and end_date
          or '" .
                        $end_date .
                        "' between start_date and end_date)  and (synch_starttime between '" .
                        $synch_starttime .
                        "' and '$endtime'
          or synch_endtime between '" .
                        $synch_starttime .
                        "' and '$endtime')
          and synch_repeatday in (" .
                        implode(',', $select_day) .
                        ")
          ",
                );
                $sum_repeatday = 0;
                foreach ($data as $key => $value) {
                    if ($sync_id != $value->sync_id) {
                        $sum_repeatday += 1;
                    } else {
                        $sum_repeatday += 0;
                    }
                }
                echo $sum_repeatday;
            }
        }
    }

    public function manage_lesson($type, $subject_id)
    {
        $subjectLearning = SubjectLearning::find($subject_id);
        $LessonSynch = LessonSynch::join('lesson_contents', 'lesson_synch.lesson_id', '=', 'lesson_contents.id')
            ->join('users', 'users.id', '=', 'lesson_synch.teacher_id', 'left')
            ->where('lesson_synch.subject_id', $subject_id)
            ->get();
        return view('subject_calendar.manage_lesson', ['subjectLearning' => $subjectLearning, 'LessonSynch' => $LessonSynch]);
    }
    public function manage_lesson_type2($subject_id)
    {
        $subjectLearning = SubjectLearning::find($subject_id);
        $LessonSynch = LessonContent::join('lesson_synch', 'lesson_synch.lesson_id', '=', 'lesson_contents.id', 'left')
            ->whereNull('sync_id')
            ->where('subject_id', $subject_id)
            ->get();
        return view('subject_calendar.manage_lesson_type2', ['subjectLearning' => $subjectLearning, 'LessonSynch' => $LessonSynch]);
    }
    public function manage_student($type, $id)
    {
        $subjectLearning = SubjectLearning::join('lesson_contents', 'lesson_contents.subject_id', '=', 'subject_learnings.id')
            ->join('lesson_synch', 'lesson_contents.id', '=', 'lesson_synch.lesson_id')
            ->join('users', 'users.id', '=', 'lesson_synch.teacher_id')
            ->where('sync_id', $id)
            ->where('lesson_contents.id', $type)
            ->get();
        $classStudent = ClassStudent::join('users', 'class_student.user_id', '=', 'users.id')
            ->where('sync_id', $id)
            ->get();
        return view('subject_calendar.manage_student', ['subjectLearning' => $subjectLearning, 'type' => $type, 'classStudent' => $classStudent]);
    }
    public function add_student($type, $id, Request $request)
    {
        $input['subject_id'] = $request->subject_id;
        $input['user_id'] = $request->user_add;
        $input['sync_id'] = $request->sync_id;
        $input['student_status'] = 0;
        ClassStudent::create($input);
        return redirect('subject_calendar/manage_synchronous/manage_class/' . $type . '/' . $id)->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function create_lesson($type, $id)
    {
        $LessonContent = LessonContent::where('subject_id', $id)->get();
        $subjectLearning = SubjectLearning::find($type);
        $User = User::where('user_type', 3)->get();
        return view('subject_calendar.create_lesson', ['subjectLearning' => $subjectLearning, 'LessonContent' => $LessonContent, 'User' => $User, 'type' => $id]);
    }

    public function edit_lesson($subject_id, $id)
    {
        $LessonContent = LessonContent::where('subject_id', $subject_id)->get();
        $subjectLearning = SubjectLearning::find($subject_id);
        $User = User::where('user_type', 3)->get();
        $LessonSynch = LessonSynch::where('sync_id', $id)->get();
        return view('subject_calendar.edit_lesson', ['subjectLearning' => $subjectLearning, 'LessonContent' => $LessonContent, 'User' => $User, 'type' => $id, 'LessonSynch' => $LessonSynch]);
    }
    
    public function store_lesson($type, Request $request)
    {
        // dd($request->all());
        $input['lesson_id'] = $request->lesson_id;
        $input['start_date'] = $request->start_date;
        $input['end_date'] = $request->end_date;
        $input['synch_time'] = $request->synch_time;
        $input['synch_amount'] = $request->synch_amount;
        $input['teacher_id'] = $request->teacher_id;
        if (!empty($request->synch_starttime)) {
            $synch_starttime = $request->synch_starttime;
        } else {
            $synch_starttime = null;
        }
        if (!empty($request->synch_endtime)) {
            $synch_endtime = $request->synch_endtime;
        } else {
            $synch_endtime = null;
        }
        $input['synch_status'] = $request->synch_status;
        if (!empty($request->start_date)) {
            [$d, $m, $y] = explode('/', $request->start_date);
            $start_date = $y - 543 . '-' . $m . '-' . $d;
        } else {
            $start_date = null;
        }
        if (!empty($request->end_date)) {
            [$d, $m, $y] = explode('/', $request->end_date);
            $end_date = $y - 543 . '-' . $m . '-' . $d;
        } else {
            $end_date = null;
        }
        LessonSynch::insert([
            'lesson_id' => $request->lesson_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'synch_starttime' => $synch_starttime,
            'synch_endtime' => $synch_endtime,
            'synch_amount' => $request->synch_amount,
            'teacher_id' => $request->teacher_id,
            'synch_status' => $request->synch_status,
        ]);
        return redirect('/subject_calendar/manage_lesson/1/' . $type)->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function update_lesson(Request $request, $type, $id)
    {
        $input['lesson_id'] = $request->lesson_id;
        $input['start_date'] = $request->start_date;
        $input['end_date'] = $request->end_date;
        $input['synch_amount'] = $request->synch_amount;
        $input['teacher_id'] = $request->teacher_id;
        $input['synch_status'] = $request->synch_status;
        if (!empty($request->start_date)) {
            [$d, $m, $y] = explode('/', $request->start_date);
            $start_date = $y - 543 . '-' . $m . '-' . $d;
        } else {
            $start_date = null;
        }
        if (!empty($request->end_date)) {
            [$d, $m, $y] = explode('/', $request->end_date);
            $end_date = $y - 543 . '-' . $m . '-' . $d;
        } else {
            $end_date = null;
        }
        if (!empty($request->synch_starttime)) {
            $synch_starttime = $request->synch_starttime;
        } else {
            $synch_starttime = null;
        }
        if (!empty($request->synch_endtime)) {
            $synch_endtime = $request->synch_endtime;
        } else {
            $synch_endtime = null;
        }
        DB::table('lesson_synch')
            ->where('sync_id', $id)
            ->update([
                'lesson_id' => $request->lesson_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'synch_starttime' => $synch_starttime,
                'synch_endtime' => $synch_endtime,
                'synch_amount' => $request->synch_amount,
                'teacher_id' => $request->teacher_id,
                'synch_status' => $request->synch_status,
            ]);
        return redirect('/subject_calendar/manage_lesson/1/' . $type)->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function update_class(Request $request, $type, $id)
    {
        $user_id = $request->user_id;
        $select_id = $request->select_id;
        foreach ($user_id as $key => $value) {
            if (isset($select_id[$key])) {
                $input['user_id'] = $user_id[$key];
                $input['student_status'] = 1;
                $input['sync_id'] = $id;
                DB::table('class_student')
                    ->where('sync_id', $id)
                    ->where('user_id', $user_id[$key])
                    ->update($input);
            } else {
                $input['user_id'] = $user_id[$key];
                $input['student_status'] = 0;
                $input['sync_id'] = $id;
                DB::table('class_student')
                    ->where('sync_id', $id)
                    ->where('user_id', $user_id[$key])
                    ->update($input);
            }
        }
        return redirect('subject_calendar/manage_synchronous/manage_class/' . $type . '/' . $id)->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function delete_student($id)
    {
        $ClassStudent = ClassStudent::where('class_id', $id)->delete();
    }
    public function delete_lesson(Request $request, $type, $id = '')
    {
        // dd($request->all());
        $LessonSynch = LessonSynch::where('sync_id', $id)->delete();
        return redirect('/subject_calendar/manage_lesson/1/' . $type)->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
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

    public function manage_schedule($id)
    {
        return view('subject_calendar.manage_schedule');
    }

    public function showcalendar_alltime()
    {
        if (auth()->user()->user_type != 1) {
            $schedule_time = LessonSynch::join('synch_repeatday', 'lesson_synch.sync_id', '=', 'synch_repeatday.sync_id')
                ->join('subject_learnings', 'subject_learnings.id', '=', 'lesson_synch.subject_id')
                ->join('users', 'lesson_synch.teacher_id', '=', 'users.id')
                ->where('lesson_synch.teacher_id', auth()->user()->id)
                ->orderBy('lesson_synch.end_date', 'desc')
                ->get();
        } else {
            $schedule_time = LessonSynch::join('synch_repeatday', 'lesson_synch.sync_id', '=', 'synch_repeatday.sync_id')
                ->join('subject_learnings', 'subject_learnings.id', '=', 'lesson_synch.subject_id')
                ->join('users', 'lesson_synch.teacher_id', '=', 'users.id')
                ->orderBy('lesson_synch.end_date', 'desc')
                ->get();
        }
        foreach ($schedule_time as $key => $value) {
            $startDate = new \DateTime($value->start_date);
            $enddate_convert = date_create($value->end_date);
            date_add($enddate_convert, date_interval_create_from_date_string('1 days'));
            $endDate = new \DateTime(date_format($enddate_convert, 'Y-m-d'));
            $time = strtotime($value->synch_endtime);
            $endTime = date('H:i', strtotime('+1 minutes', $time));
            $datePeriod = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);
            foreach ($datePeriod as $date) {
                if ($value->synch_repeatday == 1) {
                    if ($date->format('N') === '1') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'teacher' => $value->name,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
                if ($value->synch_repeatday == 2) {
                    if ($date->format('N') === '2') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'teacher' => $value->name,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
                if ($value->synch_repeatday == 3) {
                    if ($date->format('N') === '3') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'teacher' => $value->name,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
                if ($value->synch_repeatday == 4) {
                    if ($date->format('N') === '4') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'teacher' => $value->name,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
                if ($value->synch_repeatday == 5) {
                    if ($date->format('N') === '5') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'teacher' => $value->name,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
                if ($value->synch_repeatday == 6) {
                    if ($date->format('N') === '6') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'teacher' => $value->name,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
                if ($value->synch_repeatday == 7) {
                    if ($date->format('N') === '7') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'teacher' => $value->name,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $endTime,
                        ];
                    }
                }
            }
        }
        return json_encode($data);
    }
    public function select_subject(Request $request)
    {
        $teacher_id = $request->teacher_id;
        $data = Access_Subject::join('subject_learnings', 'subject_learnings.id', '=', 'access_subjects.subject_id')
            ->where('subject_learnings.show_subject', '=', '1')
            ->where('user_id', $teacher_id)
            ->get();
        if (count($data) == 0) {
            $html = '<option value="">เลือก</option>';
        } else {
            $html = '<option value="">เลือก</option>';
            foreach ($data as $subject) {
                $html .= '<option value="' . $subject->id . '">' . $subject->subjectName . '</option>';
            }
        }
        return response()->json(['html' => $html]);
    }

    public function checkstudent_synchtime(Request $request)
    {
        $user_id = $request->user_id;
        $sync_id = $request->sync_id;
        $lesson_synch = LessonSynch::join('synch_repeatday', 'synch_repeatday.sync_id', '=', 'lesson_synch.sync_id')
            ->where('lesson_synch.sync_id', $sync_id)
            ->get();
        $repeat_day = [];
        foreach ($lesson_synch as $key => $value) {
            $start_date = $value->start_date;
            $end_date = $value->end_date;
            $start_time = $value->synch_starttime;
            $endtime = $value->synch_endtime;
            $repeat_day[$value->synch_repeatday] = $value->synch_repeatday;
        }
        $data = DB::select(
            "select count(*) as count_time from lesson_synch  inner join synch_repeatday on lesson_synch.sync_id = synch_repeatday.sync_id
      inner join class_student on class_student.sync_id = lesson_synch.sync_id
      where user_id= '" .
                $user_id .
                "' and ( '" .
                $start_date .
                "' between start_date and end_date
      or '" .
                $end_date .
                "' between start_date and end_date)  and (synch_starttime between '" .
                $start_time .
                "' and '$endtime'
      or synch_endtime between '" .
                $start_time .
                "' and '$endtime')
      and synch_repeatday in (" .
                implode(',', $repeat_day) .
                ")
      ",
        );
        echo $data[0]->count_time;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type, $id)
    {
        // $LessonSynch = LessonSynch::where('sync_id', $id)->delete();
        // return redirect('/users')->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }
}
