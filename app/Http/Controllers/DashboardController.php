<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\LessonSynch;
use App\Models\tickets;
use Illuminate\Support\Carbon;
class DashboardController extends Controller
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
        // chart.js bar
        $user_bar = DB::table('login_time')
            ->select(DB::raw('(COUNT(*)) as count'), DB::raw('MONTHNAME(created_at) as monthname'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('monthname')
            ->orderBy('monthname', 'desc')
            ->get();

        $count = '';
        $monthname = '';
        foreach ($user_bar as $key => $value) {
            $count .= '' . $value->count . ',';
            $monthname .= "'" . $value->monthname . "'" . ', ';
        }
        $arr['count'] = rtrim($count, ',');
        $arr['monthname'] = rtrim($monthname, ',');
        //end chart.js bar

        // tickets
        $tickets = DB::table('tickets')
            ->where('check_status', '=', '2')
            ->get();
        $tickets_count = DB::table('tickets')
            ->where('check_status', '=', '2')
            ->count();
        // end tickets

        // count data card header
        $user_student = DB::table('users')
            ->where('user_type', 2)
            ->count();
        $news = DB::table('news')
            ->where('news_status', 1)
            ->count();
        $subject = DB::table('subject_learnings')
            ->where('show_subject', 1)
            ->count();
        $lesson = DB::table('lesson_contents')
            ->join('subject_learnings', 'lesson_contents.subject_id', '=', 'subject_learnings.id')
            ->where('subject_learnings.show_subject', 1)
            ->count();
        // end count data card header
        // dd($lesson);
        // detail
        $student = DB::table('users')
            ->where('users.user_type', '=', '2')
            ->get();
        $teacher = DB::table('users')
            ->where('users.user_type', '=', '3')
            ->get();
        // end detail

        return view('dashboard', $arr, compact('student', 'teacher', 'user_student', 'news', 'subject', 'lesson', 'tickets', 'tickets_count'));
    }

    public function tickets($id)
    {
        $tickets = DB::table('tickets')
            ->where('tickets_id', $id)
            ->get();
        return view('dashboards.tickets', compact('tickets'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_detail($id)
    {
        $user = User::findOrFail($id);
        return view('Usermanage.detail', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_tickets(Request $request, $id)
    {
        // dd($request->all());
        $input['check_status'] = $request->check_status;
        $tickets = tickets::where('tickets_id', $id);
        $tickets->update($input);
        return redirect('/dashboard')->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
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
