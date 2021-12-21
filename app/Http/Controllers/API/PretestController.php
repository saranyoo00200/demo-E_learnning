<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PretestScores;
use Illuminate\Support\Facades\DB;

class PretestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pretest = DB::table('pretest_examts')->get();

        return response()->json($pretest, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkRedirectPage($type, $id)
    {
        $preScore = DB::table('pretest_scores')
            ->where('pretest_scores.subject_id', $type)
            ->where('pretest_scores.users_id', $id)
            ->select('subject_id', 'users_id')
            ->get();

        return response()->json($preScore, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pretest_quiz(Request $request, $id)
    {
        // dd($request->all());
        $data_quiz = DB::table('pretest_examts')
            ->where('pretest_examts.subject_id', '=', $id)
            // ->join('subject_learnings', 'pretest_examts.subject_id', 'subject_learnings,id')
            ->select('id', 'question', 'aq1', 'aq2', 'aq3', 'aq4', 'answer')
            ->inRandomOrder()
            ->get();
        foreach ($data_quiz as $key => $value) {
            $value->answer = base64_encode($value->answer);
        }
        // dd($answer);

        return response()->json($data_quiz, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // $users = auth()->user()->id;
        // $users = $request->user_id;
        // $subject_id = $id;

        // $result = $request->all();
        // $answer = DB::table('pretest_examts')
        //     ->where('subject_id', '=', $subject_id)
        //     ->get('*');

        // $answer1 = [];
        // foreach ($answer as $key => $value) {
        //     $answer1[$value->id] = $value->answer;
        // }

        // $arrResult = $result['answer'];
        // $arrAnswer = $answer1;
        // $score = 0;

        // foreach ($arrResult as $key => $valueResult) {
        //     $valueAnswer = $value->answer;
        //     if ($valueResult == $valueAnswer) {
        //         $score = $score + 1;
        //     } else {
        //         $score = $score + 0;
        //     }
        // }
        // $result_score = $score;

        // PretestScores::create([
        //     'score' => $result_score,
        //     'users_id' => $users,
        //     'subject_id' => $subject_id,
        //     'timer' => $request->timer,
        // ]);

        // return response()->json(['message' => 'User test quized successfully!!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_score($id)
    {
        $subject = DB::table('subject_learnings')
            ->where('id', '=', $id)
            ->select('subjectName')
            ->get();

        $score = DB::table('users')
            ->join('pretest_scores', 'users.id', '=', 'pretest_scores.users_id')
            ->join('posttest_scores', 'users.id', '=', 'posttest_scores.users_id')
            ->where('pretest_scores.subject_id', '=', $id)
            ->where('posttest_scores.subject_id', '=', $id)
            ->select('users.name', 'pretest_scores.score as preScore', 'posttest_scores.score as postScore')
            ->get();
        // dd($score);

        //count score
        $preScore = DB::table('pretest_examts')
            ->where('subject_id', '=', $id)
            ->count();
        $postScore = DB::table('posttest_exams')
            ->where('subject_id', '=', $id)
            ->count();

        $preCount['preCount'] = $preScore;
        $postCount['postCount'] = $postScore;

        return response()->json([$score, $subject, $preCount, $postCount], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        PretestScores::create([
            'score' => $request->correctAnswers,
            'users_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            // 'timer' => $request->timer,
        ]);

        return response()->json(['message' => 'User test quized successfully!!'], 200);
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
