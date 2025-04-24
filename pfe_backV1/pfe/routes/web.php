<?php

use Illuminate\Support\Facades\Route;

// Responsable routes use
use App\Http\Controllers\espace_responsable\create_account\CreatAccountController;
use App\Http\Controllers\espace_responsable\create_account\CreatAccountResponsableController;
use App\Http\Controllers\espace_responsable\create_account\CreatAccountTechnicienController;
use App\Http\Controllers\espace_responsable\updaye_account\UpdateAccountResponsableController;
use App\Http\Controllers\espace_responsable\updaye_account\UpdateAccountTechnicienController;
use App\Http\Controllers\espace_responsable\updaye_account\UpdateAccountController;
use App\Http\Controllers\espace_responsable\authentification\AuthResponsableController;
use App\Http\Controllers\espace_responsable\dashboard\ResponsableDashboardController;
use App\Http\Controllers\espace_technicien\dashboard\TechnicienDashboardController;

use App\Http\Controllers\ProduitController;



//Technicien routes use
use App\Http\Controllers\espace_technicien\authentification\AuthTechnicienController;




Route::get('/', function () {
    return view('welcome');
});


// Routes pour l'espace responsable
Route::prefix('espace-responsable')->group(function () {
    // Page de connexion
    Route::get('/login', [AuthResponsableController::class, 'ViewPage'])
         ->name('responsable.login.page')
         ->middleware('guest:responsable');

    // Traitement de la connexion
    Route::post('/login', [AuthResponsableController::class, 'login'])
         ->name('responsable.login');

    // Déconnexion
    Route::post('/logout', [AuthResponsableController::class, 'logout'])
         ->name('responsable.logout');

    // Tableau de bord (protégé par auth)
    Route::get('/dashboard', [ResponsableDashboardController::class, 'index'])
         ->name('responsable.dashboard')
         ->middleware('auth:responsable');
});

Route::prefix('espace-responsable')->group(function () {
    
    
    Route::middleware(['auth:responsable'])->group(function () {
        Route::get('/dashboard', [ResponsableDashboardController::class, 'index'])
             ->name('responsable.dashboard');
    });
});


// Routes pour l'espace technicien
Route::prefix('espace-technicien')->group(function () {
    // Page de connexion
    Route::get('/login', [AuthTechnicienController::class, 'ViewPage'])
         ->name('technicien.login.page')
         ->middleware('guest:technicien');

    // Traitement de la connexion
    Route::post('/login', [AuthTechnicienController::class, 'login'])
         ->name('technicien.login');

    // Déconnexion
    Route::post('/logout', [AuthTechnicienController::class, 'logout'])
         ->name('technicien.logout');
});

// Routes protégées par authentification technicien
Route::prefix('espace-technicien')->middleware(['auth:technicien'])->group(function () {
    // Tableau de bord
    Route::get('/dashboard', [TechnicienDashboardController::class, 'index'])
         ->name('technicien.dashboard');
    
    
});


/*****************************************************************************************************************ROUTES RESPONSABLES */

/*****ROUTES POUR CREER UN COMPTE RESPONSABLE */

/* Affichage de page creation compte */
Route::get('/espace_responsable/creation_compte', [CreatAccountController::class, 'ViewPage'])->name('createAccount_view');

/* Affichage de page creation compte responsable */
Route::get('/espace_responsable/creation_compte/creation_compte_pour_responsable', [CreatAccountResponsableController::class, 'ViewPage'])->name('createResponsable');
Route::post('/espace_responsable/creation_compte/creation_compte_pour_responsable', [CreatAccountResponsableController::class, 'CreateResponsable'])->name('createResponsable');

/* Affichage de page creation compte technicien */
Route::get('/espace_responsable/creation_compte/creation_compte_pour_technicien', [CreatAccountTechnicienController::class, 'ViewPage'])->name('createTechnicien');
Route::post('/espace_responsable/creation_compte/creation_compte_pour_technicien', [CreatAccountTechnicienController::class, 'CreateTechnicien'])->name('createTechnicien');

/*Affichage d'authentification*/
Route::get('/authentification_responsable', [AuthResponsableController::class, 'ViewPage'])->name('auth_resp_view');

/*Update users account*/
Route::get('/espace_responsable/modifier_compte', [UpdateAccountController::class, 'ViewPage'])->name('UpdateAccount_view');
//respoansable
Route::get('/espace_responsable/modifier_compte/modifier_compte_responsable', [ UpdateAccountResponsableController::class, 'ViewPage'])->name('updateResponsable');
Route::post('/espace_responsable/modifier_compte/modifier_compte_responsable', [UpdateAccountResponsableController::class, 'UpdateResponsable'])->name('updateResponsable');
//technicien
Route::get('/espace_responsable/modifier_compte/modifier_compte_technicien', [UpdateAccountTechnicienController::class, 'ViewPage'])->name('updateTechnicien');
Route::post('/espace_responsable/modifier_compte/modifier_compte_technicien', [UpdateAccountTechnicienController::class, 'UpdateTechnicien'])->name('updateTechnicien');

// Pour les techniciens
Route::resource('techniciens', 'TechnicienController');
// Pour les responsables
Route::resource('responsables', 'ResponsableController');





/*****************************************************************************************************************ROUTES TECHNICIENS */
/*Routes d'authentification  */
Route::get('/authentification_technicien', [AuthTechnicienController::class, 'ViewPage'])->name('auth_tech_view');
Route::get('/authentification_responsable', [AuthResponsableController::class, 'ViewPage'])->name('auth_resp_view');

/*************Routes des produits***************/
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/creer', [ProduitController::class, 'create'])->name('produits.create');
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
Route::get('/produits/{produit}/modifier', [ProduitController::class, 'edit'])->name('produits.edit');
Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');
Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');




