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

Auth::routes();
//Auth::routes(['verify' => true]); //use it when MustverifyMail
Route::middleware(['auth'])->group( function(){
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/candidat', [CandidatController::class, 'index'])->name('candidat');
    Route::post('/candidat', [CandidatController::class, 'store'])->name('candidat.store');
    
    Route::post('/candidat_update/{candidat}', [CandidatController::class, 'update'])->name('candidat_update');
    
    
    Route::get('/candidat_doc', [CandidatController::class, 'addDocuments'])->name('documents');
    Route::post('/candidat_doc', [CandidatController::class, 'store_addDocuments'])->name('documents.store');

    Route::get('/candidat_home', [CandidatController::class, 'candidatIndex'])->name('candidat.home');
    Route::get('/print',[CandidatController::class, 'print'])->name('print');
    Route::get('/show_uploaded_file/{document}',[CandidatController::class, 'show_uploaded_file'])->name('show_uploaded_file');
    Route::post('/document_archived/{document}',[CandidatController::class, 'document_archived']);
    Route::post('/document_restor/{document}',[CandidatController::class, 'document_restor']);

    Route::get('/document_edit/{document}',[CandidatController::class, 'document_edit'])->name('document_edit');
    //Route::post('/document_update/{document}',[CandidatController::class, 'document_update']);
    Route::post('/document_update',[CandidatController::class, 'document_update'])->name('document.update');
    Route::post('/document_store',[CandidatController::class, 'document_store'])->name('document.store');
    
    //http://localhost/master-multi-guard-auth/public/storage/uploads/
    Route::get('/storage/{folder}/{file}.pdf');
    
   
    //Route::group([ 'middleware' => ['role:superAdmin'],], function() {
    Route::middleware(['is_admin'])->group( function(){


        Route::get('/admin',[AdminController::class, 'index'])->name('admin');

        Route::get('students/{status}', [AdminController::class, 'indexusers']);

        Route::prefix('candidats')->group(function(){
            Route::get('/',[AdminController::class, 'candidats_detail'])->name('candidats');
        
            Route::get('/candidats_deleted',[AdminController::class, 'candidats_deleted_list'])->name('candidats_deleted');
            Route::post('/candidat_enable/{candidat}', [AdminController::class,'candidat_enable'])->name('candidat_enable');
            Route::post('/candidat_disable/{candidat}', [AdminController::class,'candidat_disable'])->name('candidat_disable');
            
            Route::get('/candidat_details/{candidat}',[AdminController::class, 'candidat_details'])->name('candidat_details');
            
            Route::patch('/candidatSetEtat/{candidat}',[AdminController::class, 'candidatUpdateEtat'])->name('candidat_setEtat');
            
            Route::post('/candidat_store/{candidat}', [AdminController::class, 'update_candidat'])->name('candidat_store');
        
            Route::get('/get_print/{candidat}',[CandidatController::class, 'admin_print'])->name('get_print');
        }); 
        Route::prefix('users')->group(function(){
            Route::get('/',[AdminController::class, 'users_list'])->name('users');
            Route::post('/user_disable/{user}', [AdminController::class,'user_disable'])->name('user_disable');
            Route::post('/user_enable/{user}', [AdminController::class,'user_enable'])->name('user_enable');
           

        }); 
        Route::group([ 'middleware' => ['role:superAdmin'],], function() {
            Route::get('/registeradmin', [AdminController::class, 'show_register']);
           // Route::get('/admin_register', [AdminRegisterController::class, 'show_register']);
            Route::post('/admin_register', [AdminController::class, 'create'])->name('admin_register');
            Route::get('/admins_list',[AdminController::class, 'admins_list'])->name('admins_list');

            
    
        });   
    });

});


