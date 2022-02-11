<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ClassStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SubjectCategory;
use App\Models\PretestScores;
use App\Models\PosttestScores;
use App\Models\LessonSynch;
use App\Models\CalendarSimulation;
use Carbon\Carbon;
// use App\Models\SubjectLearning;

class SubjectLearningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject_learning = DB::table('subject_learnings')
            ->join('subject_categories', 'subject_learnings.subjectType', '=', 'subject_categories.subjectType')
            ->where('subject_learnings.show_subject', '=', '1')
            ->select('subject_learnings.id', 'subject_learnings.subjectName', 'subject_learnings.image', 'subject_learnings.title', 'subject_learnings.subjectType', 'subject_categories.category_name')
            ->paginate(8);

        foreach ($subject_learning as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
            $subjectType = $value->subjectType;
        }

        return response()->json($subject_learning, 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function course_options_subject(Request $request, $id)
    {
        $subject_learning = DB::table('subject_learnings')
            ->join('subject_categories', 'subject_learnings.subjectType', '=', 'subject_categories.subjectType')
            ->where('subject_learnings.show_subject', '=', '1')
            ->where('subject_categories.subjectType', $id)
            ->select('subject_learnings.id', 'subject_learnings.subjectName', 'subject_learnings.image', 'subject_learnings.title', 'subject_learnings.subjectType', 'subject_categories.category_name')
            ->paginate(8);

        foreach ($subject_learning as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
            $subjectType = $value->subjectType;
        }

        return response()->json($subject_learning, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subject_home()
    {
        $subject_learning = DB::table('subject_learnings')
            ->join('subject_categories', 'subject_learnings.subjectType', '=', 'subject_categories.subjectType')
            ->where('subject_learnings.show_subject', '=', '1')
            ->orderBy('subject_learnings.id', 'DESC')
            ->select('subject_learnings.id', 'subject_learnings.subjectName', 'subject_learnings.image', 'subject_learnings.title', 'subject_learnings.subjectType', 'subject_categories.category_name')
            ->paginate(8);

        foreach ($subject_learning as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
            $subjectType = $value->subjectType;
        }

        return response()->json($subject_learning, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subject_recent()
    {
        $subject_learning = DB::table('subject_learnings')
            ->where('subject_learnings.show_subject', '=', '1')
            ->orderBy('subject_learnings.id', 'DESC')
            ->select('subject_learnings.id', 'subject_learnings.subjectName', 'subject_learnings.image', 'subject_learnings.title', 'subject_learnings.subjectType')
            ->get();

        foreach ($subject_learning as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
            $subjectType = $value->subjectType;
        }

        return response()->json($subject_learning, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sub_id($id)
    {
        $subject_learning = DB::table('subject_learnings')
            ->join('access_subjects', 'subject_learnings.id', '=', 'access_subjects.subject_id')
            ->join('users', 'access_subjects.user_id', '=', 'users.id')
            ->where('subject_learnings.id', '=', $id)
            ->where('subject_learnings.show_subject', '=', '1')
            ->where('users.user_type', '=', '3')
            ->select('subject_learnings.id', 'subject_learnings.subjectName', 'subject_learnings.image', 'subject_learnings.title', 'subject_learnings.subjectType', 'subjectId', 'users.name', 'users.email', 'users.phone')
            ->get();

        foreach ($subject_learning as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
            $subjectType = $value->subjectType;
        }

        return response()->json($subject_learning, 200);
    }

    public function scorePre($id)
    {
        $scorePre = DB::table('pretest_scores')
            ->join('subject_learnings', 'subject_learnings.id', 'pretest_scores.subject_id')
            ->where('pretest_scores.users_id', $id)
            ->select('subject_learnings.id', 'subject_learnings.subjectId', 'subject_learnings.subjectName', 'pretest_scores.score')
            ->get();
        foreach ($scorePre as $key => $value) {
            $scoreAll = DB::table('pretest_examts')
                ->where('pretest_examts.subject_id', $value->id)
                ->count();

            $data[] = [
                'id' => $value->id,
                'subjectId' => $value->subjectId,
                'subjectName' => $value->subjectName,
                'score' => $value->score,
                'scoreAll' => $scoreAll,
            ];
        }

        return response()->json($data, 200);
    }

    public function scorePost($id)
    {
        $scorePre = DB::table('posttest_scores')
            ->join('subject_learnings', 'subject_learnings.id', 'posttest_scores.subject_id')
            ->where('posttest_scores.users_id', $id)
            ->select('subject_learnings.id', 'subject_learnings.subjectId', 'subject_learnings.subjectName', 'posttest_scores.score')
            ->get();
        $data = [];
        if ($scorePre) {
            foreach ($scorePre as $key => $value) {
                $scoreAll = DB::table('posttest_exams')
                    ->where('posttest_exams.subject_id', $value->id)
                    ->count();

                $data[] = [
                    'id' => $value->id,
                    'subjectId' => $value->subjectId,
                    'subjectName' => $value->subjectName,
                    'score' => $value->score,
                    'scoreAll' => $scoreAll,
                ];
            }
        }

        return response()->json($data, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_subject_leasson(Request $request, $id)
    {
        $my_subject_leasson = DB::table('subject_categories')
            ->join('subject_learnings', 'subject_learnings.subjectType', '=', 'subject_categories.subjectType')
            ->join('lesson_synch', 'subject_learnings.id', '=', 'lesson_synch.subject_id')
            ->join('class_student', 'lesson_synch.sync_id', '=', 'class_student.sync_id')
            ->where('lesson_synch.synch_status', '=', '1')
            ->where('class_student.user_id', '=', $id)
            ->select('subject_learnings.id', 'subject_learnings.subjectName', 'subject_learnings.image', 'subject_learnings.subjectType', 'subject_learnings.subjectId', 'class_student.student_status', 'class_student.class_id', 'lesson_synch.synch_starttime', 'lesson_synch.synch_endtime', 'class_student.count_progress')
            ->get();
        // ->select('*')

        foreach ($my_subject_leasson as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
            $value->synch_starttime = date('H:i', strtotime('+0 minutes', strtotime($value->synch_starttime)));
            $value->synch_endtime = date('H:i', strtotime('+1 minutes', strtotime($value->synch_endtime)));
        }

        return response()->json($my_subject_leasson, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_subject_leasson_left(Request $request, $id)
    {
        $my_subject_leasson = DB::table('subject_categories')
            ->join('subject_learnings', 'subject_learnings.subjectType', '=', 'subject_categories.subjectType')
            ->join('lesson_synch', 'lesson_synch.subject_id', '=', 'subject_learnings.id', 'left')
            ->join('class_student', 'subject_learnings.id', '=', 'class_student.subject_id')
            ->where('subject_learnings.show_subject', '=', '1')
            ->where('lesson_synch.sync_id', null)
            ->where('class_student.user_id', '=', $id)
            ->select('subject_learnings.id', 'subject_learnings.subjectName', 'subject_learnings.image', 'subject_learnings.subjectType', 'subject_learnings.subjectId', 'class_student.student_status', 'class_student.class_id', 'class_student.count_progress', 'subject_categories.category_name')
            ->get();
        // ->select('*')

        foreach ($my_subject_leasson as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
        }

        return response()->json($my_subject_leasson, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data_add_lessons(Request $request, $id)
    {
        $my_subject_leasson = DB::table('subject_learnings')
            ->join('lesson_synch', 'subject_learnings.id', '=', 'lesson_synch.subject_id')
            ->where('lesson_synch.synch_status', '=', '1')
            ->where('lesson_synch.subject_id', '=', $id)
            ->select('sync_id', 'synch_amount', 'synch_url', 'synch_password', 'synch_openpost')
            ->get();

        return response()->json($my_subject_leasson, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar_simulations(Request $request)
    {
        // dd($request->all());
        $input['subject_id'] = $request->subject_id;
        $input['user_id'] = $request->user_id;
        $input['sync_id'] = $request->sync_id;

        CalendarSimulation::create($input);

        return response()->json(['msg' => 'insert data calendar simulations fullsuccess!!'], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select_subject(Request $request)
    {
        $user_id = $request->user_id;
        $sync_id = $request->sync_id;
        $data_in_system_timer = 0;
        $data_with_data_timer = 0;

        ///////////////////////////////////////////data_form_with_data_form/////////////////////////////////////////////////////////////////
        $data_form_check_data_form = LessonSynch::join('synch_repeatday', 'synch_repeatday.sync_id', '=', 'lesson_synch.sync_id')
            ->where('lesson_synch.sync_id', $sync_id)
            ->get();

        foreach ($data_form_check_data_form as $value) {
            $start_time = $value->synch_starttime;
            $endtime = $value->synch_endtime;
            $synch_repeatday = $value->synch_repeatday;

            $data_with_data_timer_whereBetween = LessonSynch::join('synch_repeatday', 'synch_repeatday.sync_id', '=', 'lesson_synch.sync_id')
                ->join('calendar_simulations', 'lesson_synch.sync_id', '=', 'calendar_simulations.sync_id')
                ->where('synch_repeatday.sync_id', '!=', $sync_id)
                ->where('calendar_simulations.user_id', $user_id)
                ->where('synch_repeatday.synch_repeatday', $synch_repeatday)
                ->whereBetween('synch_starttime', [$start_time, $endtime])
                ->whereBetween('synch_endtime', [$start_time, $endtime])
                ->count();

            $data_with_data_timer_whereNotBetween = LessonSynch::join('synch_repeatday', 'synch_repeatday.sync_id', '=', 'lesson_synch.sync_id')
                ->join('calendar_simulations', 'lesson_synch.sync_id', '=', 'calendar_simulations.sync_id')
                ->where('synch_repeatday.sync_id', '!=', $sync_id)
                ->where('calendar_simulations.user_id', $user_id)
                ->where('synch_repeatday.synch_repeatday', $synch_repeatday)
                ->whereNotBetween('synch_starttime', [$start_time, $endtime])
                ->whereNotBetween('synch_endtime', [$start_time, $endtime])
                ->count();
        }
        if ($data_with_data_timer_whereBetween > 0 && $data_with_data_timer_whereNotBetween > 0) {
            return response()->json(['data' => true], 200);
        }
        // return response()->json([[$data_with_data_timer_whereBetween, $data_with_data_timer_whereNotBetween], [$start_time, $endtime]], 200);
        // dd($data_with_data_timer);

        ///////////////////////////////////////////data_form_with_data_system/////////////////////////////////////////////////////////////////
        $data_form = LessonSynch::join('synch_repeatday', 'synch_repeatday.sync_id', '=', 'lesson_synch.sync_id')
            ->where('lesson_synch.sync_id', $sync_id)
            ->get();

        foreach ($data_form as $value) {
            $start_time = $value->synch_starttime;
            $endtime = $value->synch_endtime;
            $synch_repeatday = $value->synch_repeatday;

            $data_in_system_timer = LessonSynch::join('synch_repeatday', 'synch_repeatday.sync_id', '=', 'lesson_synch.sync_id')
                ->join('class_student', 'synch_repeatday.sync_id', '=', 'class_student.sync_id')
                ->where('lesson_synch.sync_id', '!=', $sync_id)
                ->where('class_student.user_id', $user_id)
                ->where('synch_repeatday.synch_repeatday', $synch_repeatday)
                ->WhereBetween('synch_starttime', [$start_time, $endtime])
                ->WhereBetween('synch_endtime', [$start_time, $endtime])
                ->count();
        }
        // dd($data_in_system_timer);
        if ($data_in_system_timer > 0) {
            return response()->json(['data' => true], 200);
        }
        // return response()->json([$data_in_system_timer, [$start_time, $endtime]], 200);
        ///////////////////////////////////////////create_class_lesson/////////////////////////////////////////////////////////////////
        // dd($request->all());

        $data = ClassStudent::all();
        $subject_id = '';
        $user_id = '';
        $sync_id = '';
        foreach ($data as $key => $value) {
            $subject_id = $value->subject_id;
            $user_id = $value->user_id;
            $sync_id = $value->sync_id;
            if ($request->sync_id == '') {
                if ($user_id == $request->user_add and $subject_id == $request->subject_id) {
                    return response()->json(['msg' => 'มีค่าอยู่แล้ว!! == null'], 200);
                }
            }
            if ($request->sync_id !== '') {
                if ($user_id == $request->user_id and $subject_id == $request->subject_id) {
                    return response()->json(['msg' => 'มีค่าอยู่แล้ว!! != null'], 200);
                }
            }
        }
        // dd($request->all());

        if ($request->sync_id != '') {
            $input['subject_id'] = $request->subject_id;
            $input['user_id'] = $request->user_id;
            $input['sync_id'] = $request->sync_id;
            $input['student_status'] = 0;
            $input['count_progress'] = 0;
            ClassStudent::create($input);

            DB::table('calendar_simulations')
                ->where('subject_id', $request->subject_id)
                ->where('user_id', $request->user_id)
                ->delete();

            return response()->json(['msg' => 'success!!'], 200);
        }
        // dd($sync_id);
        if ($request->sync_id == '') {
            $input['subject_id'] = $request->subject_id;
            $input['user_id'] = $request->user_add;
            $input['sync_id'] = $request->sync_id;
            $input['student_status'] = 1;
            $input['count_progress'] = 0;
            ClassStudent::create($input);
            return response()->json(['msg' => 'success!!'], 200);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subject_intro(Request $request, $id)
    {
        $my_subject_leasson = DB::table('subject_learnings')
            ->join('subject_categories', 'subject_learnings.subjectType', '=', 'subject_categories.subjectType')
            ->join('introduction_contents', 'subject_learnings.id', '=', 'introduction_contents.introduction_id')
            ->where('subject_learnings.show_subject', '=', 1)
            ->where('introduction_contents.show_intro', '=', 1)
            ->where('subject_learnings.id', '=', $id)
            ->select('*')
            ->get();

        foreach ($my_subject_leasson as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
            $subjectType = $value->subjectType;
        }

        return response()->json($my_subject_leasson, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show_data_simulations(Request $request, $id)
    {
        $calendar_simulations = DB::table('calendar_simulations')
            ->join('subject_learnings', 'calendar_simulations.subject_id', '=', 'subject_learnings.id')
            ->where('calendar_simulations.user_id', $id)
            ->select('user_id', 'subject_id', 'subjectName', 'subjectId', 'id')
            ->get();

        return response()->json($calendar_simulations, 200);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataClass_student(Request $request)
    {
        $dataClass_student = DB::table('class_student')
            ->select('subject_id', 'user_id')
            ->get();

        $calendar_simulations = DB::table('calendar_simulations')
            ->select('subject_id', 'user_id')
            ->get();

        return response()->json(['data' => $dataClass_student, 'simulations' => $calendar_simulations], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subject_category()
    {
        $category = SubjectCategory::all();
        return response()->json($category, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function content_category($id)
    {
        $category = SubjectCategory::join('subject_learnings', 'subject_categories.subjectType', '=', 'subject_learnings.subjectType')
            ->where('subject_learnings.subjectType', $id)
            ->where('subject_learnings.show_subject', 1)
            ->where('subject_categories.category_status', 1)
            ->get();

        foreach ($category as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
            $subjectType = $value->subjectType;

            if ($subjectType == '1') {
                $value->subjectType = 'คอมพิวเตอร์';
            } elseif ($subjectType == '2') {
                $value->subjectType = 'ภาษาไทย';
            } elseif ($subjectType == '3') {
                $value->subjectType = 'ภาษาอังกฤษ';
            }
        }

        return response()->json($category, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function count_synch_amount($id)
    {
        $count = DB::table('lesson_synch')
            ->join('class_student', 'lesson_synch.sync_id', '=', 'class_student.sync_id')
            ->where('lesson_synch.subject_id', $id)
            ->count();

        $category = SubjectCategory::join('subject_learnings', 'subject_categories.subjectType', '=', 'subject_learnings.subjectType')
            ->where('subject_learnings.id', $id)
            ->where('subject_learnings.show_subject', 1)
            ->select('subject_categories.category_name', 'subject_categories.subjectType')
            ->get();

        $my_subject_leasson = DB::table('subject_learnings')
            ->join('lesson_synch', 'subject_learnings.id', '=', 'lesson_synch.subject_id')
            ->where('lesson_synch.synch_status', '=', '1')
            ->where('lesson_synch.subject_id', '=', $id)
            ->select('sync_id', 'synch_amount', 'start_date', 'end_date')
            ->get();

        return response()->json(['countAmount' => $count, 'subjectLeasson' => $my_subject_leasson, 'category' => $category], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect_page_intro(Request $request)
    {
        $data = ClassStudent::all()
            ->where('user_id', $request->user_id)
            ->where('subject_id', $request->subject_id);
        // dd($request->all());
        $count_progress = '';
        $class_id = '';
        foreach ($data as $key => $value) {
            $count_progress = $value->count_progress;
            $class_id = $value->class_id;
            if ($count_progress == 0) {
                $input['count_progress'] = 25;
                ClassStudent::where('class_id', $class_id)->update($input);
                return response()->json(['msg' => 'success!! == 25'], 200);
            } else {
                return response()->json(['msg' => 'มีค่าอยู่แล้ว!! != 0'], 200);
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect_page_pretest(Request $request)
    {
        $data = ClassStudent::all()
            ->where('user_id', $request->user_id)
            ->where('subject_id', $request->subject_id);
        // dd($request->all());
        $count_progress = '';
        $class_id = '';
        foreach ($data as $key => $value) {
            $count_progress = $value->count_progress;
            $class_id = $value->class_id;
            if ($count_progress == 25) {
                $input['count_progress'] = $count_progress + 25;
                ClassStudent::where('class_id', $class_id)->update($input);
                return response()->json(['msg' => 'success!! == 50'], 200);
            } else {
                return response()->json(['msg' => 'มีค่าอยู่แล้ว!! > 25'], 200);
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect_page_lesson(Request $request)
    {
        $data = ClassStudent::all()
            ->where('user_id', $request->user_id)
            ->where('subject_id', $request->subject_id);
        // dd($data);
        $count_progress = '';
        $class_id = '';
        foreach ($data as $key => $value) {
            $count_progress = $value->count_progress;
            $class_id = $value->class_id;
            if ($count_progress == 50) {
                $input['count_progress'] = $count_progress + 25;
                ClassStudent::where('class_id', $class_id)->update($input);
                return response()->json(['msg' => 'success!! == 75'], 200);
            } else {
                return response()->json(['msg' => 'มีค่าอยู่แล้ว!! > 75'], 200);
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect_page_posttest(Request $request)
    {
        $dt = Carbon::now('Asia/Bangkok');

        $data = ClassStudent::all()
            ->where('user_id', $request->user_id)
            ->where('subject_id', $request->subject_id);
        // dd($request->all());
        $count_progress = '';
        $class_id = '';
        foreach ($data as $key => $value) {
            $count_progress = $value->count_progress;
            $class_id = $value->class_id;
            if ($count_progress == 75) {
                $input['count_progress'] = $count_progress + 25;
                $input['graduation_day'] = $dt;
                ClassStudent::where('class_id', $class_id)->update($input);
                return response()->json(['msg' => 'success!! == 100'], 200);
            } else {
                return response()->json(['msg' => 'มีค่าอยู่แล้ว!! > 75'], 200);
            }
        }
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
        $class_student = DB::table('class_student')
            ->where('class_id', $id)
            ->get();
        foreach ($class_student as $key => $value) {
            PretestScores::where('users_id', $value->user_id)
                ->where('subject_id', $value->subject_id)
                ->delete();
            PosttestScores::where('users_id', $value->user_id)
                ->where('subject_id', $value->subject_id)
                ->delete();
        }
        // dd($class_student);
        $class_id = ClassStudent::where('class_id', $id);
        $class_id->delete();
        return response()->json(['msg' => 'delete success!!'], 200);
    }
}
