<?php

/* ================== Access Uploaded Files ================== */
$route_namespace = 'Penmedia\Admin\Http\Controllers';
Route::get('files/{hash}/{name}', $route_namespace . '\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['web', 'permission:ADMIN_PANEL']], function () {
	
	/* ================== Dashboard ================== */
	$route_namespace = 'Penmedia\Admin\Http\Controllers';
	Route::get(config('laraadmin.adminRoute'), $route_namespace . '\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', $route_namespace . '\DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', $route_namespace . '\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', $route_namespace . '\UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', $route_namespace . '\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', $route_namespace . '\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', $route_namespace . '\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', $route_namespace . '\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', $route_namespace . '\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', $route_namespace . '\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', $route_namespace . '\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', $route_namespace . '\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', $route_namespace . '\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', $route_namespace . '\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', $route_namespace . '\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', $route_namespace . '\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', $route_namespace . '\PermissionsController@save_permissions');
	
	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', $route_namespace . '\DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', $route_namespace . '\DepartmentsController@dtajax');
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', $route_namespace . '\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', $route_namespace . '\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', $route_namespace . '\EmployeesController@change_password');
	
	/* ================== Organizations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organizations', $route_namespace . '\OrganizationsController');
	Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', $route_namespace . '\OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', $route_namespace . '\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', $route_namespace . '\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', $route_namespace . '\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', $route_namespace . '\BackupsController@downloadBackup');
});
