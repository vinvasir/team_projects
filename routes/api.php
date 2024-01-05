<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberTeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\TeamsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('teams', TeamsController::class);
Route::resource('members', MemberController::class);
Route::resource('projects', ProjectController::class);

Route::put('/members/{member}/teams', [MemberTeamController::class, 'update']);
Route::get('/teams/{team}/members', [TeamMemberController::class, 'index']);
