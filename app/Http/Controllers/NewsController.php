<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\SubjectLearning;
class NewsController extends Controller
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
        $news = News::join('subject_learnings','news.subject_id','=','subject_learnings.id','left')
        ->get(['news_id','news_title','subjectName','news_status','news.created_at','news_photo']);
        return view('NewsManage.index',['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectLearning =  SubjectLearning::all();
        return view('NewsManage.create',['subjectLearning' => $subjectLearning]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $input['news_title'] = $request->news_title;
      $input['subject_id'] = $request->subject_id;
      $input['news_status'] = $request->news_status;
      $input['news_detail'] = $request->news_detail;
      if ($image = $request->file('news_photo')) {
          $destinationPath = 'image/news';
          $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
          $image->move($destinationPath, $profileImage);
          $input['news_photo'] = "$profileImage";
      }
      $news = News::create($input);
      return redirect('newsManage')->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $subjectLearning =  SubjectLearning::all();
      $news = News::where('news_id',$id)->get();
      return view('NewsManage.show',['subjectLearning' => $subjectLearning,'news' => $news]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $subjectLearning =  SubjectLearning::all();
      $news = News::where('news_id',$id)->get();
      return view('NewsManage.edit',['subjectLearning' => $subjectLearning,'news' => $news]);
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
      $input['news_title'] = $request->news_title;
      $input['subject_id'] = $request->subject_id;
      $input['news_status'] = $request->news_status;
      $input['news_detail'] = $request->news_detail;
      if ($image = $request->file('news_photo')) {
          $destinationPath = 'image/news';
          $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
          $image->move($destinationPath, $profileImage);
          $input['news_photo'] = "$profileImage";
      }
      $news =  News::where('news_id',$id);
      $news->update($input);
      return redirect('newsManage')->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $news = News::where('news_id',$id);
      $news->delete();
      return redirect('/newsManage')->with('success', 'ได้ทำการลบข้อมูลเรียบร้อยแล้ว');
    }
}
