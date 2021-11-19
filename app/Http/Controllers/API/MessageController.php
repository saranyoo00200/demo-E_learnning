<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function fetch(Request $request, $id)
    {
        $data = DB::table('messages')
            ->join('users', 'messages.user_id', '=', 'users.id')
            ->select('messages.text', 'messages.user_id', 'messages.created_at', 'users.name', 'users.user_photo')
            ->where('messages.sync_id', $id)
            ->get();
        $destinationPath = 'assets/backend/img/user_profile';
        foreach ($data as $key => $value) {
            $value->user_photo = url('/') . '/' . $destinationPath . '/' . $value->user_photo;
        }

        return response()->json($data, 200);
    }
    public function create(Request $request)
    {
        // dd($request->all());
        Message::create([
            'text' => $request->text,
            'sync_id' => $request->sync_id,
            'user_id' => $request->user_id,
            'created_at' => Carbon::now('Asia/Bangkok'),
        ]);
        return $request;
    }
    public function fetch_room(Request $request, $id)
    {
        // dd($request->all());
        $data = DB::table('chat_rooms')
            ->join('lesson_synch', 'chat_rooms.sync_id', '=', 'lesson_synch.sync_id')
            ->join('subject_learnings', 'lesson_synch.subject_id', '=', 'subject_learnings.id')
            ->join('class_student', 'lesson_synch.sync_id', '=', 'class_student.sync_id')
            ->where('class_student.user_id', $id)
            ->where('class_student.student_status', '=', 1)
            ->get();

        foreach ($data as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
        }
        return response()->json($data, 200);
    }

    public function fetch_room_teacher(Request $request, $id)
    {
        // dd($request->all());
        $data = DB::table('chat_rooms')
            ->join('lesson_synch', 'chat_rooms.sync_id', '=', 'lesson_synch.sync_id')
            ->join('subject_learnings', 'lesson_synch.subject_id', '=', 'subject_learnings.id')
            ->where('lesson_synch.teacher_id', $id)
            ->get();

        foreach ($data as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
        }
        return response()->json($data, 200);
    }

    public function fetch_room_id(Request $request, $id)
    {
        // dd($request->all());
        $data = DB::table('chat_rooms')
            ->join('lesson_synch', 'chat_rooms.sync_id', '=', 'lesson_synch.sync_id')
            ->join('subject_learnings', 'lesson_synch.subject_id', '=', 'subject_learnings.id')
            ->where('chat_rooms.sync_id', $id)
            ->get();

        foreach ($data as $key => $value) {
            $value->image = url('/') . '/' . $value->image;
        }
        return response()->json($data, 200);
    }

    public function user_id_to_click_online($id)
    {
        $user = DB::table('users')
            ->where('users.id', $id)
            ->select('users.name', 'users.user_photo', 'users.id')
            ->get();

        return response()->json($user, 200);
    }
}
