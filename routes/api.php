<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BillController;


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
//Auth module
Route::group([
	'prefix'=>'auth'
],function()
{
	Route::post('login',  [AuthController::class,'login']);
	Route::post('signup', [AuthController::class,'signUp']);
	Route::get('signup/activate/{token}', [AuthController::class,'confirmEmail']);

	//token is required to access the routes below
	Route::group([
		'middleware'=>'auth:api'
	],function()
	{
		Route::get('logout',  [AuthController::class,'logout']);
		Route::get('user',  [AuthController::class,'user']);
	});
});

Route::middleware([
	'check-jwt'
])->group(
	function()
	{
		//Reset password module
		Route::group([   
			'prefix' => 'password'
		], function () {    
			Route::post('create', [PasswordResetController::class,'create']);
			Route::get('find/{token}', [PasswordResetController::class,'find']);
			Route::post('reset', [PasswordResetController::class,'reset']);
		});

		//Admin routes
		Route::group([
			'middleware'=>'user.type:administrador'
		],function()
		{

			Route::resource('category',CategoryController::class);
			Route::resource('admin',AdminController::class);
			Route::resource('employee',EmployeeController::class);
			Route::resource('client',ClientController::class);
			Route::resource('product',ProductController::class);
			Route::resource('bill',BillController::class);
		});

		//Employee routes
		Route::group([
			'middleware'=>'auth:api',
			'middleware'=>'user.type:empleado,administrador'
		],function()
		{
			Route::resource('product',ProductController::class)
			->only(['index','show']);
			Route::resource('bill',BillController::class);
		});
	});
