<?php

use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CandidatController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRegisterController;
//switch languges
Route::get('locale/{locale}',function($locale){
    Session::put('locale',$locale);    
    return redirect()->back();
})->name('switchLan');  //switch languges

//Default route
Route::get('/', function () {
    return view('welcome');
})->name('/');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group( function(){
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/candidat', [CandidatController::class, 'index'])->name('candidat');
    Route::post('/candidat', [CandidatController::class, 'store'])->name('candidat.store');
    
    Route::get('/candidat_doc', [CandidatController::class, 'addDocuments'])->name('documents');
    Route::post('/candidat_doc', [CandidatController::class, 'store_addDocuments'])->name('documents.store');

    Route::get('/student_home', [CandidatController::class, 'candidatIndex'])->name('candidat.home');
    Route::get('/print',[CandidatController::class, 'print'])->name('print');
    Route::get('/show_uploaded_file/{document}',[CandidatController::class, 'show_uploaded_file'])->name('show_uploaded_file');
    
    //http://localhost/master-multi-guard-auth/public/storage/uploads/
    Route::get('/storage/{folder}/{file}.pdf');
    
   
    //Route::group([ 'middleware' => ['role:superAdmin'],], function() {
    Route::middleware(['is_admin'])->group( function(){
       
         
      

        Route::get('/admin',[AdminController::class, 'index'])->name('admin');
        Route::prefix('candidats')->group(function(){
            Route::get('/',[AdminController::class, 'candidats_list'])->name('candidats');

        }); 
        Route::prefix('users')->group(function(){
            Route::get('/',[AdminController::class, 'users_list'])->name('users');

        }); 
        Route::group([ 'middleware' => ['role:superAdmin'],], function() {
            Route::get('/registeradmin', [AdminController::class, 'show_register']);
           // Route::get('/admin_register', [AdminRegisterController::class, 'show_register']);
            Route::post('/admin_register', [AdminController::class, 'create'])->name('admin_register');
            Route::get('/admins_list',[AdminController::class, 'admins_list'])->name('admins_list');
    
        });   
    });

});


