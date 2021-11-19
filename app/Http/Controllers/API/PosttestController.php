<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PosttestScores;
use Illuminate\Support\Facades\DB;

class PosttestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posttest = DB::table('posttest_exams')->get();

        return response()->json($posttest, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkRedirectPage($type, $id)
    {
        $postScore = DB::table('posttest_scores')
            ->where('posttest_scores.subject_id', $type)
            ->where('posttest_scores.users_id', $id)
            ->select('subject_id', 'users_id', 'score')
            ->get();

        return response()->json($postScore, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function posttest_quiz(Request $request, $id)
    {
        $posttest = DB::table('posttest_exams')
            ->where('posttest_exams.subject_id', '=', $id)
            ->select('id', 'question', 'aq1', 'aq2', 'aq3', 'aq4', 'answer')
            ->get();

        return response()->json($posttest, 200);
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
        $users = $request->user_id;
        $subject_id = $id;

        $result = $request->all();
        $answer = DB::table('posttest_exams')
            ->where('subject_id', '=', $subject_id)
            ->get('*');

        $answer1 = [];
        foreach ($answer as $key => $value) {
            $answer1[$value->id] = $value->answer;
        }
        $arrResult = $result['answer'];
        $arrAnswer = $answer1;
        $score = 0;
        // dd($id);

        foreach ($arrResult as $key => $valueResult) {
            $valueAnswer = $value->answer;
            if ($valueResult == $valueAnswer) {
                $score = $score + 1;
            } else {
                $score = $score + 0;
            }
        }
        $result_score = $score;

        PosttestScores::create([
            'score' => $result_score,
            'users_id' => $users,
            'subject_id' => $subject_id,
            'timer' => $request->timer,
        ]);

        return response()->json(['message' => 'User test quized successfully!!'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_score($id)
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
    public function update(Request $request)
    {
        $countAnswer = DB::table('posttest_scores')
            ->where('users_id', $request->user_id)
            ->where('subject_id', $request->subject_id)
            ->get('*');
        $posttest_id = '';
        foreach ($countAnswer as $key => $value) {
            $posttest_id = $value->id;
            if ($countAnswer !== '') {
                PosttestScores::where('id', $posttest_id)->update([
                    'score' => $request->correctAnswers,
                    'users_id' => $request->user_id,
                    'subject_id' => $request->subject_id,
                ]);
                return response()->json(['message' => 'User updated quized successfully!!'], 200);
            }
            // dd($countAnswer);
        }
        PosttestScores::create([
            'score' => $request->correctAnswers,
            'users_id' => $request->user_id,
            'subject_id' => $request->subject_id,
        ]);
        return response()->json(['message' => 'User created quized successfully!!'], 200);
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
