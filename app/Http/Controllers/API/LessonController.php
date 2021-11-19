<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
