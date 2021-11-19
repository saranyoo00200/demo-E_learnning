<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LessonSynch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
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

    public function showdata_time(Request $request, $id)
    {
        $lesson_synch = LessonSynch::join('subject_learnings', 'lesson_synch.subject_id', '=', 'subject_learnings.id')
            ->join('synch_repeatday', 'lesson_synch.sync_id', '=', 'synch_repeatday.sync_id')
            ->join('class_student', 'lesson_synch.sync_id', '=', 'class_student.sync_id')
            ->where('class_student.student_status', '1')
            ->where('class_student.user_id', $id)
            ->orderBy('lesson_synch.sync_id', 'desc')
            ->select('subject_learnings.subjectName', 'lesson_synch.start_date', 'lesson_synch.end_date', 'lesson_synch.synch_starttime', 'lesson_synch.synch_endtime', 'synch_repeatday.synch_repeatday')
            ->get();
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

    public function showdata_time_simulations(Request $request, $id)
    {
        $lesson_synch = LessonSynch::join('subject_learnings', 'lesson_synch.subject_id', '=', 'subject_learnings.id')
            ->join('synch_repeatday', 'lesson_synch.sync_id', '=', 'synch_repeatday.sync_id')
            ->join('class_student', 'lesson_synch.sync_id', '=', 'class_student.sync_id')
            // ->where('class_student.student_status', '1')
            ->where('class_student.user_id', $id)
            ->orderBy('lesson_synch.sync_id', 'desc')
            ->select('subject_learnings.subjectName', 'lesson_synch.start_date', 'lesson_synch.end_date', 'lesson_synch.synch_starttime', 'lesson_synch.synch_endtime', 'synch_repeatday.synch_repeatday')
            ->get();

        $count = LessonSynch::join('subject_learnings', 'lesson_synch.subject_id', '=', 'subject_learnings.id')
            ->join('synch_repeatday', 'lesson_synch.sync_id', '=', 'synch_repeatday.sync_id')
            ->join('class_student', 'lesson_synch.sync_id', '=', 'class_student.sync_id')
            // ->where('class_student.student_status', '1')
            ->where('class_student.user_id', $id)
            ->orderBy('lesson_synch.sync_id', 'desc')
            ->select('subject_learnings.subjectName', 'lesson_synch.start_date', 'lesson_synch.end_date', 'lesson_synch.synch_starttime', 'lesson_synch.synch_endtime', 'synch_repeatday.synch_repeatday')
            ->count();

        // dd($count);
        if ($count != 0) {
            foreach ($lesson_synch as $key => $value) {
                $startDate = new \DateTime($value->start_date);
                $enddate_convert = date_create($value->end_date);
                date_add($enddate_convert, date_interval_create_from_date_string('1 days'));
                $endDate = new \DateTime(date_format($enddate_convert, 'Y-m-d'));
                $datePeriod = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);

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
        } else {
            return json_encode($lesson_synch);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check_sync_id($id)
    {
        $check_sync_id = DB::table('class_student')
            ->join('lesson_synch', 'class_student.sync_id', '=', 'lesson_synch.sync_id')
            ->where('class_student.user_id', $id)
            ->get();

        return response()->json($check_sync_id, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check_sync_to_subject_id($id)
    {
        $check_data = DB::table('lesson_synch')
            ->join('subject_learnings', 'lesson_synch.subject_id', '=', 'subject_learnings.id')
            ->where('lesson_synch.subject_id', $id)
            // ->select('start_date', 'end_date', 'synch_starttime', 'synch_endtime', 'synch_repeatday.synch_repeatday', 'subject_learnings.subjectName')
            ->get();

        $check_sync_to_subject_id = DB::table('lesson_synch')
            ->join('subject_learnings', 'lesson_synch.subject_id', '=', 'subject_learnings.id')
            ->join('synch_repeatday', 'lesson_synch.sync_id', '=', 'synch_repeatday.sync_id')
            ->where('lesson_synch.subject_id', $id)
            ->select('start_date', 'end_date', 'synch_starttime', 'synch_endtime', 'synch_repeatday.synch_repeatday', 'subject_learnings.subjectName')
            ->get();

        foreach ($check_sync_to_subject_id as $key => $value) {
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

        return response()->json(['data' => $data, 'check_data' => $check_data], 200);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_simulation($id)
    {
        DB::table('calendar_simulations')
            ->where('subject_id', $id)
            ->delete();

        return response()->json(['msg' => 'delete success!!'], 200);
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
