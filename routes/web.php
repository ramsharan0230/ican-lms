<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//login
Route::get('/', ['as'=>'login.page', 'uses'=> 'SuperAdmin\Users\UsersController@loginPage']);
Route::get('/login', ['as'=>'login', 'uses'=> 'SuperAdmin\Users\UsersController@loginPage']);
Route::get('/register', ['as'=>'register', 'uses'=> 'SuperAdmin\Users\UsersController@register']);
Route::post('/verify', ['as' => 'login.verify', 'uses'=> 'SuperAdmin\Users\UsersController@verifyLogin']);
Route::get('/terms-and-conditions', ['as' => 'auth.terms', 'uses' => 'SuperAdmin\Users\UsersController@getTerms', 'middleware' => ['guest']]);
Route::post('/terms/accept', ['as' => 'auth.terms.accept', 'uses' => 'SuperAdmin\Users\UsersController@getTermAccept']);
Route::get('/signup', ['as' => 'auth.signup', 'uses' => 'SuperAdmin\Users\UsersController@getSignup', 'middleware' => ['guest']]);
Route::post('/signup', ['as' => 'auth.signup', 'uses' => 'SuperAdmin\Users\UsersController@postSignup', 'middleware' => ['guest']]);
Route::get('/logout', ['as' => 'login.logout', 'uses'=> 'SuperAdmin\Users\UsersController@logOut']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/terms-and-conditions', ['as' => 'auth.terms', 'uses' => 'SuperAdmin\Users\UsersController@getTerms', 'middleware' => ['guest']]);
Route::post('/terms/accept', ['as' => 'auth.terms.accept', 'uses' => 'SuperAdmin\Users\UsersController@getTermAccept']);


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', ['as'=>'super-admin-dashboard', 'uses' => 'SuperAdmin\Users\UsersController@dashboard']);

    //Users Routes Starts.
    Route::post('users/import-users-excel-sheet', ['as' => 'users.import-users-excel-sheet', 'uses' => 'SuperAdmin\Users\UsersController@importUsersExcelSheet']);
    Route::get('users/export-users-excel-sheet', ['as' => 'users.export-users-excel-sheet', 'uses' => 'SuperAdmin\Users\UsersController@exportUsersExcelSheet']);
    Route::resource('users', 'SuperAdmin\Users\UsersController');
    //Users Route Ends.

    //Categories Routes Starts
    Route::resource('e-learning/categories', 'SuperAdmin\Elearnings\Categories\CategoriesController');
    //Categories Routes Ends

    //Lessons Routes Starts
    Route::resource('e-learning/lessons', 'SuperAdmin\Elearnings\Lessons\LessonsController');
    //Lessons Routes Ends

    //Courses Routes Starts
    Route::resource('e-learning/courses', 'SuperAdmin\Elearnings\Courses\CoursesController');
    //Courses Routes Ends

     //Courses Routes Starts
     Route::resource('e-learning/questions', 'SuperAdmin\Elearnings\Questions\QuestionsController');
     //Courses Routes Ends

    //Tests Routes Starts
    Route::get('e-learning/tests/filter', 'SuperAdmin\Elearnings\Tests\TestsController@filter')->name('e-learning.tests.filter');
    Route::resource('e-learning/tests', 'SuperAdmin\Elearnings\Tests\TestsController');
    Route::post('ajax-post-test-questions/true-false', 'SuperAdmin\Elearnings\Tests\TestsController@ajaxPostTestQuestionsTrueFalse')->name('e-learning.tests.ajax-post-test-questions-true-false');
    Route::post('ajax-post-test-questions/multiple-select-single', 'SuperAdmin\Elearnings\Tests\TestsController@ajaxPostTestQuestionsMultipleSelectSingle')->name('e-learning.tests.ajax-post-test-questions-multiple-select-single');
    Route::post('ajax-post-test-questions/multiple-select-multiple', 'SuperAdmin\Elearnings\Tests\TestsController@ajaxPostTestQuestionsMultipleSelectMultiple')->name('e-learning.tests.ajax-post-test-questions-multiple-select-multiple');

    Route::post('tests-select-question-toggle', ['as' => 'tests.select-question-toggle', 'uses' => 'SuperAdmin\Elearnings\Tests\TestsController@selectQuestionToggle']);
    Route::post('tests-unselect-question', ['as' => 'tests.unselect-question', 'uses' => 'SuperAdmin\Elearnings\Tests\TestsController@unselectQuestion']);
    Route::post('tests-shuffle-answer', 'SuperAdmin\Elearnings\Tests\TestsController@shuffleAnswerToggle')->name('e-learning.tests.shuffle-answer');
    //Tests Routes Ends

    //Questions Routes Starts.
    Route::get('e-learning/questions', ['as' => 'e-learning.questions.index', 'uses' => 'SuperAdmin\Elearnings\Questions\QuestionsController@index' ]);
    Route::delete('e-learning/questions/{question}', ['as' => 'e-learning.questions.destroy', 'uses' => 'SuperAdmin\Elearnings\Questions\QuestionsController@destroy' ]);

    //True False Routes Starts.
    Route::get('e-learning/questions/true-false/create-true-false-question', ['as' => 'e-learning.questions.true-false-question-create', 'uses' => 'SuperAdmin\Elearnings\Questions\QuestionsController@createTrueFalseQuestion']);
    Route::post('e-learning/questions/true-false/create-true-false-question', ['as'=>'e-learning.questions.true-false-question-store', 'uses'=>'SuperAdmin\Elearnings\Questions\QuestionsController@storeTrueFalseQuestion']);
    Route::get('e-learning/questions/true-false/{true_false}/edit', ['as'=>'e-learning.questions.true-false-question-edit', 'uses'=>'SuperAdmin\Elearnings\Questions\QuestionsController@editTrueFalseQuestion']);
    Route::PATCH('e-learning/questions/true-false/{true_false}', ['as'=>'e-learning.questions.true-false-question-update', 'uses'=>'SuperAdmin\Elearnings\Questions\QuestionsController@updateTrueFalseQuestion']);
    //True False Routes Ends.

    //Multiple Select Single Correct Answer Routes Starts
    Route::get('e-learning/questions/multiple-select/create-multiple-select-single-question', ['as' => 'e-learning.questions.multiple-select-single-question-create','uses' => 'SuperAdmin\Elearnings\Questions\QuestionsController@createMultipleSelectSingleQuestion']);
    Route::post('e-learning/questions/multiple-select/create-multiple-select-single-question', ['as' => 'e-learning.questions.multiple-select-single-question-store', 'uses' => 'SuperAdmin\Elearnings\Questions\QuestionsController@storeMultipleSelectSingleQuestion']);
    Route::get('e-learning/questions/multiple-select/{multiple_select_single}/edit', ['as'=>'e-learning.questions.multiple-select-single-question-edit', 'uses'=>'SuperAdmin\Elearnings\Questions\QuestionsController@editMultipleSelectSingleQuestion']);
    Route::PATCH('e-learning/questions/multiple-select/{multiple_select_single}', ['as'=>'e-learning.questions.multiple-select-single-question-update', 'uses'=>'SuperAdmin\Elearnings\Questions\QuestionsController@updateMultipleSelectSingleQuestion']);
    //Multiple Select Single Correct Answer Routes Ends

    //Multiple Select Multiple Correct Answer Routes Starts
    Route::get('e-learning/questions/multiple-select/create-multiple-select-multiple-question', ['as' => 'e-learning.questions.multiple-select-multiple-question-create', 'uses' => 'SuperAdmin\Elearnings\Questions\QuestionsController@createMultipleSelectMultipleQuestion']);
    Route::post('e-learning/questions/multiple-select/create-multiple-select-multiple-question', ['as' => 'e-learning.questions.multiple-select-multiple-question-store', 'uses' => 'SuperAdmin\Elearnings\Questions\QuestionsController@storeMultipleSelectMultipleQuestion']);
    Route::get('e-learning/questions/multiple-select-multiple/{multiple_select_multiple}/edit', ['as'=>'e-learning.questions.multiple-select-multiple-question-edit', 'uses'=>'SuperAdmin\Elearnings\Questions\QuestionsController@editMultipleSelectMultipleQuestion']);
    Route::PATCH('e-learning/questions/{multiple_select_multiple}', ['as'=>'e-learning.questions.multiple-select-multiple-question-update', 'uses'=>'SuperAdmin\Elearnings\Questions\QuestionsController@updateMultipleSelectMultipleQuestion']);
    //Multiple Select Multiple Correct Answer Routes Ends

    //Questions Routes Ends

    //Assign Course Routes Starts
    Route::resource('e-learning/assign-course', 'SuperAdmin\Elearnings\AssignCourses\AssignCoursesController');
    //Assign Course Routes Ends


    //Course Orders Routes Starts
    Route::resource('course-orders', 'SuperAdmin\CourseOrder\OrderController');

    Route::get('failed-course-orders', 'SuperAdmin\CourseOrder\FailedOrderController@index')->name('course-orders.failed-orders');
    Route::get('failed-course-orders-search', 'SuperAdmin\CourseOrder\FailedOrderController@failedSearch')->name('course.orders.failed.search');
    Route::get('failed-course-order-edit/{id}', 'SuperAdmin\CourseOrder\FailedOrderController@editFailedOrder')->name('course.orders.failed.edit');
    Route::get('failed-course-order-update/{id}', 'SuperAdmin\CourseOrder\FailedOrderController@updateFailedOrder')->name('course.orders.failed.update');

    Route::post('course-orders/{id}/paid', 'SuperAdmin\CourseOrder\OrderController@paidAmount')->name('course-orders.status-paid');
    Route::get('course-orders-cpe', ['as'=>'course-orders-cpe', 'uses'=>'SuperAdmin\CourseOrder\OrderController@cpeOrder']);

    //Course Orders Routes Ends
    Route::resource('time_set', 'SuperAdmin\CourseOrder\TimeSetController');

    //Terms Routes Starts
    Route::resource('terms', 'SuperAdmin\Terms\TermController');
    //Term Routes Ends

        /*=============================== Test Result ===========================================================*/


    Route::get('tests-taken', ['as' => 'tests-taken', 'uses' => 'SuperAdmin\Elearnings\Tests\TestResultController@getTestResults']);
    Route::get('tests-failed', ['as' => 'tests-failed', 'uses' => 'SuperAdmin\Elearnings\Tests\TestResultController@getTestResultsFailed']);
    Route::get('tests-pass', ['as' => 'tests-pass', 'uses' => 'SuperAdmin\Elearnings\Tests\TestResultController@getTestResultsPass']);

    //Students Routes Starts
    Route::get('e-learning/courses-view', ['as' => 'e-learning.courses-view', 'uses' => 'Students\StudentsController@getCoursesView']);
    Route::get('e-learning/my-courses', ['as'=>'e-learning.my-courses', 'uses'=>'Students\StudentsController@myCourses']);
    Route::get('e-learning/my-courses/{id}', ['as'=>'e-learning.my-courses.view', 'uses'=>'Students\StudentsController@myCoursesView']);
    Route::get('e-learning/start-course/{start_course}', ['as'=>'e-learning.start-course', 'uses'=>'Students\StudentsController@startCourse']);
    Route::get('e-learning/start-course/{start_course}/{read_lesson}', ['as'=>'e-learning.start-course.read-lesson', 'uses'=>'Students\StudentsController@readLesson']);


    /* Test */
    Route::get('e-learning/start-test/{start_test}', ['as'=>'e-learning.start-test', 'uses'=>'Students\StudentsController@startTest']);
    Route::get('e-learning/test-instruction/{test_id}', ['as' => 'e-learning.test-instruction', 'uses' => 'Students\StudentsController@testInstruction']);
    Route::get('e-learning/give-test/{start_test}', ['as'=>'e-learning.give-test', 'uses'=>'Students\StudentsController@giveTest']);
    Route::post('e-learning/give-test/{start_test}', ['as'=>'e-learning.give-test-submit', 'uses'=>'Students\StudentsController@postGiveTest']);

    /* Result */
    Route::get('e-learning/test-result/{id}', ['as'=>'e-learning.test-result', 'uses'=>'Students\StudentsController@getTestResult']);
    Route::get('e-learning/result/{id}', ['as' => 'e-learning.result', 'uses' => 'Students\StudentsController@getResult']);
    Route::get('e-learning/result/{id}/certificate', ['as' => 'e-learning.certificate', 'uses' => 'Students\StudentsController@getResultCertificate']);
    Route::get('e-learning/available-courses/filter', ['as' => 'e-learning.available-courses.filter', 'uses' => 'Students\StudentsController@getAvailableCourseFilter']);
    
    Route::get('e-learning/tests/{id}/result', ['as' => 'e-learning.tests.result', 'uses' => 'SuperAdmin\Elearnings\Tests\TestResultController@getTestResult']);
    Route::get('e-learning/tests/{id}/certificate', ['as' => 'e-learning.test.certificate', 'uses' => 'SuperAdmin\Elearnings\Tests\TestResultController@getResultCertificate']);
    //Students Routes Ends

    //Courses and Tests History Route
    Route::get('e-learning/course_tests_history', ['uses' => 'Students\StudentsController@getCourseTestsHistory', 'as' => 'e-learning.courseTestsHistory']);


    //Courses and Tests History Route Ends
    
    //Roles Route Starts
    Route::resource('roles', 'SuperAdmin\Elearnings\Roles\RolesController');
    //Roles Route Ends

    // Report
    Route::get('test-reports-userwise', 'SuperAdmin\Elearnings\TestsReports\TestReportsController@getReportUserwise')->name('e-learning.test-report.userwise');
    Route::get('test-reports-userwise-view/{id}', 'SuperAdmin\Elearnings\TestsReports\TestReportsController@getReportUserwiseView')->name('e-learning.test-report.userwise.view');
    
    Route::get('test-reports-datewise', 'SuperAdmin\Elearnings\TestsReports\TestReportsController@getReportDatewise')->name('e-learning.test-report.datewise');
    Route::get('test-reports-datewise/search', 'SuperAdmin\Elearnings\TestsReports\TestReportsController@getReportDatewiseSearch')->name('e-learning.test-report.datewise.search');
    
    Route::get('test-reports-coursewise', 'SuperAdmin\Elearnings\TestsReports\TestReportsController@getReportCoursewise')->name('e-learning.test-report.coursewise');
    Route::get('test-reports-coursewise-view/{id}', 'SuperAdmin\Elearnings\TestsReports\TestReportsController@getReportCoursewiseView')->name('e-learning.test-report.coursewise.view');
    
    Route::get('user-assigned-course-reports', 'SuperAdmin\Elearnings\UserAssignedCourseReports\UserAssignedCourseReportsController@getUserAsssignedCourseReport')->name('elearning.user-assigned-course-reports');
    Route::get('user-assigned-course-reports/{id}', 'SuperAdmin\Elearnings\UserAssignedCourseReports\UserAssignedCourseReportsController@getUserAsssignedCourseReportView')->name('elearning.user-assigned-course-reports-view');
    // Report Ends

    //PUSH NOTIFICATION ROUTE STARTS
    Route::get('/custom-push-notification', 'SuperAdmin\GcmNotifications\GcmPushNotificationController@customPushNotificationForm')->name('CUSTOM-PUSH-NOTIFICATION-FORM');
    Route::get('/version-upgrade-push-notification', 'SuperAdmin\GcmNotifications\GcmPushNotificationController@versionUpgradePushNotificationForm')->name('VERSION-UPGRADE-PUSH-NOTIFICATION-FORM');
    Route::post('/process-push-notification', 'SuperAdmin\GcmNotifications\GcmPushNotificationController@sendGcmNotification')->name('POST-SEND-GCM-PUSH-NOTIFICATION');
    //PUSH NOTIFICATION ROUTE ENDS
    
    //CREATE ORDER AND PAYMENT STARTS
    Route::get('/get-payment-details', 'Students\StudentsController@get_payment_details')->name('PAYMENT-DETAILS');
    Route::post('/create-order', 'Students\StudentsController@create_order')->name('CREATE-ORDER');
    Route::post('/cpe-create-order', 'Students\StudentsController@cpe_create_order')->name('CPE-CREATE-ORDER');

    //CREATE ORDER AND PAYMENT ENDS
    
    //Success and failure url of connect ips

//    Route::get('/ips-order-success', 'Students\StudentsController@create_order_success')->name('ips-success');
//    Route::get('/ips-order-failure', 'Students\StudentsController@create_order_failure')->name('ips-failure');

    // Success and failure url of HBL
    Route::get('/hbl-order-success', 'Students\StudentsController@getHBLOrderSuccess')->name('hbl-success');
    Route::post('/hbl-order-success-post', 'Students\StudentsController@postHBLOrderSuccess')->name('hbl-success.post');
    Route::get('/hbl-order-success-message', 'Students\StudentsController@getHBLOrderSuccessMessage');

    //CREATE ORDER AND PAYMENT ENDS
    
    Route::get('/get-test-reports','SuperAdmin\Elearnings\TestsReports\TestReportsController@export_test_report')->name('EXPORT-TEST-REPORT');
    Route::get('/get-test-reports_failed','SuperAdmin\Elearnings\TestsReports\TestReportsController@export_test_report_failed')->name('EXPORT-TEST-REPORT_FAILED');
    Route::get('/get-test-reports_pass','SuperAdmin\Elearnings\TestsReports\TestReportsController@export_test_report_pass')->name('EXPORT-TEST-REPORT_PASS');

    Route::post('/get-course-payment-reports','SuperAdmin\CourseOrder\OrderController@export_course_payment_report')->name('EXPORT-COURSE-PAYMENT-REPORT');
    Route::post('/get-failedd-course-payment-reports','SuperAdmin\CourseOrder\FailedOrderController@export_course_payment_report')->name('EXPORT-FAILED-COURSE-PAYMENT-REPORT');
    
        Route::get('/cpe_get-course-payment-reports','SuperAdmin\CourseOrder\OrderController@cpe_export_course_payment_report')->name('CPE_EXPORT-COURSE-PAYMENT-REPORT');
        Route::get('/cpe_get-failed-course-payment-reports','SuperAdmin\CourseOrder\FailedOrderController@cpe_export_course_payment_report')->name('CPE_EXPORT-FAILED-COURSE-PAYMENT-REPORT');

    // fiscal report
    Route::get('/get-test-reports_fiscal','SuperAdmin\Elearnings\TestsReports\TestReportsController@export_test_report_fiscal')->name('EXPORT-TEST-REPORT_FISCAL');

    Route::get('/get-test-reports_pass_fiscal','SuperAdmin\Elearnings\TestsReports\TestReportsController@export_test_report_pass_fiscal')->name('EXPORT-TEST-REPORT_PASS_FISCAL');
    Route::get('/get-test-reports_failed_fiscal','SuperAdmin\Elearnings\TestsReports\TestReportsController@export_test_report_failed_fiscal')->name('EXPORT-TEST-REPORT_FAILED_FISCAL');

    Route::get('/get-course-payment-reports_fiscal','SuperAdmin\CourseOrder\OrderController@export_course_payment_report_fiscal')->name('EXPORT-COURSE-PAYMENT-REPORT_FISCAL');
    Route::get('/get-failed-course-payment-reports_fiscal','SuperAdmin\CourseOrder\FailedOrderController@export_course_payment_report_fiscal')->name('EXPORT-FAILED-COURSE-PAYMENT-REPORT_FISCAL');

    Route::get('/cpe-get-course-payment-reports_fiscal','SuperAdmin\CourseOrder\OrderController@cpe_export_course_payment_report_fiscal')->name('CPE_EXPORT-COURSE-PAYMENT-REPORT_FISCAL');
    Route::get('/cpe-get-failed-course-payment-reports_fiscal','SuperAdmin\CourseOrder\FailedOrderController@cpe_export_course_payment_report_fiscal')->name('CPE_EXPORT-FAILED-COURSE-PAYMENT-REPORT_FISCAL');

    //setting
    Route::get('course/setting', 'SuperAdmin\SettingController@courseSetting')->name('e-learning.course.setting');
    Route::post('setting/{id}/update', 'SuperAdmin\SettingController@settingUpdate')->name('e-learning.setting.update');
    Route::post('fiscal/store', 'SuperAdmin\SettingController@storeFiscalYear')->name('fiscal.store');
    Route::post('fiscal/{id}/update', 'SuperAdmin\SettingController@updateFiscalYear')->name('fiscal.update');


});
