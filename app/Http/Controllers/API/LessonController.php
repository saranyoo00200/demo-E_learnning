<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LessonSynch;
use Carbon\Carbon;
use PDF;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $lesson = DB::table('lesson_contents')
            ->where('lesson_contents.subject_id', '=', $id)
            ->select('id', 'image', 'title', 'lessonName', 'vdo')
            ->paginate(1);

        foreach ($lesson as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
            $value->vdo = url('/') . '/' . $value->vdo;
        }

        return response()->json($lesson, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export_pdf(Request $request, $type, $id)
    {
        $userName = DB::table('users')
            ->where('users.id', $id)
            ->get('name');

        $subjectName = DB::table('subject_learnings')
            ->where('subject_learnings.id', $type)
            ->get('subjectName');

        $day = DB::table('class_student')
            ->where('user_id', $id)
            ->where('subject_id', $type)
            ->get('graduation_day');
        // dd($day);
        $pdf = PDF::loadView('certificate.index', ['user' => $userName, 'subject' => $subjectName, 'day' => $day])->setPaper('a4', 'landscape');

        return $pdf->download('certificates.pdf');
    }

    public function learning_online($id)
    {
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

        $dt = Carbon::now('Asia/Bangkok');
        $d = $dt->format('Y-m-d');
        $t = $dt->format('H:i:s');
        $tOff = $dt->format('H:i');

        //check AttendLearning
        $data_learn_online = [];

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
                }
            }
        }
        //end check AttendLearning

        return response()->json($data_learn_online, 200);
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
    public function destroy($id)
    {
        //
    }
}
