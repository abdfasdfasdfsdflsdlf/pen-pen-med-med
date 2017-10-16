<?php

/* ================== Access Uploaded Files ================== */
$route_namespace = config('laraadmin.adminnamespace');
Route::get('files/{hash}/{name}', $route_namespace . 'UploadsController@get_file');

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

Route::group([
    'namespace'  => $route_namespace,
	'as' => $as,
    'middleware' => ['web', 'permission:ADMIN_PANEL', 'role:SUPER_ADMIN']
], function () {

	/* ================== Dashboard ================== */
	Route::get(config('laraadmin.adminRoute'), 'DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'PermissionsController@save_permissions');
	
	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', 'DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'DepartmentsController@dtajax');
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'EmployeesController@change_password');
	
	/* ================== Organizations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organizations', 'OrganizationsController');
	Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'BackupsController@downloadBackup');

   
	/* ================== Modules ================== */
	Route::resource(config('laraadmin.adminRoute') . '/modules', 'ModuleController');
	Route::resource(config('laraadmin.adminRoute') . '/module_fields', 'FieldController');
	Route::get(config('laraadmin.adminRoute') . '/module_generate_crud/{model_id}', 'ModuleController@generate_crud');
	Route::get(config('laraadmin.adminRoute') . '/module_generate_migr/{model_id}', 'ModuleController@generate_migr');
	Route::get(config('laraadmin.adminRoute') . '/module_generate_update/{model_id}', 'ModuleController@generate_update');
	Route::get(config('laraadmin.adminRoute') . '/module_generate_migr_crud/{model_id}', 'ModuleController@generate_migr_crud');
	Route::get(config('laraadmin.adminRoute') . '/modules/{model_id}/set_view_col/{column_name}', 'ModuleController@set_view_col');
	Route::post(config('laraadmin.adminRoute') . '/save_role_module_permissions/{id}', 'ModuleController@save_role_module_permissions');
	Route::get(config('laraadmin.adminRoute') . '/save_module_field_sort/{model_id}', 'ModuleController@save_module_field_sort');
	Route::post(config('laraadmin.adminRoute') . '/check_unique_val/{field_id}', 'FieldController@check_unique_val');
	Route::get(config('laraadmin.adminRoute') . '/module_fields/{id}/delete', 'FieldController@destroy');
	Route::post(config('laraadmin.adminRoute') . '/get_module_files/{module_id}', 'ModuleController@get_module_files');
	
	/* ================== Code Editor ================== */
	Route::get(config('laraadmin.adminRoute') . '/lacodeeditor', function () {
		if(file_exists(resource_path("views/la/editor/index.blade.php"))) {
			return redirect(config('laraadmin.adminRoute') . '/laeditor');
		} else {
			// show install code editor page
			return View('admin::editor.install');
		}
	});

	/* ================== Menu Editor ================== */
	Route::resource(config('laraadmin.adminRoute') . '/la_menus', 'MenuController');
	Route::post(config('laraadmin.adminRoute') . '/la_menus/update_hierarchy', 'MenuController@update_hierarchy');
	
	/* ================== Configuration ================== */
	Route::resource(config('laraadmin.adminRoute') . '/la_configs', 'LAConfigController');
	
    Route::group([
        'middleware' => 'role'
    ], function () {
		/*
		Route::get(config('laraadmin.adminRoute') . '/menu', [
            'as'   => 'menu',
            'uses' => 'LAController@index'
        ]);
		*/
    });
});
