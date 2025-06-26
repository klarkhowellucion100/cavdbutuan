<?php

use App\Http\Controllers\BannerController;
use App\Models\FarmMechanization;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CastrationAndSpayController;
use App\Http\Controllers\FarmMechanizationController;
use App\Http\Controllers\CastrationAndSpayUserController;
use App\Http\Controllers\FarmMechanizationUserController;
use App\Http\Controllers\CastrationAndSpayBlockDatesController;
use App\Http\Controllers\FarmMechanizationBlockDatesController;
use App\Http\Controllers\CastrationAndSpayAvailabilityController;
use App\Http\Controllers\FarmMechanizationAvailabilityController;

//Welcome Blade
Route::get('/', function () {
    return view('welcome');
});

//Contact Us Route
Route::post('/contactus/store', [ContactUsController::class, 'store'])->name('contactus.store');

//Dashboard Route
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/services', function () {
    return view('userviews.services.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

//Farm Mechanization Guest Route
Route::get('/farmmechanization/create', [FarmMechanizationController::class, 'create'])->name('farmmechanization.create');
Route::post('/farmmechanization/store', [FarmMechanizationController::class, 'store'])->name('farmmechanization.store');
Route::get('/farmmechanization/form/{id}', [FarmMechanizationController::class, 'form'])->name('farmmechanization.form');
Route::get('/farmmechanization/track', [FarmMechanizationController::class, 'track'])->name('farmmechanization.track');
Route::post('/farmmechanization/tracksearch', [FarmMechanizationController::class, 'tracksearch'])->name('farmmechanization.tracksearch');
Route::get('/farmmechanization/tracksearchlink', [FarmMechanizationController::class, 'tracksearchFromLink'])->name('farmmechanization.tracksearch.link');

Route::post('/farmmechanization/trackresultupload', [FarmMechanizationController::class, 'trackresultupload'])->name('farmmechanization.trackresultupload');

Route::get('/get-provinces/{region_id}', [FarmMechanizationController::class, 'getProvinces']);
Route::get('/get-municipalities/{province_id}', [FarmMechanizationController::class, 'getMunicipalities']);
Route::get('/get-barangays/{municipality_id}', [FarmMechanizationController::class, 'getBarangays']);

//Farm Mechanization User Route (Pending Visitation)
Route::get('/farmmechanization/user/pending/index', [FarmMechanizationUserController::class, 'pendingindex'])->name('farmmechanization.user.pending.index');
Route::post('/farmmechanization/user/pending/bulk-delete', [FarmMechanizationUserController::class, 'pendingbulkdelete'])->name('farmmechanization.user.pending.bulkdelete');
Route::post('/farmmechanization/user/pending/bulk-approve', [FarmMechanizationUserController::class, 'pendingbulkapprove'])->name('farmmechanization.user.pending.bulkapprove');

//Farm Mechanization User Route (Approved Visitation)
Route::get('/farmmechanization/user/approved/index', [FarmMechanizationUserController::class, 'approvedindex'])->name('farmmechanization.user.approved.index');
Route::get('/farmmechanization/user/approved/show/{id}', [FarmMechanizationUserController::class, 'approvedshow'])->name('farmmechanization.user.approved.show');
Route::post('/farmmechanization/user/approved/cashcollection', [FarmMechanizationUserController::class, 'approvedcashcollection'])->name('farmmechanization.user.approved.cashcollection');

//Farm Mechanization User Route (Scheduled Service)
Route::get('/farmmechanization/user/scheduled/index', [FarmMechanizationUserController::class, 'scheduledindex'])->name('farmmechanization.user.scheduled.index');
Route::get('/farmmechanization/user/scheduled/form/{id}', [FarmMechanizationUserController::class, 'scheduledform'])->name('farmmechanization.user.scheduled.form');
Route::get('/farmmechanization/user/scheduled/edit/{id}', [FarmMechanizationUserController::class, 'schedulededit'])->name('farmmechanization.user.scheduled.edit');
Route::put('/farmmechanization/user/scheduled/update/{id}', [FarmMechanizationUserController::class, 'scheduledupdate'])->name('farmmechanization.user.scheduled.update');
Route::get('/farmmechanization/user/scheduled/upload/{id}', [FarmMechanizationUserController::class, 'scheduledupload'])->name('farmmechanization.user.scheduled.upload');
Route::post('/farmmechanization/user/scheduled/uploadstore', [FarmMechanizationUserController::class, 'scheduleduploadstore'])->name('farmmechanization.user.scheduled.uploadstore');
Route::delete('/farmmechanization/user/scheduled/delete/{id}', [FarmMechanizationUserController::class, 'scheduleddelete'])->name('farmmechanization.user.scheduled.delete');

//Farm Mechanization User Route (Served Clients)
Route::get('/farmmechanization/user/served/index', [FarmMechanizationUserController::class, 'servedindex'])->name('farmmechanization.user.served.index');
Route::post('/farmmechanization/user/served/bulkserved', [FarmMechanizationUserController::class, 'servedbulkserved'])->name('farmmechanization.user.served.bulkserved');

//Farm Mechanization Create Admin
Route::get('/farmmechanization/user/scheduled/admincreate', [FarmMechanizationUserController::class, 'admincreate'])->name('farmmechanization.user.scheduled.admincreate');
Route::post('/farmmechanization/user/scheduled/adminpost', [FarmMechanizationUserController::class, 'adminpost'])->name('farmmechanization.user.scheduled.adminpost');
Route::delete('/farmmechanization/user/scheduled/admindelete/{id}', [FarmMechanizationUserController::class, 'admindelete'])->name('farmmechanization.user.scheduled.admindelete');

//Farm Mechanization Block Dates
Route::get('/farmmechanization/user/blockdates/index', [FarmMechanizationBlockDatesController::class, 'blockdatesindex'])->name('farmmechanization.user.blockdates.index');
Route::get('/farmmechanization/user/blockdates/create', [FarmMechanizationBlockDatesController::class, 'blockdatescreate'])->name('farmmechanization.user.blockdates.create');
Route::post('/farmmechanization/user/blockdates/store', [FarmMechanizationBlockDatesController::class, 'blockdatesstore'])->name('farmmechanization.user.blockdates.store');
Route::post('/farmmechanization/user/blockdates/bulkdelete', [FarmMechanizationBlockDatesController::class, 'blockdatesbulkdelete'])->name('farmmechanization.user.blockdates.bulkdelete');

//Farm Mechanization Availability
Route::get('/farmmechanization/user/availability/index', [FarmMechanizationAvailabilityController::class, 'availabilityindex'])->name('farmmechanization.user.availability.index');
Route::get('/farmmechanization/user/availability/create', [FarmMechanizationAvailabilityController::class, 'availabilitycreate'])->name('farmmechanization.user.availability.create');
Route::post('/farmmechanization/user/availability/store', [FarmMechanizationAvailabilityController::class, 'availabilitystore'])->name('farmmechanization.user.availability.store');
Route::post('/farmmechanization/user/availability/bulkdelete', [FarmMechanizationAvailabilityController::class, 'availabilitybulkdelete'])->name('farmmechanization.user.availability.bulkdelete');
Route::post('/farmmechanization/user/availability/bulkdisable', [FarmMechanizationAvailabilityController::class, 'availabilitybulkdisable'])->name('farmmechanization.user.availability.bulkdisable');
Route::post('/farmmechanization/user/availability/bulkenable', [FarmMechanizationAvailabilityController::class, 'availabilitybulkenable'])->name('farmmechanization.user.availability.bulkenable');

//Castration and Spay Route
Route::get('/castrationandspay/create', [CastrationAndSpayController::class, 'create'])->name('castrationandspay.create');
Route::post('/castrationandspay/store', [CastrationAndSpayController::class, 'store'])->name('castrationandspay.store');
Route::get('/castrationandspay/form/{id}', [CastrationAndSpayController::class, 'form'])->name('castrationandspay.form');
Route::get('/castrationandspay/track', [CastrationAndSpayController::class, 'track'])->name('castrationandspay.track');
Route::post('/castrationandspay/tracksearch', [CastrationAndSpayController::class, 'tracksearch'])->name('castrationandspay.tracksearch');
Route::get('/castrationandspay/tracksearchlink', [CastrationAndSpayController::class, 'tracksearchFromLink'])->name('castrationandspay.tracksearch.link');

//Castration and Spay Availability
Route::get('/castrationandspay/user/availability/index', [CastrationAndSpayAvailabilityController::class, 'availabilityindex'])->name('castrationandspay.user.availability.index');
Route::get('/castrationandspay/user/availability/create', [CastrationAndSpayAvailabilityController::class, 'availabilitycreate'])->name('castrationandspay.user.availability.create');
Route::post('/castrationandspay/user/availability/store', [CastrationAndSpayAvailabilityController::class, 'availabilitystore'])->name('castrationandspay.user.availability.store');
Route::post('/castrationandspay/user/availability/bulkdelete', [CastrationAndSpayAvailabilityController::class, 'availabilitybulkdelete'])->name('castrationandspay.user.availability.bulkdelete');
Route::post('/castrationandspay/user/availability/bulkdisable', [CastrationAndSpayAvailabilityController::class, 'availabilitybulkdisable'])->name('castrationandspay.user.availability.bulkdisable');
Route::post('/castrationandspay/user/availability/bulkenable', [CastrationAndSpayAvailabilityController::class, 'availabilitybulkenable'])->name('castrationandspay.user.availability.bulkenable');

//Castration and Spay Block Dates
Route::get('/castrationandspay/user/blockdates/index', [CastrationAndSpayBlockDatesController::class, 'blockdatesindex'])->name('castrationandspay.user.blockdates.index');
Route::get('/castrationandspay/user/blockdates/create', [CastrationAndSpayBlockDatesController::class, 'blockdatescreate'])->name('castrationandspay.user.blockdates.create');
Route::post('/castrationandspay/user/blockdates/store', [CastrationAndSpayBlockDatesController::class, 'blockdatesstore'])->name('castrationandspay.user.blockdates.store');
Route::post('/castrationandspay/user/blockdates/bulkdelete', [CastrationAndSpayBlockDatesController::class, 'blockdatesbulkdelete'])->name('castrationandspay.user.blockdates.bulkdelete');

//Castration and Spay User Route (Scheduled Operation)
Route::get('/castrationandspay/user/scheduled/index', [CastrationAndSpayUserController::class, 'scheduledindex'])->name('castrationandspay.user.scheduled.index');
Route::post('/castrationandspay/user/scheduled/bulk-delete', [CastrationAndSpayUserController::class, 'scheduledbulkdelete'])->name('castrationandspay.user.scheduled.bulkdelete');
Route::post('/castrationandspay/user/scheduled/bulk-served', [CastrationAndSpayUserController::class, 'scheduledbulkserved'])->name('castrationandspay.user.scheduled.bulkserved');
Route::get('/castrationandspay/user/scheduled/form/{id}', [CastrationAndSpayUserController::class, 'scheduledform'])->name('castrationandspay.user.scheduled.form');
Route::get('/castrationandspay/user/scheduled/card/{id}', [CastrationAndSpayUserController::class, 'scheduledcard'])->name('castrationandspay.user.scheduled.card');

//Castration and Spay User Route (Served Clients)
Route::get('/castrationandspay/user/served/index', [CastrationAndSpayUserController::class, 'servedindex'])->name('castrationandspay.user.served.index');
Route::get('/castrationandspay/user/served/form/{id}', [CastrationAndSpayUserController::class, 'servedform'])->name('castrationandspay.user.served.form');
Route::get('/castrationandspay/user/served/card/{id}', [CastrationAndSpayUserController::class, 'servedcard'])->name('castrationandspay.user.served.card');

//Castration and Spay User Create Admin
Route::get('/castrationandspay/user/scheduled/admincreate', [CastrationAndSpayUserController::class, 'admincreate'])->name('castrationandspay.user.scheduled.admincreate');
Route::post('/castrationandspay/user/scheduled/adminpost', [CastrationAndSpayUserController::class, 'adminpost'])->name('castrationandspay.user.scheduled.adminpost');

//Banner Routes
Route::get('/banners/user/index', [BannerController::class, 'index'])->name('banners.user.index');
Route::get('/banners/user/create', [BannerController::class, 'create'])->name('banners.user.create');
Route::post('/banners/user/store', [BannerController::class, 'store'])->name('banners.user.store');
Route::get('/banners/user/view/{id}', [BannerController::class, 'view'])->name('banners.user.view');
Route::post('/banners/user/bulkdelete', [BannerController::class, 'bulkdelete'])->name('banners.user.bulkdelete');

//Auth Route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
