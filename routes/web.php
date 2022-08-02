<?php

use App\Models\User;
use App\Models\ManagerLab;
use App\Models\LabSchedule;
use App\Models\TechnicianLab;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ManagerLabController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TechnicianLabController;
use App\Http\Controllers\PatientExaminationController;
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

//change password in all users
Route::get('change-password', 'ChangePasswordController@index')->name('change');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

Route::get('/', function () {
    return view('welcome');
})->name('main');
// Admin Route Start

Route::get('/adminPanel', [HomeController::class, 'search'])->name('adminPanel')->middleware(['admin']);
Route::get('/user/{user}/update', [HomeController::class, 'update'])->middleware(['admin']);
Route::get('/user/{user}/updateunactive', [HomeController::class, 'updateunactive'])->middleware(['admin']);
Route::get('/getaccount/user/{user}/unactive', [HomeController::class, 'unactive'])->middleware(['admin']);
require __DIR__ . '/auth.php';
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['admin']);
Route::get('/showall', [HomeController::class, 'showall'])->name('showall')->middleware(['admin']);
Route::get('/search-manager/', [HomeController::class, 'search'])->name('SearchManager')->middleware(['admin']);
Route::get('/getaccount/{id}', [HomeController::class, 'getaccount'])->name('getaccount')->middleware(['admin']);
Route::get('/LabShow/{id}', [HomeController::class, 'adminshow'])->name('showlab')->middleware(['admin']);
Route::get('/labs/{user}/ActiveStatus', [HomeController::class, 'ActiveLabStatus'])->middleware(['admin']);
Route::get('/labs/{user}/unActiveStatus', [HomeController::class, 'unActiveLabStatus'])->middleware(['admin']);

// safa labRefused to refused the lab request from the manager
Route::post('/labRefused/{lab}', [HomeController::class, 'labRefused'])->middleware(['admin']);
// dowonlad the doc
//accept lab in notifications
Route::get('/labAccept/{LabID}/{notification}', [HomeController::class, 'labAccept'])->middleware(['admin']);

Route::get('/downloadDoc/{file}', function ($fileName) {
    $file_path = public_path('doc/' . $fileName);
    return response()->download($file_path);
})->middleware(['admin']);
//Admin Route End



// Route::get('/create-techician', function () {
//     return view('components.techician.create');
// })->middleware(['manager']);
Route::resource('/TechnicianLab', TechnicianLabController::class);



// // for test
// Route::get('testMe', function () {
//     //     $password = 'malekmalek';
//     //     $user = new User;
//     //   $user->UserName = 'Malek';
//     //        $user->email = 'malek@gmail.com';
//     //        $user->password = Hash::make($password);
//     //        $user->status = 0;
//     //        $user->type = 'M';
//     //         $user->save();

//     //     $manager = new ManagerLab;

//     //     $manager->MPhone = '59874353';
//     //     $user->manager()->save($manager);
//     $user = User::find(2);

//     dd($user->manager);
// });








//Manager Route Start
//create tech
Route::get('/create-tech/{id}/{lid}', [TechnicianLabController::class, 'create'])->middleware(['manager'])->middleware('auth');
Route::get('/add-tech/{id}/{lid}', [TechnicianLabController::class, 'addtech'])->middleware(['manager']);
Route::post('/createtech/{lid}', [TechnicianLabController::class, 'store'])->name('CreateTech')->middleware(['manager']);
//add tech from lab
Route::get('/AddTechLab/{id}/{lid}', [TechnicianLabController::class, 'addtechlab'])->middleware(['manager']);
//delete tech from lab
Route::get('/deleteTechLab/{id}/{lid}', [TechnicianLabController::class, 'deleteTechLab'])->middleware(['manager']);
//add lab
Route::get('/lab/create', [ManagerLabController::class, 'create'])->middleware(['manager'])->name('dashboard');
Route::post('/lab/{id}', [LabController::class, 'store']);
Route::get('/dashboard', [ManagerLabController::class, 'index'])->middleware(['manager'])->name('dashboard');
Route::delete('labDelete/{managerLab}', [ManagerLabController::class, 'destroy'])->name('labDelete');
Route::post('labUpdate/{managerLab}', [ManagerLabController::class, 'edit'])->name('labUpdate');
///receipt
Route::get('/show-receipt/{id}', [ReceiptController::class, 'ShowReceipt'])->middleware(['manager']);
Route::get('/create-receipt/{id}', [ReceiptController::class, 'CreateReceipt'])->middleware(['manager']);
Route::post('/store-receipt/{lid}', [ReceiptController::class, 'StoreReceipt'])->middleware(['manager']);
Route::get('/Receipt-search/{lid}', [ReceiptController::class, 'search'])->middleware(['manager']);
//print and show receivable
Route::get('/Receipt-receivable/{lid}', [ReceiptController::class, 'receivable'])->middleware(['manager']);
Route::get('/receivable-show/{id}/{lid}', [ReceiptController::class, 'ShowReceivable'])->middleware(['manager']);
Route::get('/print-receivable/{id}/{lid}', [ReceiptController::class, 'PrintReceivable'])->middleware(['manager']);
Route::get('/pay-receivable/{id}/{lid}', [ReceiptController::class, 'payReceivable'])->middleware(['manager']);
Route::post('/save-payment/{id}/{lid}', [ReceiptController::class, 'paymentsave'])->middleware(['manager']);
//Manager Route End














//Manager & tech Route Start
//add patient & create
Route::post('/CreatePatient/{lid}', [PatientController::class, 'store'])->name('CreatePatient');
Route::get('/create-patient/{lid}', [PatientController::class, 'create'])->middleware(['ManagerTechician']);
//show patient &search
Route::get('/show-patient/{id}', [PatientController::class, 'show'])->name('ShowPatient')->middleware(['ManagerTechician']);
Route::get('/search-patient/{id}', [PatientController::class, 'searchpatient'])->name('searchpatient')->middleware(['ManagerTechician']);
//edit patient
Route::get('/patient/{id}/edit/{lid}', [PatientController::class, 'edit'])->name('EditPatient')->middleware(['ManagerTechician']);
Route::post('/Patient-update/{id}', [PatientController::class, 'update'])->name('UpdatePatient')->middleware(['ManagerTechician']);
//show patinet examination
Route::get('/patient-examination/{id}/{lid}', [PatientController::class, 'showpatientexamination'])->middleware(['ManagerTechician']);
Route::get('/update-patient', [PatientController::class, 'show'])->middleware(['ManagerTechician']);
// add template
Route::get('/Template/{id}', [TemplateController::class, 'index'])->middleware(['ManagerTechician']);
Route::post('storeTemplate', [TemplateController::class, 'store'])->name('storeTemplate')->middleware(['ManagerTechician']);
Route::get('/allTemplate/{id}', [TemplateController::class, 'showAll'])->middleware(['ManagerTechician']);
//edit template
Route::get('/templateEdit/{template}/{id}', [TemplateController::class, 'edit'])->middleware(['ManagerTechician']);
Route::post('updateTemplate', [TemplateController::class, 'update'])->name('updateTemplate')->middleware(['ManagerTechician']);
//search examinations
Route::get('/search-examinations/{lid}', [PatientExaminationController::class, 'searchexam'])->middleware(['ManagerTechician']);

Route::get('/ShowAll-Examination/{id}', [PatientExaminationController::class, 'showallpatientexam'])->middleware(['ManagerTechician']);
Route::get('/print-receipt/{lid}', [ReceiptController::class, 'PrintReceipt'])->middleware(['ManagerTechician']);

//add doctor to examinations

Route::get('/doctor-Examination/{lid}', [PatientExaminationController::class, 'AddDoctor'])->middleware(['ManagerTechician']);
Route::get('/create-doctor/{lid}', [PatientExaminationController::class, 'CreateDoctor'])->middleware(['ManagerTechician']);
Route::post('/storeDoctor/{lid}', [PatientExaminationController::class, 'StoreDoctor'])->name('storeDoctor')->middleware(['ManagerTechician']);

//Manager & tech Route End














// tech Route Start
Route::get('/tech/dash', [TechnicianLabController::class, 'index']);
Route::get('/tech/dashboardHome/{id}', [TechnicianLabController::class, 'dashboardHome'])->name('dashboardHome');
Route::get('/dashboardHome/{id}', [ManagerLabController::class, 'dashboardHome'])->name('dashboardHome');
//create examination
Route::get('/create-examination/{lid}', [PatientExaminationController::class, 'index'])->name('examinationCreate')->middleware(['techician']);
Route::post('/create-examination/{lid}', [PatientExaminationController::class, 'store'])->name('CreateExamination')->middleware(['techician']);
Route::post('/create-examination-two/{lid}', [PatientExaminationController::class, 'storeTwo'])->name('CreateExaminationTwo')->middleware(['techician']);
// tech Route End








//patient Route Start
Route::get('/patient/dash', [PatientController::class, 'index'])->middleware(['patient']);
Route::get('/compare-examination/{id}', [PatientExaminationController::class, 'comparepatientexam'])->middleware(['patient']);
Route::get('/show-examination/{id}', [PatientExaminationController::class, 'showpatientexam']);
Route::get('/patient/Debt', [PatientExaminationController::class, 'Debt'])->middleware(['patient']);
Route::get('/show-dept/{lid}', [PatientExaminationController::class, 'showDebt'])->middleware(['patient']);
//patient Route End
















// test the lab tech ra
// Route::post('create/lab', function () {
// });


// The manager routes

//Route::get('/manager/home', function () {
//  return view('manager.index');
//});



// The lab routes

// Route::get('/lab/create', function () {
//     return view('lab.create');
// })->middleware(['manager']);


Route::get('/showlab', function () {
    return view('AdminUser.showlab');
});



// for testing
Route::get('/notifications', [HomeController::class, 'notification']);
