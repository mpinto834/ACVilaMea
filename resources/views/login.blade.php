<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Esportivo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- Mantém o estilo customizado -->
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="logo">
                <a href="/">
                    <img src="images/AC-VILA-MEA.ico" alt="Logo do Clube" style="width: 50px; height: auto;">
                </a>
            </div>
            <nav>
                <ul class="nav">
                <li class="nav-item"><a href="noticias" class="nav-link text-white">Notícias</a></li>
                    <li class="nav-item"><a href="plantel" class="nav-link text-white">Plantel</a></li>
                    <li class="nav-item"><a href="loja" class="nav-link text-white">Loja</a></li>
                    <li class="nav-item"><a href="calendario" class="nav-link text-white">Calendário</a></li>
                    <li class="nav-item"><a href="galeria" class="nav-link text-white">Galeria</a></li>
                </ul>
            </nav>
            <a href="/login" class="user-icon fs-4" style="cursor: pointer; text-decoration: none; color: white;">👤</a>
        </div>
    </nav>

    <!-- Login Container -->
    <div class="container">
        <div class="login-container">
            <h2>Login</h2>
            <!-- resources/views/auth/login.blade.php -->
<form action="{{ route('login') }}" method="POST">
    @csrf  <!-- Proteção contra CSRF -->

    <!-- Campo de Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Seu email" value="{{ old('email') }}" required>
        
        <!-- Exibir erro caso haja algum -->
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Campo de Senha -->
    <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Sua senha" required>
        
        <!-- Exibir erro caso haja algum -->
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Lembrar de mim -->
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">Lembrar de mim</label>
    </div>

    <!-- Botão de Entrar -->
    <button type="submit" class="btn btn-primary w-100">Entrar</button>

    <!-- Link para registro -->
    <p class="text-center text-muted mt-3">Não tem conta? <a href="/register">Registre-se aqui</a></p>
</form>
        </div>
    </div>

    <!-- Bootstrap JS (adicione no final do body) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
