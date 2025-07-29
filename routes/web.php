<?php

use App\Models\News;
use App\Models\Banner;
use App\Models\FarmMechanization;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UpdateProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NewsGuestController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\ContactUsReplyController;
use App\Http\Controllers\CastrationAndSpayController;
use App\Http\Controllers\FarmMechanizationController;
use App\Http\Controllers\CastrationAndSpayUserController;
use App\Http\Controllers\FarmMechanizationUserController;
use App\Http\Controllers\CastrationAndSpayDashboardController;
use App\Http\Controllers\FarmMechanizationDashboardController;
use App\Http\Controllers\CastrationAndSpayBlockDatesController;
use App\Http\Controllers\FarmMechanizationBlockDatesController;
use App\Http\Controllers\CastrationAndSpayAvailabilityController;
use App\Http\Controllers\FarmMechanizationAvailabilityController;

//Welcome Blade
Route::get('/', function () {
    $bannerLatest = Banner::select('banner_picture')->orderBy('created_at', 'desc')->limit(5)->get(); // ← Important!

    $newsLatest = News::orderBy('published_at', 'desc')->limit(5)->get();

    return view('welcome', [
        'bannerLatest' => $bannerLatest,
        'newsLatest' => $newsLatest,
    ]);
});

//Contact Us Route
//Contact Us Guest Views
Route::post('/contactus/store', [ContactUsController::class, 'store'])->name('contactus.store');

//Contact Us User Views
Route::get('/contactus/index',[ContactUsController::class, 'index'])->name('contactus.userviews.index')->middleware('auth');
Route::get('/contactus/reply/{id}',[ContactUsController::class, 'reply'])->name('contactus.userviews.reply')->middleware('auth');
Route::post('/contactus/{id}/sendreply', [ContactUsReplyController::class, 'sendreply'])->name('contact.userviews.sendreply')->middleware('auth');

//Profile
//Edit Profile
Route::get('/profile/edit/{id}', [UpdateProfileController::class,'edit'])->name('editprofile.userviews.edit')->middleware('auth');
Route::put('/profile/update/{id}', [UpdateProfileController::class,'update'])->name('editprofile.userviews.update')->middleware('auth');


//Dashboard Routes
//Dashboard Farm Mechanization
Route::get('/dashboard/services/farmmechanization', [FarmMechanizationDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.farmmechanization');

Route::post('/dashboard/services/farmmechanization/search', [FarmMechanizationDashboardController::class, 'search'])
    ->name('dashboard.farmmechanization.search')
    ->middleware('auth');

//Dashboard Castration and Spay
Route::get('/dashboard/services/castrationandspay', [CastrationAndSpayDashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard.castrationandspay');

Route::post('/dashboard/services/castrationandspay/search', [CastrationAndSpayDashboardController::class, 'search'])
    ->name('dashboard.castrationandspay.search')
    ->middleware('auth');

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
Route::get('/farmmechanization/user/pending/index', [FarmMechanizationUserController::class, 'pendingindex'])
    ->name('farmmechanization.user.pending.index')
    ->middleware('auth');
Route::post('/farmmechanization/user/pending/bulk-delete', [FarmMechanizationUserController::class, 'pendingbulkdelete'])
    ->name('farmmechanization.user.pending.bulkdelete')
    ->middleware('auth');
Route::post('/farmmechanization/user/pending/bulk-approve', [FarmMechanizationUserController::class, 'pendingbulkapprove'])
    ->name('farmmechanization.user.pending.bulkapprove')
    ->middleware('auth');

//Farm Mechanization User Route (Approved Visitation)
Route::get('/farmmechanization/user/approved/index', [FarmMechanizationUserController::class, 'approvedindex'])
    ->name('farmmechanization.user.approved.index')
    ->middleware('auth');
Route::get('/farmmechanization/user/approved/show/{id}', [FarmMechanizationUserController::class, 'approvedshow'])
    ->name('farmmechanization.user.approved.show')
    ->middleware('auth');
Route::post('/farmmechanization/user/approved/cashcollection', [FarmMechanizationUserController::class, 'approvedcashcollection'])
    ->name('farmmechanization.user.approved.cashcollection')
    ->middleware('auth');

//Farm Mechanization User Route (Scheduled Service)
Route::get('/farmmechanization/user/scheduled/index', [FarmMechanizationUserController::class, 'scheduledindex'])
    ->name('farmmechanization.user.scheduled.index')
    ->middleware('auth');
Route::get('/farmmechanization/user/scheduled/form/{id}', [FarmMechanizationUserController::class, 'scheduledform'])
    ->name('farmmechanization.user.scheduled.form')
    ->middleware('auth');
Route::get('/farmmechanization/user/scheduled/edit/{id}', [FarmMechanizationUserController::class, 'schedulededit'])
    ->name('farmmechanization.user.scheduled.edit')
    ->middleware('auth');
Route::put('/farmmechanization/user/scheduled/update/{id}', [FarmMechanizationUserController::class, 'scheduledupdate'])
    ->name('farmmechanization.user.scheduled.update')
    ->middleware('auth');
Route::get('/farmmechanization/user/scheduled/upload/{id}', [FarmMechanizationUserController::class, 'scheduledupload'])
    ->name('farmmechanization.user.scheduled.upload')
    ->middleware('auth');
Route::post('/farmmechanization/user/scheduled/uploadstore', [FarmMechanizationUserController::class, 'scheduleduploadstore'])
    ->name('farmmechanization.user.scheduled.uploadstore')
    ->middleware('auth');
Route::delete('/farmmechanization/user/scheduled/delete/{id}', [FarmMechanizationUserController::class, 'scheduleddelete'])
    ->name('farmmechanization.user.scheduled.delete')
    ->middleware('auth');

//Farm Mechanization User Route (Served Clients)
Route::get('/farmmechanization/user/served/index', [FarmMechanizationUserController::class, 'servedindex'])
    ->name('farmmechanization.user.served.index')
    ->middleware('auth');
Route::post('/farmmechanization/user/served/bulkserved', [FarmMechanizationUserController::class, 'servedbulkserved'])
    ->name('farmmechanization.user.served.bulkserved')
    ->middleware('auth');

//Farm Mechanization Create Admin
Route::get('/farmmechanization/user/scheduled/admincreate', [FarmMechanizationUserController::class, 'admincreate'])
    ->name('farmmechanization.user.scheduled.admincreate')
    ->middleware('auth');
Route::post('/farmmechanization/user/scheduled/adminpost', [FarmMechanizationUserController::class, 'adminpost'])
    ->name('farmmechanization.user.scheduled.adminpost')
    ->middleware('auth');
Route::delete('/farmmechanization/user/scheduled/admindelete/{id}', [FarmMechanizationUserController::class, 'admindelete'])
    ->name('farmmechanization.user.scheduled.admindelete')
    ->middleware('auth');

//Farm Mechanization Block Dates
Route::get('/farmmechanization/user/blockdates/index', [FarmMechanizationBlockDatesController::class, 'blockdatesindex'])
    ->name('farmmechanization.user.blockdates.index')
    ->middleware('auth');
Route::get('/farmmechanization/user/blockdates/create', [FarmMechanizationBlockDatesController::class, 'blockdatescreate'])
    ->name('farmmechanization.user.blockdates.create')
    ->middleware('auth');
Route::post('/farmmechanization/user/blockdates/store', [FarmMechanizationBlockDatesController::class, 'blockdatesstore'])
    ->name('farmmechanization.user.blockdates.store')
    ->middleware('auth');
Route::post('/farmmechanization/user/blockdates/bulkdelete', [FarmMechanizationBlockDatesController::class, 'blockdatesbulkdelete'])
    ->name('farmmechanization.user.blockdates.bulkdelete')
    ->middleware('auth');

//Farm Mechanization Availability
Route::get('/farmmechanization/user/availability/index', [FarmMechanizationAvailabilityController::class, 'availabilityindex'])
    ->name('farmmechanization.user.availability.index')
    ->middleware('auth');
Route::get('/farmmechanization/user/availability/create', [FarmMechanizationAvailabilityController::class, 'availabilitycreate'])
    ->name('farmmechanization.user.availability.create')
    ->middleware('auth');
Route::post('/farmmechanization/user/availability/store', [FarmMechanizationAvailabilityController::class, 'availabilitystore'])
    ->name('farmmechanization.user.availability.store')
    ->middleware('auth');
Route::post('/farmmechanization/user/availability/bulkdelete', [FarmMechanizationAvailabilityController::class, 'availabilitybulkdelete'])
    ->name('farmmechanization.user.availability.bulkdelete')
    ->middleware('auth');
Route::post('/farmmechanization/user/availability/bulkdisable', [FarmMechanizationAvailabilityController::class, 'availabilitybulkdisable'])
    ->name('farmmechanization.user.availability.bulkdisable')
    ->middleware('auth');
Route::post('/farmmechanization/user/availability/bulkenable', [FarmMechanizationAvailabilityController::class, 'availabilitybulkenable'])
    ->name('farmmechanization.user.availability.bulkenable')
    ->middleware('auth');

//Castration and Spay Route
Route::get('/castrationandspay/create', [CastrationAndSpayController::class, 'create'])->name('castrationandspay.create');
Route::post('/castrationandspay/store', [CastrationAndSpayController::class, 'store'])->name('castrationandspay.store');
Route::get('/castrationandspay/form/{id}', [CastrationAndSpayController::class, 'form'])->name('castrationandspay.form');
Route::get('/castrationandspay/track', [CastrationAndSpayController::class, 'track'])->name('castrationandspay.track');
Route::post('/castrationandspay/tracksearch', [CastrationAndSpayController::class, 'tracksearch'])->name('castrationandspay.tracksearch');
Route::get('/castrationandspay/tracksearchlink', [CastrationAndSpayController::class, 'tracksearchFromLink'])->name('castrationandspay.tracksearch.link');

//Castration and Spay Availability
Route::get('/castrationandspay/user/availability/index', [CastrationAndSpayAvailabilityController::class, 'availabilityindex'])
    ->name('castrationandspay.user.availability.index')
    ->middleware('auth');
Route::get('/castrationandspay/user/availability/create', [CastrationAndSpayAvailabilityController::class, 'availabilitycreate'])
    ->name('castrationandspay.user.availability.create')
    ->middleware('auth');
Route::post('/castrationandspay/user/availability/store', [CastrationAndSpayAvailabilityController::class, 'availabilitystore'])
    ->name('castrationandspay.user.availability.store')
    ->middleware('auth');
Route::post('/castrationandspay/user/availability/bulkdelete', [CastrationAndSpayAvailabilityController::class, 'availabilitybulkdelete'])
    ->name('castrationandspay.user.availability.bulkdelete')
    ->middleware('auth');
Route::post('/castrationandspay/user/availability/bulkdisable', [CastrationAndSpayAvailabilityController::class, 'availabilitybulkdisable'])
    ->name('castrationandspay.user.availability.bulkdisable')
    ->middleware('auth');
Route::post('/castrationandspay/user/availability/bulkenable', [CastrationAndSpayAvailabilityController::class, 'availabilitybulkenable'])
    ->name('castrationandspay.user.availability.bulkenable')
    ->middleware('auth');

//Castration and Spay Block Dates
Route::get('/castrationandspay/user/blockdates/index', [CastrationAndSpayBlockDatesController::class, 'blockdatesindex'])
    ->name('castrationandspay.user.blockdates.index')
    ->middleware('auth');
Route::get('/castrationandspay/user/blockdates/create', [CastrationAndSpayBlockDatesController::class, 'blockdatescreate'])
    ->name('castrationandspay.user.blockdates.create')
    ->middleware('auth');
Route::post('/castrationandspay/user/blockdates/store', [CastrationAndSpayBlockDatesController::class, 'blockdatesstore'])
    ->name('castrationandspay.user.blockdates.store')
    ->middleware('auth');
Route::post('/castrationandspay/user/blockdates/bulkdelete', [CastrationAndSpayBlockDatesController::class, 'blockdatesbulkdelete'])
    ->name('castrationandspay.user.blockdates.bulkdelete')
    ->middleware('auth');

//Castration and Spay User Route (Scheduled Operation)
Route::get('/castrationandspay/user/scheduled/index', [CastrationAndSpayUserController::class, 'scheduledindex'])
    ->name('castrationandspay.user.scheduled.index')
    ->middleware('auth');
Route::post('/castrationandspay/user/scheduled/bulk-delete', [CastrationAndSpayUserController::class, 'scheduledbulkdelete'])
    ->name('castrationandspay.user.scheduled.bulkdelete')
    ->middleware('auth');
Route::post('/castrationandspay/user/scheduled/bulk-served', [CastrationAndSpayUserController::class, 'scheduledbulkserved'])
    ->name('castrationandspay.user.scheduled.bulkserved')
    ->middleware('auth');
Route::get('/castrationandspay/user/scheduled/form/{id}', [CastrationAndSpayUserController::class, 'scheduledform'])
    ->name('castrationandspay.user.scheduled.form')
    ->middleware('auth');
Route::get('/castrationandspay/user/scheduled/card/{id}', [CastrationAndSpayUserController::class, 'scheduledcard'])
    ->name('castrationandspay.user.scheduled.card')
    ->middleware('auth');

//Castration and Spay User Route (Served Clients)
Route::get('/castrationandspay/user/served/index', [CastrationAndSpayUserController::class, 'servedindex'])
    ->name('castrationandspay.user.served.index')
    ->middleware('auth');
Route::get('/castrationandspay/user/served/form/{id}', [CastrationAndSpayUserController::class, 'servedform'])
    ->name('castrationandspay.user.served.form')
    ->middleware('auth');
Route::get('/castrationandspay/user/served/card/{id}', [CastrationAndSpayUserController::class, 'servedcard'])
    ->name('castrationandspay.user.served.card')
    ->middleware('auth');

//Castration and Spay User Create Admin
Route::get('/castrationandspay/user/scheduled/admincreate', [CastrationAndSpayUserController::class, 'admincreate'])
    ->name('castrationandspay.user.scheduled.admincreate')
    ->middleware('auth');
Route::post('/castrationandspay/user/scheduled/adminpost', [CastrationAndSpayUserController::class, 'adminpost'])
    ->name('castrationandspay.user.scheduled.adminpost')
    ->middleware('auth');

//Banner Routes
Route::get('/banners/user/index', [BannerController::class, 'index'])
    ->name('banners.user.index')
    ->middleware('auth');
Route::get('/banners/user/create', [BannerController::class, 'create'])
    ->name('banners.user.create')
    ->middleware('auth');
Route::post('/banners/user/store', [BannerController::class, 'store'])
    ->name('banners.user.store')
    ->middleware('auth');
Route::get('/banners/user/view/{id}', [BannerController::class, 'view'])
    ->name('banners.user.view')
    ->middleware('auth');
Route::post('/banners/user/bulkdelete', [BannerController::class, 'bulkdelete'])
    ->name('banners.user.bulkdelete')
    ->middleware('auth');

//News Routes
Route::get('/news/user/index', [NewsController::class, 'index'])
    ->name('news.user.index')
    ->middleware('auth');
Route::get('/news/user/create', [NewsController::class, 'create'])
    ->name('news.user.create')
    ->middleware('auth');
Route::post('/news/user/store', [NewsController::class, 'store'])
    ->name('news.user.store')
    ->middleware('auth');
Route::get('/news/user/edit/{id}', [NewsController::class, 'edit'])
    ->name('news.user.edit')
    ->middleware('auth');
Route::put('/news/user/update/{id}', [NewsController::class, 'update'])
    ->name('news.user.update')
    ->middleware('auth');
Route::get('/news/user/editpic/{id}', [NewsController::class, 'editpic'])
    ->name('news.user.editpic')
    ->middleware('auth');
Route::put('/news/user/updatepic/{id}', [NewsController::class, 'updatepic'])
    ->name('news.user.updatepic')
    ->middleware('auth');
Route::post('/news/user/bulkdelete', [NewsController::class, 'bulkdelete'])
    ->name('news.user.bulkdelete')
    ->middleware('auth');

//News Guest Route
Route::get('/news/guest', [NewsGuestController::class, 'index'])->name('news.guest.index');
Route::get('/news/guest/{id}', [NewsGuestController::class, 'show'])->name('news.guest.show');

//Manage Users Route
Route::get('/manageusers/index', [ManageUsersController::class, 'index'])
    ->name('manageusers.index')
    ->middleware('auth');
Route::get('/manageusers/edit/{id}', [ManageUsersController::class, 'edit'])
    ->name('manageusers.edit')
    ->middleware('auth');
Route::put('/manageusers/update/{id}', [ManageUsersController::class, 'update'])
    ->name('manageusers.update')
    ->middleware('auth');
Route::post('/manageusers/bulkdelete', [ManageUsersController::class, 'bulkdelete'])
    ->name('manageusers.bulkdelete')
    ->middleware('auth');

//Auth Route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
