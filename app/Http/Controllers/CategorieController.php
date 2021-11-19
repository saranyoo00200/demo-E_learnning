<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SubjectCategory;

class CategorieController extends Controller
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
        $subject_categories = DB::table('subject_categories')->get('*');
        // dd($SubjectLearning_admin);
        return view('subject_learning.categorie.index', compact('subject_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
            'category_status' => 'required|in:1,2',
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
        $upload_location = 'image/categorie/';
        $full_path = $upload_location . $img_name;

        //up load image

        SubjectCategory::create([
            'category_name' => $request->category_name,
            'category_status' => $request->category_status,
            'image' => $full_path,
        ]);

        $image->move(public_path($upload_location), $img_name);

        //subjectType
        $last_categorie_count = DB::table('subject_categories')
            ->orderBy('id', 'desc')
            ->first()->id;
        // dd($last_categorie_count);
        SubjectCategory::find($last_categorie_count)->update([
            'subjectType' => $last_categorie_count,
        ]);
        //end subjectType

        return redirect('/categorie')->with('success', 'save successfully!');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $SubjectCategory = SubjectCategory::find($id);
        // dd($SubjectCategory);
        return view('subject_learning.categorie.edit', compact('SubjectCategory'));
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
            'category_name' => 'required',
            'category_status' => 'required|in:1,2',
            'image' => 'mimes:jpg,jpeg,png',
        ]);
        // dd($request->all());

        $image = $request->file('image');

        // //up img and name
        if ($image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension()); //นามสกุล file
            $img_name = $name_gen . '.' . $img_ext;

            //upload
            $upload_location = 'image/categorie/';
            $full_path = $upload_location . $img_name;
            //test upload

            SubjectCategory::find($id)->update([
                'category_name' => $request->category_name,
                'category_status' => $request->category_status,
                'image' => $full_path,
            ]);
            // dd($request->old_image);
            // $old_image = $request->old_image;
            // unlink(public_path($old_image));

            $image->move(public_path($upload_location), $img_name);
            return redirect('/categorie')->with('success', 'update image successfully!');
        } else {
            // dd($id);
            SubjectCategory::find($id)->update([
                'category_name' => $request->category_name,
                'category_status' => $request->category_status,
            ]);
            return redirect('/categorie')->with('success', 'update image successfully!');
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
        // $img = SubjectCategory::find($id)->image;
        // unlink(public_path($img));

        SubjectCategory::find($id)->delete();
        return redirect()
            ->back()
            ->with('success', 'Delete data successfully!');
    }
}
