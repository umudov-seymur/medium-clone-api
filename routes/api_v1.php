<?php

use App\Http\Controllers\Api\V1\{
    AuthController,
    ArticleController,
    CommentController,
    FavoriteController,
    FeedController,
    FollowController,
    ProfileController,
    UserController,
    TagController
};
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.',], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::put('user', [UserController::class, 'update'])->name('user.update');

    Route::name('profiles.')->prefix('profiles/{user:username}')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');

        Route::post('/follow', [FollowController::class, 'follow'])->name('follow');
        Route::delete('/unfollow', [FollowController::class, 'unfollow'])->name('unfollow');
    });

    Route::group(['as' => 'articles.'], function () {
        Route::get('articles/feed', [FeedController::class, 'index'])->name('feed');

        Route::post('articles/{article:slug}/favorite', [FavoriteController::class, 'store'])->name('favorite');
        Route::delete('articles/{article:slug}/favorite', [FavoriteController::class, 'destroy'])->name('unfavorite');;
    });

    Route::apiResource('articles', ArticleController::class);
    Route::apiResource('articles.comments', CommentController::class)->except('show');

    Route::get('tags', [TagController::class, 'index'])->name('tags.index');
});
