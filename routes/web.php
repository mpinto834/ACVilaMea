<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ProfileController; 
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PlantelController; 
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\EquipaController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Mail\VerifyAccountMail;
use App\Mail\ResetPasswordMail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;

// Página inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Páginas públicas (não requerem autenticação)
Route::get('/plantel', [PlantelController::class, 'show'])->name('plantel.show');
Route::view('/noticias', 'noticias');
Route::get('/loja', [ProductController::class, 'loja'])->name('loja');
Route::get('/galeria', [GaleriaController::class, 'show'])->name('galeria.show');
Route::get('/calendario', [GameController::class, 'calendario'])->name('calendario');


// Páginas de autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Páginas de registro
Route::get('/register', function() {
    return view('register');
});
Route::post('/register', [RegisterController::class, 'store'])->name('register');

// Rotas do dashboard e perfil (requer login)
Route::middleware('auth')->group(function () {
    // Rota para o dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rota para atualizar o perfil
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Rota para atualizar a senha
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // Rota para atualizar a foto do perfil
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
});

// Rota para as notícias
Route::get('/noticias', [NewsController::class, 'index'])->name('news.index');
Route::get('/noticias/{slug}', [NewsController::class, 'show'])->name('noticias.show');

// Rotas protegidas para administradores
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/gerir-noticias', [NewsController::class, 'index'])->name('noticias.index');
    Route::post('/noticias', [NewsController::class, 'store'])->name('noticias.store');
    Route::put('/noticias/{noticia}', [NewsController::class, 'update'])->name('noticias.update');
    Route::delete('/noticias/{noticia}', [NewsController::class, 'destroy'])->name('noticias.destroy');
});

// Novas rotas para gerenciamento do plantel
Route::middleware(['auth', 'isAdmin'])->group(function () {
Route::get('/gerir-plantel', [PlantelController::class, 'index'])->name('plantel.index');
Route::post('/plantel', [PlantelController::class, 'store'])->name('plantel.store');
Route::put('/plantel/{jogador}', [PlantelController::class, 'update'])->name('plantel.update');
Route::delete('/plantel/{jogador}', [PlantelController::class, 'destroy'])->name('plantel.destroy');
});

// Rotas protegidas para administrar a galeria
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/gerir-galeria', [GaleriaController::class, 'index'])->name('galeria.index');
    Route::post('/galeria', [GaleriaController::class, 'store'])->name('galeria.store');
    Route::put('/galeria/{foto}', [GaleriaController::class, 'update'])->name('galeria.update');
    Route::delete('/galeria/{foto}', [GaleriaController::class, 'destroy'])->name('galeria.destroy');
});

//Rotas protegidas para administrar os utilizadores
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/gerir-utilizadores', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.update.role');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

//rotas para administrar os jogos
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/gerir-jogos', [GameController::class, 'index'])->name('games.index');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
});

// Rotas para Gerir Equipas
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/gerir-equipas', [EquipaController::class, 'index'])->name('equipas.index');
    Route::post('/equipas', [EquipaController::class, 'store'])->name('equipas.store');
    Route::put('/equipas/{equipa}', [EquipaController::class, 'update'])->name('equipas.update');
    Route::delete('/equipas/{equipa}', [EquipaController::class, 'destroy'])->name('equipas.destroy');
});

//Rotas para checkout
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/checkout-process', [CheckoutController::class, 'handleCheckout'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'checkoutSuccess'])->name('checkout.success');
});

// Routes for managing products (admin only)
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/add-product', [ProductController::class, 'showAddProductForm'])->name('products.add');
    Route::post('/products', [ProductController::class, 'createProduct'])->name('products.create');
    Route::delete('/products/{id}', [ProductController::class, 'deleteProduct'])->name('products.delete');
});

// Rotas para verificação de email
Route::get('/verify-email/{token}', function($token) {
    $user = User::where('email_verification_token', $token)->first();
    
    if (!$user) {
        return redirect('/login')->with('error', 'Link de verificação inválido.');
    }

    $user->email_verified_at = now();
    $user->email_verification_token = null;
    $user->save();

    return redirect('/login')->with('success', 'Email verificado com sucesso! Agora você pode fazer login.');
})->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Rotas para reset de senha
Route::get('/password/reset', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/password/email', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $user = User::where('email', $request->email)->first();
    
    if ($user) {
        $token = Str::random(60);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );
        
        Mail::send('emails.reset-password', [
            'token' => $token,
            'email' => $request->email
        ], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Redefinição de Senha');
        });
    }
    
    return back()->with('status', 'Se encontrarmos um usuário com esse email, enviaremos um link de recuperação de senha.');
})->name('password.email');

// Rota para mostrar o formulário de reset
Route::get('/password/reset/{token}', function ($token, Request $request) {
    return view('auth.reset-password', [
        'token' => $token,
        'email' => $request->email
    ]);
})->name('password.reset');

// Rota para processar o reset de senha
Route::post('/password/update', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed'
    ]);

    $passwordReset = DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->first();

    if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
        return back()->withErrors(['email' => 'Token inválido ou expirado.']);
    }

    $user = User::where('email', $request->email)->first();
    
    if (!$user) {
        return back()->withErrors(['email' => 'Não encontramos um usuário com esse endereço de e-mail.']);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    DB::table('password_reset_tokens')->where('email', $request->email)->delete();

    return redirect('/login')->with('status', 'Sua senha foi redefinida com sucesso!');
})->name('password.update');

// Rotas para Minhas Compras
Route::get('/minhas-compras', [OrderController::class, 'userOrders'])->name('user.orders')->middleware('auth');



