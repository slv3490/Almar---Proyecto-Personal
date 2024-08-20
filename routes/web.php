<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

Route::get("/", [IndexController::class, "index"])->name("index");
Route::get("/cursos", [IndexController::class, "cursos"])->name("cursos");
Route::get('/iniciar-sesion', [UserController::class, "session"])->name("iniciar-session");
Route::get('/user/create', [UserController::class, "create"])->name("user.create");
Route::get('/user/remember', [UserController::class, "remember"])->name("user.remember");
Route::get("/articles/meditation", [ArticlesController::class, "articleMeditation"])->name("article.meditation");
Route::get("/articles/exercise", [ArticlesController::class, "articleExercise"])->name("article.exercise");
Route::get("/articles/hobbies", [ArticlesController::class, "articleHobbies"])->name("article.hobbies");


Route::middleware('auth')->group(function () {
    //PAYPAL
    Route::get('/create-payment', [PaymentController::class, 'createPayment'])->name('payment.create');
    Route::get('/payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment-cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
    //User Profile
    Route::get("/user/profile", [UserController::class, "userProfile"])->name("user.profile");
    Route::put("/user/profile", [UserController::class])->name("update.user.profile");
    Route::delete("/user/profile/delete-account/{id}", [UserController::class, "deleteUserAccount"])->middleware("user.has.not.permission:spectator")->name("delete.user.account");
    //show
    Route::get("/dashboard", [DashboardController::class, "dashboard"])->name("dashboard");
    //Users ->middleware("user.has.any.permission:")
    Route::middleware("user.has.role:admin,spectator")->group(function() {
        Route::get("/dashboard/users", [UserController::class, "index"])->name("users.index");
        Route::get("/dashboard/users/update-roles/{id}", [UserController::class, "showUsersRoles"])->middleware("user.has.any.permission:read roles,spectator")->name("users.show-roles");
        Route::put("/dashboard/users/update-roles/{id}", [UserController::class, "updateUsersRoles"])->middleware("user.has.any.permission:update roles")->name("users.update-roles");
    });
    //Roles
    Route::get("/dashboard/roles", [RolesController::class, "index"])->middleware("user.has.any.permission:read roles,spectator")->name("roles.index");
    Route::get("/dashboard/create-roles", [RolesController::class, "createRoles"])->middleware("user.has.any.permission:read roles,spectator")->name("create-roles");
    Route::post("/dashboard/create-roles", [RolesController::class, "storeRoles"])->middleware("user.has.any.permission:create roles")->name("store-roles");
    Route::get("/dashboard/update-roles/{id}", [RolesController::class, "showRoles"])->middleware("user.has.any.permission:read roles,spectator")->name("show-roles");
    Route::put("/dashboard/update-roles/{id}", [RolesController::class, "updateRoles"])->middleware("user.has.any.permission:update roles")->name("update-roles");
    Route::delete("/dashboard/delete-role/{id}", [RolesController::class, "deleteRole"])->middleware("user.has.any.permission:delete roles")->name("delete-roles");
    //Courses
    Route::get("/dashboard/courses", [CourseController::class, "index"])->middleware("user.has.any.permission:read lessons,spectator")->name("course.index");
    Route::get("/courses/{courseUrl}/watch/{lesson}", [CourseController::class, "watchCourse"])->middleware("user.has.any.permission:read lessons,spectator")->name("courses.watch");
    
    Route::get("/dashboard/courses/create-courses", [CourseController::class, "createCourses"])->middleware("user.has.any.permission:read lessons,spectator")->name("create-courses");
    Route::post("/dashboard/courses/create-courses", [CourseController::class, "storeCourses"])->middleware("user.has.any.permission:create lessons")->name("store-courses");
    Route::get("/dashboard/courses/update-courses/{id}", [CourseController::class, "showCourses"])->middleware("user.has.any.permission:read lessons,spectator")->name("show-courses");
    Route::put("/dashboard/courses/update-courses/{id}", [CourseController::class, "updateCourses"])->middleware("user.has.any.permission:update lessons")->name("update-courses");
    Route::delete("/dashboard/courses/delete-courses/{id}", [CourseController::class, "deleteCourses"])->middleware("user.has.any.permission:delete lessons")->name("delete-courses");
    //Lessons
    Route::get("/dashboard/lessons", [LessonController::class, "index"])->name("lessons.index"); //NO TIENE NADA
    Route::get("/dashboard/courses/{courseUrl}/overview", [LessonController::class, "lesson"])->middleware("user.has.any.permission:read lessons,spectator")->name("lesson.lesson");
    Route::get("/dashboard/courses/{courseId}/create-lessons", [LessonController::class, "createLessons"])->middleware("user.has.any.permission:read lessons,spectator")->name("create-lessons");
    Route::post("/dashboard/courses/{courseId}/create-lessons", [LessonController::class, "storeLessons"])->middleware("user.has.any.permission:create lessons")->name("store-lessons");
    Route::get("/dashboard/courses/{courseUrl}/update-lessons/{id}", [LessonController::class, "showLessons"])->middleware("user.has.any.permission:read lessons,spectator")->name("show-lessons");
    Route::put("/dashboard/courses/{courseUrl}/update-lessons/{id}", [LessonController::class, "updateLessons"])->middleware("user.has.any.permission:update lessons,spectator")->name("update-lessons");
    Route::delete("/courses/{courseUrl}/delete-lessons/{id}", [LessonController::class, "deleteLessons"])->middleware("user.has.any.permission:delete lessons")->name("delete-lessons");
    //Categories
    Route::get("/dashboard/categories", [CategoryController::class, "index"])->middleware("user.has.any.permission:read categories,spectator")->name("categories.index");
    Route::get("/dashboard/create-categories", [CategoryController::class, "createCategories"])->middleware("user.has.any.permission:read categories,spectator")->name("create-categories");
    Route::post("/dashboard/create-categories", [CategoryController::class, "storeCategories"])->middleware("user.has.any.permission:create categories")->name("store-categories");
    //Logout
    Route::get("/logout", [UserController::class, "logout"])->name("logout");
});