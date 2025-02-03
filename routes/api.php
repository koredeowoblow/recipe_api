<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Recipes
    Route::get('recipes', [RecipeController::class, 'index']);
    Route::post('recipes', [RecipeController::class, 'store']);
    Route::get('recipes/{id}', [RecipeController::class, 'show']);
    Route::put('recipes/{id}', [RecipeController::class, 'update']);
    Route::delete('recipes/{id}', [RecipeController::class, 'destroy']);

    // Comments
    Route::post('recipes/{id}/comments', [CommentController::class, 'store']);
    Route::delete('comments/{id}', [CommentController::class, 'destroy']);

    // Ratings
    Route::post('recipes/{id}/ratings', [RatingController::class, 'store']);

    // Favorites
    Route::post('recipes/{id}/favorite', [FavoriteController::class, 'toggleFavorite']);
    Route::get('favorites', [FavoriteController::class, 'getFavorites']);

    // Follow System
    Route::post('users/{id}/follow', [FollowController::class, 'toggleFollow']);
    Route::get('followers', [FollowController::class, 'getFollowers']);
    Route::get('following', [FollowController::class, 'getFollowing']);
    
    // profile 
    Route::get('profile',[AuthController::class,'Profile']);
    Route::put('profile',[AuthController::class,'updateProfile']);
});
