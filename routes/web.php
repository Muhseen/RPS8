<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\StudentListController;
use App\Services\ClassAllocationServices\ClassAllocationServices;
use App\Services\CoursesServices\CoursesServices;
use App\Services\ProgrammesServices\ProgrammesServices;
use App\Services\StaffServices\StaffServices;
use Illuminate\Http\Request as HttpRequest;
use App\Http\Controllers\ResultProcessingController;

use App\Http\Controllers\ScoresUploadController;
use App\Http\Controllers\StatementOfResultController;
use App\Http\Controllers\TFAController;
use App\Http\Controllers\ScoresBreakDownController;


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

Route::get('/2FA', [TFAController::class, 'get2FA']);
Route::POST('/2FA', [TFAController::class, 'submit2FA'])->name('TFA');
Auth::routes();
Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::get('/role/{id}/addPermission', [App\Http\Controllers\RolesController::class, 'addPermission']);

    Route::resource('/roles',  RolesController::class);
    Route::resource('/permissions',    PermissionsController::class);
    Route::get('/scoresBreakDown', [ScoresBreakDownController::class, 'index']);
    Route::get('/scoresBreakDown/{id}', [ScoresBreakDownController::class, 'show']);
    Route::delete('/scoresBreakDown/{id}/destroy', [ScoresBreakDownController::class, 'destroy']);
    Route::patch('/scoresBreakDown', [ScoresBreakDownController::class, 'update']);

    Route::view('/practicals', 'scoresUpload.practical');
    Route::get('/statementOfResult', function () {
        return view('results.SORView');
    });
    Route::POST('/statementOfResult', [StatementOfResultController::class, 'index']);

    Route::get('/uploadScores/{type}', [ScoresUploadController::class, 'index']);
    Route::post('/uploadScores', [ScoresUploadController::class, 'upload']);
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

    Route::get('/downloadStudentList', [StudentListController::class, 'index'])->name('studentsListView');
    Route::post('/downloadStudentList', [StudentListController::class, 'download'])->name('downloadStudentsList');
    Route::resource('/classAllocation', ClassAllocationController::class);

    Route::get('/processResults', [ResultProcessingController::class, 'index']);
    Route::post('/processResults', [ResultProcessingController::class, 'process']);

    //api calls
    Route::get('/getStaffByFileNo', function (HttpRequest $request) {
        return StaffServices::getStaffByFileNo($request->file_no);
    });

    Route::get('/getProgrammesByDeptAndType', function (HttpRequest $request) {
        return ProgrammesServices::getProgrammesByDeptAndType($request->dept_id, $request->programme_type);
    });

    Route::get('/getCoursesForScoresLimit', function (HttpRequest $request) {
        return CoursesServices::getCourseByCodeLike($request->code);
    });
    Route::get('/getCADepts', function (HttpRequest $request) {
        return ClassAllocationServices::getDept($request->programme_type);
    });
    Route::get('/getCAProgs', function (HttpRequest $request) {
        return ClassAllocationServices::getProgramme($request->programme_type, $request->dept_id);
    });
    Route::get('/getCASessions', function (HttpRequest $request) {
        return ClassAllocationServices::getSession($request->programme_type, $request->dept_id, $request->prog_id);
    });
    Route::get('/getCASemesters', function (HttpRequest $request) {
        return ClassAllocationServices::getSemester($request->programme_type, $request->dept_id, $request->prog_id, $request->session);
    });
    Route::get('/getCACourses', function (HttpRequest $request) {
        return ClassAllocationServices::getCourses($request->programme_type, $request->dept_id, $request->prog_id, $request->session, $request->semester);
    });
    Route::get('/getProgrammesByProgrammeType', function (HttpRequest $request) {
        return ProgrammesServices::getProgrammesByDeptAndType(auth()->user()->staff->dept_id, $request->programme_type);
    });
    Route::get('/getCoursesByProgID', function (HttpRequest $request) {
        return CoursesServices::getCoursesByProgID($request->prog_id);
    });
});

Route::prefix('icon')->group(function () {  // word: "icons" - not working as part of adress
    Route::get('/coreui-icons', function () {
        return view('dashboard.icons.coreui-icons');
    });
    Route::get('/flags', function () {
        return view('dashboard.icons.flags');
    });
    Route::get('/brands', function () {
        return view('dashboard.icons.brands');
    });
});



/*



Route::prefix('icon')->group(function () {  // word: "icons" - not working as part of adress
    Route::get('/coreui-icons', function () {
        return view('dashboard.icons.coreui-icons');
    });
    Route::get('/flags', function () {
        return view('dashboard.icons.flags');
    });
    Route::get('/brands', function () {
        return view('dashboard.icons.brands');
    });
});
Route::get('/colors', function () {
    return view('dashboard.colors');
});
Route::get('/typography', function () {
    return view('dashboard.typography');
});
Route::get('/charts', function () {
    return view('dashboard.charts');
});
Route::get('/widgets', function () {
    return view('dashboard.widgets');
});
Route::get('/404', function () {
    return view('dashboard.404');
});
Route::get('/500', function () {
    return view('dashboard.500');
});
Route::prefix('base')->group(function () {
    Route::get('/breadcrumb', function () {
        return view('dashboard.base.breadcrumb');
    });
    Route::get('/cards', function () {
        return view('dashboard.base.cards');
    });
    Route::get('/carousel', function () {
        return view('dashboard.base.carousel');
    });
    Route::get('/collapse', function () {
        return view('dashboard.base.collapse');
    });

    Route::get('/forms', function () {
        return view('dashboard.base.forms');
    });
    Route::get('/jumbotron', function () {
        return view('dashboard.base.jumbotron');
    });
    Route::get('/list-group', function () {
        return view('dashboard.base.list-group');
    });
    Route::get('/navs', function () {
        return view('dashboard.base.navs');
    });

    Route::get('/pagination', function () {
        return view('dashboard.base.pagination');
    });
    Route::get('/popovers', function () {
        return view('dashboard.base.popovers');
    });
    Route::get('/progress', function () {
        return view('dashboard.base.progress');
    });
    Route::get('/scrollspy', function () {
        return view('dashboard.base.scrollspy');
    });

    Route::get('/switches', function () {
        return view('dashboard.base.switches');
    });
    Route::get('/tables', function () {
        return view('dashboard.base.tables');
    });
    Route::get('/tabs', function () {
        return view('dashboard.base.tabs');
    });
    Route::get('/tooltips', function () {
        return view('dashboard.base.tooltips');
    });

    Route::get('/', function () {
        return view('dashboard.homepage');
    });

    Route::group(['middleware' => ['role:user']], function () {
    });
    Route::prefix('buttons')->group(function () {
        Route::get('/buttons', function () {
            return view('dashboard.buttons.buttons');
        });
        Route::get('/button-group', function () {
            return view('dashboard.buttons.button-group');
        });
        Route::get('/dropdowns', function () {
            return view('dashboard.buttons.dropdowns');
        });
        Route::get('/brand-buttons', function () {
            return view('dashboard.buttons.brand-buttons');
        });
    });

    Route::prefix('notifications')->group(function () {
        Route::get('/alerts', function () {
            return view('dashboard.notifications.alerts');
        });
        Route::get('/badge', function () {
            return view('dashboard.notifications.badge');
        });
        Route::get('/modals', function () {
            return view('dashboard.notifications.modals');
        });
    });
    Route::resource('notes', 'NotesController');
});
Auth::routes();

Route::resource('resource/{table}/resource', 'ResourceController')->names([
    'index'     => 'resource.index',
    'create'    => 'resource.create',
    'store'     => 'resource.store',
    'show'      => 'resource.show',
    'edit'      => 'resource.edit',
    'update'    => 'resource.update',
    'destroy'   => 'resource.destroy'
]);

Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('bread',  'BreadController');   //create BREAD (resource)
    Route::resource('users',        'UsersController')->except(['create', 'store']);
    Route::resource('roles',        'RolesController');
    Route::resource('mail',        'MailController');
    Route::get('prepareSend/{id}',        'MailController@prepareSend')->name('prepareSend');
    Route::post('mailSend/{id}',        'MailController@send')->name('mailSend');
    Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
    Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');
    Route::prefix('menu/element')->group(function () {
        Route::get('/',             'MenuElementController@index')->name('menu.index');
        Route::get('/move-up',      'MenuElementController@moveUp')->name('menu.up');
        Route::get('/move-down',    'MenuElementController@moveDown')->name('menu.down');
        Route::get('/create',       'MenuElementController@create')->name('menu.create');
        Route::post('/store',       'MenuElementController@store')->name('menu.store');
        Route::get('/get-parents',  'MenuElementController@getParents');
        Route::get('/edit',         'MenuElementController@edit')->name('menu.edit');
        Route::post('/update',      'MenuElementController@update')->name('menu.update');
        Route::get('/show',         'MenuElementController@show')->name('menu.show');
        Route::get('/delete',       'MenuElementController@delete')->name('menu.delete');
    });
    Route::prefix('menu/menu')->group(function () {
        Route::get('/',         'MenuController@index')->name('menu.menu.index');
        Route::get('/create',   'MenuController@create')->name('menu.menu.create');
        Route::post('/store',   'MenuController@store')->name('menu.menu.store');
        Route::get('/edit',     'MenuController@edit')->name('menu.menu.edit');
        Route::post('/update',  'MenuController@update')->name('menu.menu.update');
        Route::get('/delete',   'MenuController@delete')->name('menu.menu.delete');
    });
    Route::prefix('media')->group(function () {
        Route::get('/',                 'MediaController@index')->name('media.folder.index');
        Route::get('/folder/store',     'MediaController@folderAdd')->name('media.folder.add');
        Route::post('/folder/update',   'MediaController@folderUpdate')->name('media.folder.update');
        Route::get('/folder',           'MediaController@folder')->name('media.folder');
        Route::post('/folder/move',     'MediaController@folderMove')->name('media.folder.move');
        Route::post('/folder/delete',   'MediaController@folderDelete')->name('media.folder.delete');;

        Route::post('/file/store',      'MediaController@fileAdd')->name('media.file.add');
        Route::get('/file',             'MediaController@file');
        Route::post('/file/delete',     'MediaController@fileDelete')->name('media.file.delete');
        Route::post('/file/update',     'MediaController@fileUpdate')->name('media.file.update');
        Route::post('/file/move',       'MediaController@fileMove')->name('media.file.move');
        Route::post('/file/cropp',      'MediaController@cropp');
        Route::get('/file/copy',        'MediaController@fileCopy')->name('media.file.copy');
    });
});*/