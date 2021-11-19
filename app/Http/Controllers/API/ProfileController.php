<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
    public function update_profile(Request $request, $id)
    {
        // dd($request->all());
        // $request->validate([
        //     'password' => 'string|confirmed|min:6',
        // ]);
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        if (!empty($request->password)) {
            $input['password'] = Hash::make($request->password);
        }
        if ($image = $request->file('user_photo')) {
            $destinationPath = 'assets/backend/img/user_profile/';
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['user_photo'] = "$profileImage";
        }
        $input['username'] = $request->username;
        $input['phone'] = $request->phone;
        $user = User::find($id);
        $user->update($input);
        return response()->json(['success' => 'ได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว'], 200);
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
