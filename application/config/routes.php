<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */

$route['login'] = "login_controller/login";
$route['logout'] = "login_controller/logout";
$route['dashboard'] = "dashboard_controller";

$route['users'] = "users_controller";
$route['users/new'] = "users_controller/new_user";
$route['users/(:num)/edit'] = "users_controller/edit_user/$1";
$route['users/(:num)/delete'] = "users_controller/delete_user/$1";

$route['courses'] = "courses_controller";
$route['courses/new'] = "courses_controller/new_course";
$route['courses/(:num)/edit'] = "courses_controller/edit_course/$1";
$route['courses/(:num)/delete'] = "courses_controller/delete_course/$1";

$route['subjects'] = "subjects_controller";
$route['subjects/new'] = "subjects_controller/new_subject";
$route['subjects/(:num)/edit'] = "subjects_controller/edit_subject/$1";
$route['subjects/(:num)/delete'] = "subjects_controller/delete_subject/$1";

$route['students'] = "students_controller";
$route['students/new'] = "students_controller/new_student";
$route['students/(:num)/edit'] = "students_controller/edit_student/$1";
$route['students/(:num)/delete'] = "students_controller/delete_student/$1";

$route['schoolyear'] = "schoolyear_controller";
$route['schoolyear/new'] = "schoolyear_controller/new_schoolyear";
$route['schoolyear/(:num)/edit'] = "schoolyear_controller/edit_schoolyear/$1";
$route['schoolyear/(:num)/delete'] = "schoolyear_controller/delete_schoolyear/$1";
$route['schoolyear/(:num)/update_stat'] = "schoolyear_controller/update_stat_schoolyear/$1";

$route['schedule'] = "schedule_controller";
$route['schedule/new'] = "schedule_controller/new_schedule";
$route['schedule/(:num)/edit'] = "schedule_controller/edit_schedule/$1";
$route['schedule/(:num)/delete'] = "schedule_controller/delete_schedule/$1";

$route['enroll'] = "enrollment_controller";
$route['enroll/new'] = "enrollment_controller/new_enrollment";
$route['enroll/(:num)/edit'] = "enrollment_controller/edit_enrollment/$1";
$route['enroll/(:num)/delete'] = "enrollment_controller/delete_enrollment/$1";