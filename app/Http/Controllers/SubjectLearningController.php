<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectLearning;
use App\Models\Access_Subject;
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
        $SubjectLearning_admin = DB::table('subject_categories')
            ->join('subject_learnings', 'subject_categories.subjectType', '=', 'subject_learnings.subjectType')
            ->get();
        // dd($SubjectLearning_admin);
        $user_id = auth()->user()->id;
        $subjectLearning = DB::table('subject_learnings')
            ->join('access_subjects', 'subject_learnings.id', '=', 'access_subjects.subject_id')
            ->join('subject_categories', 'subject_categories.subjectType', '=', 'subject_learnings.subjectType')
            ->where('access_subjects.user_id', '=', $user_id)
            ->where('access_subjects.status_access', '=', '1')
            ->get('*');
        // dd($subjectLearning);
        return view('subject_learning.index', compact('subjectLearning', 'SubjectLearning_admin', 'user_id'));
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
            'title' => 'required',
            'schoolYear' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
            'subjectType' => 'required',
            'show_subject' => 'required|in:1,2',
        ]);
        // dd($request->all());

        //ส่วนของรูป
        $image = $request->file('image');

        $name_gen_image = hexdec(uniqid());

        $img_ext = strtolower($image->getClientOriginalExtension()); //นามสกุล file

        $img_name = $name_gen_image . '.' . $img_ext;

        //upload_location
        $upload_location_image = 'image/subject/';
        $full_path_image = $upload_location_image . $img_name;

        SubjectLearning::insert([
            'subjectId' => $request->subjectId,
            'subjectName' => $request->subjectName,
            'title' => $request->title,
            'schoolYear' => $request->schoolYear,
            'subjectType' => $request->subjectType,
            'show_subject' => $request->show_subject,
            'image' => $full_path_image,
        ]);

        $image->move(public_path($upload_location_image), $img_name);

        // Access_Subject-save-
        $user_id = auth()->user()->id;
        $subject_id = DB::table('subject_learnings')
            ->orderBy('id', 'desc')
            ->first()->id;

        $input['subject_id'] = $subject_id;
        $input['status_access'] = 1;
        $input['user_id'] = $user_id;
        Access_Subject::create($input);

        return redirect()
            ->route('subject_learning')
            ->with('success', 'save successfully!');
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
        $categories = DB::table('subject_categories')->get();
        return view('subject_learning.edit', compact('subjectLearning', 'categories'));
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
            'title' => 'required',
            'schoolYear' => 'required',
            'subjectType' => 'required',
            'show_subject' => 'required|in:1,2',
        ]);

        // dd($request->all());
        // dd($request->old_image);

        if ($image = $request->file('image')) {
            //ส่วนของรูป
            $name_gen_image = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension()); //นามสกุล file
            $img_name = $name_gen_image . '.' . $img_ext;
            //upload_location
            $upload_location_image = 'image/subject/';
            $full_path_image = $upload_location_image . $img_name;
            $image->move(public_path($upload_location_image), $img_name);
            $input['image'] = "$full_path_image";

            SubjectLearning::find($id)->update([
                'subjectId' => $request->subjectId,
                'subjectName' => $request->subjectName,
                'title' => $request->title,
                'schoolYear' => $request->schoolYear,
                'image' => $full_path_image,
                'subjectType' => $request->subjectType,
                'show_subject' => $request->show_subject,
            ]);

            // unlink(public_path($request->old_image));

            return redirect()
                ->route('subject_learning')
                ->with('success', 'update image successfully!');
        }

        SubjectLearning::find($id)->update([
            'subjectId' => $request->subjectId,
            'subjectName' => $request->subjectName,
            'title' => $request->title,
            'schoolYear' => $request->schoolYear,
            'subjectType' => $request->subjectType,
            'show_subject' => $request->show_subject,
        ]);

        return redirect()
            ->route('subject_learning')
            ->with('success', 'update image successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Access_Subject::where('subject_id', '=', $id)->delete();
        SubjectLearning::find($id)->delete();
        return redirect()
            ->back()
            ->with('success', 'Delete data successfully!');
    }
}
