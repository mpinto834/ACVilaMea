<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AC Vila Meã</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> 
     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header')
    @include('layouts.cartmodal')

    <div class="container">
        <div class="login-container">
            <h2>Login</h2>
<form action="{{ route('login') }}" method="POST">
    @csrf  

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Seu email" value="{{ old('email') }}" required>
        
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Sua senha" required>
        
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">Lembrar de mim</label>
    </div>

    <button type="submit" class="btn btn-primary w-100">Entrar</button>

    <p class="text-center text-muted mt-3">Não tem conta? <a href="/register">Registe-se aqui</a></p>
    <p class="text-center text-muted mt-3">Esqueceu sua senha? <a href="/password/reset">Recuperar senha</a></p>
</form>
        </div>
    </div>

    @include('layouts.storescript')
</body>
</html>
