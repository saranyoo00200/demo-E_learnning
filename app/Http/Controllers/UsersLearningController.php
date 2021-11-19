<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PretestExamt;
use App\Models\LessonContent;
use App\Models\PosttestExam;
use App\Models\IntroductionContent;
use App\Models\SubjectLearning;
use Illuminate\Support\Facades\DB;


class UsersLearningController extends Controller
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
    public function index(Request $request, $id)
    {
        // dd($id);
        $subject = SubjectLearning::all()->where('id', '=', $id);
        $introduction = IntroductionContent::all()
            ->where('introduction_id', '=', $id)
            ->where('show_intro', '=', '1');
        //////////////////////////////skrip quiz test
        $users = Auth()->user()->id;
        $scores = DB::table('pretest_scores')
            ->where('users_id', '=', $users)
            ->get('*');
        // $test = "";
        // $test1 = "";
        foreach ($scores as $key => $value) {
            $test = $value->users_id;
            $test1 = $value->subject_id;
            if ($test1 == $id and $test == $users) {
                return redirect('/student_lesson/'.$id);
            }
        } 
        // dd($users, $test, $test1);

        return view('course_list.student_lesson.index', compact('id', 'subject', 'introduction'));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function users_pretest($id)
    {
        // dd($id);
        $pretestExam = DB::table('subject_learnings')
                ->join('pretest_examts', 'subject_learnings.id', '=', 'pretest_examts.subject_id')
                ->where('pretest_examts.subject_id', '=', $id)
                
                ->get();
        $subject_id = $id;        
        // dd($pretestExam);
        return view('course_list.student_lesson.pre_test', compact('pretestExam', 'subject_id'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function users_posttest($id)
    {
        $posttestExam = DB::table('subject_learnings')
                ->join('posttest_exams', 'subject_learnings.id', '=', 'posttest_exams.subject_id')
                ->where('posttest_exams.subject_id', '=', $id)
                ->get();
        $subject_id = $id;
        return view('course_list.student_lesson.post_test', compact('posttestExam' , 'subject_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function users_lesson($id)
    {
        // dd($id);
        $subject_id = $id;
        $lessonContent = DB::table('subject_learnings')
        ->join('lesson_contents', 'subject_learnings.id', '=', 'lesson_contents.subject_id')
        ->where('lesson_contents.subject_id', '=', $id)
        ->where('lesson_contents.show_lesson', '=', 1)
        ->simplePaginate(1);

        ////////////////////////////skrip quiz test
        $users = Auth()->user()->id;
        $scores = DB::table('posttest_scores')->where('users_id', '=', $users)->get('*');
        $quizSkrip = 0;
        foreach ($scores as $key => $value) {
            $test = $value->users_id;
            $test1 = $value->subject_id;
            // dd($test);
            // dd($users, $test);
            if ($test1 == $id and $test == $users) {
                $quizSkrip = 1;
            }
        } 
        // dd($quizSkrip);



        return view('course_list.student_lesson.lesson', compact('lessonContent', 'subject_id', 'quizSkrip'));
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
