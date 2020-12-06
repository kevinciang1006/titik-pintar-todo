<?php

use App\Http\Controllers\SectionController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('sections/{sectionId}/tasks/{taskId}', [SectionController::class, 'sectionTask']);
Route::get('sections/tasks', [SectionController::class, 'sectionTaskAll']);
Route::get('sections/undo/{sectionId}', [SectionController::class, 'sectionUndo']);
Route::get('tasks/undo/{taskId}', [TaskController::class, 'taskUndo']);
Route::apiResources([
    'sections' => SectionController::class,
    'tasks' => TaskController::class,
]);
