<?php

use App\Http\Controllers\GuidesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');

// SEO Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Teknik Rehberler
Route::get('/rehberler', [GuidesController::class, 'index'])->name('guides.index');
Route::get('/rehberler/{slug}', [GuidesController::class, 'show'])->name('guides.show');

// Referanslar
Route::get('/referanslar', function () {
    return Inertia::render('References');
})->name('references');

// İlçe/Bölge Bazlı Yerel SEO Sayfaları
// Örnek: /izmir/konak, /izmir/bornova, /izmir/karabaglar
Route::get('/izmir/{district}', [LocationController::class, 'show'])->name('location.show');

Route::get('/hizmetler', [ServiceController::class, 'index'])->name('services.index');

Route::get('/hizmetler/kamera-sistemleri', function () {
    return Inertia::render('CameraService');
})->name('services.camera');

Route::get('/hizmetler/internet-hizmetleri', function () {
    return Inertia::render('InternetService');
})->name('services.internet');

Route::get('/hizmetler/uydu-sistemleri', function () {
    return Inertia::render('SatelliteService');
})->name('services.satellite');
Route::get('/hizmetler/elektrik-servisi', function () {
    return Inertia::render('ElectricityService');
})->name('services.elektrik');

Route::get('/service-requests/create', [ServiceRequestController::class, 'create'])->name('service-requests.create');
Route::post('/hizmet-talebi', [ServiceRequestController::class, 'store'])->name('service-requests.store');
Route::get('/teknik-servis/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/hakkimizda', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/hizmet-talepleri/{serviceRequest}', [ServiceRequestController::class, 'show'])
    ->name('service-requests.show');

Route::delete('/hizmet-talepleri/{serviceRequest}', [ServiceRequestController::class, 'destroy'])->name('service-requests.destroy');

Route::get('/service-request', function () {
    return Inertia::render('ServiceRequest');
})->name('service-request');

Route::get('/internet-hiz-testi', function () {
    return Inertia::render('InternetSpeedTest');
})->name('internet-speed-test');

// Hizmet Talebi Sorgulama Sayfası
Route::get('/hizmet-talebi-sorgula', function () {
    return Inertia::render('ServiceRequestQuery');
})->name('service-request.query.page');

// Hizmet Talebi Sorgulama API Rotası (Talep Numarası ile Sorgulama)
Route::get('/api/hizmet-talebi-sorgula', [ServiceRequestController::class, 'queryByRequestNumber'])->name('service-request.query');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profil/duzenle', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil/duzenle', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/hizmetler/{slug}', [ServiceController::class, 'custom'])->name('services.custom');

Route::get('/iletisim', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::post('/iletisim', function () {
    // Form verilerini işleme mantığı buraya gelecek
    // Örneğin: Mail gönderme, veritabanına kaydetme
    return response()->json(['message' => 'Mesajınız başarıyla alındı.'], 200);
})->name('contact.send');

// E-posta Doğrulama Rotaları (Erişim Kısıtlaması Olmadan)
Route::get('/email/verify', function () {
    return Inertia::render('VerifyEmail', ['status' => session('status')]);
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    try {
        // Bus::dispatch(new Illuminate\Auth\Notifications\VerifyEmail($request->user())); // Moved to user model method
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    } catch (\Exception $e) {
        Log::error('E-posta bildirimi gönderme hatası:'.$e->getMessage(), ['exception' => $e]);

        return back()->with('status', 'verification-link-error')->withErrors(['email' => 'Doğrulama maili gönderilemedi (hata oluştu).']);
    }
})->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// Admin Paneli Rotaları
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/service-requests', [\App\Http\Controllers\Admin\ServiceRequestController::class, 'index'])->name('service_requests.index');
    Route::resource('/products', \App\Http\Controllers\Admin\ProductController::class)->names('products');
    // Diğer admin rotaları buraya eklenecek
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
