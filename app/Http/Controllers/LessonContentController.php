<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonContent;

class LessonContentController extends Controller
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

        $this->validate($request, [
            'title' => 'required',
            'lesson' => 'required',
            'show_lesson' => 'required|in:1,2',
            'lessonName' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
            'vdo' => 'required|mimes:mp4,mov,ogg',
        ]);

        // dd($request->all());
        //ส่วนของรูป
        $image = $request->file('image');

        $name_gen_image = hexdec(uniqid());

        $img_ext = strtolower($image->getClientOriginalExtension()); //นามสกุล file

        $img_name = $name_gen_image . '.' . $img_ext;

        //upload_location
        $upload_location_image = ('image/lesson/content/');
        $full_path_image = $upload_location_image . $img_name;

        //ส่วนของวิดิโอ
        $video = $request->file('vdo');

        $name_gen_vedio = hexdec(uniqid());

        $vedio_ext = strtolower($video->getClientOriginalExtension());
        // dd($vedio_ext);
        $vedio_name = $name_gen_vedio . '.' . $vedio_ext;

        //upload_location
        $upload_location_vedio = ('video/lesson/');
        $full_path_vedio = $upload_location_vedio . $vedio_name;

        //upload
        LessonContent::insert([
            'title' => $request->title,
            'lesson' => $request->lesson,
            'lessonName' => $request->lesson,
            'show_lesson' => $request->show_lesson,
            'image' => $full_path_image,
            'vdo' => $full_path_vedio,
            'subject_id' => $subject_id,
        ]);

        $image->move(public_path($upload_location_image), $img_name);
        $video->move(public_path($upload_location_vedio), $vedio_name);

        return redirect('/lesson/subject/show/'.$subject_id)->with('success', 'save successfully!');
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
        $lessonContent = LessonContent::find($id);
        return view('subject_learning.lesson.show', compact('lessonContent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // dd($request->id);
        $lessonContent = LessonContent::find($id);
        return view('subject_learning.lesson.edit', compact('lessonContent'));
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
            'title' => 'required',
            'lesson' => 'required',
            'lessonName' => 'required',
            'show_lesson' => 'required|in:1,2',
        ]);

        $subject_id = $request->input('subject_id');
        // dd($subject_id);
        $input['title'] = $request->title;
        $input['lesson'] = $request->lesson;
        $input['lessonName'] = $request->lessonName;
        $input['show_lesson'] = $request->show_lesson;
        // $image = $request->file('vdo');

        //video
        // dd($request->all());
        if ($video = $request->file('vdo')) {
                //ส่วนของรูป
            $name_gen_video = hexdec(uniqid());
            $video_ext = strtolower($video->getClientOriginalExtension()); //นามสกุล file
            $video_name = $name_gen_video . '.' . $video_ext;
                //upload_location
            $upload_location_video = ('video/lesson/');
            $full_path_video = $upload_location_video . $video_name;
            $video->move(public_path($upload_location_video), $video_name);
            $input['vdo'] = "$full_path_video";
            // dd($request->old_video);
            // unlink(public_path($request->old_video));
        }

        //image
        if ($image = $request->file('image')) {
                //ส่วนของรูป
            $name_gen_image = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension()); //นามสกุล file
            $img_name = $name_gen_image . '.' . $img_ext;
                //upload_location
            $upload_location_image = ('image/lesson/');
            $full_path_image = $upload_location_image . $img_name;
            $image->move(public_path($upload_location_image), $img_name);
            $input['image'] = "$full_path_image";

            // unlink(public_path($request->old_image));
        }

            LessonContent::find($id)->update($input);
            return redirect('/lesson/subject/show/'.$subject_id)->with('success', 'update image successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $img = LessonContent::find($id)->image;
        // unlink(public_path($img));

        // $video = LessonContent::find($id)->vdo;
        // unlink(public_path($video));

        LessonContent::find($id)->delete();
        return redirect()->back()->with('success', 'Delete data successfully!');
    }
}
