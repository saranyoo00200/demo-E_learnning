<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectLearning;
use App\Models\ScheduleTime;
use App\Models\ScheduleRepeatday;
use Auth;
use DateTime;
use Illuminate\Support\Facades\DB;
class ScheduleTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $scheduletime = ScheduleTime::join('subject_learnings', 'schedule_time.schedule_subject', '=', 'subject_learnings.id')
        //     ->where('teacher_id', Auth::user()->id)
        //     ->get();
        // , ['scheduletime' => $scheduletime]
        return view('schedule_time.index');
    }
    public function ShowTimeTable()
    {
        $scheduletime = ScheduleTime::join('subject_learnings', 'schedule_time.schedule_subject', '=', 'subject_learnings.id')
            ->where('teacher_id', Auth::user()->id)
            ->get();
        return view('schedule_time.showtime_table', ['scheduletime' => $scheduletime]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectLearning = SubjectLearning::all();
        $scheduletime = ScheduleTime::join('subject_learnings', 'schedule_time.schedule_subject', '=', 'subject_learnings.id')
            ->where('teacher_id', Auth::user()->id)
            ->get();
        return view('schedule_time.create', ['subjectLearning' => $subjectLearning, 'scheduletime' => $scheduletime]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $input['schedule_subject'] = $request->schedule_subject;
        $input['schedule_place'] = $request->schedule_place;
        if (!empty($request->schedule_startdate)) {
            [$d, $m, $y] = explode('/', $request->schedule_startdate);
            $input['schedule_startdate'] = $y - 543 . '-' . $m . '-' . $d;
        } else {
            $input['schedule_startdate'] = null;
        }
        if (!empty($request->schedule_enddate)) {
            [$d, $m, $y] = explode('/', $request->schedule_enddate);
            $input['schedule_enddate'] = $y - 543 . '-' . $m . '-' . $d;
        } else {
            $input['schedule_enddate'] = null;
        }
        if (!empty($request->schedule_starttime)) {
            $input['schedule_starttime'] = $request->schedule_starttime;
        } else {
            $input['schedule_starttime'] = null;
        }
        if (!empty($request->schedule_endtime)) {
            $schedule_endtime = $request->schedule_endtime;
            $end = "$request->schedule_enddate $schedule_endtime";
            $input['schedule_endtime'] = date('H:i', strtotime('-1 minutes', strtotime($end)));
        } else {
            $input['schedule_endtime'] = null;
        }
        $input['teacher_id'] = Auth::user()->id;
        $schedule = ScheduleTime::create($input);
        $repeat_day['sr_repeatday'] = $request->repeat_day;
        for ($i = 1; $i < 8; $i++) {
            if (!empty($repeat_day['sr_repeatday'][$i])) {
                ScheduleRepeatday::create([
                    'sr_repeatday' => $repeat_day['sr_repeatday'][$i],
                    'schedule_id' => $schedule->id,
                ]);
            }
        }

        return redirect('/schedule_time')->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scheduleTime = ScheduleTime::join('subject_learnings', 'schedule_time.schedule_subject', '=', 'subject_learnings.id')
            ->where('schedule_id', $id)
            ->first();
        $schedule_repeatday = ScheduleRepeatday::where('schedule_id', $id)->get();
        $repeat_day = [];
        foreach ($schedule_repeatday as $key => $value) {
            $repeat_day[$value->sr_repeatday] = $value->sr_repeatday;
        }
        return view('schedule_time.show', ['scheduleTime' => $scheduleTime, 'repeat_day' => $repeat_day]);
    }
    public function showdata_time()
    {
        $scheduletime = ScheduleTime::join('subject_learnings', 'schedule_time.schedule_subject', '=', 'subject_learnings.id')
            ->join('schedule_repeatday', 'schedule_time.schedule_id', '=', 'schedule_repeatday.schedule_id')
            ->where('teacher_id', Auth::user()->id)
            ->orderBy('schedule_enddate', 'desc')
            ->get();
        foreach ($scheduletime as $key => $value) {
            $startDate = new \DateTime($value->schedule_startdate);
            $enddate_convert = date_create($value->schedule_enddate);
            date_add($enddate_convert, date_interval_create_from_date_string('1 days'));
            $endDate = new \DateTime(date_format($enddate_convert, 'Y-m-d'));
            $datePeriod = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);
            foreach ($datePeriod as $date) {
                if ($value->sr_repeatday == 1) {
                    if ($date->format('N') === '1') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->schedule_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $value->schedule_starttime,
                        ];
                    }
                }
                if ($value->sr_repeatday == 2) {
                    if ($date->format('N') === '2') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->schedule_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $value->schedule_endtime,
                        ];
                    }
                }
                if ($value->sr_repeatday == 3) {
                    if ($date->format('N') === '3') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->schedule_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $value->schedule_endtime,
                        ];
                    }
                }
                if ($value->sr_repeatday == 4) {
                    if ($date->format('N') === '4') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->schedule_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $value->schedule_endtime,
                        ];
                    }
                }
                if ($value->sr_repeatday == 5) {
                    if ($date->format('N') === '5') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->schedule_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $value->schedule_endtime,
                        ];
                    }
                }
                if ($value->sr_repeatday == 6) {
                    if ($date->format('N') === '6') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->schedule_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $value->schedule_endtime,
                        ];
                    }
                }
                if ($value->sr_repeatday == 7) {
                    if ($date->format('N') === '7') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $date->format('Y-m-d') . 'T' . $value->schedule_starttime,
                            'end' => $date->format('Y-m-d') . 'T' . $value->schedule_endtime,
                        ];
                    }
                }
            }
        }
        return json_encode($data);
    }
    public function check_timetable(Request $request)
    {
        $input['schedule_startdate'] = $request->schedule_startdate;
        if (!empty($input['schedule_startdate'])) {
            [$d, $m, $y] = explode('/', $input['schedule_startdate']);
            $schedule_startdate = $y - 543 . '-' . $m . '-' . $d;
        }
        $input['schedule_enddate'] = $request->schedule_enddate;
        if (!empty($input['schedule_enddate'])) {
            [$d, $m, $y] = explode('/', $input['schedule_enddate']);
            $schedule_enddate = $y - 543 . '-' . $m . '-' . $d;
        }
        $input['schedule_starttime'] = $request->schedule_starttime;
        if (!empty($input['schedule_starttime'])) {
            $schedule_starttime = $input['schedule_starttime'];
            $starttime = $schedule_starttime;
        }
        $input['schedule_endtime'] = $request->schedule_endtime;
        if (!empty($input['schedule_endtime'])) {
            $schedule_endtime = $input['schedule_endtime'];
            $end = "$schedule_enddate $schedule_endtime";
            $endtime = date('H:i', strtotime('-1 minutes', strtotime($end)));
        }
        $input['select_day'] = $request->select_day;
        $data = DB::select(
            "select count(*) as count_time from `schedule_time` inner join `subject_learnings` on `schedule_time`.`schedule_subject` = `subject_learnings`.`id` inner join `schedule_repeatday` on `schedule_time`.`schedule_id` = `schedule_repeatday`.`schedule_id`
      where `teacher_id` = '" .
                Auth::user()->id .
                "' and (`schedule_time`.`schedule_startdate` between '" .
                $schedule_startdate .
                "' and '$schedule_enddate'
      or `schedule_time`.`schedule_enddate` between '$schedule_startdate' and '$schedule_enddate')  and (`schedule_time`.`schedule_starttime` between '" .
                $schedule_starttime .
                "' and '$endtime'
      or `schedule_time`.`schedule_endtime` between '$schedule_starttime' and '$endtime')
      and `sr_repeatday` in ('" .
                implode(',', $input['select_day']) .
                "')",
        );
        echo $data[0]->count_time;
    }
    public function checkedit_timetable(Request $request)
    {
        $input['schedule_startdate'] = $request->schedule_startdate;
        if (!empty($input['schedule_startdate'])) {
            [$d, $m, $y] = explode('/', $input['schedule_startdate']);
            $schedule_startdate = $y - 543 . '-' . $m . '-' . $d;
        }
        $input['schedule_enddate'] = $request->schedule_enddate;
        if (!empty($input['schedule_enddate'])) {
            [$d, $m, $y] = explode('/', $input['schedule_enddate']);
            $schedule_enddate = $y - 543 . '-' . $m . '-' . $d;
        }
        $schedule_starttime = $request->schedule_starttime;
        $input['schedule_endtime'] = $request->schedule_endtime;
        if (!empty($input['schedule_endtime'])) {
            $schedule_endtime = $input['schedule_endtime'];
            $end = "$schedule_enddate $schedule_endtime";
            $endtime = date('H:i', strtotime('-1 minutes', strtotime($end)));
        }
        $select_day = $request->select_day;
        $old_data = ScheduleTime::join('schedule_repeatday', 'schedule_time.schedule_id', '=', 'schedule_repeatday.schedule_id')
            ->where('schedule_time.schedule_id', $request->schedule_id)
            ->where('schedule_time.schedule_startdate', $schedule_startdate)
            ->where('schedule_time.schedule_enddate', $schedule_enddate)
            ->where('schedule_time.schedule_starttime', $schedule_starttime)
            ->where('schedule_time.schedule_endtime', $endtime)
            ->where('schedule_time.teacher_id', Auth::user()->id)
            ->get();
        if (count($old_data) > 0) {
            $data = [];
            $empty_select = [];
            foreach ($old_data as $key => $value) {
                $data[$value['sr_repeatday']] = $value['sr_repeatday'];
            }
            $sum_repeatday = 0;
            foreach ($select_day as $key => $select) {
                if (empty($data[$select])) {
                    $data = DB::select(
                        "select count(*) as count_time from `schedule_time` inner join `subject_learnings` on `schedule_time`.`schedule_subject` = `subject_learnings`.`id` inner join `schedule_repeatday` on `schedule_time`.`schedule_id` = `schedule_repeatday`.`schedule_id`
           where `teacher_id` = '" .
                            Auth::user()->id .
                            "' and (`schedule_time`.`schedule_startdate` between '" .
                            $schedule_startdate .
                            "' and '$schedule_enddate'
           or `schedule_time`.`schedule_enddate` between '$schedule_startdate' and '$schedule_enddate')  and (`schedule_time`.`schedule_starttime` between '" .
                            $schedule_starttime .
                            "' and '$endtime'
           or `schedule_time`.`schedule_endtime` between '$schedule_starttime' and '$endtime')
           and `sr_repeatday` = '" .
                            $select .
                            "'",
                    );
                    $sum_repeatday += $data[0]->count_time;
                }
            }
            if ($sum_repeatday > 0) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            $data = DB::select(
                "select count(*) as count_time from `schedule_time` inner join `subject_learnings` on `schedule_time`.`schedule_subject` = `subject_learnings`.`id` inner join `schedule_repeatday` on `schedule_time`.`schedule_id` = `schedule_repeatday`.`schedule_id`
        where `teacher_id` = '" .
                    Auth::user()->id .
                    "' and (`schedule_time`.`schedule_startdate` between '" .
                    $schedule_startdate .
                    "' and '$schedule_enddate'
        or `schedule_time`.`schedule_enddate` between '$schedule_startdate' and '$schedule_enddate')  and (`schedule_time`.`schedule_starttime` between '" .
                    $schedule_starttime .
                    "' and '$endtime'
        or `schedule_time`.`schedule_endtime` between '$schedule_starttime' and '$endtime')
        and `sr_repeatday` in ('" .
                    implode(',', $input['select_day']) .
                    "')",
            );
            echo $data[0]->count_time;
        }
    }

    public function test_datebetween2($value = '')
    {
        $scheduletime = ScheduleTime::join('subject_learnings', 'schedule_time.schedule_subject', '=', 'subject_learnings.id')
            ->join('schedule_repeatday', 'schedule_time.schedule_id', '=', 'schedule_repeatday.schedule_id')
            ->where('teacher_id', Auth::user()->id)
            ->get();
        foreach ($scheduletime as $key => $value) {
            $startDate = new \DateTime($value->schedule_startdate);
            $endDate = new \DateTime($value->schedule_enddate);
            $datePeriod = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);
            foreach ($datePeriod as $date) {
                if ($value->sr_repeatday == 1) {
                    if ($date->format('N') === '1') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $value->schedule_starttime,
                            'end' => $value->schedule_endtime,
                        ];
                    }
                }
                if ($value->sr_repeatday == 2) {
                    if ($date->format('N') === '2') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $value->schedule_starttime,
                            'end' => $value->schedule_endtime,
                        ];
                    }
                }
                if ($value->sr_repeatday == 3) {
                    if ($date->format('N') === '3') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $value->schedule_starttime,
                            'end' => $value->schedule_endtime,
                        ];
                    }
                }
                if ($value->sr_repeatday == 4) {
                    if ($date->format('N') === '4') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $value->schedule_starttime,
                            'end' => $value->schedule_endtime,
                        ];
                    }
                }
                if ($value->sr_repeatday == 5) {
                    if ($date->format('N') === '5') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $value->schedule_starttime,
                            'end' => $value->schedule_endtime,
                        ];
                    }
                }
                if ($value->sr_repeatday == 6) {
                    if ($date->format('N') === '6') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $value->schedule_starttime,
                            'end' => $value->schedule_endtime,
                        ];
                    }
                }
                if ($value->sr_repeatday == 7) {
                    if ($date->format('N') === '7') {
                        $data[] = [
                            'title' => $value->subjectName,
                            'start' => $value->schedule_starttime,
                            'end' => $value->schedule_endtime,
                        ];
                    }
                }
            }
        }

        return json_encode($data);
    }
    public function checkschedule_time(Request $request)
    {
        $input['schedule_startdate'] = $request->schedule_startdate;
        $input['schedule_enddate'] = $request->schedule_enddate;
        $input['schedule_starttime'] = $request->schedule_starttime;
        $input['schedule_endtime'] = $request->schedule_endtime;
        ScheduleTime::first()->checkschedule_time($input);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = '')
    {
        $subjectLearning = SubjectLearning::all();
        $scheduleTime = ScheduleTime::where('schedule_id', $id)->first();
        $schedule_repeatday = ScheduleRepeatday::where('schedule_id', $id)->get();
        $repeat_day = [];
        foreach ($schedule_repeatday as $key => $value) {
            $repeat_day[$value->sr_repeatday] = $value->sr_repeatday;
        }
        return view('schedule_time.edit', ['subjectLearning' => $subjectLearning, 'scheduleTime' => $scheduleTime, 'repeat_day' => $repeat_day]);
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
        $input['schedule_subject'] = $request->schedule_subject;
        $input['schedule_place'] = $request->schedule_place;
        if (!empty($request->schedule_startdate)) {
            [$d, $m, $y] = explode('/', $request->schedule_startdate);
            $input['schedule_startdate'] = $y - 543 . '-' . $m . '-' . $d;
        } else {
            $input['schedule_startdate'] = null;
        }
        if (!empty($request->schedule_enddate)) {
            [$d, $m, $y] = explode('/', $request->schedule_enddate);
            $input['schedule_enddate'] = $y - 543 . '-' . $m . '-' . $d;
        } else {
            $input['schedule_enddate'] = null;
        }
        if (!empty($request->schedule_starttime)) {
            $input['schedule_starttime'] = $request->schedule_starttime;
        } else {
            $input['schedule_starttime'] = null;
        }
        if (!empty($request->schedule_endtime)) {
            $schedule_endtime = $request->schedule_endtime;
            $end = "$request->schedule_enddate $schedule_endtime";
            $input['schedule_endtime'] = date('H:i', strtotime('-1 minutes', strtotime($end)));
        } else {
            $input['schedule_endtime'] = null;
        }
        $input['teacher_id'] = Auth::user()->id;
        $scheduleTime = ScheduleTime::where('schedule_id', $id);
        $scheduleTime->update($input);

        ScheduleRepeatday::where('schedule_id', $id)->delete();
        $repeat_day['sr_repeatday'] = $request->repeat_day;
        for ($i = 1; $i < 8; $i++) {
            if (!empty($repeat_day['sr_repeatday'][$i])) {
                ScheduleRepeatday::create([
                    'sr_repeatday' => $repeat_day['sr_repeatday'][$i],
                    'schedule_id' => $id,
                ]);
            }
        }
        return redirect('/schedule_time')->with('success', 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $scheduleTime = ScheduleTime::where('schedule_id', $id);
        $scheduleTime->delete();
        $scheduleRepeatday = ScheduleRepeatday::where('schedule_id', $id);
        $scheduleRepeatday->delete();

        return redirect('/schedule_time')->with('success', 'ได้ทำการลบข้อมูลเรียบร้อยแล้ว');
    }
}
