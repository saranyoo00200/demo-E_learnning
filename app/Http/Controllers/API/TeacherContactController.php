<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TeacherContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function teacher_contact()
    {
        $teacher = DB::table('users')
            ->where('user_type', '=', 3)
            ->select('id', 'name', 'user_photo')
            ->paginate(6);

        $destinationPath = 'assets/backend/img/user_profile/';
        foreach ($teacher as $key => $value) {
            $value->user_photo = url('/') . '/' . $destinationPath . $value->user_photo;
        }

        return response()->json($teacher, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function teacher_id($id)
    {
        $teacher = DB::table('users')
            ->join('access_subjects', 'users.id', '=', 'access_subjects.user_id')
            ->join('subject_learnings', 'access_subjects.subject_id', '=', 'subject_learnings.id')
            ->where('users.id', $id)
            ->where('users.user_type', 3)
            ->where('subject_learnings.show_subject', 1)
            ->select('users.id', 'users.name', 'users.user_photo', 'users.email', 'users.phone', 'subject_learnings.subjectName', 'subject_id')
            ->get();

        $destinationPath = 'assets/backend/img/user_profile/';
        foreach ($teacher as $key => $value) {
            $value->user_photo = url('/') . '/' . $destinationPath . $value->user_photo;
        }

        return response()->json($teacher, 200);
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
