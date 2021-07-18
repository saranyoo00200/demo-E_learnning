<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IntroductionMeetController;
use App\Http\Controllers\PretestExamController;
use App\Http\Controllers\LessonContentController;
use App\Http\Controllers\PostTestExamController;
use App\Http\Controllers\SubjectLearningController;
use App\Http\Controllers\UsersLearningController;
use App\Http\Controllers\CourseListController;
use App\Models\PretestExamt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
    return view('welcome');
});
Route::get('/404_page', function(){
    return view('404-page');
});
//backend
//dashboard
//introduction
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);


//subject_learning
Route::get('/subject_learning', [SubjectLearningController::class, 'index'])->name('subject_learning');
Route::post('/subject_learning/add', [SubjectLearningController::class, 'create'])->name('addSubject_learning');
Route::get('/subject_learning/edit/{id}', [SubjectLearningController::class, 'edit'])->name('editSubject_learning');
Route::post('/subject_learning/update/{id}', [SubjectLearningController::class, 'update'])->name('updateSubject_learning');
Route::get('/subject_learning/delete/{id}', [SubjectLearningController::class, 'destroy'])->name('deleteSubject_learning');

Route::get('/introduction/content/{id}', [SubjectLearningController::class, 'show_introduction']);
Route::get('/pretest/subject/show/{id}', [SubjectLearningController::class, 'show_pre_test']);
Route::get('/posttest/subject/show/{id}', [SubjectLearningController::class, 'show_post_test']);
Route::get('/lesson/subject/show/{id}', [SubjectLearningController::class, 'show_lesson']);

Route::get('/subject_learning/addSubject', function () {
    return view('subject_learning.add');
});


//introduction_content
Route::post('/introduction/content/add/{id}', [IntroductionMeetController::class, 'create'])->name('addDetail');
Route::post('/introduction/content/update/{id}', [IntroductionMeetController::class, 'update'])->name('updateDetail');
Route::get('/introduction/content/edit/{id}', [IntroductionMeetController::class, 'edit']);
Route::get('/introduction/content/delete/{id}', [IntroductionMeetController::class, 'destroy']);

Route::get('/introduction/content/addContentMore/{id}', function ($id) {
    $subject_id = $id;
    return view('subject_learning.intro_content.add', compact('subject_id'));
});

//pre_exam
Route::post('/pretest/exam/add/{id}', [PretestExamController::class, 'create'])->name('addPreExam');
Route::get('/pretest/exam/edit/{id}', [PretestExamController::class, 'edit']);
Route::post('/pretest/exam/update/{id}', [PretestExamController::class, 'update'])->name('updatePreExam');
Route::get('/pretest/exam/delete/{id}', [PretestExamController::class, 'destroy']);
Route::get('/pretest/exam/addIndex/{id}', function ($id) {
    $subject_id = $id;
    return view('subject_learning.pre_exam.add', compact('subject_id'));
});

//post_exam
Route::post('/posttest/exam/add/{id}', [PostTestExamController::class, 'create'])->name('addPostExam');
Route::get('/posttest/exam/edit/{id}', [PostTestExamController::class, 'edit']);
Route::post('/posttest/exam/update/{id}', [PostTestExamController::class, 'update'])->name('updatePostExam');
Route::get('/posttest/exam/delete/{id}', [PostTestExamController::class, 'destroy']);
Route::get('/posttest/exam/addIndex/{id}', function ($id) {
    $subject_id = $id;
    return view('subject_learning.post_exam.add', compact('subject_id'));
});

//lasson
Route::post('/lesson/content/add/{id}', [LessonContentController::class, 'create'])->name('addPostLes');
Route::get('/lesson/content/edit/{id}', [LessonContentController::class, 'edit']);
Route::post('/lesson/content/update/{id}', [LessonContentController::class, 'update'])->name('updatePostLes');
Route::get('/lesson/content/delete/{id}', [LessonContentController::class, 'destroy']);
Route::get('/lesson/content/show/{id}', [LessonContentController::class, 'show']);

Route::get('/lesson/content/addIndex/{id}', function ($id) {
    $subject_id = $id;
    return view('subject_learning.lesson.add', compact('subject_id'));
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//student_lesson
Route::get('/student_index/{id}', [UsersLearningController::class, 'index']);
Route::get('/student_pretest/{id}', [UsersLearningController::class, 'users_pretest']);
Route::get('/student_posttest/{id}', [UsersLearningController::class, 'users_posttest']);
Route::get('/student_lesson/{id}', [UsersLearningController::class, 'users_lesson']);

// course_list
Route::post('/check_pretest_save/{id}', [CourseListController::class, 'check_pretest_save']);
Route::post('/check_posttest_save/{id}', [CourseListController::class, 'check_posttest_save']);
Route::get('/course_list', [CourseListController::class, 'index']);
Route::get('/total_score/{id}', [CourseListController::class, 'total_score']);
Route::get('/show_answer/{id}', [CourseListController::class, 'show_answer']);
Route::get('/show_answer_2/{id}', [CourseListController::class, 'show_answer_2']);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// Auth::routes();
//usermanage
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/main', [App\Http\Controllers\HomeController::class, 'index']);
Route::resource('/users', UserManageController::class);
Route::resource('/edit_profile', ProfileController::class);
Route::get('/export_pdf',[App\Http\Controllers\UserManageController::class, 'export_pdf']);
// Route::get('/edit_profile',[App\Http\Controllers\UserManageController::class, 'edit_profile']);
Route::post('/update_profile',[App\Http\Controllers\UserManageController::class, 'update_profile']);
Route::get('/export_excel', [App\Http\Controllers\UserManageController::class, 'export_excel']);
Route::post('/check_username', [App\Http\Controllers\UserManageController::class, 'check_username']);
Route::post('/check_email', [App\Http\Controllers\UserManageController::class, 'check_email']);
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/access_lesson/{id}', [App\Http\Controllers\UserManageController::class, 'access_lesson']);
Auth::routes();

//subject_calendar
Route::resource('/subject_calendar', SubjectCalendar_Controller::class);
Route::get('/subject_calendar/manage_lesson/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class,'manage_lesson']);
Route::get('/subject_calendar/manage_lesson/manage_student/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class,'manage_student']);
Route::post('/subject_calendar/manage_lesson/update_class/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class,'update_class']);
Route::get('/subject_calendar/manage_lesson_type2/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class,'manage_lesson_type2']);
Route::get('/subject_calendar/manage_lesson/create/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class,'create_lesson']);
Route::get('/subject_calendar/manage_lesson/edit/{subject_id}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class,'edit_lesson']);
Route::post('/subject_calendar/manage_lesson/update_lesson/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class,'update_lesson']);
Route::post('/subject_calendar/manage_lesson/store_lesson/{type}', [App\Http\Controllers\SubjectCalendar_Controller::class,'store_lesson']);
Route::get('/subject_calendar/manage_lesson/edit_course/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class,'edit_course']);
Route::get('/subject_calendar/manage_lesson/delete_lesson/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class,'delete_lesson']);
//accessing
Route::get('/access_lesson/{id}', [App\Http\Controllers\UserManageController::class, 'access_lesson']);
Route::post('/update_access/{id}', [App\Http\Controllers\UserManageController::class, 'update_access']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/chat_system', ChatController::class);
Route::resource('/newsManage', NewsController::class);
//scheduleTime
Route::resource('/schedule_time', ScheduleTimeController::class);
Route::get('/ShowTimeTable',[App\Http\Controllers\ScheduleTimeController::class, 'ShowTimeTable']);
Route::get('/showdata_time', [App\Http\Controllers\ScheduleTimeController::class, 'showdata_time']);
