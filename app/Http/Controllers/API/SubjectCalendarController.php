<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ClassStudent;
use Illuminate\Support\Facades\DB;

class SubjectCalendarController extends Controller
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
    public function add_student(Request $request)
    {
        $user_id = DB::table('class_student')->get();

        $userID = "";
        foreach ($user_id as $key => $value) {
            $userID = $value->user_id;
            if ($userID == $request->user_add) {
                return response()->json(['msg' => 'user id required!'], 201);
            }
        }
        // dd($userID);
        $input['user_id'] = $request->user_add;
        $input['sync_id'] = $request->sync_id;
        $input['student_status'] = 0;
        ClassStudent::create($input);
        return response()->json(['msg' => 'success!'], 200);
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
