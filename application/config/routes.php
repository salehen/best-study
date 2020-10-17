<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'home';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "home" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*************---->Front-End-Route<----****************/

$route['about'] = 'home/about';

//Frontend API route
$route['api/email-check'] = 'api/checkEmail';
$route['api/gd-email-check'] = 'api/gdCheckEmail';
$route['api/load-section'] = 'api/loadSection';
$route['api/load-city'] = 'api/loadCity';
$route['api/load-city-name'] = 'api/loadCityName';

//admission Controller
$route['admission'] = 'admission';
$route['admission/check'] = 'admission/check';
$route['view-form'] = 'admission/viewForm';
$route['student-verification/(:any)'] = 'admission/studentVerification';
$route['student-confirm'] = 'admission/studentVerificationConfirm';
$route['guardian-verification/(:any)'] = 'admission/guardianVerification';
$route['guardian-confirm'] = 'admission/guardianVerificationConfirm';

//Auth Controller route
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['register/check'] = 'auth/register_check';
$route['login/check'] = 'auth/login_check';
$route['forgat-password'] = 'auth/forgat_password';
$route['reset-password'] = 'auth/reset_password';
$route['new-password/(:any)'] = 'auth/new_password';
$route['confirm-password'] = 'auth/confirm_password';

$route['teacher-verification/(:any)'] = 'home/teacherVerification';
$route['teacher-confirm'] = 'home/teacherVerificationConfirm';

/*************---->Admin-Route<----****************/

//admin API route
$route['admin/api/teacher-email-check'] = 'admin/api/teacherCheckMail';

$route['admin/api/load-admission'] = 'admin/api/loadAdmission';
$route['admin/api/applicant-info'] = 'admin/api/applicantInfo';
$route['admin/api/adConfirm-list'] = 'admin/api/adConfirmList';
$route['admin/api/app-confirm-info'] = 'admin/api/appConfirmInfo';
$route['admin/api/applicant-confirm'] = 'admin/api/applicantConfirm';
$route['admin/api/applicant-delete'] = 'admin/api/applicantDelete';
$route['admin/api/admitted-confirm'] = 'admin/api/admittedConfirm';

$route['admin/api/student-list'] = 'admin/api/studentList';
$route['admin/api/student-info'] = 'admin/api/studentInfo';

$route['admin/api/class-info'] = 'admin/api/classInfo';

$route['admin/api/load-routine'] = 'admin/api/loadRoutine';

$route['admin/api/load-exam'] = 'admin/api/loadExam';
$route['admin/api/load-exam-result'] = 'admin/api/loadExamResult';

$route['admin/api/exam-mark-input'] = 'admin/api/examMarkInput';
$route['admin/api/exam-mark-view'] = 'admin/api/examMarkView';

$route['admin/api/exam'] = 'admin/api/exam';
$route['admin/api/load-exam-subject'] = 'admin/api/examSubject';
$route['admin/api/load-exam-teacher'] = 'admin/api/examTeacher';

//Admin Dashboard route
$route['dashboard'] = 'admin/dashboard';
$route['dashboard/event'] = 'admin/dashboard/event';
$route['logout'] = 'admin/dashboard/logout';

$route['dashboard/admission'] = 'admin/admission/admission';
$route['dashboard/admission-confirm'] = 'admin/admission/admissionConfirm';
$route['dashboard/admission-result'] = 'admin/admission/admissionResult';
$route['dashboard/admission-result-save'] = 'admin/admission/admissionResultSave';
$route['dashboard/admission-setup'] = 'admin/admission/admissionSetup';
$route['dashboard/admission-setup-save'] = 'admin/admission/admissionSetupSave';

$route['dashboard/student'] = 'admin/student';

$route['dashboard/class-list'] = 'admin/dashboard/class';
$route['dashboard/section-list'] = 'admin/dashboard/section';

$route['dashboard/teacher'] = 'admin/dashboard/teacher';
$route['dashboard/add-teacher'] = 'admin/dashboard/addTeacher';
$route['dashboard/add-teacher/check'] = 'admin/dashboard/addTeacherCheck';

$route['dashboard/subject'] = 'admin/dashboard/subject';
$route['dashboard/add-subject'] = 'admin/dashboard/addSubject';

$route['dashboard/exam'] = 'admin/dashboard/exam';
$route['dashboard/add-exam'] = 'admin/dashboard/addExam';
$route['dashboard/add-exam/check'] = 'admin/dashboard/addExamCheck';

$route['dashboard/result'] = 'admin/result';
$route['dashboard/add-result'] = 'admin/result/addResult';
$route['dashboard/exam-marks-save'] = 'admin/result/examMarkSave';

$route['dashboard/routine'] = 'admin/dashboard/routine';
$route['dashboard/add-routine'] = 'admin/dashboard/addRoutine';
$route['dashboard/add-routine/check'] = 'admin/dashboard/addRoutineCheck';



