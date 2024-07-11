<?php

//  Start Route Resource
//  Route Index
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@showIndex')->name('index');


//  Route Login
Route::post('login', 'HomeController@doLogin')->name('login');
Route::get('logout', 'HomeController@logout')->name('logout')->middleware(['auth']);


//  Route Change Password
Route::get('change-password', 'HomeController@changePassword')->name('get_change-password')->middleware(['auth', 'active']);
Route::post('change-password', 'HomeController@updatePassword')->name('post_change-password')->middleware(['auth', 'active']);
//  End Route Resource

Route::get('assets/coverImage', "LeaveController@coverImage")->name('coverImagePic');
// Start Route Assets
Route::get('assets/img/logo', 'AssetsController@imgLogo')->name('assets/img/logo');
Route::get('assets/img/iconic', 'AssetsController@iconicLogo')->name('assets/img/iconic');
Route::get('assets/img/opening', 'AssetsController@iconicOpening')->name('assets/img/opening');
Route::get('assets/img/kinema', 'AssetsController@imgKinema')->name('assets/img/kinema');
Route::get('assets/img/globe', 'AssetsController@imgGlobe')->name('assets/img/globe');
Route::get('assets/img/wis', 'AssetsController@imgWis')->name('assets/img/wis');
Route::get('assets/img/strucutre', 'AssetsController@imgStructure')->name('assets/img/strucutre');
Route::get('assets/css/bootstrap', 'AssetsController@cssBootstrap')->name('assets/css/bootstrap');
Route::get('assets/css/metis', 'AssetsController@cssMetis')->name('assets/css/metis');
Route::get('assets/css/sb-admin-2', 'AssetsController@cssSBAdmin2')->name('assets/css/sb-admin-2');
Route::get('assets/css/font-awesome', 'AssetsController@cssFontAwesome')->name('assets/css/font-awesome');
Route::get('assets/css/plugin/datatables', 'AssetsController@cssPluginDatatables')->name('assets/css/plugin/datatables');
Route::get('assets/css/responsive/datatables', 'AssetsController@cssResponsiveDatatables')->name('assets/css/responsive/datatables');
Route::get('assets/js/jquery', 'AssetsController@jsJQuery')->name('assets/js/jquery');
//datepicker
//Route::get('assets/js/datepicker/jquery_1.8.3.js', 'AssetsController@jquery_1.8.3')->name('assets/js/datepicker/jquery_1.8.3.js');
//Route::get('assets/js/datepicker/jquery-ui.js', 'AssetsController@jquery-ui')->name('assets/js/datepicker/jquery-ui.js');
//Route::get('assets/js/datepicker/jquery-ui.css', 'AssetsController@jquery-ui')->name('assets/js/datepicker/jquery-ui.css');
//
Route::get('assets/js/1.js', 'AssetsController@jjs')->name('assets/js/1.js');
Route::get('assets/css/1.css', 'AssetsController@jcss')->name('assets/css/1.css');
Route::get('assets/js/bootstrap', 'AssetsController@jsBootstrap')->name('assets/js/bootstrap');
Route::get('assets/js/metis', 'AssetsController@jsMetis')->name('assets/js/metis');
Route::get('assets/js/sb-admin-2', 'AssetsController@jsSBAdmin2')->name('assets/js/sb-admin-2');
Route::get('assets/js/datatables', 'AssetsController@jsDatatables')->name('assets/js/datatables');
Route::get('assets/js/plugin/datatables', 'AssetsController@jsPluginDatatables')->name('assets/js/plugin/datatables');
Route::get('assets/js/responsive/datatables', 'AssetsController@jsResponsiveDatatables')->name('assets/js/responsive/datatables');
Route::get('assets/js/highcharts', 'AssetsController@jsHighCharts')->name('assets/js/highcharts');
Route::get('assets/js/exporting', 'AssetsController@jsExporting')->name('assets/js/exporting');
Route::get('assets/js/tinymce', 'AssetsController@jsTinyMCE')->name('assets/js/tinymce');
Route::get('assets/fonts/fontawesome-webfont.woff2', 'AssetsController@fontFontAwesomeWebfontWoff2')->name('assets/fonts/fontawesome-webfont.woff2');
Route::get('assets/fonts/fontawesome-webfont.woff', 'AssetsController@fontFontAwesomeWebfontWoff')->name('assets/fonts/fontawesome-webfont.woff');
Route::get('assets/fonts/fontawesome-webfont.ttf', 'AssetsController@fontFontAwesomeWebfontTTF')->name('assets/fonts/fontawesome-webfont.ttf');

Route::get('assets/vendor/Buttons/css/buttons.dataTables.min.css', 'AssetsController@cssButtonDatatables')->name('assets/vendor/Buttons/css/buttons.dataTables.min.css');
Route::get('assets/vendor/Buttons/js/dataTables.buttons.min.js', 'AssetsController@jsButtonDatatables')->name('assets/vendor/Buttons/js/dataTables.buttons.min.js');
Route::get('assets/vendor/Buttons/js/buttons.flash.min.js', 'AssetsController@jsButtonFlash')->name('assets/vendor/Buttons/js/buttons.flash.min.js');
Route::get('assets/vendor/Buttons/js/buttons.html5.min.js', 'AssetsController@jsButtonHtml5')->name('assets/vendor/Buttons/js/buttons.html5.min.js');
Route::get('assets/vendor/Buttons/js/buttons.print.min.js', 'AssetsController@jsButtonPrint')->name('assets/vendor/Buttons/js/buttons.print.min.js');
Route::get('assets/vendor/JSZip/jszip.min.js', 'AssetsController@jsJSZip')->name('assets/vendor/JSZip/jszip.min.js');
Route::get('assets/vendor/pdfmake/pdfmake.min.js', 'AssetsController@jsPdfmake')->name('assets/vendor/pdfmake/pdfmake.min.js');
Route::get('assets/vendor/pdfmake/vfs_fonts.js', 'AssetsController@jsPdfmake_vfs_fonts')->name('assets/vendor/pdfmake/vfs_fonts.js');
// End Route Assets


// Start Route Ajax
//
// End Route Ajax


//  Start Route ADMIN
//  Route User

Route::get('mgmt-data/All_User', 'ADMController@allUser')->name('mgmt-data/All_User');

Route::get('mgmt-data/getAll_User', 'ADMController@getallUser')->name('mgmt-data/getAll_User');

Route::get('mgmt-data/user', 'ADMController@indexUser')->name('mgmt-data/user');
Route::get('mgmt-data/user/getindex', 'ADMController@getIndexUser')->name('mgmt-data/user/getindex');
Route::get('mgmt-data/user/create', 'ADMController@createUser')->name('mgmt-data/user/create');
Route::post('mgmt-data/user/store', 'ADMController@storeUser')->name('mgmt-data/user/store');
Route::get('mgmt-data/user/{id}/edit-data', 'ADMController@editDataUser')->name('mgmt-data/user/edit-data');
Route::get('mgmt-data/user/{id}/edit-password', 'ADMController@editPasswordUser')->name('mgmt-data/user/edit-password');
Route::post('mgmt-data/user/{id}/update-data', 'ADMController@updateDataUser')->name('mgmt-data/user/update-data');
Route::post('mgmt-data/user/{id}/update-password', 'ADMController@updatePasswordUser')->name('mgmt-data/user/update-password');
Route::get('mgmt-data/user/{id}/delete', 'ADMController@destroyUser')->name('mgmt-data/user/delete');
Route::get('mgmt-data/user/{id}/detail', 'ADMController@detailUser')->name('mgmt-data/user/detail');
Route::get('mgmt-data/user/{id}/passReset', 'ADMController@passResetUser')->name('mgmt-data/user/passReset');
Route::get('mgmt-data/user/{id}/actionPassReset', 'ADMController@actionPassResetUser')->name('mgmt-data/user/ActionPassReset');
//  Start Route Initial Leave
Route::get('mgmt-data/initial', 'ADMController@indexInitial')->name('mgmt-data/initial');
Route::get('mgmt-data/initial/getindexInitial', 'ADMController@getIndexInitial')->name('mgmt-data/initial/getindexInitial');
Route::get('mgmt-data/initial/getindexInitial2', 'ADMController@getIndexInitial2')->name('mgmt-data/initial/getindexInitial2');
Route::get('mgmt-data/initial/{id}/create', 'ADMController@createInitial')->name('mgmt-data/initial/create');
Route::post('mgmt-data/initial/{id}/store', 'ADMController@storeInitial')->name('mgmt-data/initial/store');
Route::get('mgmt-data/initial/{id}/delete', 'ADMController@destroyInitial')->name('mgmt-data/initial/delete');
//  Start Route User Previlege
Route::get('mgmt-data/previlege', 'ADMController@indexPrevilege')->name('mgmt-data/previlege');
Route::get('mgmt-data/previlege/getindex', 'ADMController@getIndexPrevilege')->name('mgmt-data/previlege/getindex');
Route::get('mgmt-data/previlege/{id}/edit-previlege', 'ADMController@editPrevilege')->name('mgmt-data/previlege/edit-previlege');
Route::post('mgmt-data/previlege/{id}/update-previlege', 'ADMController@updatePrevilege')->name('mgmt-data/previlege/update-previlege');
//  Start Route Department Category
Route::get('mgmt-data/department', 'ADMController@indexDepartment')->name('mgmt-data/department');
Route::get('mgmt-data/department/getindex', 'ADMController@getIndexDepartment')->name('mgmt-data/department/getindexDepartment');
Route::get('mgmt-data/department/create', 'ADMController@createDepartment')->name('mgmt-data/department/create');
Route::post('mgmt-data/department/store', 'ADMController@storeDepartment')->name('mgmt-data/department/store');
Route::get('mgmt-data/department/{id}/edit-data', 'ADMController@editDataDepartment')->name('mgmt-data/department/edit-data');
Route::post('mgmt-data/department/{id}/update-data', 'ADMController@updateDataDepartment')->name('mgmt-data/department/update-data');
Route::get('mgmt-data/department/{id}/delete', 'ADMController@destroyDepartment')->name('mgmt-data/department/delete');
//	Trafic Light
//grafic
Route::get('getchart', 'ADMController@grafic')->name('getchart');
//online
Route::get('getonline', 'ADMController@online')->name('getonline');
Route::get('getonline1', 'ADMController@indexonline')->name('getonline1');
//	Maintanace
//Contract
Route::get('Contract-Staff', 'ADMController@indexContract')->name('Contract-Staff');
Route::get('Contract-Index', 'ADMController@getindexContract')->name('Contract-Index');
Route::get('Contract-Post', 'ADMController@storeContract')->name('Contract-Post');
//Birthday
Route::get('Birthday-Staff', 'ADMController@indexBirhtday')->name('Birthday-Staff');
Route::get('Birthday-Index', 'ADMController@getindexBirhtday')->name('Birthday-Index');
Route::get('Birthday/{id}/Mail', 'ADMController@mailBirthday')->name('Birthday/Mail');
// Level Access
Route::get('HRD-Access', 'ADMController@indexAccess')->name('HRD-Access');
Route::get('HRD-get', 'ADMController@getindexAccess')->name('HRD-get');
Route::get('hrd-access/{id}/change', 'ADMController@editAccess')->name('hrd-access/change');
Route::post('hrd-post/{id}', 'ADMController@storeAccess')->name('hrd-post');

// Production Access
Route::prefix('Production')->group(function () {
    Route::get('indexProduction', 'ADMController@indexProduction')->name('indexProduction');
    Route::get('getProduction', 'ADMController@getindexProductionAccess')->name('getProduction');
    Route::get('editProduction/{id}', 'ADMController@editProductionAccess')->name('editProduction');
    Route::post('postProduction/{id}', 'ADMController@storeProductionAccess')->name('postProduction');

    Route::get('phone', 'AllEmployesForProductionsController@indexPhoneBookProduction')->name('production/phonebook');
    Route::get('phone/data', 'AllEmployesForProductionsController@objetDataPhoneBookProduction')->name('production/phonebook/data');
});
//  End Route ADMIN

//  Start Route HR
//Contract
Route::get('End-Contract-Staff', 'HRController@indexContract')->name('End-Contract-Staff');
Route::get('End-Contract-Index', 'HRController@getindexContract')->name('End-Contract-Index');
Route::get('Contract/{id}/Edit', 'HRController@editContract')->name('Contract/Edit');
Route::post('End-Contract-Store', 'HRController@storeContract')->name('End-Contract-Store');
Route::get('Contract/{id}/Save', 'HRController@saveContract')->name('Contract/Save');
//  Route User
Route::get('hr_mgmt-data/user', 'HRController@indexUser')->name('hr_mgmt-data/user');
Route::get('hr_mgmt-data/user/getindex', 'HRController@getIndexUser')->name('hr_mgmt-data/user/getindex');
Route::get('hr_mgmt-data/user/create', 'HRController@createUser')->name('hr_mgmt-data/user/create');
Route::post('hr_mgmt-data/user/store', 'HRController@storeUser')->name('hr_mgmt-data/user/store');
Route::get('hr_mgmt-data/user/{id}/edit-data', 'HRController@editDataUser')->name('hr_mgmt-data/user/edit-data');
Route::get('hr_mgmt-data/user/{id}/edit-password', 'HRController@editPasswordUser')->name('hr_mgmt-data/user/edit-password');
Route::get('hr_mgmt-data/user/{id}/save-data', 'HRController@saveDataUser')->name('hr_mgmt-data/user/save-data');
Route::post('hr_mgmt-data/user/{id}/update-data', 'HRController@updateDataUser')->name('hr_mgmt-data/user/update-data');
Route::post('hr_mgmt-data/user/{id}/update-password', 'HRController@updatePasswordUser')->name('hr_mgmt-data/user/update-password');
Route::get('hr_mgmt-data/user/{id}/delete', 'HRController@destroyUser')->name('hr_mgmt-data/user/delete');
Route::get('hr_mgmt-data/user/{id}/detail', 'HRController@detailUser')->name('hr_mgmt-data/user/detail');
Route::get('hr_mgmt-data/user/{id}/passReset', 'HRController@passResetUser')->name('hr_mgmt-data/user/passReset');
Route::get('hr_mgmt-data/user/{id}/actionPassReset', 'HRController@actionPassResetUser')->name('hr_mgmt-data/user/ActionPassReset');

//  Start Route Initial Leave exdo
Route::get('hr_mgmt-data/initial', 'HRController@indexInitial')->name('hr_mgmt-data/initial');
Route::get('hr_mgmt-data/initial/getindexInitial', 'HRController@getIndexInitial')->name('hr_mgmt-data/initial/getindexInitial');
/////////////////////////////////////////////////
Route::get('hr_mgmt-data/initial/createdLimit', 'HRController@createdLimit')->name('hr_mgmt-data/initial/createdLimit');
Route::get('hr_mgmt-data/initial/storeLimit', 'HRController@storeLimit')->name('hr_mgmt-data/initial/storeLimit');
////////////////////////////////////////////////
Route::get('hr_mgmt-data/initial/exdo/{id}', 'HRController@indexExpiredExdo')->name('hr_mgmt-data/initial/exdo/limit');
Route::post('hr_mgmt-data/initial/exdo/update/{id}', 'HRController@storeExpiredExdo')->name('hr_mgmt-data/initial/exdo/update');
Route::get('hr_mgmt-data/initial/getindexInitial2', 'HRController@getIndexInitial2')->name('hr_mgmt-data/initial/getindexInitial2');
Route::get('hr_mgmt-data/initial/{id}/create', 'HRController@createInitial')->name('hr_mgmt-data/initial/create');
Route::post('hr_mgmt-data/initial/{id}/store', 'HRController@storeInitial')->name('hr_mgmt-data/initial/store');
Route::get('hr_mgmt-data/initial/{id}/delete', 'HRController@destroyInitial')->name('hr_mgmt-data/initial/delete');
//  Start Route Leave Report
Route::get('hr_mgmt-data/leaveReport', 'HRController@indexLeaveReport')->name('hr_mgmt-data/leaveReport');
Route::get('hr_mgmt-data/previewLeaveReport', 'HRController@previewLeaveReport')->name('hr_mgmt-data/previewLeaveReport');
Route::post('hr_mgmt-data/printLeaveReport', 'HRController@printLeaveReport')->name('hr_mgmt-data/printLeaveReport');
Route::get('hr_mgmt-data/leaveEntitledReport', 'HRController@indexLeaveEntitledReport')->name('hr_mgmt-data/leaveEntitledReport');
Route::post('hr_mgmt-data/storeGetleaveEntitledReport', 'HRController@storeGetleaveEntitledReport')->name('hr_mgmt-data/storeGetleaveEntitledReport');
Route::post('hr_mgmt-data/storeGetleaveEntitledReportDaily', 'HRController@storeGetleaveEntitledReportDaily')->name('hr_mgmt-data/storeGetleaveEntitledReportDaily');
Route::get('hr_mgmt-data/getIndexLeaveEntitled', 'HRController@getIndexLeaveEntitled')->name('hr_mgmt-data/getIndexLeaveEntitled');
Route::get('hr_mgmt-data/leaveTransactionReport', 'HRController@indexLeaveTransactionReport')->name('hr_mgmt-data/leaveTransactionReport');
Route::get('hr_mgmt-data/getIndexLeaveTransactionReport', 'HRController@getIndexLeaveTransactionReport')->name('hr_mgmt-data/getIndexLeaveTransactionReport');
Route::get('hr_mgmt-data/leaveTransactionReport/{id}/uncancel', 'HRController@uncancelLeaveTransaction')->name('hr_mgmt-data/leaveTransactionReport/uncancel');
Route::get('hr_mgmt-data/leaveTransactionReport/{id}/cancel', 'HRController@cancelLeaveTransaction')->name('hr_mgmt-data/leaveTransactionReport/cancel');
Route::get('hr_mgmt-data/leaveTransactionReport/{id}/cdetail', 'HRController@detailTransaction')->name('hr_mgmt-data/leaveTransactionReport/cdetail');

Route::get('hr_mgmt-data/leaveTransactionReport/{id}/delete', 'HRController@destroyLeave')->name('hr_mgmt-data/leaveTransactionReport/delete');

Route::get('hr_mgmt-data/historyTransactionReport', 'HRController@indexHistoricalTransactionReport')->name('hr_mgmt-data/historyTransactionReport');

Route::get('hr_mgmt-data/getIndexHistoricalTransactionReport', 'HRController@getIndexHistoricalTransactionReport')->name('hr_mgmt-data/getIndexHistoricalTransactionReport');
Route::get('hr_mgmt-data/getchart', 'HRController@indexGrafik')->name('hr_mgmt-data/getchart');


//  Start Route User Previlege
Route::get('hr_mgmt-data/previlege', 'HRController@indexPrevilege')->name('hr_mgmt-data/previlege');
Route::get('hr_mgmt-data/previlege/getindex', 'HRController@getIndexPrevilege')->name('hr_mgmt-data/previlege/getindex');
Route::get('hr_mgmt-data/previlege/{id}/edit-previlege', 'HRController@editPrevilege')->name('hr_mgmt-data/previlege/edit-previlege');
Route::post('hr_mgmt-data/previlege/{id}/update-previlege', 'HRController@updatePrevilege')->name('hr_mgmt-data/previlege/update-previlege');
//  Start Route Department Category
Route::get('hr_mgmt-data/department', 'HRController@indexDepartment')->name('hr_mgmt-data/department');
Route::get('hr_mgmt-data/department/getindex', 'HRController@getIndexDepartment')->name('hr_mgmt-data/department/getindexDepartment');
Route::get('hr_mgmt-data/department/create', 'HRController@createDepartment')->name('hr_mgmt-data/department/create');
Route::post('hr_mgmt-data/department/store', 'HRController@storeDepartment')->name('hr_mgmt-data/department/store');
//  Start Route Rusun Report
Route::get('hr_mgmt-data/rusunReport', 'HRController@indexRusunReport')->name('hr_mgmt-data/rusunReport');
Route::get('hr_mgmt-data/getIndexRusunReport', 'HRController@getIndexRusunReport')->name('hr_mgmt-data/getIndexRusunReport');
//  Start Route Job Function Category
Route::get('hr_mgmt-data/jobFunction', 'HRController@indexJobFunction')->name('hr_mgmt-data/jobFunction');
Route::get('hr_mgmt-data/jobFunction/getindex', 'HRController@getIndexJobFunction')->name('hr_mgmt-data/jobFunction/getindexJobFunction');
Route::get('hr_mgmt-data/jobFunction/create', 'HRController@createJobFunction')->name('hr_mgmt-data/jobFunction/create');
Route::post('hr_mgmt-data/jobFunction/store', 'HRController@storeJobFunction')->name('hr_mgmt-data/jobFunction/store');
//  Start Route Project Category
Route::get('hr_mgmt-data/project', 'HRController@indexProject')->name('hr_mgmt-data/project');
Route::get('hr_mgmt-data/project/getindex', 'HRController@getIndexProject')->name('hr_mgmt-data/project/getindexProject');
Route::get('hr_mgmt-data/project/create', 'HRController@createProject')->name('hr_mgmt-data/project/create');
//Route::post('hr_mgmt-data/Project/{id}/delete', 'HRController@deleteProject')->name('hr_mgmt-data/Project/deleteProject');
Route::post('hr_mgmt-data/project/store', 'HRController@storeProject')->name('hr_mgmt-data/project/store');
//  Start Route User Project
Route::get('hr_mgmt-data/userProject', 'HRController@indexUserProject')->name('hr_mgmt-data/userProject');
Route::get('hr_mgmt-data/userProject/getindex', 'HRController@getIndexUserProject')->name('hr_mgmt-data/userProject/getindexUserProject');
Route::get('hr_mgmt-data/userProject/create', 'HRController@createUserProject')->name('hr_mgmt-data/userProject/create');
Route::post('hr_mgmt-data/userProject/store', 'HRController@storeUserProject')->name('hr_mgmt-data/userProject/store');
Route::get('hr_mgmt-data/userProject/{id}/edit-data', 'HRController@editDataUserProject')->name('hr_mgmt-data/userProject/edit-data');
//  Start Temporary Initial Leave Transaction
Route::get('hr_mgmt-data/leave/tempInitialLeave', 'HRController@indexTempInitialLeave')->name('hr_mgmt-data/leave/tempInitialLeave');
Route::get('hr_mgmt-data/leave/getIndexTempInitialLeave', 'HRController@getIndexTempInitialLeave')->name('hr_mgmt-data/leave/getIndexTempInitialLeave');
Route::get('hr_mgmt-data/leave/getIndexTempInitialAnnualLeave', 'HRController@getIndexTempInitialAnnualLeave')->name('hr_mgmt-data/leave/getIndexTempInitialAnnualLeave');

Route::get('hr_mgmt-data/leave/{id}/tempCreateInitialLeave', 'HRController@tempCreateInitialLeave')->name('hr_mgmt-data/leave/tempCreateInitialLeave');
Route::get('hr_mgmt-data/leave/{id}/tempCreateInitialLeave/data', 'HRInitialLeaveController@dataTempCreateInitialLeave')->name('hr_mgmt-data/leave/tempCreateInitialLeave/data');
Route::get('hr_mgmt-data/leave/{id}/tempCreateInitialLeave/detail', 'HRInitialLeaveController@modalViewTempCreateInitialLeave')->name('hr_mgmt-data/leave/tempCreateInitialLeave/detail');
Route::post('hr_mgmt-data/leave/tempStoreInitialLeave/{id}', 'HRController@storeTempCreateInitialLeave')->name('hr_mgmt-data/leave/tempStoreInitialLeave');
Route::get('hr_mgmt-data/initialAnnualLeave/{id}/delete', 'HRController@destroyInitialAnnualLeave')->name('hr_mgmt-data/initialAnnualLeave/delete');

//////////////////////////////////////////////////////

Route::get('hr_mgmt-data/leave/{id}/tempCreateInitialExdo', 'HRController@tempCreateInitialExdo')->name('hr_mgmt-data/leave/tempCreateInitialExdo');

Route::post('hr_mgmt-data/leave/{id}/tempStoreInitialExdo', 'HRController@tempStoreInitialExdo')->name('hr_mgmt-data/leave/tempStoreInitialExdo');
//  End Route HR
Route::get('leavel/ecek/{id}', 'LeaveController@dataKota')->name('leave/ecek');
//	Start Route Leave
//	Start Route Applying Leave
Route::get('leave/apply', 'LeaveController@indexNewApply')->name('leave/apply');
Route::get('leave/getindexApply', 'LeaveController@getIndexLeaveApply')->name('leave/getindexApply');
Route::get('leave/apply/dataExdo', 'LeaveController@indexDataExdo')->name('indexDataExdo');
Route::get('leave/create/advanced', 'LeaveController@createAdvance')->name('createAdvanceLeave');
Route::get('leave/create', 'LeaveController@createLeave')->name('leave/create');  // halo
Route::get('leave/create1', 'LeaveController@createLeave')->name('leave/create1');
Route::get('leave/createExdo', 'LeaveController@createExdo')->name('leave/createExdo');
Route::get('leave/createEtc', 'LeaveController@createEtc')->name('leave/createEtc');
Route::post('leave/store', 'LeaveController@storeLeave')->name('leave/store');
Route::post('leaveExdo/store', 'LeaveController@storeLeaveExdo')->name('leaveExdo/store');
Route::post('leaveEtc/store', 'LeaveController@storeLeaveEtc')->name('leaveEtc/store');
Route::post('leaveAdvanceEtc/store', 'LeaveController@storeAdvanceLeave')->name('advancedLeave/store');
//////////////////////////////////////
Route::get('leave/create/half-day', 'LeaveHalfDayController@indexHalfDay')->name('leave/indexHalfDay');
Route::post('leave/create/half-day/store', 'LeaveHalfDayController@storeLeaveHalfDay')->name('leave/storeHalfDay');
///////////////////////////////////////////////////////////////////////////////////////
Route::get('DetailStoreLeaveETC', 'LeaveController@DetailStoreLeaveETC')->name('DetailStoreLeaveETC');
//////////////////////////////////////////////////////////////////////////////////////
Route::get('leave/annual/self-declaration', 'LeaveController@forwarderAnnualLeave')->name('leave/forwarder/annual');
////////////////////////////////////////////////////////////////////////////////////
Route::post('leave/annual/self-declaration/post', 'LeaveController@postStoreAnnualLeave')->name('leave/forwarder/annual/post');
//////////////////////////////////////////////////////////////////////////////////////
//	Start Route Transaction Leave
Route::get('leave/transaction', 'LeaveController@indexLeaveTransaction')->name('leave/transaction');
Route::get('leave/transactionuser', 'LeaveController@indexLeaveTransactionUser')->name('leave/transactionuser');
Route::get('leave/transactionhd', 'LeaveController@indexLeaveTransactionHD')->name('leave/transactionhd');
Route::get('leave/alltransaction', 'LeaveController@indexLeaveAllTransaction')->name('leave/alltransaction');
Route::get('leave/getindexTransaction', 'LeaveController@getIndexLeaveTransaction')->name('leave/getindexTransaction');
Route::get('leave/reSendMailLeave/{id}', 'LeaveController@reSendMailLeave')->name('leave/reSendMailLeave');
Route::get('leave/reSendMailLeave/{id}/hod', 'LeaveController@resendMailLeaveHod')->name('leave/reSendMailLeave/hod');
Route::get('leave/transaction/pipeline', 'LeaveController@indexLeaveTransactionPipiline')->name('leave/indexLeaveTransactionPipiline');
Route::get('leave/transaction/production', 'LeaveController@getIndexTransactionProduction')->name('leave/getIndexTransactionProduction');
Route::get('leave/transaction/operations', 'LeaveController@getIndexTransactionOperation')->name('leave/getIndexTransactionOperation');
Route::get('leave/transaction/hrd', 'LeaveController@getIndexLeaveTransactionHRD')->name('leave/getIndexLeaveTransactionHRD');
// Route Transaction
Route::get('leave/transaction/head-of-department/faclities', 'LeaveController@getIndexTransactionHDFacilities')->name('leave/getIndexTransactionHDFacilities');
Route::get('leave/transaction/head-of-department', 'LeaveController@getIndexLeaveTransactionHD')->name('leave/getIndexLeaveTransactionHD');
Route::get('leave/transaction/head-of-department/finance-accounting', 'LeaveController@getIndexLeaveTransactionHDfa')->name('leave/getIndexLeaveTransactionHDfa');
Route::get('leave/transaction/head-of-department/live-shoot', 'LeaveController@getIndexLeaveTransactionHDLiveShoot')->name('leave/getIndexLeaveTransactionHDLiveShoot');

//Route::get('leave/getIndexLeaveTransactionUser', 'LeaveController@getIndexLeaveTransactionUser')->name('leave/getindexTransactionUser');
////////////////////////////////////////////////////////////////////////////////////
Route::post('leave/getGuide', 'LeaveController@getGUuide')->name('getGUuide');
Route::get('guided', 'LeaveController@guided')->name('guided');

///////////////////////////////////////////////////////////////////////////////////////////////
Route::get('leave/getindexAllTransaction', 'LeaveController@getIndexAllLeaveTransaction')->name('leave/getindexAllTransaction');
Route::get('leave/{id}/detail', 'LeaveController@detailLeave')->name('leave/detail');
Route::get('leave/{id}/detail/hod', 'LeaveController@detailLeaveHod')->name('leave/detail/hod');
Route::get('leave/{id}/detail2', 'LeaveController@detailLeave2')->name('leave/detail2');
Route::get('leave/{id}/print', 'LeaveController@printLeave')->name('leave/print');
Route::get('leave/{id}/print1', 'LeaveController@print1Leave')->name('leave/print1');
Route::get('leave/{id}/print2', 'LeaveController@print2Leave')->name('leave/print2');

Route::prefix('Projects')->group(function () {
    Route::get('indexYourProjects', 'LeaveController@indexYourProjects')->name('indexYourProjects');
    Route::get('List-Member', 'PMController@list76')->name('List-Member');
    Route::get('getList76', 'PMController@getlist76')->name('getList76');
    Route::get('getList2', 'PMController@getlist2')->name('getList2');
    Route::get('getList3', 'PMController@getlist3')->name('getList3');
    Route::get('getList4', 'PMController@getlist4')->name('getList4');
    Route::get('getList5', 'PMController@getlist5')->name('getList5');

    Route::get('List-Member-Koor', 'KoorController@list76')->name('List-Member-Koor');
    Route::get('getList761', 'KoorController@getlist76')->name('getList761');
    Route::get('getList22', 'KoorController@getlist2')->name('getList22');
    Route::get('getList33', 'KoorController@getlist3')->name('getList33');
    Route::get('getList44', 'KoorController@getlist4')->name('getList44');
    Route::get('getList55', 'KoorController@getlist5')->name('getList55');
});

//	Start Route Head Department Approval
Route::prefix('Manager')->group(function () {
    Route::get('leave/HD_approval', 'HD_ApprovalController@indexLeaveApproval')->name('leave/HD_approval');
    Route::get('leave/getindexHD_Approval', 'HD_ApprovalController@getIndexLeaveApproval')->name('leave/getindexHD_Approval');
    Route::get('leave/getIndexLeaveMiaSinaga', 'HD_ApprovalController@getIndexLeaveMiaSinaga')->name('leave/getIndexLeaveMiaSinaga');

    // Approve by John Radel
    Route::get('leave/getIndexLeaveApprovalForFacilities', 'HD_ApprovalController@getIndexLeaveApprovalForFacilities')->name('leave/getIndexLeaveApprovalForFacilities');

    // Approve HR -> HD
    Route::get('leave/hrd-approval', 'HD_ApprovalController@getIndexLeaveHRD')->name('leave/HRApproval');

    Route::get('ap_hd/{id}/detail', 'HD_ApprovalController@detailLeave')->name('ap_hd/detail');
    Route::get('ap_hd/{id}/approve', 'HD_ApprovalController@approveLeave')->name('ap_hd/approve');
    Route::get('ap_hd/{id}/disapprove', 'HD_ApprovalController@disapproveLeave')->name('ap_hd/disapprove');
    Route::get('ap_hd/{id}/sendDisapprove_email', 'HD_ApprovalController@sendDisapproveEmail')->name('ap_hd/sendDisapprove_email');

    // Approved HR
    Route::get('ap_hrd/{id}/detail', 'HD_ApprovalController@detailLeaveHRD')->name('ap_hrd/detail');
    Route::get('ap_hrd/{id}/approve', 'HD_ApprovalController@approveLeave')->name('ap_hrd/approve');
    Route::get('ap_hrd/{id}/disapprove', 'HD_ApprovalController@disapproveLeaveHRD')->name('ap_hrd/disapprove');

    Route::prefix('Reporting')->group(function () {
        Route::get('index-Grafik', 'HD_ApprovalController@indexHistorical')->name('index-Grafik');
        Route::get('index-History', 'HD_ApprovalController@indexHistori')->name('index-History');
        Route::get('get-History', 'HD_ApprovalController@getHistory')->name('get-History');
        Route::get('get-History-office', 'HD_ApprovalController@getHistory1')->name('get-History-office');
    });
    Route::middleware('hd_production')->group(function () {
        Route::prefix('WS-Avaiblity')->group(function () {
            Route::get('index', 'HD_ApprovalController@indexWS_Availability')->name('indexWS_AvailabilityManager');
            Route::get('ws-get', 'HD_ApprovalController@get_indexWS_Availability')->name('get_indexWS_AvailabilityManager');
            Route::get('idle', 'HD_ApprovalController@index_idle_Avability')->name('index_idle_AvabilityManager');
            Route::get('idle-get', 'HD_ApprovalController@get_index_idle_Avability')->name('get_index_idle_AvabilityManager');
            Route::get('legend', 'HD_ApprovalController@indexLegendAvailability')->name('indexLegendAvailabilityManager');
            Route::get('Scrapped', 'HD_ApprovalController@index_Scrapped')->name('index_ScrappedManager');
            Route::get('Scrapped-get', 'HD_ApprovalController@get_index_Scrapped')->name('get_index_ScrappedManager');
        });
    });
});



// Start Route HR Head Of Department
Route::get('leave/HRD_approval', 'HRD_ApprovalController@indexLeaveApproval')->name('leave/HRD_approval');

Route::get('leave/getindexHRD_Approval', 'HRD_ApprovalController@getIndexLeaveApproval')->name('leave/getindexHRD_Approval');
Route::get('ap_hrd/{id}/detail', 'HRD_ApprovalController@detailLeave')->name('ap_hrd/detail');
Route::get('ap_hrd/{id}/approve', 'HRD_ApprovalController@approveLeave')->name('ap_hrd/approve');
Route::get('ap_hrd/{id}/disapprove', 'HRD_ApprovalController@disapproveLeave')->name('ap_hrd/disapprove');
Route::get('ap_hrd/{id}/detailStaff', 'HRD_ApprovalController@detailLeaveStaff')->name('ap_hrd/detailLeaveStaff');
Route::get('ap_hrd/{id}/approveStaff', 'HRD_ApprovalController@approveLeaveStaff')->name('ap_hrd/approveStaff');
Route::get('ap_hrd/{id}/disapproveStaff', 'HRD_ApprovalController@disapproveLeaveStaff')->name('ap_hrd/disapproveStaff');
///////////////////////////////////////////////////////////
Route::get('management-data/leaveEntitledReport', 'HRD_ApprovalController@indexLeaveEntitledReport')->name('management-data/leaveEntitledReport');
Route::get('management-data/getleaveEntitledReport', 'HRD_ApprovalController@getIndexLeaveEntitled')->name('management-data/getleaveEntitledReport');
Route::get('management-data/historical', 'HRD_ApprovalController@indexhistorical')->name('management-data/historical');
Route::get('management-data/gethistorical', 'HRD_ApprovalController@getindexhistorical')->name('management-data/gethistorical');
Route::get('management-data/getPieGrafik', 'HRD_ApprovalController@indexGrafik')->name('management-data/getPieGrafik');

// employee HR Manager
Route::prefix('Management-HR_Manager')->group(function () {
    Route::prefix('Employee-HR_Manager')->group(function () {
        Route::get('Employee-HRD', 'HRD_ApprovalController@indexEmployee')->name('Employee-HRD');
        Route::get('getEmployee-HRD', 'HRD_ApprovalController@getEmployee')->name('getEmployee-HRD');
        Route::get('editEmployee/HRD/{id}', 'HRD_ApprovalController@editEmployee')->name('editEmployee/HRD');
        ROute::post('updateEmployee/HRD/{id}', 'HRD_ApprovalController@updateEmployee')->name('updateEmployee/HRD');
        Route::get('detailEmployee/{id}/HRD', 'HRD_ApprovalController@detailEmployee')->name('detailEmployee/HRD');
    });
    Route::prefix('Employee-HR_Manager')->group(function () {
        Route::get('rusun-HRD', 'HRD_ApprovalController@indexRusunHRD')->name('rusun-HRD');
        Route::get('getrusun-HRD', 'HRD_ApprovalController@getRusunHRD')->name('getrusun-HRD');
        Route::get('edit-rusun/{id}/HRD', 'HRD_ApprovalController@editRusunRusun')->name('edit-rusun/HRD');
        Route::post('post-rusun/{id}/HRD', 'HRD_ApprovalController@postRusunHRD')->name('post-rusun/HRD');
    });
});

Route::prefix('Leave')->group(function () {
    Route::prefix('Transaction')->group(function () {
        Route::get('indexAllEmployee', 'HRD_ApprovalController@indexLeaveAllEmploye')->name('indexAllEmployee');
        Route::get('getAllEmployee', 'HRD_ApprovalController@getLeaveAllEmployee')->name('getAllEmployee');
    });
});


//-0----------------------------------------------------------------------
//	Start Route General Manager Approval
Route::get('leave/GM_approval', 'GM_ApprovalController@indexLeaveApproval')->name('leave/GM_approval');
Route::get('leave/getindexGM_Approval', 'GM_ApprovalController@getIndexLeaveApproval')->name('leave/getindexGM_Approval');
Route::get('leave/getIndexMikeApproval', 'GM_ApprovalController@getIndexMikeApproval')->name('leave/getIndexMikeApproval');
Route::get('ap_gm/{id}/detail', 'GM_ApprovalController@detailLeave')->name('ap_gm/detail');
Route::get('ap_gm/{id}/approve', 'GM_ApprovalController@approveLeave')->name('ap_gm/approve');
Route::get('ap_gm/{id}/disapprove', 'GM_ApprovalController@disapproveLeave')->name('ap_gm/disapprove');
//	Start Route HR verification
Route::get('leave/HR_ver', 'HRController@indexLeaveApproval')->name('leave/HR_ver');
Route::get('leave/getIndexLeaveHR_Ver', 'HRController@getIndexLeaveHR_Ver')->name('leave/getIndexLeaveHR_Ver');
Route::get('ver_hr/{id}/detail', 'HRController@detailLeaveHR')->name('ver_hr/detail');
//Route::get('ver_hr/{id}/detail2', 'HRController@detailLeaveHR2')->name('ver_hr/detail2');
Route::get('ver_hr/{id}/ver', 'HRController@verLeave')->name('ver_hr/ver');
Route::get('ver_hr/{id}/unver', 'HRController@unVerLeave')->name('ver_hr/unver');
//  End Route Leave

//  Start Route Email
Route::get('email/index', 'EmailController@indexEmail')->name('email/index');
Route::get('email/send', 'EmailController@sendEmail')->name('email/send');
Route::get('email/sendGM', 'EmailController@sendEmailGM')->name('email/sendGM');
//  End Route Email

//  Start Route Annual Post 12 (tahunan)
Route::get('annual/index', 'AnnualController@indexAnnual')->name('annual/index');
Route::get('annual_post/action', 'AnnualController@action')->name('annual_post/action');
//  End Route Annual Post

// Start Route USER
//
// End Route USER


// start organitation
Route::get('structute-organitation', 'LeaveController@indexOrganitation')->name('structute-organitation');
//end organitation


//start Koordinator
Route::get('Koordinator/indexApproval', 'KoorController@indexKoorApproval')->name('Koordinator/indexApproval');
Route::get('Koordinator/getindexKoor_Approval', 'KoorController@getindexKoor_Approval')->name('Koordinator/getindexKoor_Approval');
Route::get('ap_koor/{id}/detail', 'KoorController@detailLeave')->name('ap_koor/detail');
Route::get('ap_koor/{id}/approve', 'KoorController@approveLeave')->name('ap_koor/approve');
Route::get('ap_koor/{id}/disapprove', 'KoorController@disapproveLeave')->name('ap_koor/disapprove');
Route::get('Koordinator/Histori', 'KoorController@indexHistoriKoor')->name('Koordinator/Histori');
Route::get('Koordinator/getHistori', 'KoorController@getHistoriKoor')->name('Koordinator/getHistori');
Route::get('ap_koor/tambah', 'KoorController@tambah')->name('ap_koor/tambah');

Route::get('Koordinator/Summary/Approved', 'KoorController@indexSummaryApprovedCoordinator')->name('indexSummaryApprovedCoordinator');
Route::get('Koordinator/Summary/Approved/data', 'KoorController@getDataSummaryApprovedCoordinator')->name('getDataSummaryApprovedCoordinator');


//Coordinator IT
Route::get('Coordinator/index-IT', 'KoorController@getIndexKoorIT')->name('Koordinator/leaveIT');
Route::get('ap_koor/{id}/detail/IT', 'KoorController@detailLeaveIT')->name('ap_koor/detail/it');

//start SPV
Route::get('Supervisor/indexApproval', 'SPVController@indexSPVApproval')->name('Supervisor/indexApproval');

Route::get('Supervisor/getindexSPV_Approval', 'SPVController@getindexSPV_Approval')->name('Supervisor/getindexSPV_Approval');
Route::get('Supervisor/getindexSPV_Approval2', 'SPVController@getindexSPV_Approval2')->name('Supervisor/getindexSPV_Approval2');
Route::get('Supervisor/getindexSPV_Approval3', 'SPVController@getindexSPV_Approval3')->name('Supervisor/getindexSPV_Approval3');

Route::get('ap_spv/{id}/detail', 'SPVController@detailLeave')->name('ap_spv/detail');
Route::get('ap_spv/{id}/detail2', 'SPVController@detailLeave2')->name('ap_spv/detail2');
Route::get('ap_spv/{id}/detail3', 'SPVController@detailLeave3')->name('ap_spv/detail3');

Route::get('ap_spv/{id}/approve', 'SPVController@approveLeave')->name('ap_spv/approve');
Route::get('ap_spv/{id}/disapprove', 'SPVController@disapproveLeave')->name('ap_spv/disapprove');
Route::get('Supervisor/Histori', 'SPVController@indexHistoriSPV')->name('Supervisor/Histori');
Route::get('Supervisor/getHistori', 'SPVController@getHistoriSPV')->name('Supervisor/getHistori');

Route::get('Supervisor/Summary/Approved', 'SPVController@indexSummaryApprovedSPV')->name('indexSummaryApprovedSPV');
Route::get('Supervisor/Summary/Approved/data', 'SPVController@getDataSummaryApprovedSPV')->name('getDataSummaryApprovedSPV');

//start PM
Route::get('ProjectManager/indexApproval', 'PMController@indexPMApproval')->name('ProjectManager/indexApproval');
Route::get('ProjectManager/getindexPMApproval', 'PMController@getindexPMApproval')->name('ProjectManager/getindexPMApproval');
Route::get('ProjectManager/getindexPMApproval2', 'PMController@getindexPMApproval2')->name('ProjectManager/getindexPMApproval2');
Route::get('ap_pm/{id}/detail', 'PMController@detailLeave')->name('ap_pm/detail');
Route::get('ap_pm/{id}/detail2', 'PMController@detailLeave2')->name('ap_pm/detail2');
Route::get('ap_pm/{id}/approve', 'PMController@approveLeave')->name('ap_pm/approve');
Route::get('ap_pm/{id}/disapprove', 'PMController@disapproveLeave')->name('ap_pm/disapprove');

Route::get('ProjectManager/Summary/Approved', 'PMController@indexSummaryApprovedPM')->name('indexSummaryApprovedPM');
Route::get('ProjectManager/Summary/Approved/data', 'PMController@getDataSummaryApprovedPM')->name('getDataSummaryApprovedPM');

//meeting
Route::get('meeting', 'LeaveController@meeting')->name('meeting');
Route::post('meeting-post', 'LeaveController@storemeeting')->name('meeting-post');
Route::get('meeting/audit', 'LeaveController@indexMeetingAudit')->name('meeting/audit');

route::get('getINdexMeetingAudit', 'LeaveController@getINdexMeetingAudit')->name('getINdexMeetingAudit');

//start Producer
Route::get('Producer/indexApproval', 'ProducerController@indexApproval')->name('Producer/indexApproval');
Route::get('Producer/getindexProducer_Approval', 'ProducerController@getindexProdocerApproval')->name('Producer/getindexProducer_Approval');
Route::get('ap_producer/{id}/detail', 'ProducerController@detailLeave')->name('ap_producer/detail');
Route::get('ap_producer/{id}/approve', 'ProducerController@approveLeave')->name('ap_producer/approve');
Route::get('ap_producer/{id}/disapprove', 'ProducerController@disapproveLeave')->name('ap_producer/disapprove');
Route::get('detailMeeting/{id}', 'LeaveController@detailMeeting')->name('detailMeeting');
route::post('postDetailMeeting/{id}', 'LeaveController@postDetailMeeting')->name('postDetailMeeting');

Route::get('producer/weekends-crew', 'Producer_WeekendCrew_controller@index')->name('producer/weekend-crew/index');
Route::get('producer/weekends-crew/data', 'Producer_WeekendCrew_controller@datatables')->name('producer/weekend-crew/index/data');
Route::get('producer/weekends-crew/detail/{id}', 'Producer_WeekendCrew_controller@detail')->name('producer/weekend-crew/detail');
Route::get('producer/weekends-crew/approved/{id}', 'Producer_WeekendCrew_controller@approved')->name('producer/weekend-crew/approved');
Route::get('producer/weekends-crew/disapproved/{id}', 'Producer_WeekendCrew_controller@disapproved')->name('producer/weekend-crew/disapproved');
Route::get('producer/weekends-crew/summary', 'Producer_WeekendCrew_controller@summary')->name('producer/weekend-crew/summary');
Route::get('producer/weekends-crew/summary/data', 'Producer_WeekendCrew_controller@dataSummary')->name('producer/weekend-crew/summary/data');
//end Producer

Route::prefix('leave')->group(function () {
    Route::get('deleted/{id}', 'LeaveController2@deleteFormLeaveOfficer')->name('leave/delete/form/Officer');
});

/////////////////////////////////////////////////////////////////////////////////////
// HRD Level Access / HR Department
Route::prefix('HRD')->group(function () {
    // Rusun
    Route::prefix('Rusun')->group(function () {
        Route::get('rusun', 'HRDLevelAccess@indexRusun')->name('rusun');
        Route::get('getrusun', 'HRDLevelAccess@getRusun')->name('get');
        Route::get('edit/{id}', 'HRDLevelAccess@editRusun')->name('edit');
        Route::post('post/{id}', 'HRDLevelAccess@postRusun')->name('post');
    });
    // Management Staff
    Route::prefix('Management')->group(function () {
        Route::get('employee', 'HRDLevelAccess@indexStaff')->name('employee');
        Route::get('getemployee', 'HRDLevelAccess@getStaff')->name('getEmployee');
        Route::get('addemployee', 'HRDLevelAccess@addStaff')->name('addEmployee');
        Route::post('saveemployee', 'HRDLevelAccess@saveStaff')->name('saveEmployee');
        Route::get('editemployee/{id}', 'HRDLevelAccess@editStaff')->name('editEmployee');
        Route::post('updateemployee/{id}', 'HRDLevelAccess@updateStaff')->name('updateEmployee');
        Route::post('upload', 'HRDLevelAccess@importExcel')->name('upload');
        Route::post('upload-update', 'HRDLevelAccess@importExcelUpdate')->name('upload-update');
        route::get('detail/{id}/Employee', 'HRDLevelAccess@detailEmployee')->name('detail/Employee');
        ///////////////////////////////////////
        Route::get('contract-employee', 'HRDLevelAccess@indexContract')->name('contract-employee');
        Route::get('getContract', 'HRDLevelAccess@getindexContract')->name('getContract');
        Route::get('editcontract/{id}/employee', 'HRDLevelAccess@editContract')->name('editContract/Employee');
        Route::post('storeContract/{id}/employee', 'HRDLevelAccess@storeContract')->name('storeContract/Employee');
        ///////////////////////////////////////
        Route::get('Upload/Employee', 'HRDLevelAccess@ExcelDataStaffIndex')->name('Upload/Employee');
        Route::post('Upload/Address', 'HRDLevelAccess@importExcelUpdateAlamat')->name('Address');
        Route::get('Get-Form-Date', 'HRDLevelAccess@UploadedGetDate')->name('getget');

        Route::get('Get-Form-Address-DKK', 'HRDLevelAccess@UploadedGetDate2')->name('getget2');
        Route::get('Get-Form-New-Employes', 'HRDLevelAccess@UploadedFormInserEmployes')->name('form/insser/data/NewEmploye');


        //Ex Employes
        Route::get('ex-employes', 'HRExEmployesController@index')->name('hr/ex-employes/index');
        Route::get('ex-employes/data', 'HRExEmployesController@objetDataIndex')->name('hr/ex-employes/data');
        Route::get('ex-employes/data/{id}', 'HRExEmployesController@modalDataIndex')->name('hr/ex-employes/data/modal');

        //Rusun Management HRD
        Route::get('dormitory', 'HRDormitoryController@index')->name('hr/management/dorm/index');
        Route::get('dormitory/data', 'HRDormitoryController@dataindex')->name('hr/management/dorm/data');
        Route::get('dormitory/{id}', 'HRDormitoryController@modalEdit')->name('hr/management/dorm/edit');
        Route::post('dormitory/update{id}', 'HRDormitoryController@updateDorm')->name('hr/management/dorm/update');
        Route::post('dormitory/add', 'HRDormitoryController@addDormitories')->name('hr/management/dorm/add');
        Route::get('dormitory/delete/{id}', 'HRDormitoryController@modalDeleteDormitories')->name('hr/management/dorm/delete');
        Route::post('dormitory/update/delete/{id}', 'HRDormitoryController@deleteDormitories')->name('hr/management/dorm/update/delete');
    });
    /////////////////////////////////////////////////////////////////////////////////////
    // Summary Attendance HR
    Route::prefix('Summary')->group(function () {
        Route::get('attendances', 'HR_Attendance_Controller@index')->name('hr/summary/attendance/index');
        Route::get('attendances/data', 'HR_Attendance_Controller@datatables')->name('hr/summary/attendance/datatables');
        Route::get('attendances/edit/{id}', 'HR_Attendance_Controller@edit')->name('hr/summary/attendance/edit');
        Route::post('attendances/update/{id}', 'HR_Attendance_Controller@update')->name('hr/summary/attendance/update');
        Route::get('attendances/delete/{id}', 'HR_Attendance_Controller@delete')->name('hr/summary/attendance/delete');
        Route::post('attendances/delete/{id}', 'HR_Attendance_Controller@removed')->name('hr/summary/attendance/removed');
        Route::post('attendances/insert', 'HR_Attendance_Controller@insert')->name('hr/summary/attendance/insert');

        Route::get('attendances/reset/{id}', 'HR_Attendance_Controller@reset')->name('hr/summary/attendance/reset');

        Route::post('attendances/employes', 'HR_Attendance_Controller@convertEmp')->name('hr/summary/attendance/summary/employes/convert');
        Route::get('attendances/employes/{selectEmp}/{empDateStarted}/{empDateEnded}', 'HR_Attendance_Controller@summaryEmp')->name('hr/summary/attendance/summary/employes');
        Route::get('attendances/employes/data/{selectEmp}/{empDateStarted}/{empDateEnded}', 'HR_Attendance_Controller@dataSummaryEmp')->name('hr/summary/attendance/summary/employes/data');
        Route::get('attendances/employes/edit/{id}/{selectEmp}/{empDateStarted}/{empDateEnded}', 'HR_Attendance_Controller@SummaryEmpEdit')->name('hr/summary/attendance/summary/employes/edit');
        Route::post('attendances/employes/push/{id}', 'HR_Attendance_Controller@SummaryEmpUpdate')->name('hr/summary/attendance/summary/employes/update');
        Route::get('attendances/employes/delete/{id}/{selectEmp}/{empDateStarted}/{empDateEnded}', 'HR_Attendance_Controller@DeleteEmp')->name('hr/summary/attendance/summary/employes/delete');
        Route::post('attendances/employes/delete/post/{id}', 'HR_Attendance_Controller@removeEmp')->name('hr/summary/attendance/summary/employes/delete/post');



        Route::prefix('Attendance')->group(function () {
            Route::get('index', 'HR2Controller@indexAttendace')->name('indexHrAttendace');
            Route::get('index/data', 'HR2Controller@dataAttendace')->name('indexDataAttendance');
            Route::get('edit/{id}', 'HR2Controller@editAttendance')->name('editAttendance');
            Route::post('update/{id}', 'HR2Controller@updateAttendace')->name('updateAttendace');
            Route::get('delete/{id}', 'HR2Controller@deleteAttendance')->name('deleteAttendance');
            Route::get('chart', 'HR2Controller@indexChart')->name('indexChartAttendance');
            Route::get('index/Day', 'HR2Controller@indexPerDayAttendance')->name('indexPerDayAttendance');
            Route::get('getListtAttendance', 'HR2Controller@getListtAttendance')->name('getListtAttendance');
            Route::get('getListtAttendance/{id}', 'HR2Controller@editGetListDataAttendance')->name('editGetListDataAttendance');
            Route::get('getListtAttendance/{id}/modal', 'HR2Controller@modalDeletegetListtAttendance')->name('editGetListDataAttendance/modalDelete');
            Route::post('getListtAttendance/{id}/modal/post', 'HR2Controller@updateDeleteAbove')->name('editGetListDataAttendance/modalDelete/post');
            Route::post('getListtAttendance/{id}', 'HR2Controller@updateGetListDataAttendance')->name('updateGetListDataAttendance');
            Route::get('downloadAttendance/{startDate}/{endDate}/{id}', 'HR2Controller@downloadExcelListAttendance')->name('downloadExcelListAttendance');
            Route::get('getDataAttendanceDepartment', 'HR2Controller@getDataAttendanceDepartment')->name('getDataAttendanceDepartment');
            Route::get('downloadAllAttendance/{start_date}/{department}', 'HR2Controller@downloadExcelListAllAttendance')->name('downloadExcelListAllAttendance');
            Route::get('detailAttendance/index/{id}', 'HR2Controller@detailIndexAttendance')->name('detailIndexAttendance');
            // Create
            Route::get('create', 'HR2Controller@createAttendanceHR')->name('createAttendanceHR');
            Route::post('create/post', 'HR2Controller@postCreatedAttendanceHR')->name('postCreatedAttendanceHR');

            // TOday Attendance
            Route::get('attendance/today', 'HRAttendanceController@indexTodayAttendance')->name('attendance/today/index');
            Route::get('attendance/today/data', 'HRAttendanceController@dataTodayAttendance')->name('attendance/today/data');

            //Search By Date Summary Attendance HR
            Route::get('searchBydate', 'HRAttendanceSearchByDate@searchByDate')->name('hr/attendance/search/date/index');
            Route::get('searchBydate/{start}/{end}', 'HRAttendanceSearchByDate@dataObject')->name('hr/attendance/search/date/index/data');
        });
        Route::get('verified', 'HR2Controller@indexSummaryVerified')->name('indexSummaryVerified');
        Route::get('verified/data', 'HR2Controller@getDataSummaryVerified')->name('getDataSummaryVerified');
        Route::get('verified/Summary', 'HR2Controller@getDataHistorical')->name('getDataHistoricalVerified');
        Route::post('verified/excel/{started}/{ended}', 'HR2Controller@getDataExcelHistorical')->name('getDataExcelHistorical');

        Route::prefix('leave')->group(function () {
            Route::get('list', 'HRLeaveSummaryController@indexSummaryLeave')->name('hrd/summary/leave/index');
            Route::get('list/data', 'HRLeaveSummaryController@dataSummaryLeave')->name('hrd/summary/leave/index/data');
            Route::get('data/view-{id}', 'HRLeaveSummaryController@viewSummaryLeave')->name('hrd/summary/leave/index/view');
            Route::get('data/view/detail', 'HRLeaveSummaryController@detailLeaveSummary')->name('hrd/summary/leave/index/view/detail');
            Route::get('edit/{id}', 'HRLeaveSummaryController@editSummaryOfLeave')->name('hrd/summary/leave/edit');
            Route::post('update/{id}', 'HRLeaveSummaryController@updateDataSummaryLeave')->name('hrd/summary/leave/update');
            Route::get('destory/{id}', 'HRLeaveSummaryController@destroyDataSummaryLeave')->name('hrd/summary/leave/destroy');
            Route::post('destory/push/{id}', 'HRLeaveSummaryController@putDestroyDataSummaryLeave')->name('hrd/summary/leave/destroy/push');
            Route::get('details/all/{dateFrom}/{dateToo}/{category}/{hometown}/{townn}', 'HRLeaveSummaryController@detailAllSummaryLeaeve')->name('hrd/summary/leave/index/view/detail/all');
            Route::get('detail/all/excel/{dateFrom}/{dateToo}/{category}/{hometown}/{townn}', 'HRLeaveSummaryController@excelDetailAllSummaryLeave')->name('hrd/summary/leave/index/view/detail/all/excel');
            Route::get('details/{dateFrom}/{dateToo}/{category}/{hometown}/{townn}', 'HRLeaveSummaryController@detailSummaryLeaeve')->name('hrd/summary/leave/index/view/detail/category');
            Route::get('details/excel/{dateFrom}/{dateToo}/{category}/{hometown}/{townn}', 'HRLeaveSummaryController@excelDetailSummaryLeave')->name('hrd/summary/leave/index/view/detail/category/excel');
            Route::get('detail/employee', 'HRLeaveSummaryController@indexSummaryEmpoyeByEmploye')->name('detail/employee/summary/hr');
            Route::post('download/employee/excel', 'HRLeaveSummaryController@downloadDetailSummaryExdo')->name('hr/summary/leave/download/excel/employee');

            // chart leave summary

            Route::get('chart-of-summary', 'HRLeaveSummaryChartController@index')->name('hr/summary/leave/chart/index');
            Route::get('chart-of-summary/data', 'HRLeaveSummaryChartController@dataObjectIndex')->name('hr/summary/leave/chart/index/data');
            Route::post('chart-of-summary/excel', 'HRLeaveSummaryChartController@excel')->name('hr/summary/leave/chart/excel/data');

            Route::prefix('reschedule')->group(function () {
                route::get('index', 'HRLeaveRescheduleControoler@index')->name('leave/reschedule/index');
                route::get('index/data', 'HRLeaveRescheduleControoler@dataIndex')->name('leave/reschedule/index/data');
                route::get('edit/{id}', 'HRLeaveRescheduleControoler@editReschedule')->name('leave/reschedule/edit');
                route::post('update/{id}', 'HRLeaveRescheduleControoler@updateRescheduleAnnual')->name('leave/reschedule/update');
                route::get('view/{id}', 'HRLeaveRescheduleControoler@viewReschedule')->name('leave/reschedule/view');
                route::get('approved/{id}', 'HRLeaveRescheduleControoler@aprrovedButton')->name('leave/reschedule/approved');
                route::post('approved//post/{id}', 'HRLeaveRescheduleControoler@pushApprovedButton')->name('leave/reschedule/approved/post');
                route::get('disapproved/{id}', 'HRLeaveRescheduleControoler@disapproveButton')->name('leave/reschedule/disapproved');
                route::post('disapproved//post/{id}', 'HRLeaveRescheduleControoler@pushDisapprovedButton')->name('leave/reschedule/disapproved/post');
            });
        });

        //HR department - entitlement exdo
        Route::get('entitlement/exdo/{id}', 'HREntitlementExdoLeaveController@index')->name('hr/entitlement/exdo/index');
        Route::get('entitlement/exdo/data/{id}', 'HREntitlementExdoLeaveController@dataIndex')->name('hr/entitlement/exdo/data');
        Route::get('entitlement/exdo/edit/{id}', 'HREntitlementExdoLeaveController@edit')->name('hr/entitlement/exdo/edit');
        Route::post('entitlement/exdo/update/{id}', 'HREntitlementExdoLeaveController@update')->name('hr/entitlement/exdo/update');
    });

    ////////////////////////////////////////
    route::get('privilege', 'HRDLevelAccess@privilege')->name('privilege');
    route::get('getprivilege', 'HRDLevelAccess@getIndexPrivellage')->name('getprivilege');
    route::get('Editprivellage/{id}', 'HRDLevelAccess@Editprivellage')->name('Editprivellage');
    route::post('postEditprivellage/{id}', 'HRDLevelAccess@postEditprivellage')->name('postEditprivellage');
    /////////////////////////////////////////
    route::get('project', 'HRDLevelAccess@projectHRD')->name('projectHRD');
    route::get('getprojectHRD', 'HRDLevelAccess@getprojectHRD')->name('getprojectHRD');
    route::get('EditprojectHRD/{id}', 'HRDLevelAccess@EditprojectHRD')->name('EditprojectHRD');
    route::post('postEditprojectHRD/{id}', 'HRDLevelAccess@postEditprojectHRD')->name('postEditprojectHRD');
    route::get('Add-project', 'HRDLevelAccess@AddNewPrivilege')->name('Addproject12');
    route::post('postNewPrivilege', 'HRDLevelAccess@postNewPrivilege')->name('postNewPrivilege');

    route::get('exportproject', 'HRDLevelAccess@exportProject')->name('exportProject');
    /////////////////////////////////////////////////
    route::get('indexAllSummary', 'HRDLevelAccess@indexAllSummary')->name('indexAllSummary');

    route::get('indexEndEmployee', 'HRDLevelAccess@indexEndEmployee')->name('indexEndEmployee');
    route::get('getEndEmployee', 'HRDLevelAccess@getEndEmployee')->name('getEndEmployee');

    route::prefix('Detail')->group(function () {
        route::get('detailTotalEmployee', 'HRDLevelAccess@detailTotalEmployee')->name('detailTotalEmployee');
        route::get('getdetailTotalEmployee', 'HRDLevelAccess@getdetailTotalEmployee')->name('getdetailTotalEmployee');
        route::get('detailTotalPermanent', 'HRDLevelAccess@detailTotalPermanent')->name('detailTotalPermanent');
        route::get('getdetailTotalPermanent', 'HRDLevelAccess@getdetailTotalPermanent')->name('getdetailTotalPermanent');
        route::get('detailTotalContract', 'HRDLevelAccess@detailTotalContract')->name('detailTotalContract');
        route::get('getdetailTotalContract', 'HRDLevelAccess@getdetailTotalContract')->name('getdetailTotalContract');
        route::get('detailTotalPKL', 'HRDLevelAccess@detailTotalPKL')->name('detailTotalPKL');
        route::get('getdetailTotalPKL', 'HRDLevelAccess@getdetailTotalPKL')->name('getdetailTotalPKL');
        route::get('detailTotalOutsource', 'HRDLevelAccess@detailTotalOutsource')->name('detailTotalOutsource');
        route::get('getdetailTotalOutsource', 'HRDLevelAccess@getdetailTotalOutsource')->name('getdetailTotalOutsource');
    });
    /*Payroll*/
    Route::prefix('Payroll')->group(function () {
        Route::get('indexUnpaidLeave', 'PayrollController@indexUnpaidLeave')->name('indexUnpaidLeave');
        Route::get('getUnpaidLeave', 'PayrollController@getUnpaidLeave')->name('getUnpaidLeave');
    });
    Route::prefix('index-days-off')->group(function () {
        Route::get('index', 'HRDLevelAccess@indexViewOffYears')->name('indexViewOffYears');
        Route::get('index/data', 'HRDLevelAccess@getDataViewOffYears')->name('getDataViewOffYears');
        Route::get('add-ViewOffYear', 'HRDLevelAccess@addViewOffYears')->name('addViewOffYears');
        Route::post('post-ViewOffYear', 'HRDLevelAccess@storeAddViewOffYears')->name('storeAddViewOffYears');
        Route::get('delete-ViewOffYear/{id}', 'HRDLevelAccess@deleteViewOffYears')->name('deleteViewOffYears');
    });

    Route::prefix('entitled')->group(function () {
        Route::get('list', 'HRLeaveEntitled@index')->name('hr/entitled/index');
        Route::get('list/data', 'HRLeaveEntitled@dataObject')->name('hr/entitled/index/data');
    });

    Route::get('weekend-crew', 'HR_Weekend_Crew_controller@indexSummary')->name('hrd/weekend-crew/index');
    Route::get('weekend-crew/data', 'HR_Weekend_Crew_controller@dataTabalesSummary')->name('hrd/weekend-crew/summary/data');
    Route::get('weekend-crew/data/{id}', 'HR_Weekend_Crew_controller@showDataSummary')->name('hrd/weekend-crew/summary/data/show');
    Route::get('weekend-crew/data/exdo/{id}', 'HR_Weekend_Crew_controller@showDataSummary2')->name('hrd/weekend-crew/summary/data/exdo/show');
    Route::get('weekend-crew/delete/{id}', 'HR_Weekend_Crew_controller@delete')->name('hrd/weekend-crew/summary/delete');
    Route::get('weekend-crew/delete/push/{id}', 'HR_Weekend_Crew_controller@pushDelete')->name('hrd/weekend-crew/summary/delete/push');

    Route::get('weekend-crew/approved/complate', 'HR_Weekend_Crew_controller@dataTabalesSummaryApproved')->name('hrd/weekend-crew/summary/data/complate');


    Route::get('weekend-crew/history', 'HR_Weekend_Crew_controller@historical')->name('hrd/weekend-crew/history/index');
    Route::get('weekend-crew/history/data', 'HR_Weekend_Crew_controller@dataHistorical')->name('hrd/weekend-crew/history/data');
    Route::post('weekend-crew/history/detail/date', 'HR_Weekend_Crew_controller@findDate')->name('hrd/weekend-crew/history/detail');
    Route::post('weekend-crew/history/detail/date/data', 'HR_Weekend_Crew_controller@datatablesFindDate')->name('hrd/weekend-crew/history/detail/data');
    Route::post('weekend-crew/history/detail/emp', 'HR_Weekend_Crew_controller@findEmployee')->name('hrd/weekend-crew/history/detail/emp');
    Route::post('weekend-crew/history/detail/emp/data', 'HR_Weekend_Crew_controller@datatablesFindEmployee')->name('hrd/weekend-crew/history/detail/emp/data');

    // baliak kamari
});
//// frontdesk
Route::prefix('frontdesk')->group(function () {

    Route::prefix('stationery')->group(function () {
        Route::get('atk', 'FrontdeskStationeryController@indexAtk')->name('stationery/atk/index');
        Route::get('atk/stocked', 'FrontdeskStationeryController@addStock')->name('stationery/atk/stocked/add');
        Route::post('atk/stocked', 'FrontdeskStationeryController@storeStock')->name('stationery/atk/stocked/store');
        Route::get('atk/purchase/{id}', 'FrontdeskStationeryController@inStocked')->name('stationery/atk/purchase/add');
        Route::post('atk/purchase/{id}/store', 'FrontdeskStationeryController@storeInStocked')->name('stationery/atk/purchase/store');
        Route::get('atk/out-item/{id}', 'FrontdeskStationeryController@outStocked')->name('stationery/atk/out/add');
        Route::post('atk/out-item/{id}/store', 'FrontdeskStationeryController@storeOutStocked')->name('stationery/atk/out/store');
        Route::get('atk/edit/{id}', 'FrontdeskStationeryController@editATK')->name('stationery/atk/edit');
        Route::post('atk/update/{id}', 'FrontdeskStationeryController@updateATK')->name('stationery/atk/update');

        Route::get('atk/modal/{code}/{date}', 'FrontdeskStationeryController@modalViewData')->name('stationery/atk/modal');
        Route::get('atk/transaction/edit/{id}', 'FrontdeskStationeryController@editTransaction')->name('stationery/atk/transaction/edit');
        Route::post('atk/transaction/update/{id}', 'FrontdeskStationeryController@updateTransaction')->name('stationery/atk/transaction/update');
        Route::get('atk/transaction/delete', 'FrontdeskStationeryController@deleteTransaction')->name('stationery/atk/transaction/delete');
        Route::get('atk/pdf/{id}/{month}', 'FrontdeskStationeryController@PDF')->name('stationery/atk/pdf');
        Route::get('atk/excel/{id}/{month}', 'FrontdeskStationeryController@Excel')->name('stationery/atk/excel');

        Route::get('atk/category/{id}/{month}', 'FrontdeskStationeryController@modalCategory')->name('stationery/atk/category/edit');
        Route::post('atk/category/update/{id}', 'FrontdeskStationeryController@updateCategory')->name('stationery/atk/category/update');

        // Detail Transaction 
        Route::get('atk/transactions/{code}/{month}', 'FrontdeskStationeryController@indexViewDetailTransaction')->name('stationery/atk/transactions/index');
        Route::get('atk/transactions/data/{code}/{month}', 'FrontdeskStationeryController@dataViewDetailTransaction')->name('stationery/atk/transactions/index/data');


        Route::get('month/{month}', 'FrontdeskStationeryMonthController@index')->name('stationery/atk/month/index');

        Route::get('month/{id}/{month}', 'FrontdeskStationeryMonthController@inStocked')->name('stationery/atk/month/purchase/add');
        Route::post('month/{id}/{month}/post', 'FrontdeskStationeryMonthController@storeInStocked')->name('stationery/atk/month/purchase/store');

        Route::get('month/out/{id}/{month}', 'FrontdeskStationeryMonthController@outStocked')->name('stationery/atk/month/out/index');
        Route::post('month/out/{id}/{month}/post', 'FrontdeskStationeryMonthController@storeOutStocked')->name('stationery/atk/month/out/store');

        // jalankan excel dan pdf nya

        // jalankan mineral water 
        Route::get('mineral', 'FrontdeskMineralController@index')->name('stationery/mineral/index');
        Route::get('mineral/add', 'FrontdeskMineralController@addStock')->name('stationery/mineral/add');
        Route::post('mineral/store', 'FrontdeskMineralController@storeStock')->name('stationery/mineral/store');
        Route::get('mineral/pruchase/{id}', 'FrontdeskMineralController@inStocked')->name('stationery/mineral/purcahse/add');
        Route::post('mineral/pruchase/{id}/store', 'FrontdeskMineralController@storeInStocked')->name('stationery/mineral/purcahse/store');
        Route::get('mineral/out/{id}', 'FrontdeskMineralController@outStocked')->name('stationery/mineral/out/add');
        Route::post('mineral/out/{id}/store', 'FrontdeskMineralController@storeOutStocked')->name('stationery/mineral/out/store');
        Route::get('mineral/edit/{id}', 'FrontdeskMineralController@editMineral')->name('stationery/mineral/edit');
        Route::post('mineral/update/{id}', 'FrontdeskMineralController@updateMineral')->name('stationery/mineral/update');
        Route::get('mineral/modal/{code}/{date}', 'FrontdeskMineralController@modalViewData')->name('stationery/mineral/modal');
        Route::get('mineral/transaction/edit/{id}', 'FrontdeskMineralController@editTransaction')->name('stationery/mineral/transaction/edit');
        Route::post('mineral/transaction/update/{id}', 'FrontdeskMineralController@updateTransaction')->name('stationery/mineral/transaction/update');
        Route::get('mineral/transaction/delete/{id}', 'FrontdeskMineralController@deleteTransaction')->name('stationery/mineral/transaction/delete');
        Route::get('mineral/pdf/{month}', 'FrontdeskMineralController@PDF')->name('stationery/mineral/pdf');
        Route::get('mineral/excel/{month}', 'FrontdeskMineralController@Excel')->name('stationery/mineral/excel');

        Route::get('mineral/find/{month}', 'FrontdeskMineralMonthController@index')->name('stationery/mineral/find/index');
        Route::get('mineral/find/add/{month}', 'FrontdeskMineralMonthController@addStock')->name('stationery/mineral/find/add');
        Route::post('mineral/find/post/{month}', 'FrontdeskMineralMonthController@storeStock')->name('stationery/mineral/find/post');
        Route::get('mineral/find/in/{id}/{month}', 'FrontdeskMineralMonthController@inStocked')->name('stationery/mineral/find/in');
        Route::post('mineral/find/in/post/{id}/{month}', 'FrontdeskMineralMonthController@storeInStocked')->name('stationery/mineral/find/post');
        Route::get('mineral/find/out/{id}/{month}', 'FrontdeskMineralMonthController@outStocked')->name('stationery/mineral/find/out');
        Route::post('mineral/find/out/post/{id}/{month}', 'FrontdeskMineralMonthController@storeOutStocked')->name('stationery/mineral/find/out/post');

        // iko nyo
        // Route::get('mineral/history/search/form', 'FrontdeskMineralHistoricalController@formSearch')->name('stationery/mineral/history/search');
        Route::get('mineral/history/{year}/{month}', 'FrontdeskMineralHistoricalController@index')->name('stationery/mineral/history/index');

        // lanjut 
        Route::get('mineral/tracking/{id}', 'FrontdeskMineralTrackingController@index')->name('statinery/mineral/tracking/index');
        Route::get('mineral/tracking/data/{id}', 'FrontdeskMineralTrackingController@objectIndex')->name('statinery/mineral/tracking/index/data');

        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        Route::prefix('Category')->group(function () {
            Route::get('index', 'FrontdeskController@indexKategoryStationary')->name('indexKategoryStationary');
            Route::get('index/data', 'FrontdeskController@dataIndexCategory')->name('dataKategoryStationary');
            Route::get('add', 'FrontdeskController@addKategoryStationary')->name('addKategoryStationary');
            Route::post('post-data', 'FrontdeskController@storeKategoryStationary')->name('storeKategoryStationary');
            Route::get('edit/{id}', 'FrontdeskController@editKategoryStationary')->name('editKategoryStationary');
            Route::post('save-data/{id}', 'FrontdeskController@SaveKategoryStationary')->name('SaveKategoryStationary');
            Route::get('GeneratePDFNameKategori/{id}', 'FrontdeskController@GeneratePDFNameKategori')->name('GeneratePDFNameKategori');
        });

        Route::get('summary/index', 'HRsummaryStationnaryController@index')->name('stationery/summary/stock/index');
        Route::get('summary/index/data', 'HRsummaryStationnaryController@dataIndex')->name('stationery/summary/stock/index/data');
    });

    // Route::prefix('Stock')->group(function () {
    //     Route::get('stationary/ATK', 'FrontdeskController@indexstokstoonery')->name('Statoonery/index');
    //     // Route::get('stationary/getstokstoonery', 'FrontdeskController@getstokstoonery')->name('getstokstoonery');
    //     Route::get('stationary/{id}/outStockStationary', 'FrontdeskController@outStockStationary')->name('Statoonery/outStockStationary');
    //     Route::get('stationary/{id}/outStock', 'FrontdeskController@indexOutStock')->name('Statoonery/indexOutStock');
    //     Route::post('stationary/{id}/storeOutStock', 'FrontdeskController@storeOutStock')->name('Statoonery/storeOutStock');
    //     Route::get('stationary/{id}/indexInStock', 'FrontdeskController@indexInStock')->name('Statoonery/indexInStock');
    //     Route::post('stationary/{id}/storeInStock', 'FrontdeskController@storeInStock')->name('Statoonery/storeInStock');
    //     Route::get('stationary/addStockStatoonary', 'FrontdeskController@addStockStatoonary')->name('Stationary/addStockStatoonary');
    //     Route::post('stationary/storeAddStockStatoonary', 'FrontdeskController@storeAddStockStatoonary')->name('Statoonery/storeAddStockStatoonary');
    //     Route::get('GenerateStocked', 'FrontdeskController@GenerateStocked')->name('GenerateStocked');
    //     Route::get('stationary/edit/{id}', 'FrontdeskController@editStationaryName')->name('editStationaryName');
    //     Route::post('stationary/saveStationaryName/{id}', 'FrontdeskController@saveStationaryName')->name('saveStationaryName');
    //     Route::get('ExcelStationaryStock', 'FrontdeskController@ExcelStationaryStock')->name('ExcelStationaryStock');

    //     Route::get('summary/index', 'HRsummaryStationnaryController@index')->name('stationery/summary/stock/index');
    //     Route::get('summary/index/data', 'HRsummaryStationnaryController@dataIndex')->name('stationery/summary/stock/index/data');

    //     Route::prefix('Mineral')->group(function () {
    //         Route::get('water', 'FrontdeskController@indexStockStationaryWater')->name('indexStockStationaryWater');
    //         Route::get('add', 'FrontdeskController@addStockStationaryWater')->name('addStockStationaryWater');
    //         Route::post('store', 'FrontdeskController@storeAddStockStationaryWater')->name('storeAddStockStationaryWater');
    //         Route::get('out/{id}', 'FrontdeskController@indexOutStockStationaryWater')->name('indexOutStockStationaryWater');
    //         Route::post('store-out/{id}', 'FrontdeskController@storeOutStockStationaryWater')->name('storeOutStockStationaryWater');
    //         Route::get('in-water/{id}', 'FrontdeskController@indexInStockStationaryWater')->name('indexInStockStationaryWater');
    //         Route::post('store-in-water/{id}', 'FrontdeskController@storeInStockStationaryWater')->name('storeInStockStationaryWater');
    //         Route::get('edit-water/{id}', 'FrontdeskController@editStockStationaryWater')->name('editStockStationaryWater');
    //         Route::post('save-water/{id}', 'FrontdeskController@saveStockStationaryWater')->name('saveStockStationaryWater');
    //         Route::get('PDF', 'FrontdeskController@GenerateStockedWater')->name('GenerateStockedWater');
    //         Route::get('ExcelStationaryStockWater', 'FrontdeskController@ExcelStationaryStockWater')->name('ExcelStationaryStockWater');

    //         Route::get('modalMineralViewTable/{code}/{day}', 'FrontdeskController@modalMineralViewTable')->name('mineral/modalMineralViewTable');
    //         Route::get('edit/transaction/{id}', 'FrontdeskController@editTransaction')->name('mineral/transaction/edit');
    //         Route::post('update/transaction/{id}', 'FrontdeskController@updateTransaction')->name('mineral/transaction/update');
    //         Route::get('delete/transaction/{id}', 'FrontdeskController@deleteTransaction')->name('mineral/transaction/delete');
    //     });

    //     Route::prefix('Category')->group(function () {
    //         Route::get('index', 'FrontdeskController@indexKategoryStationary')->name('indexKategoryStationary');
    //         Route::get('index/data', 'FrontdeskController@dataIndexCategory')->name('dataKategoryStationary');
    //         Route::get('add', 'FrontdeskController@addKategoryStationary')->name('addKategoryStationary');
    //         Route::post('post-data', 'FrontdeskController@storeKategoryStationary')->name('storeKategoryStationary');
    //         Route::get('edit/{id}', 'FrontdeskController@editKategoryStationary')->name('editKategoryStationary');
    //         Route::post('save-data/{id}', 'FrontdeskController@SaveKategoryStationary')->name('SaveKategoryStationary');
    //         Route::get('GeneratePDFNameKategori/{id}', 'FrontdeskController@GeneratePDFNameKategori')->name('GeneratePDFNameKategori');
    //     });

    //     Route::prefix('previous')->group(function () {
    //         Route::get('stationary/{id}', 'HRFrontdeskStationaryPreviousMonthly@index')->name('previous/monthly/stationary/index');
    //     });
    // });



    Route::prefix('medical-certification')->group(function () {
        Route::get('index', 'HRmedicalController@indexSicked')->name('index/sicked');
        Route::get('index/data', 'HRmedicalController@dataSicked')->name('data/sicked');
        Route::get('add-{id}', 'HRmedicalController@addMedicalStaff')->name('sicked/add');
        Route::post('add/update', 'HRmedicalController@updateMedicalStaff')->name('sicked/update');
        Route::get('edit-{id}', 'HRmedicalController@editMedicalStaff')->name('sicked/edit');
        Route::post('edit/upload-{id}', 'HRmedicalController@uploadMedicalStaff')->name('sicked/upload');
        Route::get('delete-{id}', 'HRmedicalController@deleteMC')->name('sicked/delete');
        Route::get('detail-{id}', 'HRmedicalController@detailMC')->name('sicked/detail');

        Route::get('download-{id}', 'HRmedicalController@downloadMC')->name('sicked/download/mc');

        Route::get('summary', 'HRmedicalController@summaryMC')->name('sicked/summary');
        Route::get('summary/data', 'HRmedicalController@dataSummaryMC')->name('sicked/summary/data');
        Route::get('summary/ViewMC-{id}', 'HRmedicalController@viewImageMC')->name('sicked/summary/view');
        Route::get('summary/delete-{id}', 'HRmedicalController@deleteMedicalDisease')->name('sicked/summary/delete');
        Route::get('summary/edit/{id}', 'HRmedicalController@editSummmaryMC')->name('sicked/summary/edit');
        Route::post('summary/update/{id}', 'HRmedicalController@updateSummaryMC')->name('sicked/summary/update');

        Route::get('details/summary', 'HRmedicalController@detailDataSummaryMC')->name('details/summary/index');
        Route::get('details/summary/all/{dateFrom}/{dateToo}/{category}', 'HRmedicalController@detailAllDataSummaryMC')->name('details/summary/all');
        Route::get('details/summary/all/excel/{dateFrom}/{dateToo}/{category}', 'HRmedicalController@excelAllDataSummaryMC')->name('details/summary/all/excel');
        Route::get('details/summary/{dateFrom}/{dateToo}/{category}', 'HRmedicalController@detailCategorySummaryMC')->name('details/summary/category');
        Route::get('details/summary/excel/{dateFrom}/{dateToo}/{category}', 'HRmedicalController@getExcelSummaryExcel')->name('details/summary/excel');


        Route::get('push-sementara', 'HRmedicalController@pushSementara')->name('push/sementara');
    });
});

Route::prefix('forfeited')->group(function () {
    Route::get('index', 'HRForfeitedNew@index')->name('forfeited/index');
    Route::get('index/data', 'HRForfeitedNew@dataObjectIndex')->name('forfieted/logs/index/data');
    Route::get('detail/{id}', 'HRForfeited@viewForfeited')->name('forfeited/detail');
    Route::get('add/{id}', 'HRForfeited@addForfeited')->name('forfeited/add');
    Route::post('store/{id}', 'HRForfeited@storeForfeited')->name('forfeited/store');
    Route::get('delete/{id}', 'HRForfeited@deleteDataForfeited')->name('forfeited/delete');
    // ------------------------------------------------------
    Route::get('yuks', 'HRForfeited@deleteYearsForfeid')->name('yuks');

    // Route::get('index/new', 'HRForfeitedNew@index')->name('forfeited/index/new');
    // Route::get('index/data1', 'HRForfeitedNew@dataForfeited')->name('forfeited/new/data1');
    // pemotongan untuk cuti hangus
    Route::get('cutOff/{id}/{forfeited}', 'HRForfeited@cutOffForfeited')->name('forfeited/cutOff');
    Route::post('cutOff', 'HRForfeited@storeCutOffForfeited')->name('forfeited/cutOff/post');

    Route::get('form', 'HR_ForfeitedForm_Controller@index')->name('forfeited/form/index');
    Route::get('form/datatables', 'HR_ForfeitedForm_Controller@datatables')->name('forfeited/form/index/datatables');
    Route::get('form/modalformleave/{id}', 'HR_ForfeitedForm_Controller@modalformleave')->name('forfeited/form/modalformleave');
    Route::post('form/reloadPage', 'HR_ForfeitedForm_Controller@reloadPage')->name('forfeited/form/reloadPage');
    Route::get('form/employee/{id}', 'HR_ForfeitedForm_Controller@indexPerson')->name('forfeited/indexPerson');
    Route::get('form/employee/{id}/datatables', 'HR_ForfeitedForm_Controller@datatablesPerson')->name('forfeited/indexPerson/datatablesPerson');
});

// VIew Exndo in Forfeited
Route::prefix('hr/exdo')->group(function () {
    Route::get('{id}', 'HRExdoViewController@index')->name('hr/exdo/view/index');
    Route::get('datatables/{id}', 'HRExdoViewController@datatablesCountdown')->name('hr/exdo/view/index/datatables');
    Route::get('transaction/datatables/{id}', 'HRExdoViewController@datatablesExdoTransaction')->name('hr/exdo/view/transaction/datatables');

    //excel generate
    Route::post('generate/indexExdo', 'HRExdoViewController@excelIndexExdo')->name('hr/exdo/view/generate/indexExcel');
    Route::post('generate/exdoLeaveTransaction', 'HRExdoViewController@excelExdoTransaction')->name('hr/exdo/view/generate/excelExdoLeaveTransaction');
});

/*End HRD Llevel*/
//Technical Production Approval
Route::prefix('Operations')->group(function () {
    Route::get('indexApprovalOperations', 'HRDLevelAccess@indexApprovalTechnicalProduction')->name('indexApprovalOperations');
    Route::get('getApprovalOperations', 'HRDLevelAccess@getApprovalTechnicalProduction')->name('getApprovalOperations');
    Route::get('detailOperation/{id}', 'HRDLevelAccess@detailLeaveProduction')->name('detailOperation');
    Route::get('approve/{id}/Operations', 'HRDLevelAccess@approveLeave')->name('approve/Operations');
    Route::get('disapprove/{id}/Operations', 'HRDLevelAccess@disapproveLeave')->name('disapprove/Operations');
});
//Approval Pipeline
Route::prefix('Pipeline')->group(function () {
    Route::get('GetIndexTransactionPipeline', 'Pipeline_Approval@GetindexTransactionPipeline')->name('GetIndexTransactionPipeline');
    //SPV Pipeline
    Route::get('indexApprovalPipeline', 'Pipeline_Approval@IndexApproval')->name('indexApprovalPipeline');
    Route::get('GetApprovalPipeline', 'Pipeline_Approval@GetApproval')->name('GetApprovalPipeline');
    Route::get('detailApprovalPipeline/{id}', 'Pipeline_Approval@detailLeavePipeline')->name('detailApprovalPipeline');
    Route::get('ApprovalPipeline/{id}/Pipeline', 'Pipeline_Approval@approveLeavePipeline')->name('ApprovalPipeline/Pipeline');
    Route::get('DisapprovePipeline/{id}/Pipeline', 'Pipeline_Approval@disapproveLeavePipeline')->name('DisapprovePipeline/Pipeline');

    /// Senior Technical
    Route::get('index/approval', 'PipeLineTechnical@indexApproval')->name('PipeLineTechnicalIndexApproval');
    Route::get('index/approval/data', 'PipeLineTechnical@GetApproval')->name('PipeLineTechnicalGetApproval');
    ROute::get('index/approval/detail/{id}', 'PipeLineTechnical@detailLeavePipelineTechnical')->name('detailLeavePipelineTechnical');
    Route::get('approval/{id}', 'PipeLineTechnical@approveLeavePipelineTechnical')->name('approveLeavePipelineTechnical');
    Route::get('disapproval/{id}', 'PipeLineTechnical@disapproveLeavePipelineTechnical')->name('disapproveLeavePipelineTechnical');

    //SPV Senior Technical Director
    Route::get('GetApprovalDirector', 'Pipeline_Approval@GetApprovalDirector')->name('GetApprovalDirector');
    Route::get('detailApprovalDirector/{id}', 'Pipeline_Approval@detailLeaveDirector')->name('detailApprovalDirector');
    Route::get('ApprovalDirector/{id}/Pipeline', 'Pipeline_Approval@approveLeaveDirector')->name('ApprovalDirector/Pipeline');
    Route::get('DisapproveDirector/{id}/Pipeline', 'Pipeline_Approval@disapproveLeaveDirector')->name('DisapproveDirector/Pipeline');

    ///WS Availability
    Route::prefix('WS-Avaiblity')->group(function () {
        Route::get('index', 'Pipeline_Approval@indexWS_Availability')->name('indexWS_AvailabilityPipeline');
        Route::get('ws-get', 'Pipeline_Approval@get_indexWS_Availability')->name('get_indexWS_AvailabilityPipeline');
        Route::get('idle', 'Pipeline_Approval@index_idle_Avability')->name('index_idle_AvabilityPipeline');
        Route::get('idle-get', 'Pipeline_Approval@get_index_idle_Avability')->name('get_index_idle_AvabilityPipeline');
        Route::get('legend', 'Pipeline_Approval@indexLegendAvailability')->name('indexLegendAvailabilityPipeline');
        Route::get('Scrapped', 'Pipeline_Approval@index_Scrapped')->name('index_ScrappedPipeline');
        Route::get('Scrapped-get', 'Pipeline_Approval@get_index_Scrapped')->name('get_index_ScrappedPipeline');
    });

    Route::prefix('workstations')->group(function () {
        Route::get('availability', 'PipelineWorkstationsAvailability@index')->name('pipeline/workstations/availability/index');
        Route::get('availability/data', 'PipelineWorkstationsAvailability@dataIndex')->name('pipeline/workstations/availability/data');
        Route::get('availability/notes/{id}', 'PipelineWorkstationsAvailability@noted')->name('pipeline/workstations/availability/notes');

        Route::get('availability/idle', 'PipelineWorkstationsAvailability@indexIdle')->name('pipeline/workstations/availability/idle/index');
        Route::get('availability/idle/data', 'PipelineWorkstationsAvailability@dataIdle')->name('pipeline/workstations/availability/idle/data');
        Route::get('availability/idle/notes/{id}', 'PipelineWorkstationsAvailability@idleNoted')->name('pipeline/workstations/availability/idle/notes');

        Route::get('availability/fails', 'PipelineWorkstationsAvailability@indexFails')->name('pipeline/workstations/availability/fails/index');
        Route::get('availability/fails/data', 'PipelineWorkstationsAvailability@dataFails')->name('pipeline/workstations/availability/fails/data');
        Route::get('availability/fails/notes/{id}', 'PipelineWorkstationsAvailability@failsNoted')->name('pipeline/workstations/availability/fails/notes');

        Route::get('availability/scrapped', 'PipelineWorkstationsAvailability@indexScrapped')->name('pipeline/workstations/availability/scrapped/index');
        Route::get('availability/scrapped/data', 'PipelineWorkstationsAvailability@dataScrapped')->name('pipeline/workstations/availability/scrapped/data');
        Route::get('availability/scrapped/notes/{id}', 'PipelineWorkstationsAvailability@scrappedNoted')->name('pipeline/workstations/availability/scrapped/notes');
    });
});



/////////// IT Department ////////////////////////////////////////////////////////////

Route::prefix('Information-IT')->group(function () {
    Route::prefix('Availability')->group(function () {
        Route::get('indexIT', 'ITController@indexWS_Availability')->name('indexIT');
        Route::get('add-WS', 'ITController@addWS_Availability')->name('add-WS');
        Route::post('storeAddWS', 'ITController@storeAddWS')->name('storeAddWS');
        route::get('getindexIT', 'ITController@get_indexWS_Availability')->name('getWS');
        route::get('edit-WS/{id}', 'ITController@EditWs_Availability')->name('edit-WS');
        route::post('store-edit/{id}', 'ITController@Store_EditWs_Availability')->name('store-edit');
        route::get('History/Availability', 'ITController@index_Histori_Avaiblility')->name('History/Availability');
        route::get('get/History/Availability', 'ITController@get_index_Histori_Avaiblility')->name('get/History/Availability');
        route::get('der/{id}', 'ITController@editHIStoriWS_Availability')->name('der');
        route::post('store-histori-edit/{id}', 'ITController@Store_Edit_Histori_Ws_Availability')->name('store-histori-edit');

        route::get('send/WS-Avaiblity', 'ITController@send_WS_Availability')->name('send/WS-Avaiblity');

        Route::get('list', 'ITWSAvailability@index')->name('workstations/availability/index');
        Route::get('list/data', 'ITWSAvailability@dataObject')->name('workstations/availability/index/data');
        Route::get('edit/{id}', 'ITWSAvailability@edit')->name('workstations/availability/edit');
        Route::post('update/{id}', 'ITWSAvailability@update')->name('workstations/availability/update');
        Route::get('delete/{id}', 'ITWSAvailability@delete')->name('workstations/availability/delete');
        Route::post('delete/post/{id}', 'ITWSAvailability@postDelete')->name('workstations/availability/delete/post');
        Route::get('noted/{id}', 'ITWSAvailability@noted')->name('workstations/availability/noted');

        Route::get('idle', 'ITWSAvailability@idleIndex')->name('workstations/availability/idle/index');
        Route::get('idle/data', 'ITWSAvailability@dataIdle')->name('workstations/availability/idle/data');
        Route::get('idle/edit/{id}', 'ITWSAvailability@editIdle')->name('workstations/availability/idle/edit');
        Route::post('idle/update/{id}', 'ITWSAvailability@updateIdle')->name('workstations/availability/idle/update');
        Route::get('idle/delete/{id}', 'ITWSAvailability@deleteIdle')->name('workstations/availability/idle/delete');
        Route::post('idle/delete/post/{id}', 'ITWSAvailability@postDeleteIdle')->name('workstations/availability/idle/delete/post');

        Route::get('scrapped', 'ITWSAvailability@scrappedIndex')->name('workstations/availability/scrapped/index');
        Route::get('scrapped/data', 'ITWSAvailability@dataScrapped')->name('workstations/availability/scrapped/data');
        Route::get('scrapped/edit/{id}', 'ITWSAvailability@editScrapped')->name('workstations/availability/scrapped/edit');
        Route::post('scrapped/update/{id}', 'ITWSAvailability@updateSrcapped')->name('workstations/availability/scrapped/update');
        Route::get('scrapped/delete/{id}', 'ITWSAvailability@deleteScrapped')->name('workstations/availability/scrapped/delete');
        Route::post('scrapped/delete/post/{id}', 'ITWSAvailability@postDeleteScrapped')->name('workstations/availability/scrapped/delete/post');

        Route::get('fails', 'ITWSAvailability@failsindex')->name('workstations/availability/fails/index');
        Route::get('fails/data', 'ITWSAvailability@dataFails')->name('workstations/availability/fails/data');
        Route::get('fails/edit/{id}', 'ITWSAvailability@editFails')->name('workstations/availability/fails/edit');
        Route::post('fails/update/{id}', 'ITWSAvailability@updateFails')->name('workstations/availability/fails/update');
        Route::get('fails/delete/{id}', 'ITWSAvailability@deleteFails')->name('workstations/availability/fails/delete');
        Route::get('fails/delete/post/{id}', 'ITWSAvailability@postDeleteFails')->name('workstations/availability/fails/delete/post');

        Route::get('add-workstation', 'ITWSAvailability@add')->name('workstations/availability/add');
        Route::post('store-workstation', 'ITWSAvailability@store')->name('workstations/availability/store');
    });

    Route::prefix('Workstatios-Idle')->group(function () {
        route::get('idle', 'ITController@index_idle_Avability')->name('idle');
        route::get('getidle', 'ITController@get_index_idle_Avability')->name('getidle');

        route::get('edit-WS/Idle/{id}', 'ITController@Edi_Idlet_Ws_Availability')->name('edit-WS/Idle');
        route::post('store-edit/Idle/{id}', 'ITController@Store_Edit_Idlet_Ws_Availability')->name('store-edit/Idle');
    });

    route::prefix('Workstatios-Legend')->group(function () {
        route::get('legend', 'ITController@index_LegendWS')->name('legend');
        route::get('view-legend', 'ITController@view_legend')->name('view_legend');
    });

    route::prefix('Scrap-&-Fail')->group(function () {
        route::get('index-scrapped', 'ITController@index_Scrapped')->name('scrapped');
        route::get('get-scrapped', 'ITController@get_index_Scrapped')->name('get-scrapped');
        route::get('index-failed', 'ITController@index_Failed')->name('failed');
        route::get('get-failed', 'ITController@get_index_Failed')->name('get-failed');

        route::get('editSracped/{id}', 'ITController@editSracped')->name('editSracped');
    });

    route::prefix('Mapping')->group(function () {
        route::get('indexAnimation', 'ITController@index_WS_MAP')->name('indexMAP');
        route::get('PDF-3D', 'ITController@PDF_3D_Animation')->name('PDF-3D');
        route::get('postData3DMap/{id}', 'ITController@postData3DMap')->name('postData3DMap');
        route::post('postInputData3DMap/{id}', 'ITController@postInputData3DMap')->name('postInputData3DMap');
        route::post('ImportData3DMap/{id}', 'ITController@ImportData3DMap')->name('ImportData3DMap');
        route::get('Detail3DMap/{id}', 'ITController@Detail3DMap')->name('Detail3DMap');
        route::get('Detail3DMap2/{id}', 'ITController@Detail3DMap2')->name('Detail3DMap2');
        route::get('loadHTML3D_Animation', 'ITController@loadHTML3D_Animation')->name('loadHTML3D_Animation');
        Route::get('ExcellAnimation', 'TestingController@ExcellAnimation')->name('ExcellAnimation');

        route::get('indexLayout', 'ITController@indexLayout')->name('indexLayout');
        route::get('postDataLayout/{id}', 'ITController@postDataLayout')->name('postDataLayout');
        route::post('postInputDataLayout/{id}', 'ITController@postInputDataLayout')->name('postInputDataLayout');
        route::get('loadHTMLLayout', 'ITController@loadHTMLLayout')->name('loadHTMLLayout');
        Route::get('excellLayout', 'ITController@excellLayout')->name('excellLayout');

        route::get('indexMAPOfficer', 'ITController@indexMAPOfficer')->name('indexMAPOfficer');
        route::get('loadHTMLOfficer', 'ITController@loadHTMLOfficer')->name('loadHTMLOfficer');
        route::get('postDataOfficerMap/{id}', 'ITController@postDataOfficerMap')->name('postDataOfficerMap');
        route::post('postInputDataOfficerMap/{id}', 'ITController@postInputDataOfficerMap')->name('postInputDataOfficerMap');
        route::get('postDataOfficerMobileMap/{id}', 'ITController@postDataOfficerMobileMap')->name('postDataOfficerMobileMap');
        route::post('postInputDataOfficerMobileMap/{id}', 'ITController@postInputDataOfficerMobileMap')->name('postInputDataOfficerMobileMap');

        route::get('indexRender', 'ITController@indexRender')->name('indexRender');
        route::get('postDataRender/{id}', 'ITController@postDataRender')->name('postDataRender');
        route::get('postDataRenderLightings/{id}', 'ITController@postDataRenderLightings')->name('postDatarender');
        route::post('postInputDataRender/{id}', 'ITController@postInputDataRender')->name('postInputDataRender');
        route::get('loadHTMLRender', 'ITController@loadHTMLRender')->name('loadHTMLRender');


        route::get('indexITMap', 'MapingController@indexITMap')->name('indexITMap');

        route::get('loadHTMLITRoom', 'ITController@loadHTMLITRoom')->name('loadHTMLITRoom');

        route::get('DetailMobileMap/{id}', 'ITController@DetailMobileMap')->name('DetailMobileMap');
        route::get('DetailMobileMap2/{id}', 'ITController@DetailMobileMap2')->name('DetailMobileMap2');

        route::get('tes', 'ITController@tes')->name('tes');
    });


    route::prefix('username-&&-email')->group(function () {
        route::get('index-audit', 'ITController@index_Audit_Employee')->name('index-audit');
        route::get('get-audit', 'ITController@get_Audit_Employee')->name('get-audit');
        route::get('audit/{id}', 'ITController@edit_Audit_Employee')->name('audit');
        route::post('audit/{id}/post', 'ITController@store_Audit_Employee')->name('audit/post');
        route::post('audit/{id}/oldPost', 'ITController@store_Audit_Employee_old')->name('audit/post/old');

        route::get('indexALLUSER', 'ITController@indexALLUSER')->name('IT-EMploye_all');
        route::get('indexALLUSER/data', 'ITController@getAllUser')->name('indexALLUSER/data');
        route::get('indexALLUSER/show/{id}', 'ITController@modalActionEmployes')->name('indexALLUSER/show');
    });

    route::prefix('Asset')->group(function () {

        route::prefix('IT')->group(function () {
            route::get('index-asset', 'IT_Controller2@indexUtamaAsset')->name('indexUtamaAsset');
            Route::prefix('hardware')->group(function () {
                route::get('index-asset-IT', 'ITController@asset_IT')->name('asset-it');
                route::get('get-asset-IT', 'ITController@index_asset_IT')->name('get-asset-it');
                route::get('add-asset', 'ITController@add_asset_IT')->name('add-it');
                route::post('store-asset', 'ITController@store_add_asset_IT_123')->name('store-asset');
                route::get('edit-Asset/{id}', 'ITController@edit_Asset_IT')->name('edit-Asset');
                route::post('post-edit-Asset/{id}', 'ITController@post_edit_Asset_IT')->name('post-edit-Asset');
                route::get('print-asset/{id}', 'ITController@print_asset_IT')->name('print-asset');
                route::get('GetBarcodeID', 'ITController@GetBarcodeID')->name('GetBarcodeID');
                route::get('DetailAssett/{id}', 'ITController@DetailAssett')->name('DetailAssett');
                route::post('Import-Asseting-Data', 'ITController@ImportDataAsset')->name('ImportDataAsset');
                route::post('1234567890', 'ITController@postUpdate')->name('1234567890');
                route::get('embeddedAsset/{id}', 'ITController@embeddedAsset')->name('embeddedAsset');
                route::post('POSTembeddedAsset/{id}', 'ITController@POSTembeddedAsset')->name('POSTembeddedAsset');
                ////////////////////////////////////////////////////////////////////////////////////////////////////
                route::get('indexAsset/{id}', 'IT_Controller2@indextAsset1')->name('indextAsset1');
                route::get('getAsset1/{id}', 'IT_Controller2@getAsset1')->name('getAsset1');
                route::get('addAsset1', 'IT_Controller2@addAsset1')->name('addAsset1');
                route::post('post-asset', 'IT_Controller2@storeAddAsset1')->name('storeAddAsset1');
                route::get('detailAssetTracking/{id}', 'IT_Controller2@detailAssetTracking')->name('detailAssetTracking');
                route::get('editAsset/{id}', 'IT_Controller2@editAssetTracking')->name('editAssetTracking');
                route::post('SaveEditAssetTracking/{id}', 'IT_Controller2@SaveEditAssetTracking')->name('SaveEditAssetTracking');
                route::get('deleteAssetTracking/{id}', 'IT_Controller2@deleteAssetTracking')->name('deleteAssetTracking');
                route::get('barcode/{id}', 'IT_Controller2@indexBarcodeAsset')->name('indexBarcodeAsset');
                route::get('pdf-barcode/{id}', 'IT_Controller2@pdfBarcodeAssetTrackingAll')->name('pdfBarcodeAssetTrackingAll');
                route::get('ifw-code/{id}', 'IT_Controller2@pdfIFWCodeAssetTrackingAll')->name('pdfIFWCodeAssetTrackingAll');
                /////////////////////////////////////////////
                route::get('contoh', 'IT_Controller2@contoh')->name('contoh');
            });
            /////////////////////////////////
            route::prefix('Software')->group(function () {
                route::get('addAssetSoftware', 'IT_Controller2@addAssetSoftware')->name('addAssetSoftware');
                route::post('storeAssetSoftware', 'IT_Controller2@storeAssetSoftware')->name('storeAssetSoftware');
                route::get('index-software', 'IT_Controller2@indexAssetSoftware')->name('indexAssetSoftware');
                route::get('GetAssetSoftware', 'IT_Controller2@GetAssetSoftware')->name('GetAssetSoftware');

                route::get('SendMailReminderSoftwareMail', 'IT_Controller2@SendMailReminderSoftwareMail')->name('SendMailReminderSoftwareMail');
                route::get('addUserSoftware/{id}', 'IT_Controller2@addUserSoftware')->name('addUserSoftware');
                route::post('storeAddUserSoftware/{id}', 'IT_Controller2@storeAddUserSoftware')->name('storeAddUserSoftware');
                route::get('detailInventorySoftware/{id}', "IT_Controller2@detailInventorySoftware")->name('detailInventorySoftware');
                route::get('deleteMarkInventory/{id}', 'IT_Controller2@deleteMarkInventory')->name('deleteMarkInventory');

                route::get('edtiInvertorySoftware/{id}', 'IT_Controller2@edtiInvertorySoftware')->name('edtiInvertorySoftware');
                route::post('saveEditInventorySoftware/{id}', 'IT_Controller2@saveEditInventorySoftware')->name('saveEditInventorySoftware');

                Route::get('deleteListSoftware/{id}', 'IT_Controller2@deleteListSoftware')->name('deleteListSoftware');
            });
        });
        route::prefix('Production-Services')->group(function () {
            route::get('indexAssetPS', 'ITController@indexAssetPS')->name('indexAssetPS');
            route::get('getAssetPS', 'ITController@getAssetPS')->name('getAssetPS');
            route::get('addAssetPS', 'ITController@addAssetPS')->name('addAssetPS');
            route::post('StoreAssetPS', 'ITController@StoreAssetPS')->name('StoreAssetPS');
            route::get('editAssetPS/{id}', 'ITController@editAssetPS')->name('editAssetPS');
            route::post('postEditAsssetPS/{id}', 'ITController@postEditAsssetPS')->name('postEditAsssetPS');
            route::get('printAssetPS/{id}', 'ITController@printAssetPS')->name('printAssetPS');
        });
    });
    route::prefix('Requested')->group(function () {
        route::get('IndexForm', 'ITController@indexRequestForm')->name('IndexForm');
        route::get('CreateForm', 'ITController@CreateRequestForm')->name('CreateForm');
    });

    Route::prefix('Reset-Password')->group(function () {
        route::get('index-reset', 'ResetPasswordContorller@indexResetPasswordIT')->name('indexResetPasswordIT');
        route::get('getIndexResetPassword', 'ResetPasswordContorller@getIndexResetPassword')->name('getIndexResetPassword');
        route::get('passResetUserIT/{id}', 'ResetPasswordContorller@passResetUser')->name('passResetUserIT');
        Route::get('actionReset/{id}', 'ResetPasswordContorller@actionPassResetUser')->name('actionResetIT');

        /* new */

        Route::get('indexReset/password', 'IT_Controller2@indexResetPasswordIT')->name('indexResetPassswordIT');
        Route::get('indexReset/password/data', 'IT_Controller2@dataIndexResetPasswordIT')->name('dataIndexResetPasswordIT');
        Route::get('indexReset/password/reset/{id}', 'IT_Controller2@passResetUserIT')->name('passResetUserIT2');
        Route::get('indexReset/password/{id}', 'IT_Controller2@actionPassResetUser')->name('actionPassResetUserIT');
    });

    //support
    Route::get('leave/summary', 'ITLeaveSupportController@index')->name('it/support/leave/summary/index');
});

Route::prefix('registration')->group(function () {
    Route::get('it/form/requested', 'ITformOvertimesController@index')->name('it/registration/form/overtimes/index');
    Route::get('it/form/requested/data', 'ITformOvertimesController@dataObject')->name('it/registration/form/overtimes/data');
    Route::get('it/form/requested/modal/{id}', 'ITformOvertimesController@modalVerifyObejct')->name('it/registration/form/overtimes/modal');
    Route::post('it/form/requested/verified/{id}', 'ITformOvertimesController@verified')->name('it/registration/form/overtimes/verified');
    Route::post('it/form/requested/unverified/{id}', 'ITformOvertimesController@unverified')->name('it/registration/form/overtimes/unverified');

    //summary overtime it
    Route::get('it/form/requested/summary', 'ITformOvertimesController@indexSummary')->name('form/overtime/summary/index');
    Route::get('it/form/requested/summary/data', 'ITformOvertimesController@dataSummary')->name('form/overtime/summary/data');

    Route::get('it/form/requested/progress', 'ITformOvertimesController@indexProgress')->name('form/overtime/progress/index');
    Route::get('it/form/requested/progress/data', 'ITformOvertimesController@dataProgress')->name('form/overtime/progress/index/data');
    Route::get('it/form/requested/progress/{id}', 'ITformOvertimesController@modalProgressing')->name('form/overtime/progress/modal');

    Route::get('history/overtime', 'ITDataOvertimeMonth@index')->name('it/form/history/index');
    Route::get('history/overtime/data', 'ITDataOvertimeMonth@dataIndex')->name('it/form/history/index/data');
    Route::get('history/overtime/user', 'ITDataOvertimeMonth@indexUser')->name('it/form/history/user/index');
    Route::get('history/overtime/user/data', 'ITDataOvertimeMonth@dataUser')->name('it/form/history/user/index/data');

    Route::get('pipeline/form/requested/progress', 'PipelineRemoteAccessController@indexProgress')->name('pipeline/form/overtime/progress/index');
    Route::get('pipeline/form/requested/progress/data', 'PipelineRemoteAccessController@dataProgress')->name('pipeline/form/overtime/progress/index/data');
    Route::get('pipeline/form/requested/progress/{id}', 'PipelineRemoteAccessController@modalProgressing')->name('pipeline/form/overtime/progress/modal');
});

Route::get('leave/create/apa', 'AllEmployes_AttendanceController@dataProvinsi');
///////////////////////////////

//AllEmployee
Route::prefix('Informations')->group(function () {
    Route::prefix('WS-MAP')->group(function () {
        Route::get('3D-Animation', 'AllEmployeeController@index3DAnimation')->name('3D-Animation');
        Route::get('PDF-3D-Animation', 'AllEmployeeController@pdf3DAnimation')->name('PDF-3D-Animation');
        Route::get('2D-Layout', 'AllEmployeeController@indexLayout')->name('2D-Layout');
        Route::get('PDF-2D-Layout', 'AllEmployeeController@pdfLayout')->name('PDF-2D-Layout');
        Route::get('Render', 'AllEmployeeController@indexRender')->name('Render-Area');
        Route::get('PDF-Render', 'AllEmployeeController@pdfRender')->name('PDF-Render-Area');
    });
    Route::prefix('Voting')->group(function () {
        //Canteen Assessment
        Route::get('index-Voting', 'AllEmployee_2Controller@votingPolingKantin')->name('indexPolingKantinEmployee');
        Route::post('store-voting', 'AllEmployee_2Controller@storePolingKantin')->name('storePolingKantinEmployee');
        //housing assessment
        Route::get('index-HousingAssessment', 'AllEmployee_2Controller@indexHousingAssessment')->name('indexHousingAssessment');
    });
    Route::prefix('Transportation')->group(function () {
        Route::get('booking', 'AllEmployee_2Controller@inputDataBookingTransportation')->name('bookingg');
        Route::get('view-booking', 'AllEmployee_2Controller@viewDataBookingTransportation')->name('viewDataBookingTransportation');
        Route::get('booking/To-Studio', 'AllEmployee_2Controller@inputToStudio')->name('inputToStudio');
        Route::post('booking/ToStudio/inputed', 'AllEmployee_2Controller@storeInputToStudios')->name('storeInputToStudios');
        Route::get('booking/From-Studio', 'AllEmployee_2Controller@inputFromStudio')->name('inputFromStudio');
        Route::post('booking/FromStudio/inputed', 'AllEmployee_2Controller@storeInputFromStudio')->name('storeInputFromStudio');
        ////////////////////////////////////////////////////////////////////
        Route::get('reschedule/{id}/{key_transportation}', 'AllEmployee_2Controller@ReschedlueDataBooking')->name('ReschedlueDataBooking');
        Route::post('reschedule-edit2/{id}/{key_transportation}', 'AllEmployee_2Controller@editData2RescheduleDataBooking')->name('editData2RescheduleDataBooking');
        Route::post('reschedule-edit1/{id}/{key_transportation}', 'AllEmployee_2Controller@editData1RescheduleDataBooking')->name('editData1RescheduleDataBooking');
        Route::get('booking/delete/{id}', 'AllEmployee_2Controller@deleteScheduleBooking')->name('deleteScheduleBooking');

        Route::get('checkInTransportation/{id}', 'AllEmployee_2Controller@checkInTransportation')->name('checkInTransportation');
        Route::get('storeCheckInTransportaion/{id}', 'AllEmployee_2Controller@storeCheckInTransportaion')->name('storeCheckInTransportaion');
    });
    Route::prefix('Troubleshooting')->group(function () {
        Route::get('guidelines', 'AllEmployee_2Controller@wfh_trouble')->name('guidelines');
        Route::get('guidelines/download', 'AllEmployee_2Controller@downloadGuideRemoteWFH')->name('guidelines/download');
    });
    // Profile Employes
    Route::get('profile', 'AllEmployesProfileController@indexProfile')->name('employes/profile/index');
    Route::post('profile/post/{id}', 'AllEmployesProfileController@uploadImageProfile')->name('employes/profile/post');
    Route::get('profile/modalProject/{id}/{project}', 'AllEmployesProfileController@modalProject')->name('employes/profile/modal');
    Route::post('profile/modalProject/post/{id}', 'AllEmployesProfileController@updateProject')->name('employes/profile/modal/post');
    Route::post('profile/phone/post', 'AllEmployesProfileController@postPhone')->name('employes/profile/post/phone');
    Route::post('profile/dormStat/post', 'AllEmployesProfileController@postDormStat')->name('employes/profile/post/dormStat');
    Route::post('profile/dormRoom/post', 'AllEmployesProfileController@postDormRoom')->name('employes/profile/post/dormRoom');
    Route::post('profile/educationInstitution/post', 'AllEmployesProfileController@postEducationInstituion')->name('employes/profile/post/educationInstitution');
    Route::post('profile/nickname/post', 'AllEmployesProfileController@postNickName')->name('employes/profile/post/nickname');

    //summary leave (all Employes)
    Route::get('leave/summary/employes', 'AllEmployesLeaveController@indexSummary')->name('leave/summary/employes/index');
    Route::get('leave/summary/employes/object', 'AllEmployesLeaveController@objectSummary')->name('leave/summary/employes/object');
    Route::get('leave/summary/employes/modal/{id}', 'AllEmployesLeaveController@modalSummary')->name('leave/summary/employes/modal');
    Route::post('leave/summary/employes/request', 'AllEmployesLeaveController@getRequest')->name('leave/summary/employes/request');
    Route::get('leave/summary/employes/find/{start}/{end}/{dept}', 'AllEmployesLeaveController@findLeave')->name('leave/summary/employes/find');
    Route::get('leave/summary/employes/find/data/{start}/{end}/{dept}', 'AllEmployesLeaveController@findData')->name('leave/summary/employes/find/data');

    //calender leave
    Route::get('leave/calender', 'AllEmployesLeaveController@indexCalender')->name('leave/calender/index');
    Route::get('leave/calender/data', 'AllEmployesLeaveController@objectCalender')->name('leave/calender/data');
});

//All Employes Leave Transaction new baru loh  dikerjakan

Route::get('leave-migrations', 'Leave_Transaction_Migrations_Page_Controller@migrationRoute')->name('all_employes/leave/transaction/migrate');

//employes production staff leave transactions
Route::get('leave-transactions', 'Leave_Transactions_Employes_Controller@indexForEmployes')->name('all_employes/leave/transaction/index');
Route::get('leave-transactions/data', 'Leave_Transactions_Employes_Controller@datatablesForEmployes')->name('all_employes/leave/transaction/data');
Route::get('leave-transactions/{id}', 'Leave_Transactions_Employes_Controller@detailDatatablesForEmployes')->name('all_employes/leave/transaction/detail');
Route::get('leave-transactions/reminder/{id}', 'Leave_Transactions_Employes_Controller@reminderDatatablesForEmployes')->name('all_employes/leave/transaction/reminder');
Route::post('leave-transactions/reminder/{id}/post', 'Leave_Transactions_Employes_Controller@sendReminder')->name('all_employes/leave/transaction/reminder/post');
Route::get('leave-transactions/delete/{id}', 'Leave_Transactions_Employes_Controller@deleteDatatablesForEmployes')->name('all_employes/leave/transaction/delete');
Route::post('leave-transactions/delete/post/{id}', 'Leave_Transactions_Employes_Controller@postDeleteDatatablesForEmployes')->name('all_employes/leave/transaction/delete/post');
Route::get('leave-transactions/download/{id}', 'Leave_Transactions_Employes_Controller@generePDF')->name('all_employes/leave/transaction/download/pdf');

//employes productions coordiantor leave transactions
Route::get('leave-transactions-coordinator', 'Leave_Transaction_Employes_Coordinator_Controller@indexEmployes')->name('all_employes/leave/transaction/coordinator/index');
Route::get('leave-transactions-coordinator/data', 'Leave_Transaction_Employes_Coordinator_Controller@dataEmployesCoordinator')->name('all_employes/leave/transaction/coordinator/data');
Route::get('leave-transactions-coordinator/{id}', 'Leave_Transaction_Employes_Coordinator_Controller@detail')->name('all_employes/leave/transaction/coordinator/detail');
Route::get('leave-transactions-coordinator/pdf/{id}', 'Leave_Transaction_Employes_Coordinator_Controller@generePDF')->name('all_employes/leave/transaction/coordinator/pdf');
Route::get('leave-transactions-coordinator/mail/{id}', 'Leave_Transaction_Employes_Coordinator_Controller@reminderMail')->name('all_employes/leave/transaction/coordinator/mail');
Route::post('leave-transactions-coordinator/mail/post/{id}', 'Leave_Transaction_Employes_Coordinator_Controller@sendReminder')->name('all_employes/leave/transaction/coordinator/mail/post');
Route::get('leave-transactions-coordinator/delete/{id}', 'Leave_Transaction_Employes_Coordinator_Controller@delete')->name('all_employes/leave/transaction/coordinator/delete');
Route::post('leave-transactions-coordinator/delete/post/{id}', 'Leave_Transaction_Employes_Coordinator_Controller@postDelete')->name('all_employes/leave/transaction/coordinator/delete/post');

////employes productions supervisor leave transactions
Route::get('leave-transactions-superviosr', 'Leave_Transaction_Employes_Supervisor__Controller@indexEmployes')->name('all_employes/leave/transaction/supervisor/index');
Route::get('leave-transactions-supervisor/data', 'Leave_Transaction_Employes_Supervisor__Controller@datatatable')->name('all_employes/leave/transaction/supervisor/data');
Route::get('leave-transactions-supervisor/{id}', 'Leave_Transaction_Employes_Supervisor__Controller@detail')->name('all_employes/leave/transaction/supervisor/detail');
Route::get('leave-transactions-supervisor/pdf/{id}', 'Leave_Transaction_Employes_Supervisor__Controller@generePDF')->name('all_employes/leave/transaction/supervisor/pdf');
Route::get('leave-transactions-supervisor/mail/{id}', 'Leave_Transaction_Employes_Supervisor__Controller@reminderMail')->name('all_employes/leave/transaction/supervisor/mail');
Route::post('leave-transactions-supervisor/mail/post/{id}', 'Leave_Transaction_Employes_Supervisor__Controller@sendReminder')->name('all_employes/leave/transaction/supervisor/mail/post');
Route::get('leave-transactions-supervisor/delete/{id}', 'Leave_Transaction_Employes_Supervisor__Controller@delete')->name('all_employes/leave/transaction/supervisor/delete');
Route::post('leave-transactions-supervisor/delete/post/{id}', 'Leave_Transaction_Employes_Supervisor__Controller@postDelete')->name('all_employes/leave/transaction/supervisor/delete/post');

////employes productions project manager leave transactions
Route::get('leave-transactions-pm', 'Leave_Transaction_Employes_ProjectManager_Controller@indexEmployes')->name('all_employes/leave/transaction/pm/index');
Route::get('leave-transactions-pm/data', 'Leave_Transaction_Employes_ProjectManager_Controller@datatatable')->name('all_employes/leave/transaction/pm/data');
Route::get('leave-transactions-pm/{id}', 'Leave_Transaction_Employes_ProjectManager_Controller@detail')->name('all_employes/leave/transaction/pm/detail');
Route::get('leave-transactions-pm/pdf/{id}', 'Leave_Transaction_Employes_ProjectManager_Controller@generePDF')->name('all_employes/leave/transaction/pm/pdf');
Route::get('leave-transactions-pm/mail/{id}', 'Leave_Transaction_Employes_ProjectManager_Controller@reminderMail')->name('all_employes/leave/transaction/pm/mail');
Route::post('leave-transactions-pm/mail/post/{id}', 'Leave_Transaction_Employes_ProjectManager_Controller@sendReminder')->name('all_employes/leave/transaction/pm/mail/post');
Route::get('leave-transactions-pm/delete/{id}', 'Leave_Transaction_Employes_ProjectManager_Controller@delete')->name('all_employes/leave/transaction/pm/delete');
Route::post('leave-transactions-pm/delete/post/{id}', 'Leave_Transaction_Employes_ProjectManager_Controller@postDelete')->name('all_employes/leave/transaction/pm/delete/post');

////employes haed of manager leave transactions
Route::get('leave-transactions-hd', 'Leave_Transaction_Head_of_Department_Controller@indexEmployes')->name('all_employes/leave/transaction/hd/index');
Route::get('leave-transactions-hd/data', 'Leave_Transaction_Head_of_Department_Controller@datatatable')->name('all_employes/leave/transaction/hd/data');
Route::get('leave-transactions-hd/{id}', 'Leave_Transaction_Head_of_Department_Controller@detail')->name('all_employes/leave/transaction/hd/detail');
Route::get('leave-transactions-hd/pdf/{id}', 'Leave_Transaction_Head_of_Department_Controller@generePDF')->name('all_employes/leave/transaction/hd/pdf');
Route::get('leave-transactions-hd/mail/{id}', 'Leave_Transaction_Head_of_Department_Controller@reminderMail')->name('all_employes/leave/transaction/hd/mail');
Route::post('leave-transactions-hd/mail/post/{id}', 'Leave_Transaction_Head_of_Department_Controller@sendReminder')->name('all_employes/leave/transaction/hd/mail/post');
Route::get('leave-transactions-hd/delete/{id}', 'Leave_Transaction_Head_of_Department_Controller@delete')->name('all_employes/leave/transaction/hd/delete');
Route::post('leave-transactions-hd/delete/post/{id}', 'Leave_Transaction_Head_of_Department_Controller@postDelete')->name('all_employes/leave/transaction/hd/delete/post');

//employes senior pipeline production leave transaction
Route::get('leave-transaction-senior-pipeline', 'Leave_Transaction_Pipeline_Senior_Controller@index')->name('all_employes/leave/transaction/senior-pipeline/index');
Route::get('leave-transaction-senior-pipeline/data', 'Leave_Transaction_Pipeline_Senior_Controller@datatables')->name('all_employes/leave/transaction/senior-pipeline/data');
Route::get('leave-transaction-senior-pipeline/{id}/detail', 'Leave_Transaction_Pipeline_Senior_Controller@detail')->name('all_employes/leave/transaction/senior-pipeline/detail');
Route::get('leave-transaction-senior-pipeline/{id}/pdf', 'Leave_Transaction_Pipeline_Senior_Controller@generePDF')->name('all_employes/leave/transaction/senior-pipeline/pdf');
Route::get('leave-transaction-senior-pipeline/{id}/mail', 'Leave_Transaction_Pipeline_Senior_Controller@reminderMail')->name('all_employes/leave/transaction/senior-pipeline/mail');



//All Employes Register
Route::prefix('register')->group(function () {

    // Overtimes Employes
    Route::get('form', 'AllEmployesFormProgressingController@index')->name('form/progressing/index');
    Route::get('form/data', 'AllEmployesFormProgressingController@dataObject')->name('form/progressing/data');
    Route::get('form/data/{id}', 'AllEmployesFormProgressingController@modalObject')->name('form/progressing/data/modal');
    Route::get('form/edit/{id}', 'AllEmployesFormProgressingController@modalEditObject')->name('form/progressing/edit/index');
    Route::post('form/update/{id}', 'AllEmployesFormProgressingController@modalUpdateObject')->name('form/progressing/update');
    Route::get('form/delete/{id}', 'AllEmployesFormProgressingController@modalDeleteObject')->name('form/progressing/delete');
    Route::post('form/delete/post/{id}', 'AllEmployesFormProgressingController@postDelete')->name('form/progressing/delete/post');

    Route::get('form/requested', 'AllEmployesOverTimerController@index')->name('form/overtime/index')->middleware(['AccessOvertimeRemote', 'Saturday']);
    Route::post('form/overtime/post', 'AllEmployesOverTimerController@post')->name('form/overtime/post');

    // Overtimes SUmmary index
    Route::get('form/summary/requested', 'AllEmployesOverTimerController@summaryOvetime')->name('form/summary/overtime/index');

    Route::get('form/summary/requested/coordinator', 'AllEmployesOverTimerController@summaryOvertimeCoordinator')->name('form/summary/overtime/coordinator/index');
    Route::get('form/summary/requested/coordinator/data', 'AllEmployesOverTimerController@dataSummaryCoordinator')->name('form/summary/overtime/coordinator/data');

    Route::get('form/summary/requested/project-manager', 'AllEmployesOverTimerController@summaryOvertimeProjectManager')->name('form/summary/overtime/projectmanager/index');
    Route::get('form/summary/requested/project-manager/data', 'AllEmployesOverTimerController@dataSummaryProjectManager')->name('form/summary/overtime/projectmanager/data');

    Route::get('form/summary/requested/general-manager', 'AllEmployesOverTimerController@summaryOvertimeGeneralManager')->name('form/summary/overtime/generalmanager/index');
    Route::get('form/summary/requested/general-manager/data', 'AllEmployesOverTimerController@dataSummaryGeneralManager')->name('form/summary/overtime/generalmanager/data');


    // Approval Coordinator Overtimes
    Route::get('form/approval/coordinator', 'FormOvertimesApprovalController@indexCoordinator')->name('form/approval/coordinator/index');
    Route::get('form/approval/coordinator/data', 'FormOvertimesApprovalController@dataIndexCoordinator')->name('form/approval/coordinator/index/data');
    Route::get('form/approval/coordinator/modal/{id}', 'FormOvertimesApprovalController@modalCoordinatorApproved')->name('form/approval/coordinator/approved');
    Route::post('form/approval/coordinator/approved/{id}', 'FormOvertimesApprovalController@approvedCoordinator')->name('form/approval/coordinator/approved/post');
    Route::post('form/approval/coordinator/disapproved/{id}', 'FormOvertimesApprovalController@disapprovedCoordinator')->name('form/approval/coordinator/disapproved/post');

    // Working on Weekends for Coordinator -> ini dia
    Route::get('working-weekend/form-not-accessed', 'CoordinatorWorkingWeekendsController@notAccessed')->name('coordinator/working/weekends/form/not-accessed');
    Route::get('working-weekend/form', 'CoordinatorWorkingWeekendsController@form')->name('coordinator/working/weekends/form');
    Route::get('working-weekend/form/insert/modal', 'CoordinatorWorkingWeekendsController@formInserModal')->name('coordinator/working/weekends/form/insert/modal');
    Route::post('working-weekend/form/insert', 'CoordinatorWorkingWeekendsController@postFormInsert')->name('coordinator/working/weekends/form/insert');
    Route::get('working-weekend/edit/{id}', 'CoordinatorWorkingWeekendsController@editDataTable')->name('coordinator/working/weekends/edit');
    Route::post('working-weekend/update/{id}', 'CoordinatorWorkingWeekendsController@updateData')->name('coordinator/working/weekends/update');
    Route::get('working-weekend/delete/{id}', 'CoordinatorWorkingWeekendsController@deleteData')->name('coordinator/working/weekends/delete');
    Route::get('working-weekend/remove/{id}', 'CoordinatorWorkingWeekendsController@removeRecordData')->name('coordinator/working/weekends/remove');
    Route::post('working-weekend/send', 'CoordinatorWorkingWeekendsController@sendData')->name('coordinator/working/weekends/send/data');

    Route::post('working-weekend/syu', 'CoordinatorWorkingWeekendsController@tested')->name('coordinator/working/weekends/syu');

    //approval Project Manager Overtime
    Route::get('form/approval/project-manager', 'FormOvertimesApprovalController@indexProjectManager')->name('form/approval/projectmanager/index');
    Route::get('form/approval/project-manager/data', 'FormOvertimesApprovalController@dataIndexProjectManager')->name('form/approval/projectmanager/index/data');
    Route::get('form/approval/project-manager/modal/{id}', 'FormOvertimesApprovalController@modalProjectManagerApproved')->name('form/approval/projectmanager/approved');
    Route::post('form/approval/project-manager/approved/{id}', 'FormOvertimesApprovalController@approvedProjectManager')->name('form/approval/projectmanager/approved/post');
    Route::post('form/approval/project-manager/disapproved/{id}', 'FormOvertimesApprovalController@disapprovedProjectManager')->name('form/approval/projectmanager/disapproved/post');

    //approval General Manager Overtime
    Route::get('form/approval/general-manager', 'FormOvertimesApprovalController@indexGeneralManager')->name('form/approval/generalmanager/index');
    Route::get('form/approval/general-manager/data', 'FormOvertimesApprovalController@dataIndexGeneralManager')->name('form/approval/generalmanager/index/data');
    Route::get('form/approval/general-manager/modal/{id}', 'FormOvertimesApprovalController@modalGeneramlManagerApproved')->name('form/approval/generalmanager/approved');
    Route::post('form/approval/general-manager/approved/{id}', 'FormOvertimesApprovalController@approvedGeneralManager')->name('form/approval/generalmanager/approved/post');
    Route::post('form/approval/general-manager/disapproved/{id}', 'FormOvertimesApprovalController@disapprovedGeneralManager')->name('form/approval/generalmanager/disapproved/post');
});

//AllEmployee Absensi
Route::prefix('Absensi')->group(function () {
    Route::get('indexAbsensi', 'absensiController@index')->name('indexAbsensi');
    Route::get('dataAbsensi', 'absensiController@dataAbsensi')->name('dataAbsensi');
    Route::post('checkIn', 'absensiController@postCheckIn')->name('checkIn');
    Route::post('checkOut', 'absensiController@postCheckOut')->name('checkOut');
    Route::get('detail/{id}', 'absensiController@detailAttendance')->name('detailAttendance');

    Route::post('postedCheckIn', 'absensiController@postedCheckIn')->name('postedCheckIn');
    Route::post('postedCheckOut', 'absensiController@postedCheckOut')->name('postedCheckOut');
});

ROute::get('attendance', 'AllEmployes_AttendanceController@index')->name('attendance/index');
Route::prefix('attendance')->group(function () {
    Route::get('checkIn', 'AllEmployes_AttendanceController@checkIn')->name('attendance/checkin');
    Route::post('checkIn/post', 'AllEmployes_AttendanceController@postCheckIn')->name('attendance/checkin/post');
    Route::get('checkOut', 'AllEmployes_AttendanceController@checkOut')->name('attendance/checkOut');
    Route::post('checkOut/post', 'AllEmployes_AttendanceController@postCheckOut')->name('attendance/checkOut/post');
    Route::get('data', 'AllEmployes_AttendanceController@dataTables')->name('attendance/datatables');
});


Route::prefix('employee/forfeited')->group(function () {
    Route::get('index', 'AllEmployee_2Controller@indexForfeited')->name('employee/forfeited/index');
});

Route::get('employee/exit-interview-form', 'AllEmployee_2Controller@indexEmployeeExitInterview')->name('indexEmployeeExitInterview');


// Ghea Lisanova
Route::prefix('general-manager')->group(function () {
    Route::get('remote-access/summary', 'GeneralManager_SummaryRemoteAccessVPN_Controller@index')->name('gm/remote-access/summary/index');
    Route::get('remote-access/summary/{date}', 'GeneralManager_SummaryRemoteAccessVPN_Controller@dataIndex')->name('gm/remote-access/summary/index/data');

    Route::get('remote-access/summary/month/{date}', 'GeneralManager_SummaryRemoteAccessVPN_Controller@indexMonthly')->name('gm/remote-access/summary/month/index');

    // Working on Weekend General Manager
    Route::get('working-on-weekends', 'GM_WeekendsController@index')->name('gm/working-on-weekends/index');
    Route::get('working-on-weekends/allowance', 'GM_WeekendsController@datatablesAllowance')->name('gm/working-on-weekends/index/allowance/data');
    Route::get('working-on-weekends/allowance/detail/{id}', 'GM_WeekendsController@detail')->name('gm/working-on-weekends/detail');
    Route::get('working-on-weekends/approved/{id}', 'GM_WeekendsController@apporved')->name('gm/working-on-weekends/approved');
    Route::get('working-on-weekends/approved/exdo/{id}', 'GM_WeekendsController@apporvedExdo')->name('gm/working-on-weekends/approved/exdo');
    Route::get('working-on-weekends/disapproved/{id}', 'GM_WeekendsController@disapproved')->name('gm/working-on-weekends/disapproved');
    Route::get('working-on-weekends/disapproved/exdo/{id}', 'GM_WeekendsController@disapprovedExdo')->name('gm/working-on-weekends/disapproved/exdo');

    Route::get('working-on-weekends/exdo', 'GM_WeekendsController@datatablesExdo')->name('gm/working-on-weekends/index/exdo/data');
    Route::get('working-on-weekends/exdo/detail/{id}', 'GM_WeekendsController@detailExdo')->name('gm/working-on-weekends/detail/exdo');

    Route::post('working-on-weekends/ajaxPush', 'GM_WeekendsController@ajaxPush')->name('gm/working-on-weekends/ajaxPush');

    Route::get('working-on-weekends/getStat/{id}', 'GM_WeekendsController@getStat')->name('gm/working-on-weekends/getStat');

    Route::get('working-on-weekends/summary', 'GM_WeekendsController@summary')->name('gm/working-on-weekends/summary');
    Route::get('working-on-weekends/summary/data', 'GM_WeekendsController@dataSummary')->name('gm/working-on-weekends/summary/data');
});

Route::prefix('Voting')->group(function () {
    Route::get('index-Voting', 'HandleController@votingPolingKantin')->name('indexPolingKantin');
    Route::post('store-voting', 'HandleController@storePolingKantin')->name('storePolingKantin');
    Route::get('tglCanteen', 'MaintanaceProgrammer@showTglCanteen')->name('tglCanteen');
});

Route::get('ResetAllPassword', 'ADMController@ResetAllPassword')->name('ResetAllPassword');

//Administrator
Route::prefix('Administrator')->group(function () {
    Route::prefix('Human-Resoucer')->group(function () {
        Route::prefix('General-Affair')->group(function () {
            Route::get('index-voting', 'AdministratorController@indexVotingCanteen')->name('indexVotingCanteenAdministrator');
            Route::get('get-voting', 'AdministratorController@getVotingCanteen')->name('getVotingCanteenAdministrator');
        });
    });
    Route::prefix('Officer-Statment')->group(function () {
        Route::get('index', 'AdministratorController@statOfficer')->name('admin/statOfficer/index');
        Route::get('index/data', 'AdministratorController@dataStatOfficer')->name('admin/statOfficer/data');
        Route::get('edit/{id}', 'AdministratorController@editStatOfficer')->name('admin/statOfficer/edit');
        Route::get('update/{id}', 'AdministratorController@updateStatOfficer')->name('admin/statOfficer/update');
        Route::get('deupdate/{id}', 'AdministratorController@deupdateSetOfficer')->name('admin/statOfficer/deupdate');
        Route::post('up/{id}', 'AdministratorController@upSetOfficer')->name('admin/statOfficer/upSetOfficer');
    });
    Route::prefix('Head-of-Department')->group(function () {
        Route::get('access', 'AdministratorController@HeadOFDepartmentAccess')->name('admin/head-of-department/access');
        Route::get('access/data', 'AdministratorController@dataHeadOfDepartmentAccess')->name('admin/head-of-department/access/data');
        Route::get('acess/{id}', 'AdministratorController@addHeadOfDepartmentAccess')->name('admin/head-of-deparment/access/update');
    });
});

//Akses GA HR
Route::prefix('General_Affair')->group(function () {
    Route::prefix('Committee')->group(function () {
        Route::get('dateSearch', 'HR_GAController@dateSeacrhingCanteen')->name('dateSeacrhingCanteen');
        Route::get('index', 'HR_GAController@indexVotingCanteen')->name('indexVotingCanteen');
        Route::get('get-index-canteen', 'HR_GAController@getVotingCanteen')->name('getVotingCanteen');
        Route::get('detail/{id}', 'HR_GAController@detailVoteAssessmentReport')->name('detailVoteAssessmentReport');
        Route::get('get-index-desiredfood', 'HR_GAController@getVotingCanteenDesiredFood')->name('getVotingCanteenDesiredFood');
        Route::get('get-index-undesiredfood', 'HR_GAController@getVotingCanteenUndesiredFood')->name('getVotingCanteenUndesiredFood');
        Route::get('index-undersiredfood', 'HR_GAController@UndesiredFood')->name('UndesiredFood');
        Route::get('index-dersiredfood', 'HR_GAController@DesiredFood')->name('DesiredFood');
        Route::get('Comment', 'HR_GAController@getCommentData')->name('Commenttt');
        Route::get('excelData/{strated}/{ended}', 'HR_GAController@excelData')->name('excelData');
    });

    Route::prefix('Attendance')->group(function () {
        Route::get('index', 'HR_GAController@indexAttendace')->name('indexHrGaAttendace');
        Route::get('index/data', 'HR_GAController@dataAttendace')->name('indexDataGaAttendance');
        Route::get('edit/{id}', 'HR_GAController@editAttendance')->name('GaAttendance');
        Route::post('update/{id}', 'HR_GAController@updateAttendace')->name('updateGaAttendace');
        Route::get('delete/{id}', 'HR_GAController@deleteAttendance')->name('deleteGaAttendance');
        Route::get('chart', 'HR_GAController@indexChart')->name('indexChartGaAttendance');
        Route::get('index/Day', 'HR_GAController@indexPerDayAttendance')->name('indexPerDayGaAttendance');
        Route::get('getListtAttendance', 'HR_GAController@getListtAttendance')->name('getListtGaAttendance');
        Route::get('getListtAttendance/{id}', 'HR_GAController@editGetListDataAttendance')->name('editGetListDataGaAttendance');
        Route::post('getListtAttendance/{id}', 'HR_GAController@updateGetListDataAttendance')->name('updateGetListDataGaAttendance');
        Route::get('downloadAttendance/{startDate}/{endDate}/{id}', 'HR_GAController@downloadExcelListAttendance')->name('downloadExcelListGaAttendance');
        Route::get('getDataAttendanceDepartment', 'HR_GAController@getDataAttendanceDepartment')->name('getDataGaAttendanceDepartment');
        Route::get('downloadAllAttendance/{start_date}/{department}', 'HR_GAController@downloadExcelListAllAttendance')->name('downloadExcelListAllGaAttendance');
        Route::get('detailAttendance/index/{id}', 'HR_GAController@detailIndexAttendance')->name('detailIndexGaAttendance');
    });
});

//Faclities
Route::prefix('Faclities')->group(function () {
    Route::get('index', 'FacilitiesController@indexTransportationBUS')->name('indexTransportationBUS');
    Route::get('getINdex', 'FacilitiesController@getINdexTransaction')->name('getINdexTransaction');
    Route::get('getINdex1', 'FacilitiesController@getINdexTransaction1')->name('getINdexTransaction1');
    Route::post('post/locked_Transportations', 'FacilitiesController@locked_Transportations')->name('locked_Transportations');
    Route::post('Transportation-Email-Sending', 'FacilitiesController@sendEmailTransportation')->name('sendEmailTransportation');
    Route::post('Download-Transportation', 'FacilitiesController@ExcelTransportation')->name('ExcelTransportation');
    Route::get('UnlockedBus/{id}', 'FacilitiesController@UnlockedBus')->name('UnlockedBus');
    Route::get('lockedBus/{id}', 'FacilitiesController@lockedBus')->name('lockedBus');
    Route::post('GenerateExcelTransportasi', 'FacilitiesController@GenerateExcelTransportasi')->name('GenerateExcelTransportasi');
    Route::get('index-seacrh', 'FacilitiesController@searchListTransportation')->name('searchListTransportation');

    Route::get('summary', 'FacilitiesAdminController@verifyFacilities')->name('facilities/admin/verify');
    Route::get('summary/data', 'FacilitiesAdminController@dataVerifyFacilities')->name('facilities/admin/verify/data');
    Route::get('summary/{id}', 'FacilitiesAdminController@detailVerify')->name('facilities/admin/verify/id');
    Route::get('summary/delete/{id}', 'FacilitiesAdminController@destroyVerify')->name('facilities/admin/verify/delete');
});


Route::prefix('Finance-Accounting')->group(function () {
    Route::prefix('Software')->group(function () {
        Route::get('List-Software', 'FinanceController@indexListSoftware')->name('indexListSoftware');
        Route::get('getListSoftware', 'FinanceController@getListSoftware')->name('getListSoftware');
        Route::get('detailListSoftware/{id}', 'FinanceController@detailListSoftware')->name('detailListSoftware');
        Route::get('PrintItemListSoftware/{id}', 'FinanceController@PrintItemListSoftware')->name('PrintItemListSoftware');
    });

    Route::prefix('Hardware')->group(function () {
        Route::get('index-list', 'FinanceController@indexListAssetTracking')->name('indexListAssetTracking');
        ROute::get('index-list-department/{id}', 'FinanceController@indexListAssetTrackingDP')->name('indexListAssetTrackingDP');
        Route::get('getListAssetTracking', 'FinanceController@getListAssetTracking')->name('getListAssetTracking');
        Route::get('index-purchase-cost/{id}', 'FinanceController@addPurchaseCost')->name('addPurchaseCost');
        ROute::get('edit-purchase-cost/{id}', 'FinanceController@editPurchase')->name('editPurchase');
        Route::post('store-purchase-soct/{id}', 'FinanceController@storePurchaseCost')->name('storePurchaseCost');
        Route::get('List-Accumulution/{id}', 'FinanceController@indexListAccumulution')->name('indexListAccumulution');
        Route::get('Download-Excel-Accmulation/{id}', 'FinanceController@excelListAccumulution')->name('excelListAccumulution');
    });
});

// Route untuk approval Hod
Route::prefix('head-of-approval')->group(function () {
    Route::get('index', 'DeptApprovedHODController@index')->name('head-of-approval/index');
    Route::get('index/data', 'DeptApprovedHODController@dataIndex')->name('head-of-approval/index/data');
    Route::get('approval/{id}', 'DeptApprovedHODController@approval')->name('head-of-approval/approval');
    Route::get('approval/post/{id}', 'DeptApprovedHODController@approvalPost')->name('head-of-approval/approval/post');
    Route::get('disapproval/post/{id}', 'DeptApprovedHODController@disapprovalPost')->name('head-of-approval/disapproval/post');
});

//ROute Head of Department Production ( Phill )
Route::prefix('head-summary-production')->group(function () {
    Route::get('attendance/index', 'HeadProductionAttendanceController@summaryIndexAttendance')->name('headOfProduction/index');
    Route::get('attendance/index/data', 'HeadProductionAttendanceController@dataObjectSummaryIndexAttendance')->name('headOfProduction/index/data');
    Route::get('attendance/index/{id}', 'HeadProductionAttendanceController@modalObjectSummaryindexAttendance')->name('headOfProduction/index/modal');
    Route::get('attendance/findName/', 'HeadProductionAttendanceController@findNameAttendanceDepartment')->name('headOfProduction/findName');
    Route::get('attendance/wfh', 'HeadProductionAttendanceController@attendanceOnline')->name('attendance/wfh');

    //
    Route::get('attendance/onsite', 'FingerPrint\\FingerPrintSpotController@attendanceOnsite')->name('attendance/onsite');
    Route::get('attendance/finger', 'FingerPrint\\FingerPrintSpotController@getObjectFingerPrint')->name('attendance/finger');
    Route::get('attendance/finger/modal/{id}', 'FingerPrint\\FingerPrintSpotController@modalObjectFingerPrint')->name('attendance/finger/modal');
    Route::get('attendance/finger/search', 'FingerPrint\\FingerPrintSpotController@searchIndexFingerPrint')->name('attendance/finger/search');
});

// summary ->ini dia
Route::prefix('summary')->group(function () {
    Route::get('working-on-weekends', 'CoordinatorWorkingWeekendsController@summary')->name('working-on-weekends/summary/index');
    Route::get('working-on-weekends/data', 'CoordinatorWorkingWeekendsController@dataSummary')->name('working-on-weekends/summary/index/data');
    Route::get('working-on-weekends/list/{id}', 'CoordinatorWorkingWeekendsController@modalListCrew')->name('working-on-weekends/summary/list');
});

//Route Infinite Studios
Route::prefix('kinema-studios')->group(function () {
    route::prefix('leave')->group(function () {
        route::get('infinite-approval', 'InfiniteStudiosController@indexApproval')->name('indexApprovalInfinite');
        route::get('infinite-approval/data', 'InfiniteStudiosController@getIndexApproval')->name('getIndexApprovalInfinite');
        route::get('infinite-approval/data/production', 'InfiniteStudiosController@getIndexApprovalProduction')->name('getIndexProductionApprovalInfinite');
        route::get('infinite-approval/{id}/detail', 'InfiniteStudiosController@detailLeave')->name('detailLeaveApprovalInfinite');
        route::get('infinite-approval/{id}/approveLeave', 'InfiniteStudiosController@approveLeave')->name('approvalInfinite');
        route::get('infinite-approval/{id}/disapproveLeave', 'InfiniteStudiosController@disapproveLeave')->name('disapproveLeaveInfinite');
    });
});

//Outside
Route::prefix('outside')->group(function () {
    Route::get('index-outside/{id}', 'SoftwareListContorller@index')->name('index-outside');
});

Route::get('antaha', 'TestingController@testingblablabalba')->name('antaha');
Route::get('covid', 'TestingController@Covid19')->name('covid')->middleware('auth');

Route::get('random', 'TestingController@random')->name('random')->middleware('auth');

//DEDE AFTAFIANDI
Route::prefix('dev')->group(function () {
    Route::get('forfeited/encouter', 'ForfeitedController@indexCounterForfeit')->name('forfeited/encounter');
    Route::get('forfeited/encouter/data', 'ForfeitedController@getDataCounterForfeit')->name('forfeited/data');
    Route::post('forfeited/encouter/upload', 'ForfeitedController@encounterForfei')->name('forfeited/upload');
    Route::get('forfeited/encouter/upload/{id}', 'ForfeitedController@detailEncounterForfei')->name('forfeited/uploaded');

    ////////////////
    Route::prefix('leave')->group(function () {
        Route::get('progress', 'programmer\\DevController@indexProgressLeave')->name('dev/indexProgressLeave');
        Route::get('progress/data', 'programmer\\DevController@dataProggressLeave')->name('dev/dataProggressLeave');
        Route::get('progress/statment', 'programmer\\DevController@indexStatmentLeaveProgress')->name('dev/indexStatmentLeaveProgress');
        Route::get('progress/statment/data', 'programmer\\DevController@dataStatmentLeavePrograess')->name('dev/dataStatmentLeavePrograess');
        Route::get('delete/{id}', 'programmer\\DevController@deleteFormLeave')->name('dev/delete/leave');
        ////
        Route::get('histori', 'programmer\\DevController@indexHistoriLeave')->name('dev/histori/leave');
        Route::get('histori/data', 'programmer\\DevController@dataHistoriLeave')->name('dev/histori/leave/data');
        Route::get('histori-{id}', 'programmer\\DevController@deleteHistoriLeave')->name('dev/histori/leave/delete');
    });

    Route::prefix('attendance')->group(function () {
        Route::get('reset', 'programmer\\AttendanceController@resetIndex')->name('dev/attendance/reset');
        Route::get('reset/data', 'programmer\\AttendanceController@dataResetIndex')->name('dev/attendance/reset/data');
        Route::get('reset/edit/{id}', 'programmer\\AttendanceController@editResetIndex')->name('dev/attendance/reset/edit');
        Route::post('reset/update/{id}', 'programmer\\AttendanceController@updateResetIndex')->name('dev/attendance/reset/update');
    });

    Route::get('exdo-expired', 'programmer\\ExdoExpiredCutController@exdoExpired')->name('dev/exdo/expired');
    Route::get('exdo-expired/data', 'programmer\\ExdoExpiredCutController@userExdoExpired')->name('dev/exdo/expired/data');

    Route::get('signature', 'programmer\\DevController@signatureEmail')->name('dev/signature/index');
    Route::post('signature/layout_v2', 'programmer\\DevController@signatureLayoutV2')->name('dev/signature/layout2');
    Route::post('signature/download', 'programmer\\DevController@downloadSignature')->name('dev/signature/download');
});

Route::prefix('fingerprint')->group(function () {
    Route::prefix('lobby')->group(function () {
        Route::get('attendance', 'FingerPrint\\HR\\AttendanceLobbyController@index')->name('hr\lobby\attendance\index');
        Route::get('attendance/data', 'FingerPrint\\HR\\AttendanceLobbyController@dataIindex')->name('hr\lobby\attendance\data');
    });
});

Route::get('mail/approved/{array}', 'LeaveAnnualMailController@approvedMail')->name('mail.approved');

// Route::get('hallow', 'AllEmployes_AttendanceController@test00');

Route::prefix('guideline')->group(function () {
    Route::get('induction', 'GuidelineController@induction')->name('guideline/induction');
    Route::get('wfh', 'GuidelineController@wfh')->name('guideline/wfh');
    Route::get('orginazation', 'GuidelineController@orginazation')->name('guideline/orginazation');
    Route::get('wiki', 'GuidelineController@wiki')->name('guideline/wiki');
});

Route::prefix('freelance')->group(function () {
    Route::get('create', 'CoordinatorUserFreelancerController@create')->name('freelance/create');
    Route::post('store', 'CoordinatorUserFreelancerController@store')->name('freelance/store');
    Route::get('list', 'CoordinatorUserFreelancerController@view')->name('freelance/view');
    Route::get('list/datatables', 'CoordinatorUserFreelancerController@datatablesView')->name('freelance/list/datatables');
    Route::get('edit/{id}', 'CoordinatorUserFreelancerController@edit')->name('freelance/edit');
    Route::post('update/{id}', 'CoordinatorUserFreelancerController@update')->name('freelance/update');
    Route::get('modalDestroy/{id}', 'CoordinatorUserFreelancerController@modalDestroy')->name('freelance/modalDestroy');
    Route::get('destroy/{id}', 'CoordinatorUserFreelancerController@destroy')->name('freelance/destroy');
    Route::get('modalEmail/{id}', 'CoordinatorUserFreelancerController@modalEmail')->name('freelance/modalEmail');
    Route::post('modalEmail/send/{id}', 'CoordinatorUserFreelancerController@sendMail')->name('freelance/modalEmail/send');
});

Route::prefix('coordinator')->group(function () {
    Route::get('exdo-extends', 'CoordinatorExtendsExdoController@index')->name('coordinator/exdo-extends/index');
    Route::get('exdo-extends/datatables', 'CoordinatorExtendsExdoController@data')->name('coordinator/exdo-extends/data');
    Route::get('exdo-extends/data', 'CoordinatorExtendsExdoController@datatables')->name('coordinator/exdo-extends/datatables');
    Route::post('exdo-extends/set-cookies', 'CoordinatorExtendsExdoController@setCookie')->name('coordinator/exdo-extends/cookies');

    Route::get('exdo-extends/{id}', 'CoordinatorExtendsExdoController@view')->name('coordinator/exdo-extends/view');
    Route::get('exdo-extends/edit/{id}', 'CoordinatorExtendsExdoController@editExtend')->name('coordinator/exdo-extends/edit');
    Route::post('exdo-extends/store/{id}', 'CoordinatorExtendsExdoController@storeExtends')->name('coordinator/exdo-extends/store');
});

Route::prefix('dev')->group(function () {
    Route::get('freelance', 'programmer\\User_FreelanceController@index')->name('dev/user/freelance/index');
    Route::get('freelance/datatables', 'programmer\\User_FreelanceController@datatables')->name('dev/user/freelance/datatables');
    Route::get('freelance/username/{id}', 'programmer\\User_FreelanceController@modalUsername')->name('dev/user/freelance/username');
    Route::post('freelance/username/post/{id}', 'programmer\\User_FreelanceController@storeUsername')->name('dev/user/freelance/username/post');
});
