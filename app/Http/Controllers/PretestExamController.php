<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PretestExamt;

class PretestExamController extends Controller
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
        // dd($request->all());
        $subject_id = $id;
        $this->validate($request, [
            'question' => 'required',
            'aq1' => 'required',
            'aq2' => 'required',
            'aq3' => 'required',
            'aq4' => 'required',
            'answer' => 'required|in:1,2,3,4',
        ]);
        PretestExamt::insert([
            'question' => $request->question,
            'aq1' => $request->aq1,
            'aq2' => $request->aq2,
            'aq3' => $request->aq3,
            'aq4' => $request->aq4,
            'answer' => $request->answer,
            'subject_id' => $subject_id,
        ]);

        return redirect('/pretest/subject/show/'.$id)->with('success', 'save successfully!');
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
        $pretestExam = PretestExamt::find($id);
        return view('subject_learning.pre_exam.edit', compact('pretestExam'));
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

        PretestExamt::find($id)->update([
            'question' => $request->question,
            'aq1' => $request->aq1,
            'aq2' => $request->aq2,
            'aq3' => $request->aq3,
            'aq4' => $request->aq4,
            'answer' => $request->answer,
        ]);
        return redirect('/pretest/subject/show/'. $subject_id)->with('success', 'update image successfully!');
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
        PretestExamt::find($id)->delete();
        return redirect()->back()->with('success', 'Delete data successfully!');
    }
}
