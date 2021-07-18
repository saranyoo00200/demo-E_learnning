<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectLearning;
use Illuminate\Support\Facades\DB;
use App\Models\PretestExamt;
use App\Models\PosttestExam;
use App\Models\PretestScores;
use App\Models\PosttestScores;

use Carbon\Carbon;

class CourseListController extends Controller
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
        return view('course_list.index', compact('subjectLearning'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check_pretest_save(Request $request, $id)
    {
        // dd($request->all());
        // dd($id);
        $users = auth()->user()->id;
        $subject_id = $id;

        $result = $request->all();
        $answer = DB::table('pretest_examts')->where('subject_id', '=', $subject_id)->get('*');

        $answer1 = [];
        foreach ($answer as $key => $value) {
            $answer1[$value->id] = $value->answer;
        }
        $arrResult = $result['answer'];
        $arrAnswer = $answer1;
        $score = 0;

        foreach ($arrResult as $key => $valueResult) {
            $valueAnswer = $value->answer;
            if ($valueResult == $valueAnswer) {
                // echo '1'.'<br>';
                $score = $score + 1;
            } else {
                // echo '0'.'<br>';
                $score = $score + 0;
            }
        }
        $result_score = $score;
        // $test = [];
        // $scores = DB::table('pretest_scores')->get('users_id');
        // foreach ($scores as $key => $value) {
        //     $test = $value->users_id;
        //     if ($test == $users) {
        //         return redirect('/show_answer/' . $id);
        //     }
        //     dd($test);
        // }
        PretestScores::insert([
            'score' => $result_score,
            'users_id' => $users,
            'subject_id' => $subject_id,
            'timer' => $request->timer,
            'created_at' => Carbon::now(),
        ]);

        // dd($arrResult, $arrAnswer, $result_score);
        return redirect('/show_answer/' . $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check_posttest_save(Request $request, $id)
    {
        $users = auth()->user()->id;
        $subject_id = $id;

        $result = $request->all();
        $answer = DB::table('posttest_exams')->where('subject_id', '=', $subject_id)->get('*');

        $answer1 = [];
        foreach ($answer as $key => $value) {
            $answer1[$value->id] = $value->answer;
        }
        $arrResult = $result['answer'];
        $arrAnswer = $answer1;
        $score = 0;
        // dd($answer1);

        foreach ($arrResult as $key => $valueResult) {
            $valueAnswer = $value->answer;
            if ($valueResult == $valueAnswer) {
                // echo '1'.'<br>';
                $score = $score + 1;
            } else {
                // echo '0'.'<br>';
                $score = $score + 0;
            }
        }
        $result_score = $score;

        // $scores = DB::table('posttest_scores')->get('*');
        // foreach ($scores as $key => $value) {
        //     $test = $value->users_id;
        //     if ($test == $users) {
        //         return redirect('/show_answer_2/' . $id);
        //     }
        // }

        PosttestScores::insert([
            'score' => $result_score,
            'users_id' => $users,
            'subject_id' => $subject_id,
            'timer' => $request->timer,
            'created_at' => Carbon::now(),
        ]);

        // dd($request->all());

        // dd($arrResult, $arrAnswer, $result_score);
        return redirect('/show_answer_2/' . $id);
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
    public function total_score(Request $request, $id)
    {
        $subject = DB::table('subject_learnings')
            ->where('id', '=', $id)
            ->get('*');

        $score = DB::table('users')
            ->join('pretest_scores', 'users.id', '=', 'pretest_scores.users_id')
            ->join('posttest_scores', 'users.id', '=', 'posttest_scores.users_id')
            ->select('users.name', 'pretest_scores.score as preScore', 'posttest_scores.score as postScore')
            ->get();
        // dd($score);  

        //count score
        $preScore = DB::table('pretest_examts')->where('subject_id', '=', $id);
        $postScore = DB::table('posttest_exams')->where('subject_id', '=', $id);

        return view('course_list.total_score', compact('subject', 'score', 'preScore', 'postScore'));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_answer($id)
    {
        $subject_id = $id;
        $users = auth()->user()->id;

        $preScore = PretestScores::all()->where('users_id', '=', $users)->where('subject_id', '=', $subject_id);

        // dd($id);
        $subject = DB::table('subject_learnings')
            ->join('pretest_scores', 'subject_learnings.id', '=', 'pretest_scores.subject_id')
            ->where('pretest_scores.subject_id', '=', $subject_id)
            ->where('users_id', '=', $users)
            ->get();

        $introduction = DB::table('introduction_contents')
            ->join('pretest_scores', 'introduction_contents.introduction_id', '=', 'pretest_scores.subject_id')
            ->where('pretest_scores.subject_id', '=', $subject_id)
            ->where('users_id', '=', $users)
            ->get();

        //donut chart
        $result = DB::table('users')
            ->join('pretest_scores', 'users.id', '=', 'pretest_scores.users_id')
            ->where('pretest_scores.users_id', '=', $users)
            ->where('pretest_scores.subject_id', '=', $subject_id)
            ->get('score');
        // dd($result);

        $chartData = "";
        foreach ($result as $valuePre) {
            $chartData = "['ข้อที่ตอบถูก', " . $valuePre->score . '],';
        }
        // dd($chartData);

        $pretestExam = PretestExamt::all()->where('subject_id', '=', $subject_id);
        $sumChart = $pretestExam->count() - $valuePre->score;

        $chartTotal = "['ข้อที่ตอบผิด', " . $sumChart . '],';
        // dd($chartTotal);
        //donut chart end

        // line chart
        $score = DB::table('subject_learnings')
            ->join('pretest_scores', 'subject_learnings.id', '=', 'pretest_scores.subject_id')
            ->where('pretest_scores.subject_id', '=', $id)
            ->selectRaw('score,count(pretest_scores.users_id) as amount')
            ->groupBy('pretest_scores.score')
            ->orderByRaw('CONVERT(pretest_scores.score, SIGNED) ASC')
            ->get();

        // dd($score);
        // $score = PretestScores::select('score')
        //     ->where('pretest_scores.subject_id', '=', $id)
        //     ->selectRaw('count(score) as amount')
        //     ->groupBy('score')
        //     ->orderBy('score', 'ASC')
        //     ->get();

        $label_score = "";
        $data_score = "";
        foreach ($score as $value) {
            $label_score .= "" . $value->score . ",";
            $data_score .= "" . $value->amount . ",";
        }
        // dd($label_score, $data_score);
        //line chart end

        //score me

        $scoreMe = DB::table('subject_learnings')
            ->join('pretest_scores', 'subject_learnings.id', '=', 'pretest_scores.subject_id')
            ->where('pretest_scores.subject_id', '=', $id)
            ->where('pretest_scores.users_id', '=', $users)
            ->selectRaw('score,count(pretest_scores.users_id) as amount')
            ->groupBy('pretest_scores.score')
            ->get();

        $scoreMe_score = "";
        $scoreMe_label = "";
        foreach ($scoreMe as $value) {
            $scoreMe_score .= "" . $value->score . "";
        }

        $scoreTest = PretestScores::select('score')
            ->where('pretest_scores.subject_id', '=', $id)
            ->where('score', '=', $scoreMe_score)
            ->selectRaw('count(score) as amount')
            ->groupBy('score')
            ->orderBy('score', 'ASC')
            ->get();

        foreach ($scoreTest as $key => $value) {
            $scoreMe_label .= "" . $value->amount . "";
        }

        // dd($scoreMe_label);
        //score me end

        $arr['scoreMe_score'] = rtrim($scoreMe_score, ',');
        $arr['scoreMe_label'] = rtrim($scoreMe_label, ',');

        $arr['label_score'] = rtrim($label_score, ',');
        $arr['data_score'] = rtrim($data_score, ',');
        //
        $arr['chartTotal'] = rtrim($chartTotal, ',');
        $arr['chartData'] = rtrim($chartData, ',');
        // dd($arr);
        return view('course_list.show_answer', $arr, compact('subject_id', 'preScore', 'subject', 'introduction', 'pretestExam'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_answer_2($id)
    {
        $subject_id = $id;
        $users = auth()->user()->id;
        // dd($users);
        $posttestExam = PosttestExam::all()->where('subject_id', '=', $subject_id);
        $postScore = PosttestScores::all()->where('subject_id', '=', $subject_id)->where('users_id', '=', $users);
        $preScore = PretestScores::all()->where('subject_id', '=', $subject_id)->where('users_id', '=', $users);

        $subject = DB::table('subject_learnings')
            ->join('posttest_scores', 'subject_learnings.id', '=', 'posttest_scores.subject_id')
            ->where('posttest_scores.subject_id', '=', $subject_id)
            ->where('users_id', '=', $users)
            ->get();

        $introduction = DB::table('introduction_contents')
            ->join('posttest_scores', 'introduction_contents.introduction_id', '=', 'posttest_scores.subject_id')
            ->where('posttest_scores.subject_id', '=', $subject_id)
            ->where('users_id', '=', $users)
            ->get();

        //pretest
        //donut chart
        $result = DB::table('users')
            ->join('pretest_scores', 'users.id', '=', 'pretest_scores.users_id')
            ->where('pretest_scores.users_id', '=', $users)
            ->where('pretest_scores.subject_id', '=', $subject_id)
            ->get('score');
        // dd($result);
        $chartData = "";
        foreach ($result as $valuePre) {
            $chartData = "['ข้อที่ตอบถูก', " . $valuePre->score . '],';
        }

        $pretestExam = PretestExamt::all()->where('subject_id', '=', $subject_id);
        $sumChart = $pretestExam->count() - $valuePre->score;

        $chartTotal = "['ข้อที่ตอบผิด', " . $sumChart . '],';
        //donut chart end

        // line chart
        $score = DB::table('subject_learnings')
            ->join('pretest_scores', 'subject_learnings.id', '=', 'pretest_scores.subject_id')
            ->where('pretest_scores.subject_id', '=', $id)
            ->selectRaw('score,count(pretest_scores.users_id) as amount')
            ->groupBy('pretest_scores.score')
            ->orderByRaw('CONVERT(pretest_scores.score, SIGNED) ASC')
            ->get();

        $label_score = "";
        $data_score = "";
        foreach ($score as $value) {
            $label_score .= "" . $value->score . ",";
            $data_score .= "" . $value->amount . ",";
        }
        // dd($label_score, $data_score);

        //score me

        $scoreMe = DB::table('subject_learnings')
            ->join('pretest_scores', 'subject_learnings.id', '=', 'pretest_scores.subject_id')
            ->where('pretest_scores.subject_id', '=', $id)
            ->where('pretest_scores.users_id', '=', $users)
            ->selectRaw('score,count(pretest_scores.users_id) as amount')
            ->groupBy('pretest_scores.score')
            ->get();

        $scoreMe_score = "";
        $scoreMe_label = "";
        foreach ($scoreMe as $value) {
            $scoreMe_score .= "" . $value->score . "";
        }

        $scoreTest = PretestScores::select('score')
            ->where('pretest_scores.subject_id', '=', $id)
            ->where('score', '=', $scoreMe_score)
            ->selectRaw('count(score) as amount')
            ->groupBy('score')
            ->orderBy('score', 'ASC')
            ->get();

        foreach ($scoreTest as $key => $value) {
            $scoreMe_label .= "" . $value->amount . "";
        }

        // dd($scoreMe_label);
        //score me end

        $arr['scoreMe_score'] = rtrim($scoreMe_score, ',');
        $arr['scoreMe_label'] = rtrim($scoreMe_label, ',');

        //line chart end
        $arr['label_score'] = rtrim($label_score, ',');
        $arr['data_score'] = rtrim($data_score, ',');
        //

        $arr['chartTotal'] = rtrim($chartTotal, ',');
        $arr['chartData'] = rtrim($chartData, ',');

        //posttest
        //donut chart
        $result2 = DB::table('users')
            ->join('posttest_scores', 'users.id', '=', 'posttest_scores.users_id')
            ->where('posttest_scores.subject_id', '=', $subject_id)
            ->get('score');

        $chartData2 = "";
        foreach ($result2 as $valuePre) {
            $chartData2 = "['ข้อที่ตอบถูก', " . $valuePre->score . '],';
        }

        $posttestExam2 = PosttestExam::all()->where('subject_id', '=', $subject_id);
        $sumChart2 = $posttestExam2->count() - $valuePre->score;
        $chartTotal2 = "['ข้อที่ตอบผิด', " . $sumChart2 . '],';
        // dd($result2);
        //donut chart end

        // line chart
        $score2 = DB::table('subject_learnings')
            ->join('posttest_scores', 'subject_learnings.id', '=', 'posttest_scores.subject_id')
            ->where('posttest_scores.subject_id', '=', $id)
            ->selectRaw('score,count(posttest_scores.users_id) as amount')
            ->groupBy('posttest_scores.score')
            ->orderByRaw('CONVERT(posttest_scores.score, SIGNED) ASC')
            ->get();

        $label_score2 = "";
        $data_score2 = "";
        foreach ($score2 as $value) {
            $label_score2 .= "" . $value->score . ",";
            $data_score2 .= "" . $value->amount . ",";
        }
        // dd($label_score2, $data_score2);
        //line chart end

        //score me poesttest

        $scoreMe2 = DB::table('subject_learnings')
            ->join('posttest_scores', 'subject_learnings.id', '=', 'posttest_scores.subject_id')
            ->where('posttest_scores.subject_id', '=', $id)
            ->where('posttest_scores.users_id', '=', $users)
            ->selectRaw('score,count(posttest_scores.users_id) as amount')
            ->groupBy('posttest_scores.score')
            ->get();

        $scoreMe_score2 = "";
        $scoreMe_label2 = "";
        foreach ($scoreMe2 as $value) {
            $scoreMe_score2 .= "" . $value->score . "";
        }

        $scoreTest2 = PosttestScores::select('score')
            ->where('posttest_scores.subject_id', '=', $id)
            ->where('score', '=', $scoreMe_score2)
            ->selectRaw('count(score) as amount')
            ->groupBy('score')
            ->orderBy('score', 'ASC')
            ->get();

        foreach ($scoreTest2 as $key => $value) {
            $scoreMe_label2 .= "" . $value->amount . "";
        }

        // dd($scoreMe_label2);
        //score me end

        $arr['scoreMe_score2'] = rtrim($scoreMe_score2, ',');
        $arr['scoreMe_label2'] = rtrim($scoreMe_label2, ',');


        $arr['label_score2'] = rtrim($label_score2, ',');
        $arr['data_score2'] = rtrim($data_score2, ',');
        //

        $arr['chartTotal2'] = rtrim($chartTotal2, ',');
        $arr['chartData2'] = rtrim($chartData2, ',');

        // dd($arr);

        return view('course_list..show_answer_2', $arr, compact('subject_id', 'postScore', 'subject', 'introduction', 'posttestExam', 'pretestExam', 'preScore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
