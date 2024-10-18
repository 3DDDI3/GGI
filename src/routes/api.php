<?php

use App\Exports\ExportUserInfo;
use App\Http\Controllers\Pa\AchievementController;
use App\Http\Controllers\Pa\AuthorizationController;
use App\Http\Controllers\Pa\ExaminationSheetController;
use App\Http\Controllers\Pa\FileUpload;
use App\Http\Controllers\Pa\UserController;
use App\Models\Pa\Acount;
use App\Models\Pa\PersonalDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;
use ZanySoft\Zip\Facades\Zip;

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

Route::prefix('auth')
        ->group(function () {
                Route::post('/signin', [AuthorizationController::class, 'signin'])->withoutMiddleware('api');
                Route::post('/login', [AuthorizationController::class, 'login']);
                Route::post('/check', [AuthorizationController::class, 'check'])->middleware('auth:sanctum');
                Route::post('/logout', [AuthorizationController::class, 'logout'])->middleware('auth:sanctum');
        });

Route::prefix('pa/users')
        ->middleware('auth:sanctum')
        ->group(function () {
                Route::put('/personal_data/edit', [UserController::class, 'personalDataEdit']);
                Route::put('/main_info/edit', [UserController::class, 'mainInfoEdit']);
                Route::prefix('files')->group(function () {
                        Route::post('/upload',  [FileUpload::class, 'upload']);
                        Route::delete('/delete', [FileUpload::class, 'delete']);
                });
                Route::put('/dissertation_work/edit', [UserController::class, 'dissertationWorkEdit']);
                Route::put('/scientific_supervisor/edit', [UserController::class, 'scientificSupervisorEdit']);
        });

Route::prefix('pa/achievments')
        ->group(function () {
                Route::put('/edit', [AchievementController::class, 'edit']);
                Route::delete('/delete', [AchievementController::class, 'delete']);
        });

Route::prefix('pa/examination-sheets')
        ->group(function () {
                Route::put('/edit', [ExaminationSheetController::class, 'edit']);
                Route::delete('/delete', [ExaminationSheetController::class, 'delete']);
        });

Route::prefix("pa/files")
        ->withoutMiddleware('api')
        ->group(function () {
                Route::delete("delete", function (Request $request) {
                        $acountFields = collect(
                                'passport',
                                'snils',
                                'inn'
                        );

                        if ($acountFields->contains($request->field)) {
                                Acount::query()
                                        ->where([
                                                'id' => $request->id,
                                                "{$request->field}" => $request->input('path'),
                                        ])
                                        ->first()
                                        ->fill([
                                                "{$request->field}" => null,
                                                "{$request->field}_comment" => null
                                        ])
                                        ->save();

                                return response()->json(["message" => "Удалено"], 200);
                        } else {
                                PersonalDocument::query()
                                        ->where(['id' => $request->id,])
                                        ->delete();

                                return response()->json(["message" => "Удалено"], 200);
                        }
                });
                Route::get('/{id}/zip/create', function ($id) {

                        $acount = Acount::query()->find($id);

                        Excel::store(new ExportUserInfo($acount->id, $acount->acount_type_id), "pa/{$acount->lastName}.xlsx");

                        $zip = Zip::create("storage/pa/{$acount->lastName}.zip");

                        if ($acount->acount_type_id == 2)
                                $control_names = [
                                        'report',
                                        'diploma',
                                        'diplomaApp',
                                        'reportAb',
                                        'articleApp',
                                        'Philosophy',
                                        'English',
                                        'specialty'
                                ];
                        else
                                $control_names = [
                                        'reportAsp',
                                        'individualPlan',
                                        'annualPlan',
                                        'supervisorReview',
                                        'seminarProtocol',
                                        'councilReport',
                                        'materialConf',
                                        'thesisReport',
                                        'article',
                                        'pid',
                                        'anotherPg',
                                        'reportStudent',
                                ];

                        foreach ($acount->documents as $document) {
                                if (in_array($document->control_name, $control_names)) {
                                        $content = file_get_contents("storage/{$document->path}");
                                        preg_match("/.([a-zA-Z]+)$/", $document->path, $extensions);
                                        $name = preg_replace("/[^a-zA-Zа-яА-Я0-9\s+]/u", " ", $document->document->type);
                                        $zip->addFromString($name . $extensions[0], $content);
                                }
                        }

                        $zip->add("storage/pa/{$acount->lastName}.xlsx");

                        if (!empty($acount->inn)) {
                                $content = file_get_contents("storage/{$acount->inn}");
                                preg_match("/.([a-zA-Z]+)$/", $acount->inn, $extensions);
                                $name = "inn";
                                $zip->addFromString($name . $extensions[0], $content);
                        }

                        if (!empty($acount->passport)) {
                                $content = file_get_contents("storage/{$acount->passport}");
                                preg_match("/.([a-zA-Z]+)$/", $acount->passport, $extensions);
                                $name = "passport";
                                $zip->addFromString($name . $extensions[0], $content);
                        }

                        if (!empty($acount->snils)) {
                                $content = file_get_contents("storage/{$acount->snils}");
                                preg_match("/.([a-zA-Z]+)$/", $acount->snils, $extensions);
                                $name = "snils";
                                $zip->addFromString($name . $extensions[0], $content);
                        }

                        $zip->close();
                        return response()->download("storage/pa/{$acount->lastName}.zip")->deleteFileAfterSend();
                });
        });
