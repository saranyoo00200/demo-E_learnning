<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IntroductionContent;

class IntroductionMeetController extends Controller
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
        // dd($id);
        $this->validate($request, [
            'title' => 'required',
            'show_intro' => 'required|in:1,2',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);

        // dd($request->all());
        // //         //เข้ารหัสรูป
        $image = $request->file('image');

        // generate
        $name_gen = hexdec(uniqid());

        $img_ext = strtolower($image->getClientOriginalExtension()); //นามสกุล file

        $img_name = $name_gen . '.' . $img_ext; // commit image with lastname

        // //upload
        $upload_location = ('image/introduction/content/');
        $full_path = $upload_location . $img_name;

        //up load image

        IntroductionContent::insert([
            'title' => $request->title,
            'show_intro' => $request->show_intro,
            'introduction_id' => $id,
            'image' => $full_path,
        ]);

        $image->move(public_path($upload_location), $img_name);

        return redirect('/introduction/content/'.$id)->with('success', 'save successfully!');
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
        $introductionContent = IntroductionContent::find($id);
        return view('subject_learning.intro_content.show', compact('introductionContent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $introductionContent = IntroductionContent::find($id);
        return view('subject_learning.intro_content.edit', compact('introductionContent'));
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


        $this->validate($request, [
            'title' => 'required',
            'show_intro' => 'required|in:1,2',
            'image' => 'mimes:jpg,jpeg,png',
        ]);

        $subject_id = $request->input('introduction_id');
        // dd($request->all());
        // dd($request->portfolio_image, $request->portfolio_title, $request->portfolio_);

        $image = $request->file('image');

        // //up img and name
        if ($image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension()); //นามสกุล file
            $img_name = $name_gen . '.' . $img_ext;

            //upload
            $upload_location = ('image/introduction/content/');
            $full_path = $upload_location . $img_name;
            //test upload

            IntroductionContent::find($id)->update([
                'title' => $request->title,
                'show_intro' => $request->show_intro,
                'image' => $full_path,
            ]);
            // dd($request->old_image);
            $old_image = $request->old_image;
            // unlink(public_path($old_image));

            $image->move(public_path($upload_location), $img_name);
            return redirect('/introduction/content/'.$subject_id)->with('success', 'update image successfully!');
        } else {
            IntroductionContent::find($id)->update([
                'title' => $request->title,
                'show_intro' => $request->show_intro,
            ]);
            return redirect('/introduction/content/'.$subject_id)->with('success', 'update image successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img = IntroductionContent::find($id)->image;
        // unlink(public_path($img));

        $introduction = IntroductionContent::find($id)->delete();
        return redirect()->back()->with('success', 'Delete data successfully!');
    }
}
