<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('pages.dashboard');
// });

Route::get('/', function () {
    return redirect()->route('index');
});

//🏀 CONNEXION ZONE //
Route::controller(AuthController::class)
// START \\
->group(function () {
    Route::post('/authentification', 'authentification')->name('authentification');
    Route::get('/logout/{id}', 'logout')->name('logout');
});
//🏀 END CONNEXION ZONE //


//🏀 CONNEXION PAGE ZONE //
Route::controller(AdminController::class)
// START \\
->group(function () {
    Route::get('/login', 'login')->name('login');
});
//🏀 END CONNEXION PAGE ZONE //


//🏀 REQUEST ZONE //
Route::controller(AdminController::class)
->middleware('auth')
// START \\
->group(function () {
    Route::get('/Welcome', 'dashboard')->name('index');
    Route::get('/Profile', 'profile')->name('dashboard.profile');

/*/ ❌ School Request ❌ /*/
    Route::get('/Ajouter.une.école', 'add_new_school_page')->name('dashboard.add_school');
    Route::post('/add_new_school_request', 'add_new_school_request')->name('dashboard.add_school_request');
    Route::get('/Modifier.une.école/{id}', 'edit_new_school')->name('dashboard.edit_school');
    Route::post('/update_new_school_request/{id}', 'update_school_request')->name('dashboard.update_school_request');
    Route::get('/delete_new_school_request/{id}', 'delete_new_school')->name('dashboard.delete_new_school');
    Route::get('/Liste.école', 'liste_school')->name('dashboard.liste_school');
/*/ ❌ School Request ❌ /*/

/*/ ❌ Role Request ❌ /*/
    Route::get('/Ajouter.un.rôle', 'add_new_role_page')->name('dashboard.add_role');
    Route::post('/add_new_role_request', 'add_new_role_request')->name('dashboard.add_role_request');
    Route::get('/Modifier.un.rôle/{id}', 'edit_new_role')->name('dashboard.edit_role');
    Route::post('/update_new_role_request/{id}', 'update_role_request')->name('dashboard.update_role_request');
    Route::get('/delete_new_role_request/{id}', 'delete_new_role')->name('dashboard.delete_new_role');
    Route::get('/Liste.rôle', 'liste_role')->name('dashboard.liste_role');
/*/ ❌ Role Request ❌ /*/

/*/ ❌ Classe Request ❌ /*/
    Route::get('/Ajouter.une.classe', 'add_new_classroom_page')->name('dashboard.add_classroom');
    Route::post('/add_new_classroom_request', 'add_new_classroom_request')->name('dashboard.add_classroom_request');
    Route::get('/Modifier.une.classe/{id}', 'edit_new_classroom')->name('dashboard.edit_classroom');
    Route::post('/update_new_classroom_request/{id}', 'update_classroom_request')->name('dashboard.update_classroom_request');
    Route::get('/delete_new_classroom_request/{id}', 'delete_new_classroom')->name('dashboard.delete_new_classroom');
    Route::get('/Liste.classe', 'liste_classroom')->name('dashboard.liste_classroom');
/*/ ❌ Classe Request ❌ /*/

/*/ ❌ Scolarite Request ❌ /*/
    Route::get('/Ajouter.une.scolarite', 'add_new_scolarite_page')->name('dashboard.add_scolarite');
    Route::post('/add_new_scolarite_request', 'add_new_scolarite_request')->name('dashboard.add_scolarite_request');
    Route::get('/Modifier.une.scolarite/{id}', 'edit_new_scolarite')->name('dashboard.edit_scolarite');
    Route::post('/update_new_scolarite_request/{id}', 'update_scolarite_request')->name('dashboard.update_scolarite_request');
    Route::get('/delete_new_scolarite_request/{id}', 'delete_new_scolarite')->name('dashboard.delete_new_scolarite');
    Route::get('/Liste.scolarite', 'liste_scolarite')->name('dashboard.liste_scolarite');
/*/ ❌ Scolarite Request ❌ /*/

/*/ ❌ Niveau Etude Request ❌ /*/
    Route::get('/Ajouter.un.niveau.etude', 'add_new_niveau_etude_page')->name('dashboard.add_niveau_etude');
    Route::post('/add_new_niveau_etude_request', 'add_new_niveau_etude_request')->name('dashboard.add_niveau_etude_request');
    Route::get('/Modifier.un.niveau.etude/{id}', 'edit_new_niveau_etude')->name('dashboard.edit_niveau_etude');
    Route::post('/update_new_niveau_etude_request/{id}', 'update_niveau_etude_request')->name('dashboard.update_niveau_etude_request');
    Route::get('/delete_new_niveau_etude_request/{id}', 'delete_new_niveau_etude')->name('dashboard.delete_new_niveau_etude');
    Route::get('/Liste.niveau.etude', 'liste_niveau_etude')->name('dashboard.liste_niveau_etude');
/*/ ❌ Niveau Etude Request ❌ /*/

/*/ ❌ Account Request ❌ /*/
    Route::get('/Ajouter.un.compte', 'add_new_admin_account_page')->name('dashboard.add_admin_account');
    Route::post('/add_new_admin_account_request', 'add_new_admin_account_request')->name('dashboard.add_admin_account_request');
    Route::post('/check_user_account', 'check_user_account')->name('dashboard.check_user_account');
    Route::get('/Modifier.un.compte/{id}', 'edit_new_admin_account')->name('dashboard.edit_admin_account');
    Route::post('/update_new_admin_account_request/{id}', 'update_admin_account_request')->name('dashboard.update_admin_account_request');
    Route::get('/delete_new_admin_account_request/{id}', 'delete_new_admin_account')->name('dashboard.delete_new_admin_account');
    Route::get('/Liste.admin', 'liste_admin_account')->name('dashboard.liste_admin_account');
/*/ ❌ Account Request ❌ /*/

/*/ ❌ Register Student Request ❌ /*/
    Route::get('/Faire.une.inscription', 'add_new_student_page')->name('dashboard.add_student');
    Route::post('/add_new_student_request', 'add_new_student_request')->name('dashboard.add_student_request');
    Route::get('/Modifier.une.inscription/{id}', 'edit_new_student')->name('dashboard.edit_student');
    Route::post('/update_new_student_request/{id}', 'update_student_request')->name('dashboard.update_student_request');
    Route::get('/delete_new_student_request/{id}', 'delete_new_student')->name('dashboard.delete_new_student');
    Route::get('/Liste.des.inscriptions', 'liste_student')->name('dashboard.liste_student');
/*/ ❌ Register Student Request ❌ /*/

//🏀 END REQUEST ZONE //

});
