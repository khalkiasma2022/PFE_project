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
use App\Http\Controllers\espace_responsable\ListeUtilisateurController ;
use App\Http\Controllers\espace_responsable\Update_mdp\UpdateMdpController;
use App\Http\Controllers\ProduitController;











//Technicien routes use
use App\Http\Controllers\espace_technicien\authentification\AuthTechnicienController; //controller pour l'authentification des techniciens
use App\Http\Controllers\espace_technicien\consulter_liste_produit\ConsulterListeProduitTechController; //controller pour consulter la liste des produits tech
use App\Http\Controllers\espace_technicien\gestion_analyse\ListeEtapeController; //controller pour afficher la liste des étapes d'analyse
use App\Http\Controllers\espace_technicien\Update_mdp\UpdateMdpController as UpdateMdpTech; //controller pour changer le mot de passe des techniciens
use App\Http\Controllers\espace_technicien\gestion_analyse\RefonteBruteController; //controller pour la refonte brute
use App\Http\Controllers\espace_technicien\gestion_analyse\ChaulageController; //controller pour la refonte brute
use App\Http\Controllers\espace_technicien\gestion_analyse\RefonteEpureeController; //controller pour la refonte épurée
use App\Http\Controllers\espace_technicien\gestion_analyse\RefonteDecoloreeController; //controller pour la refonte décolorée
use App\Http\Controllers\espace_technicien\gestion_analyse\EvapurationController; //controller pour l'évapuration
use App\Http\Controllers\espace_technicien\gestion_analyse\PremierCarboController; //controller pour la première carbonisation
use App\Http\Controllers\espace_technicien\gestion_analyse\DeuxiemeCarboController; //controller pour la deuxième carbonisation
use App\Http\Controllers\espace_technicien\gestion_analyse\CristalisationController; //controller pour le chaulage
use App\Http\Controllers\espace_technicien\historique_analyse\HistoriqueAnalyseTechController; //controller pour l'historique des analyses
use App\Http\Controllers\espace_technicien\gestion_analyse\LotController; //controller pour la gestion des lots











Route::get('/', function () {return view('welcome');})->name('first_page'); // Page d'accueil hethy awel page tjyk
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
});
// Routes protégées par authentification responsable
Route::prefix('espace-responsable')->middleware(['auth:responsable'])->group(function () {
    // Tableau de bord
    Route::get('/dashboard', [ResponsableDashboardController::class, 'index'])
         ->name('responsable.dashboard');
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

/*Route pour changer le mot de passe*/
Route::get('/espace_responsable/modifier_mdp', [UpdateMdpController::class, 'ViewPage'])->name('update_mdp_view_resp');
Route::post('/espace_responsable/modifier_mdp', [UpdateMdpController::class, 'updatePassword'])->name('update_mdp_action_resp');
/*Affichage de page gestion utilisateurs*/
Route::get('/espace_responsable/gestion_utilisateurs', [ListeUtilisateurController::class, 'ViewPage'])->name('gestion_utilisateurs_view');





// Pour les techniciens
Route::resource('techniciens', 'TechnicienController');
// Pour les responsables
Route::resource('responsables', 'ResponsableController');










/*****************************************************************************************************************ROUTES TECHNICIENS */
/*Routes d'authentification  */
Route::get('/authentification_technicien', [AuthTechnicienController::class, 'ViewPage'])->name('auth_tech_view');
Route::get('/authentification_responsable', [AuthResponsableController::class, 'ViewPage'])->name('auth_resp_view');

/*Route pour changer le mot de passe*/
Route::get('/espace_technicien/modifier_mdp', [UpdateMdpTech::class, 'ViewPage'])->name('update_mdp_view');
Route::post('/espace_technicien/modifier_mdp', [UpdateMdpTech::class, 'updatePassword'])->name('update_mdp_action');

/*Route pour liste des produits*/
Route::get('/espace_technicien/liste_produit', [ConsulterListeProduitTechController::class, 'liste_produit_tech'])->name('liste_produit_tech_view');
Route::get('/espace_technicien/liste_produit/{produit}', [ConsulterListeProduitTechController::class, 'show'])->name('produit_show_tech');

/*route pour gestion des lots*/
Route::get('/espace_technicien/Processus_de_Production', [LotController::class, 'ViewPage'])->name('gestion_lot_view');
Route::get('/espace_technicien/Processus_de_Production/Nouveau_lot/Refonte_Brute', [RefonteBruteController::class, 'ViewPageNewLotRefonte'])->name('refonte_brute_view_lot');
Route::post('/espace_technicien/Processus_de_Production/Nouveau_lot/Refonte_Brute', [RefonteBruteController::class, 'AjouteRefonteBrute_lot'])->name('refonte_brute_ajouter_lot');

/*Route pour gestion d'analyse*/
Route::get('/espace_technicien/Processus_de_Production/liste_etape', [ListeEtapeController::class, 'ViewPage'])->name('liste_etape_view');
Route::get('/espace_technicien/Processus_de_Production/liste_etape/Refonte_Brute', [RefonteBruteController::class, 'ViewPage'])->name('refonte_brute_view');
Route::post('/espace_technicien/Processus_de_Production/liste_etape/Refonte_Brute', [RefonteBruteController::class, 'AjouteRefonteBrute'])->name('refonte_brute_ajouter');

Route::get('/espace_technicien/Processus_de_Production/liste_etape/Chaulage', [ChaulageController::class, 'ViewPage'])->name('chaulage_view');
Route::post('/espace_technicien/Processus_de_Production/liste_etape/Chaulage', [ChaulageController::class, 'AjouteChaulage'])->name('chaulage_ajouter');

Route::get('/espace_technicien/Processus_de_Production/liste_etape/Premier_carbonitation', [PremierCarboController::class, 'ViewPage'])->name('premier_carbo_view');
Route::post('/espace_technicien/Processus_de_Production/liste_etape/Premier_carbonitation', [PremierCarboController::class, 'enregistrerAnalyse'])->name('premier_carbo_ajouter');

Route::get('/espace_technicien/Processus_de_Production/liste_etape/Deuxieme_carbonitation', [DeuxiemeCarboController::class, 'ViewPage'])->name('deu_carbo_view');
Route::post('/espace_technicien/Processus_de_Production/liste_etape/Deuxieme_carbonitation', [DeuxiemeCarboController::class, 'enregistrerAnalyse'])->name('deu_carbo_ajouter');

Route::get('/espace_technicien/Processus_de_Production/liste_etape/Refonte_epuree', [RefonteEpureeController::class, 'ViewPage'])->name('Refonte_epuree_view');
Route::post('/espace_technicien/Processus_de_Production/liste_etape/Refonte_epuree', [RefonteEpureeController::class, 'AjouteAnalyse'])->name('refonte_epuree_ajouter');

Route::get('/espace_technicien/Processus_de_Production/liste_etape/Refonte_decoloree', [RefonteDecoloreeController::class, 'ViewPage'])->name('Refonte_decoloree_view');
Route::post('/espace_technicien/Processus_de_Production/liste_etape/Refonte_decoloree', [RefonteDecoloreeController::class, 'AjouteAnalyse'])->name('refonte_decoloree_ajouter');

Route::get('/espace_technicien/Processus_de_Production/liste_etape/Evapuration', [EvapurationController::class, 'ViewPage'])->name('evapuration_view');
Route::post('/espace_technicien/Processus_de_Production/liste_etape/Evapuration', [EvapurationController::class, 'AjouteAnalyse'])->name('evapuration_ajouter');

Route::get('/espace_technicien/Processus_de_Production/liste_etape/Cristalisation', [CristalisationController::class, 'ViewPage'])->name('cristalisation_view');


/*Route pour l'historique des analyses*/
Route::get('/espace_technicien/historique_analyse', [HistoriqueAnalyseTechController::class, 'AfficherHistorique'])->name('historique_analyse_view');
Route::get('/espace_technicien/historique_analyse/detail_historique', [HistoriqueAnalyseTechController::class, 'DetailHistorique_ViewPage'])->name('detail_historique_view');
//Route::post('/espace_technicien/historique_analyse', [HistoriqueAnalyseTechController::class, 'AfficherHistorique'])->name('AfficherHistorique');







/***************************************************************************************************Routes des produits*/
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/creer', [ProduitController::class, 'create'])->name('produits.create'); // Afficher le formulaire de création create.bade.php
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
Route::get('/produits/{produit}/modifier', [ProduitController::class, 'edit'])->name('produits.edit');
Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');
Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');




