<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\LessonSynch;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function teaching_time($id)
    {
        $lesson_synch = LessonSynch::join('subject_learnings', 'lesson_synch.subject_id', '=', 'subject_learnings.id')
            ->join('synch_repeatday', 'lesson_synch.sync_id', '=', 'synch_repeatday.sync_id')
            ->where('lesson_synch.teacher_id', $id)
            ->orderBy('lesson_synch.sync_id', 'desc')
            // ->select('subject_learnings.subjectName', 'lesson_synch.start_date', 'lesson_synch.end_date', 'lesson_synch.synch_starttime', 'lesson_synch.synch_endtime', 'synch_repeatday.synch_repeatday')
            ->get();

        $data = [];
        foreach ($lesson_synch as $key => $value) {
            $startDate = new \DateTime($value->start_date);
            $enddate_convert = date_create($value->end_date);
            date_add($enddate_convert, date_interval_create_from_date_string('1 days'));
            $endDate = new \DateTime(date_format($enddate_convert, 'Y-m-d'));
            $datePeriod = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);
            //test => sr_repeatday
            foreach ($datePeriod as $date) {
                if ($value->synch_repeatday == 1) {
                    if ($date->format('N') === '1') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . date('H:i', strtotime('+1 minutes', strtotime($value->synch_endtime))),
                        ];
                    }
                }
                if ($value->synch_repeatday == 2) {
                    if ($date->format('N') === '2') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . date('H:i', strtotime('+1 minutes', strtotime($value->synch_endtime))),
                        ];
                    }
                }
                if ($value->synch_repeatday == 3) {
                    if ($date->format('N') === '3') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . date('H:i', strtotime('+1 minutes', strtotime($value->synch_endtime))),
                        ];
                    }
                }
                if ($value->synch_repeatday == 4) {
                    if ($date->format('N') === '4') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . date('H:i', strtotime('+1 minutes', strtotime($value->synch_endtime))),
                        ];
                    }
                }
                if ($value->synch_repeatday == 5) {
                    if ($date->format('N') === '5') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . date('H:i', strtotime('+1 minutes', strtotime($value->synch_endtime))),
                        ];
                    }
                }
                if ($value->synch_repeatday == 6) {
                    if ($date->format('N') === '6') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . date('H:i', strtotime('+1 minutes', strtotime($value->synch_endtime))),
                        ];
                    }
                }
                if ($value->synch_repeatday == 7) {
                    if ($date->format('N') === '7') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->synch_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . date('H:i', strtotime('+1 minutes', strtotime($value->synch_endtime))),
                        ];
                    }
                }
            }
        }
        return response()->json($data, 200);
        //    return json_encode($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $learnOnline = DB::table('class_student')
            ->where('class_student.sync_id', '!=', null)
            ->where('class_student.count_progress', '!=', 100)
            ->where('class_student.user_id', '=', $id)
            ->where('student_status', 1)
            ->count();

        $learnOffline = DB::table('class_student')
            ->where('class_student.sync_id', '=', null)
            ->where('class_student.count_progress', '!=', 100)
            ->where('class_student.user_id', '=', $id)
            ->count();

        $learnOnlineCheck = DB::table('class_student')
            ->where('class_student.sync_id', '!=', null)
            ->where('class_student.count_progress', '=', 100)
            ->where('class_student.user_id', '=', $id)
            ->count();

        $learnOfflineCheck = DB::table('class_student')
            ->where('class_student.sync_id', '=', null)
            ->where('class_student.count_progress', '=', 100)
            ->where('class_student.user_id', '=', $id)
            ->count();
        //check dayOfTheWeek
        $weekMap = [
            0 => 6,
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
        ];
        $dayOfTheWeek = Carbon::now()->dayOfWeek;
        $weekday = $weekMap[$dayOfTheWeek];
        //end check dayOfTheWeek

        //check date
        // date_default_timezone_set('Thailand/Bangkok');
        $dt = Carbon::now('Asia/Bangkok');
        $d = $dt->format('Y-m-d');
        $t = $dt->format('H:i:s');
        $tOff = $dt->format('H:i');
        // dd($d);
        //end check date

        //check AttendLearning
        $data_learn_online = [];
        $data_learn_offline_min = [];
        $data_learn_offline_max = [];
        $data_for_date = LessonSynch::join('synch_repeatday', 'synch_repeatday.sync_id', '=', 'lesson_synch.sync_id')
            ->where('start_date', '<=', $d)
            ->where('end_date', '>=', $d)
            ->get();
        foreach ($data_for_date as $value) {
            $data_for_weekday = LessonSynch::join('synch_repeatday', 'synch_repeatday.sync_id', '=', 'lesson_synch.sync_id')
                ->where('synch_repeatday', $weekday)
                ->select('subject_id', 'synch_starttime', 'synch_endtime')
                ->get();
        }
        if ($data_for_weekday != '') {
            foreach ($data_for_weekday as $key => $item) {
                if ($t >= $item->synch_starttime && $t <= $item->synch_endtime) {
                    $data_learn_online = DB::table('subject_categories')
                        ->join('subject_learnings', 'subject_learnings.subjectType', '=', 'subject_categories.subjectType')
                        ->join('lesson_synch', 'subject_learnings.id', '=', 'lesson_synch.subject_id')
                        ->join('class_student', 'lesson_synch.sync_id', '=', 'class_student.sync_id')
                        ->where('lesson_synch.synch_status', '=', '1')
                        ->where('class_student.user_id', $id)
                        ->where('student_status', 1)
                        ->where('lesson_synch.subject_id', '=', $item->subject_id)
                        ->select('subject_learnings.id', 'subject_learnings.subjectName', 'subject_learnings.image', 'subject_learnings.subjectType', 'subject_learnings.subjectId', 'class_student.student_status', 'class_student.class_id', 'lesson_synch.synch_starttime', 'lesson_synch.synch_endtime')
                        ->get();

                    foreach ($data_learn_online as $key => $value) {
                        $value->image = url('/') . '/' . $value->image;
                        $value->synch_starttime = date('H:i', strtotime('+0 minutes', strtotime($value->synch_starttime)));
                        $value->synch_endtime = date('H:i', strtotime('+1 minutes', strtotime($value->synch_endtime)));
                    }
                } else {
                    $data_learn_offline_min = DB::table('subject_categories')
                        ->join('subject_learnings', 'subject_learnings.subjectType', '=', 'subject_categories.subjectType')
                        ->join('lesson_synch', 'subject_learnings.id', '=', 'lesson_synch.subject_id')
                        ->join('synch_repeatday', 'synch_repeatday.sync_id', '=', 'lesson_synch.sync_id')
                        ->join('class_student', 'lesson_synch.sync_id', '=', 'class_student.sync_id')
                        ->where('lesson_synch.synch_status', '=', '1')
                        ->where('class_student.user_id', $id)
                        ->where('synch_repeatday', $weekday)
                        ->whereTime('synch_starttime', '<', $tOff)
                        ->whereTime('synch_endtime', '<', $tOff)
                        ->select('subject_learnings.id', 'subject_learnings.subjectName', 'subject_learnings.image', 'subject_learnings.subjectType', 'subject_learnings.subjectId', 'class_student.student_status', 'class_student.class_id', 'lesson_synch.synch_starttime', 'lesson_synch.synch_endtime')
                        ->get();

                    foreach ($data_learn_offline_min as $key => $value) {
                        $value->image = url('/') . '/' . $value->image;
                        $value->synch_starttime = date('H:i', strtotime('+0 minutes', strtotime($value->synch_starttime)));
                        $value->synch_endtime = date('H:i', strtotime('+1 minutes', strtotime($value->synch_endtime)));
                    }

                    $data_learn_offline_max = DB::table('subject_categories')
                        ->join('subject_learnings', 'subject_learnings.subjectType', '=', 'subject_categories.subjectType')
                        ->join('lesson_synch', 'subject_learnings.id', '=', 'lesson_synch.subject_id')
                        ->join('synch_repeatday', 'synch_repeatday.sync_id', '=', 'lesson_synch.sync_id')
                        ->join('class_student', 'lesson_synch.sync_id', '=', 'class_student.sync_id')
                        ->where('lesson_synch.synch_status', '=', '1')
                        ->where('class_student.user_id', $id)
                        ->where('synch_repeatday', $weekday)
                        ->whereTime('synch_starttime', '>', $tOff)
                        ->whereTime('synch_endtime', '>', $tOff)
                        ->select('subject_learnings.id', 'subject_learnings.subjectName', 'subject_learnings.image', 'subject_learnings.subjectType', 'subject_learnings.subjectId', 'class_student.student_status', 'class_student.class_id', 'lesson_synch.synch_starttime', 'lesson_synch.synch_endtime')
                        ->get();

                    foreach ($data_learn_offline_max as $key => $value) {
                        $value->image = url('/') . '/' . $value->image;
                        $value->synch_starttime = date('H:i', strtotime('+0 minutes', strtotime($value->synch_starttime)));
                        $value->synch_endtime = date('H:i', strtotime('+1 minutes', strtotime($value->synch_endtime)));
                    }
                }

                // dd($data_learn_offline);
            }
        }
        //end check AttendLearning

        $learnOnlines = DB::table('class_student')
            ->join('subject_learnings', 'class_student.subject_id', '=', 'subject_learnings.id')
            ->where('class_student.sync_id', '!=', null)
            ->where('class_student.count_progress', '!=', 100)
            ->where('class_student.user_id', '=', $id)
            ->where('student_status', 1)
            ->select('count_progress', 'id', 'subjectName', 'subjectId')
            ->get();

        $learnOfflines = DB::table('class_student')
            ->join('subject_learnings', 'class_student.subject_id', '=', 'subject_learnings.id')
            ->where('class_student.sync_id', '=', null)
            ->where('class_student.count_progress', '!=', 100)
            ->where('class_student.user_id', '=', $id)
            ->select('count_progress', 'id', 'subjectName', 'subjectId')
            ->get();

        $finishedOnline = DB::table('class_student')
            ->join('subject_learnings', 'class_student.subject_id', '=', 'subject_learnings.id')
            ->where('class_student.sync_id', '!=', null)
            ->where('class_student.count_progress', '=', 100)
            ->where('class_student.user_id', '=', $id)
            ->get();

        $finishedOffline = DB::table('class_student')
            ->join('subject_learnings', 'class_student.subject_id', '=', 'subject_learnings.id')
            ->where('class_student.sync_id', '=', null)
            ->where('class_student.count_progress', '=', 100)
            ->where('class_student.user_id', '=', $id)
            ->select('count_progress', 'id', 'subjectName', 'subjectId')
            ->get();

        return response()->json(['learnOnline' => $learnOnline, 'learnOffline' => $learnOffline, 'data_learn_online' => $data_learn_online, 'data_learn_offline_min' => $data_learn_offline_min, 'data_learn_offline_max' => $data_learn_offline_max, 'learnOnlineCheck' => $learnOnlineCheck, 'learnOfflineCheck' => $learnOfflineCheck, 'learnOnlines' => $learnOnlines, 'learnOfflines' => $learnOfflines, 'finishedOnline' => $finishedOnline, 'finishedOffline' => $finishedOffline], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function long_time(Request $request)
    {
        // dd($request->user_id);
        DB::table('login_time')->insert([
            'user_login' => $request->user_id,
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp(),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
        return response()->json(['msg' => 'long time success!!'], 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_progress(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
