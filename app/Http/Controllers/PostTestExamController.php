<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PosttestExam;

class PostTestExamController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $subject_id = $id;
        // dd($request->all());
        $this->validate($request, [
            'question' => 'required',
            'aq1' => 'required',
            'aq2' => 'required',
            'aq3' => 'required',
            'aq4' => 'required',
            'answer' => 'required|in:1,2,3,4',
        ]);
        // dd($request->all());
        PosttestExam::insert([
            'question' => $request->question,
            'aq1' => $request->aq1,
            'aq2' => $request->aq2,
            'aq3' => $request->aq3,
            'aq4' => $request->aq4,
            'answer' => $request->answer,
            'subject_id' => $subject_id,
        ]);

        return redirect('/posttest/subject/show/'.$id)->with('success', 'save successfully!');
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
        $posttestExam = PosttestExam::find($id);
        return view('subject_learning.post_exam.edit', compact('posttestExam'));
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
        $subject_id = $request->input('subject_id');
        $this->validate($request, [
            'question' => 'required',
            'aq1' => 'required',
            'aq2' => 'required',
            'aq3' => 'required',
            'aq4' => 'required',
            'answer' => 'required|in:1,2,3,4',
        ]);
        // dd($request->all());

        PosttestExam::find($id)->update([
            'question' => $request->question,
            'aq1' => $request->aq1,
            'aq2' => $request->aq2,
            'aq3' => $request->aq3,
            'aq4' => $request->aq4,
            'answer' => $request->answer,
        ]);
        return redirect('/posttest/subject/show/'.$subject_id)->with('success', 'update image successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        PosttestExam::find($id)->delete();
        return redirect()->back()->with('success', 'Delete data successfully!');
    }
}
