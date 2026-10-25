<?php 
 
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\ProjectController; 
use App\Http\Controllers\TaskController; 
use Illuminate\Support\Facades\Route; 
use Mcamara\LaravelLocalization\Facades\LaravelLocalization; 

Route::get('/en', function () {
    app()->setLocale('en');
    return view('welcome');
});

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ], function () {

        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware(['auth', 'verified'])
            ->name('dashboard');

        Route::middleware('auth')->group(function () {
            Route::resource('projects', ProjectController::class);
            Route::resource('users', UserController::class);
            Route::post('/projects/{project}/members', [ProjectController::class, 'addMember'])
                ->name('projects.members.add');
            Route::delete('/projects/{project}/members/{user}', [ProjectController::class, 'removeMember'])
                ->name('projects.members.remove');
            Route::resource('tasks', TaskController::class);
            Route::get('/projects/{project}/members', [ProjectController::class, 'members'])
                ->name('projects.members');
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        require __DIR__ . '/auth.php';
    });
 
// Localized authentication routes for English and Arabic.
foreach (['en', 'ar'] as $locale) {
    Route::prefix($locale)
        ->name($locale . '.')
        ->middleware([
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
        ])
        ->group(function () use ($locale) {
            Route::middleware('guest')->group(function () use ($locale) {
                Route::get('register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
                    ->name('register');
                Route::post('register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])
                    ->name('register.store');

                Route::get('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
                    ->name('login');
                Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
                    ->name('login.store');
            });
        });
}
    