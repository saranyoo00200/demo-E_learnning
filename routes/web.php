<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IntroductionMeetController;
use App\Http\Controllers\PretestExamController;
use App\Http\Controllers\LessonContentController;
use App\Http\Controllers\PostTestExamController;
use App\Http\Controllers\SubjectLearningController;
use App\Http\Controllers\UsersLearningController;
use App\Http\Controllers\CourseListController;
use App\Http\Controllers\CategorieController;
use App\Models\PretestExamt;
use Illuminate\Support\Facades\DB;

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

//backend
//dashboard
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/{id}/tickets', [App\Http\Controllers\DashboardController::class, 'tickets'])->name('tickets');
Route::get('/dashboard/{id}/detail', [App\Http\Controllers\DashboardController::class, 'edit_detail'])->name('edit_detail');
Route::post('/dashboard/{id}/update_tickets', [App\Http\Controllers\DashboardController::class, 'update_tickets'])->name('update_tickets');

//subject_learning
Route::get('/subject_learning', [SubjectLearningController::class, 'index'])->name('subject_learning');
Route::post('/subject_learning/add', [SubjectLearningController::class, 'create'])->name('addSubject_learning');
Route::get('/subject_learning/edit/{id}', [SubjectLearningController::class, 'edit'])->name('editSubject_learning');
Route::post('/subject_learning/update/{id}', [SubjectLearningController::class, 'update'])->name('updateSubject_learning');
Route::delete('/subject_learning/delete/{id}', [SubjectLearningController::class, 'destroy'])->name('deleteSubject_learning');

Route::get('/introduction/content/{id}', [SubjectLearningController::class, 'show_introduction']);
Route::get('/pretest/subject/show/{id}', [SubjectLearningController::class, 'show_pre_test']);
Route::get('/posttest/subject/show/{id}', [SubjectLearningController::class, 'show_post_test']);
Route::get('/lesson/subject/show/{id}', [SubjectLearningController::class, 'show_lesson']);

Route::get('/subject_learning/addSubject', function () {
    $categories = DB::table('subject_categories')->get();
    // dd($categories);
    return view('subject_learning.add', compact('categories'));
});

//introduction_content
Route::post('/introduction/content/add/{id}', [IntroductionMeetController::class, 'create'])->name('addDetail');
Route::post('/introduction/content/update/{id}', [IntroductionMeetController::class, 'update'])->name('updateDetail');
Route::get('/introduction/content/show/{id}', [IntroductionMeetController::class, 'show']);
Route::get('/introduction/content/edit/{id}', [IntroductionMeetController::class, 'edit']);
Route::delete('/introduction/content/delete/{id}', [IntroductionMeetController::class, 'destroy']);

Route::get('/introduction/content/addContentMore/{id}', function ($id) {
    $subject_id = $id;
    return view('subject_learning.intro_content.add', compact('subject_id'));
});

//pre_exam
Route::post('/pretest/exam/add/{id}', [PretestExamController::class, 'create'])->name('addPreExam');
Route::get('/pretest/exam/edit/{id}', [PretestExamController::class, 'edit']);
Route::post('/pretest/exam/update/{id}', [PretestExamController::class, 'update'])->name('updatePreExam');
Route::delete('/pretest/exam/delete/{id}', [PretestExamController::class, 'destroy']);
Route::get('/pretest/exam/addIndex/{id}', function ($id) {
    $subject_id = $id;
    return view('subject_learning.pre_exam.add', compact('subject_id'));
});

//post_exam
Route::post('/posttest/exam/add/{id}', [PostTestExamController::class, 'create'])->name('addPostExam');
Route::get('/posttest/exam/edit/{id}', [PostTestExamController::class, 'edit']);
Route::post('/posttest/exam/update/{id}', [PostTestExamController::class, 'update'])->name('updatePostExam');
Route::delete('/posttest/exam/delete/{id}', [PostTestExamController::class, 'destroy']);
Route::get('/posttest/exam/addIndex/{id}', function ($id) {
    $subject_id = $id;
    return view('subject_learning.post_exam.add', compact('subject_id'));
});

//lasson
Route::post('/lesson/content/add/{id}', [LessonContentController::class, 'create'])->name('addPostLes');
Route::get('/lesson/content/edit/{id}', [LessonContentController::class, 'edit']);
Route::post('/lesson/content/update/{id}', [LessonContentController::class, 'update'])->name('updatePostLes');
Route::delete('/lesson/content/delete/{id}', [LessonContentController::class, 'destroy']);
Route::get('/lesson/content/show/{id}', [LessonContentController::class, 'show']);

Route::get('/lesson/content/addIndex/{id}', function ($id) {
    $subject_id = $id;
    return view('subject_learning.lesson.add', compact('subject_id'));
});

//categorie
Route::get('/categorie', [CategorieController::class, 'index'])->name('categorie');
Route::post('/categorie/create', [CategorieController::class, 'create']);
Route::get('/categorie/{id}/edit', [CategorieController::class, 'edit']);
Route::post('/categorie/update/{id}', [CategorieController::class, 'update']);
Route::delete('/categorie/delete/{id}', [CategorieController::class, 'destroy']);
Route::get('/categorie/addIndex', function () {
    return view('subject_learning.categorie.add');
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
// usermanage
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/main', [App\Http\Controllers\HomeController::class, 'index']);
Route::resource('/users', UserManageController::class);
Route::resource('/edit_profile', ProfileController::class);
Route::get('/export_pdf', [App\Http\Controllers\UserManageController::class, 'export_pdf']);
// Route::get('/edit_profile',[App\Http\Controllers\UserManageController::class, 'edit_profile']);
Route::post('/update_profile', [App\Http\Controllers\UserManageController::class, 'update_profile']);
Route::get('/export_excel', [App\Http\Controllers\UserManageController::class, 'export_excel']);
Route::post('/check_username', [App\Http\Controllers\UserManageController::class, 'check_username']);
Route::post('/check_email', [App\Http\Controllers\UserManageController::class, 'check_email']);
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/access_lesson/{id}', [App\Http\Controllers\UserManageController::class, 'access_lesson']);
Route::post('/check_timetable', [App\Http\Controllers\ScheduleTimeController::class, 'check_timetable']);
Route::post('/checkedit_timetable', [App\Http\Controllers\ScheduleTimeController::class, 'checkedit_timetable']);
Auth::routes();

//subject_calendar
Route::resource('/subject_calendar', SubjectCalendar_Controller::class);
Route::get('subject_calendar/manage_schedule/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'manage_schedule']);
Route::get('subject_calendar/manage_synchronous/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'manage_synchronous']);
Route::get('subject_calendar/manage_synchronous/create/{type}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'create_synchronous']);
Route::get('subject_calendar/manage_synchronous/edit/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'edit_synchronous']);
Route::post('subject_calendar/manage_synchronous/store/{type}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'store_synchronous']);
Route::post('subject_calendar/manage_synchronous/update/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'update_synchronous']);
Route::post('/subject_calendar/manage_synchronous/delete_subject/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'delete_subject']);
Route::get('subject_calendar/manage_synchronous/manage_class/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'manage_class']);
Route::post('/get_student', [App\Http\Controllers\SubjectCalendar_Controller::class, 'get_student']);
Route::post('/check_student', [App\Http\Controllers\SubjectCalendar_Controller::class, 'check_student']);
Route::post('/user_exist', [App\Http\Controllers\SubjectCalendar_Controller::class, 'user_exist']);
Route::post('subject_calendar/manage_synchronous/add_student/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'add_student']);
Route::post('subject_calendar/manage_synchronous/manage_class/update_class/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'update_class']);
Route::get('subject_calendar/manage_synchronous/delete_student/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'delete_student']);
Route::get('/subject_calendar/manage_lesson/manage_student/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'manage_student']);
Route::post('/subject_calendar/manage_lesson/update_class/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'update_class']);
Route::get('/subject_calendar/manage_lesson_type2/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'manage_lesson_type2']);
Route::get('/subject_calendar/manage_lesson/create/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'create_lesson']);
Route::get('/subject_calendar/manage_lesson/edit/{subject_id}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'edit_lesson']);
Route::post('/subject_calendar/manage_lesson/update_lesson/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'update_lesson']);
Route::post('/subject_calendar/manage_lesson/store_lesson/{type}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'store_lesson']);
Route::get('/subject_calendar/manage_lesson/edit_course/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'edit_course']);
Route::get('/subject_calendar/manage_lesson/delete_lesson/{type}/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'delete_lesson']);
//accessing
Route::get('/access_lesson/{id}', [App\Http\Controllers\UserManageController::class, 'access_lesson']);
Route::post('/update_access/{id}', [App\Http\Controllers\UserManageController::class, 'update_access']);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/chat_system', ChatController::class);
Route::resource('/newsManage', NewsController::class);
//scheduleTime
Route::resource('/schedule_time', ScheduleTimeController::class);
Route::get('/ShowTimeTable', [App\Http\Controllers\ScheduleTimeController::class, 'ShowTimeTable']);
Route::post('/checkschedule_time', [App\Http\Controllers\ScheduleTimeController::class, 'checkschedule_time']);
Route::get('/showdata_time', [App\Http\Controllers\ScheduleTimeController::class, 'showdata_time']);
Route::get('/showcalendar_time/{id}', [App\Http\Controllers\SubjectCalendar_Controller::class, 'showcalendar_time']);
Route::get('/test_datebetween', [App\Http\Controllers\ScheduleTimeController::class, 'test_datebetween']);
Route::get('/test_datebetween2', [App\Http\Controllers\ScheduleTimeController::class, 'test_datebetween2']);
Route::post('/check_synchtime', [App\Http\Controllers\SubjectCalendar_Controller::class, 'check_synchtime']);
Route::post('/checkstudent_synchtime', [App\Http\Controllers\SubjectCalendar_Controller::class, 'checkstudent_synchtime']);
Route::post('/checkedit_synchtime', [App\Http\Controllers\SubjectCalendar_Controller::class, 'checkedit_synchtime']);
Route::get('/showcalendar_alltime/', [App\Http\Controllers\SubjectCalendar_Controller::class, 'showcalendar_alltime']);
Route::post('/select_subject', [App\Http\Controllers\SubjectCalendar_Controller::class, 'select_subject']);
//frontend
//ไว้ล่างสุดเสมอเด้ออ!!!!
Route::get('/{any?}', function () {
    return view('layouts.frontend.app');
})->where('any', '.*');
