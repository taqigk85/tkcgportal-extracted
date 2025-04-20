<?php
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return redirect('/');
});

// Select Option For City & State
Route::post('/get-cities', [App\Http\Controllers\Web\Client\ProjectController::class, 'getCitiesByState'])->name('getCitiesByState');
Route::post('/get/wind-snow', [App\Http\Controllers\Web\Client\ProjectController::class, 'getWindSnowValueByCities'])->name('getWindSnowValueByCities');

Route::post('/logout', [App\Http\Controllers\Web\Auth\AuthController::class, 'LogOut'])->name('logout');
Route::post('/import/riskcategories', [App\Http\Controllers\Web\Public\PublicController::class, 'importRiskCategories'])->name('import.riskcategories');

Route::middleware(['guest'])->group(function () {
    Route::get('/', [App\Http\Controllers\Web\Public\PublicController::class, 'index']);
    Route::get('/welcome', [App\Http\Controllers\Web\Public\PublicController::class, 'welcome']);
    Route::get('/login', [App\Http\Controllers\Web\Auth\AuthController::class, 'Login'])->name('login');
    Route::post('/login/post', [App\Http\Controllers\Web\Auth\AuthController::class, 'LoginPost'])->name('login.post');
    // Route::get('/register', [App\Http\Controllers\Web\Auth\AuthController::class, 'Register'])->name('register');
    // Route::post('/register/post', [App\Http\Controllers\Web\Auth\AuthController::class, 'RegisterPost'])->name('register.post');
    Route::post('/company/logo/upload', [App\Http\Controllers\Web\Auth\AuthController::class, 'CompanyLogoUpload'])->name('company.logo.upload');
});


Route::group(
[
    'prefix'=>'admin','as'=>'admin.',
        'middleware' => [
            'auth','isAdmin'
        ],
],
function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Web\Admin\DashboardController::class, 'Dashboard'])->name('dashboard');

    // Clients
    Route::get('/client/list', [App\Http\Controllers\Web\Admin\ClientController::class, 'ClientList'])->name('client.list');
    Route::get('/client/add', [App\Http\Controllers\Web\Admin\ClientController::class, 'ClientAdd'])->name('client.add');
    Route::post('/client/add/post', [App\Http\Controllers\Web\Admin\ClientController::class, 'ClientAddPost'])->name('client.add.post');
    Route::get('/client/edit/{id}', [App\Http\Controllers\Web\Admin\ClientController::class, 'ClientEdit'])->name('client.edit');
    Route::post('/client/edit/post/{id}', [App\Http\Controllers\Web\Admin\ClientController::class, 'ClientEditPost'])->name('client.edit.post');
    Route::get('/client/view/{id}', [App\Http\Controllers\Web\Admin\ClientController::class, 'ClientView'])->name('client.view');
    Route::post('/client/delete/post/{id}', [App\Http\Controllers\Web\Admin\ClientController::class, 'ClientDelete'])->name('client.delete.post');
    Route::post('/company/logo/upload', [App\Http\Controllers\Web\Admin\ClientController::class, 'CompanyLogoUpload'])->name('company.logo.upload');

    // Projects
    Route::get('/project/list', [App\Http\Controllers\Web\Admin\ProjectController::class, 'ProjectList'])->name('project.list');
    Route::get('/project/view/{id}', [App\Http\Controllers\Web\Admin\ProjectController::class, 'ProjectView'])->name('project.view');
    Route::get('/project/artwork/{id}', [App\Http\Controllers\Web\Admin\ProjectController::class, 'ProjectArtwork'])->name('project.artwork');
    Route::post('/store-table-data', [App\Http\Controllers\Web\Admin\ArtworkController::class, 'storeTableData'])->name('store.table_data');
    Route::get('/download-pdf/{id}', [App\Http\Controllers\Web\Admin\ArtworkController::class, 'generatePDF'])->name('download.pdf');

});


Route::group(
    [
        'prefix'=>'client','as'=>'client.',
            'middleware' => [
                'auth','isClient'
            ],
    ],
    function () {

        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Web\Client\DashboardController::class, 'Dashboard'])->name('dashboard');

        // Projects
        Route::get('/project/list', [App\Http\Controllers\Web\Client\ProjectController::class, 'ProjectList'])->name('project.list');
        Route::get('/project/add', [App\Http\Controllers\Web\Client\ProjectController::class, 'ProjectAdd'])->name('project.add');
        Route::post('/project/create/next', [App\Http\Controllers\Web\Client\ProjectController::class, 'create'])->name('project.create.next');
        Route::get('/project/calculation', [App\Http\Controllers\Web\Client\ProjectController::class, 'ProjectCalculation'])->name('project.calculation');
        Route::post('/project/artwork/upload', [App\Http\Controllers\Web\Client\ProjectController::class, 'ArtworkImageUpload'])->name('project.artwork.upload');
        Route::post('/project/calculation/post', [App\Http\Controllers\Web\Client\ProjectController::class, 'ProjectCalculationPost'])->name('project.calculation.post');
        Route::get('/project/edit/{id}', [App\Http\Controllers\Web\Client\ProjectController::class, 'ProjectEdit'])->name('project.edit');
        Route::post('/project/edit/post/{id}', [App\Http\Controllers\Web\Client\ProjectController::class, 'ProjectEditPost'])->name('project.edit.post');
        Route::get('/project/view/{id}', [App\Http\Controllers\Web\Client\ProjectController::class, 'ProjectView'])->name('project.view');
        Route::get('/project/artwork/{id}', [App\Http\Controllers\Web\Client\ProjectController::class, 'ProjectArtwork'])->name('project.artwork');
        Route::post('/store-table-data', [App\Http\Controllers\Web\Client\ArtworkController::class, 'storeTableData'])->name('store.table_data');
        
        Route::get('/download-pdf/{id}', [App\Http\Controllers\Web\Client\ArtworkController::class, 'generatePDF'])->name('download.pdf');
        Route::post('/project/delete/post/{id}', [App\Http\Controllers\Web\Client\ProjectController::class, 'ProjectDelete'])->name('project.delete.post');

        // 3D Sign 
        Route::get('/project/3d-sign/create', [App\Http\Controllers\Web\Client\ProjectController::class, 'createThreeDSign'])->name('project.3d-sign.create');

        
        // Settings 
        Route::get('/profile/view/{id}', [App\Http\Controllers\Web\Client\SettingController::class, 'View'])->name('profile.view');
        Route::get('/profile/edit/{id}', [App\Http\Controllers\Web\Client\SettingController::class, 'Edit'])->name('profile.edit');
        Route::post('/profile/edit/post/{id}', [App\Http\Controllers\Web\Client\SettingController::class, 'EditPost'])->name('profile.edit.post');
        Route::post('/company/logo/upload', [App\Http\Controllers\Web\Client\SettingController::class, 'CompanyLogoUpload'])->name('company.logo.upload');

    });
