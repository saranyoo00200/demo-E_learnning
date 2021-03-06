<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\SubjectLearning;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Auth;
use App\Models\Access_Subject;
use App\Models\LessonContent;
use Illuminate\Support\Facades\Redirect;
class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        @$user_type = $_GET['user_type'];
        if (!empty($user_type)) {
            $users = User::Where('user_type', $user_type)->get();
        } else {
            $users = DB::table('users')
                ->orderBy('user_type', 'ASC')
                ->get();
        }
        return view('Usermanage.index', ['users' => $users, 'user_type' => $user_type]);
    }
    public function export_pdf(Request $request)
    {
        // dd($request->all());
        $user_type = $_GET['user_type'];
        if (!empty($user_type)) {
            $users = User::Where('user_type', $user_type)->get();
        } else {
            $users = User::All();
        }
        $pdf = PDF::loadView('Usermanage.export_pdf', ['users' => $users, 'user_type' => $user_type]);

        return $pdf->stream('list_user.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Usermanage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required',
            'username' => 'required',
            'phone' => 'required',
            'user_status' => 'required',
            'user_type' => 'required',
        ]);
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['password'] = Hash::make($request->password);
        $input['username'] = $request->username;
        $input['phone'] = $request->phone;
        $input['user_status'] = $request->user_status;
        $input['user_type'] = $request->user_type;
        if ($image = $request->file('user_photo')) {
            $destinationPath = 'assets/backend/img/user_profile/';
            $profileImage = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['user_photo'] = "$profileImage";
        }
        $user = User::create($input);
        $user->assignRole($request->input('user_type'));
        return redirect('/users')->with('success', '???????????????????????????????????????????????????????????????????????????????????????????????????');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('Usermanage.show', compact('user'));
    }

    // public function edit_profile()
    // {
    //   $id = Auth::user()->id;
    //   $user = User::findOrFail($id);
    //   return view('Usermanage.edit_profile',compact('user'));
    // }

    public function shows($id)
    {
        $subjectLearning = SubjectLearning::all();
        return view('Usermanage.access_lesson', ['user_id' => $id, 'subjectLearning' => $subjectLearning]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = '')
    {
        $user = User::findOrFail($id);
        return view('Usermanage.edit', compact('user'));
    }

    public function update_profile(Request $request)
    {
        // dd($request->all());
        $id = Auth::user()->id;
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'username' => 'required',
            'phone' => 'required',
            'user_status' => 'required',
            'user_type' => 'required',
        ]);
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
        return redirect('/dashboard')->with('success', '???????????????????????????????????????????????????????????????????????????????????????????????????');
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
        $input['user_status'] = $request->user_status;
        $input['user_type'] = $request->user_type;
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')
            ->where('model_id', $id)
            ->delete();
        $user->assignRole($request->input('user_type'));
        return redirect('/users')->with('success', '???????????????????????????????????????????????????????????????????????????????????????????????????');
    }

    public function update_access(Request $request, $id)
    {
        // dd($id);
        // dd($request->all());
        $subject_id = $request->subject_id;
        $select_id = $request->select_id;
        // $lesson_id = $request->lesson_id;
        $user = Access_Subject::where('user_id', $id);
        // dd($user);
        $user->delete();
        foreach ($subject_id as $key => $value) {
            if (isset($select_id[$key])) {
                $input['subject_id'] = $select_id[$key];
                $input['status_access'] = 1;
                echo $input['user_id'] = $id;
                Access_Subject::create($input);
            }
        }
        return redirect('/users')->with('success', '???????????????????????????????????????????????????????????????????????????????????????????????????');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/users')->with('success', '???????????????????????????????????????????????????????????????????????????????????????????????????');
    }

    public function access_lesson($id)
    {
        $subjectLearning = DB::table('subject_categories')
            ->join('subject_learnings', 'subject_categories.subjectType', '=', 'subject_learnings.subjectType')
            ->get();
        $data_group = $this->access_check($id);
        // dd($subjectLearning);
        return view('Usermanage.access_lesson', ['subjectLearning' => $subjectLearning, 'user_id' => $id, 'data_group' => $data_group]);
    }

    public function access_check($id)
    {
        $data = [];
        $result = Access_Subject::Where('user_id', $id)->get();
        foreach ($result as $key => $value) {
            $data[$value->subject_id] = $value->subject_id;
        }
        return $data;
    }

    public function subject_group()
    {
        $data = [];
        $result = SubjectLearning::join('')::all();
        foreach ($result as $key => $value) {
            $data[$value->id] = $value->id;
        }
        return $data;
    }

    function check_username(Request $request)
    {
        $username = $request->username;
        $user_id = $request->user_id;
        if (!empty($user_id)) {
            $result = User::Where('username', $username)
                ->where('id', $user_id)
                ->get()
                ->count();
            if ($result == 0) {
                echo $users = User::Where('username', $username)
                    ->get()
                    ->count();
            }
        } else {
            echo $users = User::Where('username', $username)
                ->get()
                ->count();
        }
    }
    public function check_email(Request $request)
    {
        $email = $request->email;
        $user_id = $request->user_id;
        if (!empty($user_id)) {
            $result = User::Where('email', $email)
                ->where('id', $user_id)
                ->get()
                ->count();
            if ($result == 0) {
                echo $users = User::Where('email', $email)
                    ->get()
                    ->count();
            }
        } else {
            echo $users = User::Where('email', $email)
                ->get()
                ->count();
        }
    }

    public function export_excel()
    {
        $user_type = intval($_GET['user_type']);
        return (new UsersExport($user_type))->download('users.xlsx');
    }
}
