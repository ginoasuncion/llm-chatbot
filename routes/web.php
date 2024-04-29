<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\CreatePost;
use App\Livewire\SinglePost;
use App\Livewire\ManagePosts;
use App\Livewire\EditPost;
// use App\Livewire\ListPosts;
use App\Livewire\EditComment;
use App\Http\Controllers\ListPostsController;
use App\Http\Controllers\ManagePostsController;
use App\Http\Controllers\CreatePostController;
use App\Http\Controllers\SinglePostController;
use App\Http\Controllers\CommentListComponentController;
use App\Http\Controllers\EditCommentController;
use App\Http\Controllers\EditPostController;

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');


Auth::routes();
// // Backend routes
// Route::middleware(['auth'])->group(function () { 
//     Route::get('/create-post', CreatePost::class);
//     Route::get('/manage-posts', ManagePosts::class)->name('manage.posts'); 
//     Route::get('/post/{postId}', SinglePost::class)->name('single.post');
//     Route::get('/post/{postId}/edit', EditPost::class)->name('edit.post');
// });


// Backend routes
Route::middleware(['role:admin'])->group(function () { 
    // Route::get('/create-post', CreatePost::class)->name('create.post'); 
    // Route::get('/manage-posts', ManagePosts::class)->name('manage.posts'); 

    Route::get('/create-post', [CreatePostController::class, 'create'])->name('create.post');
    Route::post('/create-post', [CreatePostController::class, 'store']);
    Route::get('/manage-posts', [ManagePostsController::class, 'index'])->name('manage.posts');
    Route::delete('/manage-posts/delete-post/{postId}', [ManagePostsController::class, 'deletePost'])->name('manage-posts.delete-post');
    Route::delete('/manage-posts/delete-comment/{commentId}', [ManagePostsController::class, 'deleteComment'])->name('manage-posts.delete-comment');

    // Route::get('/post/{postId}', SinglePost::class)->name('single.post');
    Route::get('/posts/{postId}', [SinglePostController::class, 'show'])->name('single.post');
    // Route::get('/post/{postId}/edit', EditPost::class)->name('edit.post');

    Route::get('/posts/{postId}/comments', [CommentListComponentController::class, 'index'])->name('comments.index');
    Route::post('/posts/{postId}/comments', [CommentListComponentController::class, 'store'])->name('comments.store');

    // Route::get('/comment/{commentId}/edit', EditComment::class)->name('edit.comment');
    Route::get('/comments/{comment}/edit', [EditCommentController::class, 'edit'])->name('edit.comment');
    Route::put('/comments/{comment}', [EditCommentController::class, 'update'])->name('comments.update');


    // Define route for displaying the edit form
    Route::get('/posts/{postId}/edit', [EditPostController::class, 'edit'])->name('edit.post');

    // Define route for updating the post
    Route::put('/posts/{postId}', [EditPostController::class, 'update'])->name('update.post');

    // Define route for removing a photo
    Route::delete('/photos/{photoId}', [EditPostController::class, 'removePhoto'])->name('remove.photo');


});





Route::get('/posts/{postId}', [SinglePostController::class, 'show'])->name('single.post');



// Frontend Routes
Route::get('/', [ListPostsController::class, 'index'])->name('landing.page');
// Route::get('/posts', [ListPostsController::class, 'index'])->name('posts.index');

// Route::post('/', [ListPostsController::class, 'index'])->name('landing.page.search');

// Route::get('/', ListPosts::class)->name('landing.page'); 
// Route::get('/post/{postId}', SinglePost::class)->name('single.post');





// Route::get('/edit-post/{postId}', EditPost::class)->name('edit.post');

// Route::get('/', ListPosts::class)->name('landing.page');

// require __DIR__.'/auth.php';

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
