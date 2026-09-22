<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentCategoryController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GreetingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RelatedLinkController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\ContactController as FrontendContactController;
use App\Http\Controllers\Frontend\DocumentController as FrontendDocumentController;
use App\Http\Controllers\Frontend\GalleryController as FrontendGalleryController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\ProfileController as FrontendProfileController;
use Illuminate\Support\Facades\Route;

// Public Frontend Routes
Route::name('frontend.')->group(function () {
    Route::get('/', [FrontendHomeController::class, 'index'])->name('home');
    Route::get('/profil', [FrontendProfileController::class, 'index'])->name('profile');
    Route::get('/profil/struktur-organisasi', [FrontendProfileController::class, 'structure'])->name('profile.structure');
    Route::get('/profil/tugas-fungsi', [FrontendProfileController::class, 'duties'])->name('profile.duties');
    Route::get('/dokumen', [FrontendDocumentController::class, 'index'])->name('documents.index');
    Route::get('/dokumen/{document}/preview', [FrontendDocumentController::class, 'preview'])->name('documents.preview');
    Route::get('/dokumen/{document}/download', [FrontendDocumentController::class, 'download'])->name('documents.download');
    Route::get('/galeri', [FrontendGalleryController::class, 'index'])->name('gallery.index');
    Route::get('/kontak', [FrontendContactController::class, 'index'])->name('contact.index');
});

// Admin shortcut redirects
Route::get('/admin', fn () => redirect()->route('admin.dashboard'));
Route::get('/admin/login', fn () => redirect()->route('login'));

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Admin Panel Routes (Super Admin & Operator Mutu)
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:super_admin,operator_mutu'])
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Hero Banners
        Route::resource('banners', BannerController::class)->except(['show', 'create', 'edit']);
        Route::patch('banners/{banner}/toggle', [BannerController::class, 'toggle'])->name('banners.toggle');

        // Sambutan Kepala PPM
        Route::get('/greeting', [GreetingController::class, 'index'])->name('greeting.index');
        Route::put('/greeting', [GreetingController::class, 'update'])->name('greeting.update');

        // Layanan Kami
        Route::resource('services', ServiceController::class)->except(['show', 'create', 'edit']);
        Route::patch('services/{service}/toggle', [ServiceController::class, 'toggle'])->name('services.toggle');

        // Link Terkait
        Route::resource('related-links', RelatedLinkController::class)->except(['show', 'create', 'edit']);

        // Profil & Tupoksi
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Kategori Dokumen SPMI
        Route::resource('document-categories', DocumentCategoryController::class)->except(['show', 'create', 'edit']);

        // Dokumen & SOP
        Route::get('documents/{document}/preview-file', [DocumentController::class, 'previewFile'])->name('documents.preview-file');
        Route::resource('documents', DocumentController::class)->except(['show', 'create', 'edit']);

        // Galeri Kegiatan
        Route::resource('gallery', GalleryController::class)->except(['show', 'create', 'edit']);

        // Kontak & Footer
        Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
        Route::put('/contact', [ContactController::class, 'update'])->name('contact.update');

        // Super Admin Only Area
        Route::middleware('role:super_admin')->group(function () {
            Route::resource('users', UserController::class)->except(['show', 'create', 'edit']);
        });
    });
