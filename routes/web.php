<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CounselingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InnovationController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TalentController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('home');

// Auth — Google OAuth
Route::prefix('auth/google')->name('auth.google.')->group(function () {
    Route::get('redirect', [GoogleController::class, 'redirect'])->name('redirect');
    Route::get('callback', [GoogleController::class, 'callback'])->name('callback');
});

// Simple login/logout for dev (without Google)
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
})->name('login.post');

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    Auth::login($user);

    return redirect()->route('dashboard');
})->name('register.post');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home');
})->name('logout');

// Dashboard (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('talents', TalentController::class);
    Route::resource('assets', AssetController::class);
    Route::resource('clients', ClientController::class);

    Route::get('/counseling', [CounselingController::class, 'index'])->name('counseling.index');
    Route::post('/counseling/ask', [CounselingController::class, 'ask'])->name('counseling.ask');

    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/analytics/data', [AnalyticsController::class, 'data'])->name('analytics.data');
    Route::get('/analytics/export/{type}', [AnalyticsController::class, 'export'])->name('analytics.export');

    // Settings
    Route::get('/settings', fn () => view('dashboard.settings'))->name('settings');

    // Pencarian Global Lintas Modul
    Route::get('/api/search', [SearchController::class, 'query'])->name('api.search');

    // Inovasi & Ide AI Generator
    Route::resource('innovations', InnovationController::class)->only(['index', 'store']);
    Route::post('/innovations/generate-ai', [InnovationController::class, 'generateAi'])->name('innovations.generate-ai');
    Route::post('/innovations/{innovation}/upvote', [InnovationController::class, 'upvote'])->name('innovations.upvote');
});
