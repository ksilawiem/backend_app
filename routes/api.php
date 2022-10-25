<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\QuizAnswerController;
use App\Http\Controllers\TookedController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\OffreQuestionController;
use App\Http\Controllers\OffreAnswerController;
use App\Http\Controllers\PostulerController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignOutController;
use App\Http\Controllers\Auth\MeController;
use App\Http\Middleware\CheckApiToken;
use App\Http\Middleware\JwtMiddleware;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([ 'prefix' => 'auth' , 'namespace' => 'Auth'], function(){
     Route::post('signin', [SignInController::class , '__invoke']); 
     route::middleware([JwtMiddleware::class])->group(function(){
     Route::post('signout', [SignOutController::class , '__invoke']);
     Route::get('me', [MeController::class , '__invoke']);
     Route::get('/offres', [OffreController::class,'all']);
    });
});

    Route::get('refresh', [JwtMiddleware::class,'refresh']);
// Route::group([ 'prefix' => 'auth' , 'namespace' => 'Auth'], function(){
//     Route::post('signin', [SignInController::class , '__invoke']); 
//     Route::post('signout', [SignOutController::class , '__invoke']);
//     Route::get('me', [MeController::class , '__invoke']);
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/users/create', [UserController::class, 'create']);

Route::post('/users/login', [UserController::class, 'logIn']);

Route::get('/users', [UserController::class, 'all']);

Route::put('/passwordreset/users/{id}', [UserController::class, 'resetPassowrd']);

Route::put('/updateprofil/users/{id}', [UserController::class, 'updateProfil']);

Route::get('/verification/users/{id}', [UserController::class, 'Verification']);

Route::get('/sendMail/users/{user_id}', [UserController::class, 'sendMail']);

Route::put('/resubcribe/users/{user_id}', [UserController::class, 'resubcribe']);

Route::get('/unverify/users/{user_id}', [UserController::class, 'unverify']);

Route::get('/forgetpassword/users/{email}', [UserController::class, 'forgetPassword']);

Route::get('/users/{id}', [UserController::class, 'getUserById']);

// Route::get('/users/role', [UserController::class, 'getUserByRole']);

Route::put('/update-photo/user/{id}' , [UserController::class,'updatePhoto']);

Route::delete('/users/{id}' , [UserController::class,'delete']);

Route::post('/categorie', [CategorieController::class,'create']);

Route::get('/categories', [CategorieController::class,'show']);

Route::get('/categorie/{id}', [CategorieController::class,'showbyid']);

Route::put('/categorie/{id}/update' , [CategorieController::class,'update']);

Route::delete('/categorie/{id}/delete' , [CategorieController::class,'destroy']);

Route::post('/add-test/{id}', [TestController::class,'addTest']);

Route::get('/test/{id}', [TestController::class,'getTestById']);

Route::put('/test/{id}', [TestController::class,'updateTest']);

Route::get('/test/categorie/{cat_id}', [TestController::class,'getTestByCat']);

Route::delete('/test/{id}' , [TestController::class,'delete']);

Route::post('/quiz-question/{id}', [QuizQuestionController::class,'add']);

Route::get('/quiz-question/{id}', [QuizQuestionController::class,'getQuestionById']);

Route::put('/quiz-question/update/{id}', [QuizQuestionController::class,'updateQuestion']);

Route::get('/quiz-question/test/{test_id}', [QuizQuestionController::class,'getQuestionsByTest']);

Route::delete('/quiz-question/{id}' , [QuizQuestionController::class,'delete']);

Route::post('/quiz-answer/test/{test_id}/question/{question_id}', [QuizAnswerController::class,'add']);

Route::get('/quiz-answer/{id}', [QuizAnswerController::class,'getAnswerById']);

Route::put('/quiz-answer/update/{id}', [QuizAnswerController::class,'updateAnswer']);

Route::get('/quiz-answer/test/{test_id}/question/{question_id}', [QuizAnswerController::class,'getAnswersByQuestion']);

Route::delete('/quiz-answer/{id}' , [QuizAnswerController::class,'delete']);

Route::post('/take-test/user/{user_id}/test/{test_id}', [TookedController::class,'create']);

Route::post('/take-test/{took_id}/answer/{answer_id}', [TookedController::class,'checkAnswer']);

Route::get('/take-test/{took_id}', [TookedController::class,'getTookById']);

Route::get('/take-test/user/{user_id}', [TookedController::class,'getTookByUser']);

Route::delete('/take-test/{id}' , [TookedController::class,'delete']);

Route::post('/add-offre/user/{user_id}', [OffreController::class,'addOffre']);



Route::get('/offre/{id}', [OffreController::class,'getOffreById']);

Route::get('/offre/user/{user_id}', [OffreController::class,'getOffreByUser']);

Route::put('/offre/update/{id}', [OffreController::class,'updateOffre']);

Route::delete('/offre/{id}' , [OffreController::class,'delete']);

Route::put('/offre-question/update/{id}', [OffreQuestionController::class,'updateOffreQuestion']);

Route::post('/offre-question/{id}', [OffreQuestionController::class,'add']);

Route::get('/offre-question/{id}', [OffreQuestionController::class,'getQuestionById']);

Route::get('/offre-question/offre/{offre_id}', [OffreQuestionController::class,'getQuestionsByOffre']);

Route::delete('/offre-question/{id}' , [OffreQuestionController::class,'delete']);

Route::post('/offre-answer/offre/{offre_id}/question/{question_id}', [OffreAnswerController::class,'add']);

Route::get('/offre-answer/{id}', [OffreAnswerController::class,'getAnswerById']);

Route::get('/offre-answer/offre/{offre_id}/question/{question_id}', [OffreAnswerController::class,'getAnswersByQuestion']);

Route::put('/offre-answer/update/{id}', [OffreAnswerController::class,'updateOffreAnswer']);

Route::delete('/offre-answer/{id}' , [OffreAnswerController::class,'delete']);

Route::post('/postuler/user/{user_id}/offre/{offre_id}', [PostulerController::class,'create']);

Route::post('/postuler/{offre_id}/answer/{answer_id}', [PostulerController::class,'checkAnswer']);

Route::get('/postuler/{id}', [PostulerController::class,'getPostById']);

Route::get('/postuler/user/{user_id}', [PostulerController::class,'getPostByUser']);

Route::get('/postuler/offre/{offre_id}', [PostulerController::class,'getPostByOffre']);

Route::delete('/postuler/{id}' , [PostulerController::class,'delete']);

Route::post('/domaine/user/{user_id}', [DomaineController::class,'create']);

Route::get('/domaine/user/{user_id}', [DomaineController::class,'getDomaineByUser']);

Route::put('/domaine/{id}' , [DomaineController::class,'updateDomaine']);

Route::delete('/domaine/{id}' , [DomaineController::class,'delete']);

Route::post('/experience/user/{user_id}', [ExperienceController::class,'create']);

Route::get('/experience/user/{user_id}', [ExperienceController::class,'getExperienceByUser']);

Route::put('/experience/{id}' , [ExperienceController::class,'updateExperience']);

Route::delete('/experience/{id}' , [ExperienceController::class,'delete']);

Route::post('/formation/user/{user_id}', [FormationController::class,'create']);

Route::get('/formation/user/{user_id}', [FormationController::class,'getFormationByUser']);

Route::put('/formation/{id}' , [FormationController::class,'updateFormation']);

Route::delete('/formation/{id}' , [FormationController::class,'delete']);