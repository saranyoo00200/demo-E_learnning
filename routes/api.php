<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubjectLearningController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PretestController;
use App\Http\Controllers\Api\PosttestController;
use App\Http\Controllers\API\SubjectCalendarController;
use App\Http\Controllers\API\TeacherContactController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\CalendarController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//login logout register refresh user-profile

Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'auth',
    ],
    function ($router) {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
    },
);

// ยืมใช้ controller in dashboard
Route::post('/long_time', [DashboardController::class, 'long_time']);
Route::get('/teaching_time/{id}', [DashboardController::class, 'teaching_time']);
//end login logout register refresh user-profile
Route::get('/index/{id}/dashboard', [DashboardController::class, 'index']);

//profile
Route::post('/update_profile/{id}', [ProfileController::class, 'update_profile']);

//show subject Learning!!
Route::post('/select_subject', [SubjectLearningController::class, 'select_subject']);
Route::post('/calendar_simulations', [SubjectLearningController::class, 'calendar_simulations']);
Route::get('/subject_home', [SubjectLearningController::class, 'subject_home']);
Route::get('/subject_recent', [SubjectLearningController::class, 'subject_recent']);
Route::get('/destroy_subject/{id}', [SubjectLearningController::class, 'destroy']);
Route::get('/data_add_lessons/{id}', [SubjectLearningController::class, 'data_add_lessons']);
Route::get('/subject_intro/{id}', [SubjectLearningController::class, 'subject_intro']);
Route::get('/scorePre/{id}', [SubjectLearningController::class, 'scorePre']);
Route::get('/scorePost/{id}', [SubjectLearningController::class, 'scorePost']);
Route::get('/my_subject_leasson/{id}', [SubjectLearningController::class, 'my_subject_leasson']);
Route::get('/my_subject_leasson_left/{id}', [SubjectLearningController::class, 'my_subject_leasson_left']);
Route::get('/subject_learning', [SubjectLearningController::class, 'index']);
Route::get('/course_options_subject/{id}', [SubjectLearningController::class, 'course_options_subject']);
Route::get('/subject_id/{id}', [SubjectLearningController::class, 'sub_id']);
Route::get('/count_synch_amount/{id}', [SubjectLearningController::class, 'count_synch_amount']);
Route::get('/subject_category', [SubjectLearningController::class, 'subject_category']);
Route::get('/content_category/{id}', [SubjectLearningController::class, 'content_category']);
Route::get('/show_data_simulations/{id}', [SubjectLearningController::class, 'show_data_simulations']);
Route::get('/dataClass_student', [SubjectLearningController::class, 'dataClass_student']);

// show news
Route::get('/news_all', [NewsController::class, 'index']);
Route::get('/news_id', [NewsController::class, 'news_id']);

//lesson
Route::get('/lesson_learning/{id}', [LessonController::class, 'index']);
Route::get('/lesson_learning/learning_online/{id}', [LessonController::class, 'learning_online']);
Route::get('/export_pdf/{type}/{id}', [LessonController::class, 'export_pdf']);

// quize---
//pretest
Route::get('/pretest_quize_all', [PretestController::class, 'index']);
Route::get('/pretest_quiz/{id}', [PretestController::class, 'pretest_quiz']);
Route::get('/checkRedirectPage/{type}/{id}', [PretestController::class, 'checkRedirectPage']);
Route::post('/pretest_save', [PretestController::class, 'update']);
Route::get('/score_all/{id}', [PretestController::class, 'show_score']);

//posttest
Route::post('/posttest_save', [PosttestController::class, 'update']);
Route::get('/checkRedirectPage2/{type}/{id}', [PosttestController::class, 'checkRedirectPage']);
Route::get('/posttest_quiz/{id}', [PosttestController::class, 'posttest_quiz']);
Route::get('/posttest_quize_all', [PosttestController::class, 'index']);

//end quize---

// add_student to course learning
Route::post('/add_student', [SubjectCalendarController::class, 'add_student']);

//teacher contact
route::get('/teacher_contact', [TeacherContactController::class, 'teacher_contact']);
route::get('/teacher_id/{id}', [TeacherContactController::class, 'teacher_id']);

//fullcalendar
route::get('/showdata_time/{id}', [CalendarController::class, 'showdata_time']);
route::get('/showdata_time_simulations/{id}', [CalendarController::class, 'showdata_time_simulations']);
route::get('/check_sync_id/{id}', [CalendarController::class, 'check_sync_id']);
route::get('/destroy_simulation/{id}', [CalendarController::class, 'destroy_simulation']);
route::get('/check_sync_to_subject_id/{id}', [CalendarController::class, 'check_sync_to_subject_id']);

// redirect_save lesson
Route::post('/redirect_save/intro_progress', [SubjectLearningController::class, 'redirect_page_intro']);
Route::post('/redirect_save/pretest_progress', [SubjectLearningController::class, 'redirect_page_pretest']);
Route::post('/redirect_save/lesson_progress', [SubjectLearningController::class, 'redirect_page_lesson']);
Route::post('/redirect_save/posttest_progress', [SubjectLearningController::class, 'redirect_page_posttest']);

// chat
Route::get('/fetch/{id}/message', [MessageController::class, 'fetch']);
Route::get('/fetch_room/subject/message/{id}', [MessageController::class, 'fetch_room']);
Route::get('/fetch_room_teacher/subject/message/{id}', [MessageController::class, 'fetch_room_teacher']);
Route::get('/fetch_room/subject/{id}/message', [MessageController::class, 'fetch_room_id']);
Route::post('/create/message', [MessageController::class, 'create']);
Route::get('/user_id_to_click_online/{id}/message', [MessageController::class, 'user_id_to_click_online']);

// contact
Route::post('/create/tickets/contact', [ContactController::class, 'create']);
