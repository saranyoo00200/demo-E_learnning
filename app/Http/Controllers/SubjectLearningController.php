<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectLearning;
use Illuminate\Support\Facades\DB;


class SubjectLearningController extends Controller
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
        return view('subject_learning.index', compact('subjectLearning'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'subjectId' => 'required',
            'subjectName' => 'required',
            'schoolYear' => 'required',
            'subjectType' => 'required|in:1,2,3',
        ]);
        // dd($request->all());
        SubjectLearning::insert([
            'subjectId' => $request->subjectId,
            'subjectName' => $request->subjectName,
            'schoolYear' => $request->schoolYear,
            'subjectType' => $request->subjectType,
        ]);

        return redirect()->route('subject_learning')->with('success', 'save successfully!');
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
    public function show_introduction($id)
    {
        $result = DB::table('subject_learnings')
                ->join('introduction_contents', 'subject_learnings.id', '=', 'introduction_contents.introduction_id')
                ->where('introduction_contents.introduction_id', '=', $id)
                // ->select('introduction_contents.*')
                ->get();

        $subject_id = $id;

        // dd($subject_id);
        //  $result =  Introduction::find($id);
        return view('subject_learning.intro_content.index', compact('result', 'subject_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_pre_test($id)
    {
        $result = DB::table('subject_learnings')
                ->join('pretest_examts', 'subject_learnings.id', '=', 'pretest_examts.subject_id')
                ->where('pretest_examts.subject_id', '=', $id)
                // ->select('introduction_contents.*')
                ->get();

        $subject_id = $id;

        // dd($subject_id);
        //  $result =  Introduction::find($id);
        return view('subject_learning.pre_exam.index', compact('result', 'subject_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_post_test($id)
    {
        $result = DB::table('subject_learnings')
                ->join('posttest_exams', 'subject_learnings.id', '=', 'posttest_exams.subject_id')
                ->where('posttest_exams.subject_id', '=', $id)
                // ->select('introduction_contents.*')
                ->get();
        $subject_id = $id;

        // dd($subject_id);
        //  $result =  Introduction::find($id);
        return view('subject_learning.post_exam.index', compact('result', 'subject_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_lesson(Request $request, $id)
    {
        // dd($request->all());
        $result = DB::table('subject_learnings')
                ->join('lesson_contents', 'subject_learnings.id', '=', 'lesson_contents.subject_id')
                ->where('lesson_contents.subject_id', '=', $id)
                // ->select('introduction_contents.*')
                ->get();

        $subject_id = $id;

        // dd($subject_id);
        //  $result =  Introduction::find($id);
        return view('subject_learning.lesson.index', compact('result', 'subject_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subjectLearning = SubjectLearning::find($id);
        return view('subject_learning.edit', compact('subjectLearning'));
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
        // dd($request->all());
        $this->validate($request, [
            'subjectId' => 'required',
            'subjectName' => 'required',
            'schoolYear' => 'required',
            'subjectType' => 'required|in:1,2,3',
        ]);

        // dd($request->all());
        SubjectLearning::find($id)->update([
            'subjectId' => $request->subjectId,
            'subjectName' => $request->subjectName,
            'schoolYear' => $request->schoolYear,
            'subjectType' => $request->subjectType,
        ]);
        return redirect()->route('subject_learning')->with('success', 'update image successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // dd($request->id);
        SubjectLearning::find($id)->delete();
        return redirect()->back()->with('success', 'Delete data successfully!');
    }
}
