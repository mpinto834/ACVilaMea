<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Site Esportivo</title>
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
                    <li class="nav-item"><a href="#" class="nav-link text-white">Loja</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Calendário</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Galeria</a></li>
                </ul>
            </nav>
            <a href="/login" class="user-icon fs-4" style="cursor: pointer; text-decoration: none; color: white;">👤</a>
        </div>
    </nav>

    <!-- Registro Container -->
    <div class="container">
        <div class="register-container">
            <h2>Registro</h2>
            <form>
                <!-- Nome Completo -->
                <div class="mb-3">
                    <label for="firstName" class="form-label">Primeiro Nome</label>
                    <input type="text" class="form-control" id="firstName" placeholder="Seu primeiro nome">
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Último Nome</label>
                    <input type="text" class="form-control" id="lastName" placeholder="Seu último nome">
                </div>
                <!-- Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Seu username">
                </div>
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Seu email">
                </div>
                <!-- Data de Nascimento -->
                <div class="mb-3">
                    <label for="birthDate" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="birthDate">
                </div>
                <!-- Número de Telefone -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Número de Telefone</label>
                    <input type="tel" class="form-control" id="phone" placeholder="Seu número de telefone">
                </div>
                <!-- Senha -->
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" placeholder="Sua senha">
                </div>
                <!-- Confirmação da Senha -->
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirmação de Senha</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirme sua senha">
                </div>
                <!-- Botão de Registro -->
                <button type="submit" class="btn btn-primary w-100">Registrar</button>
                <p class="text-center text-muted mt-3">Já tem uma conta? <a href="/login">Faça login aqui</a></p>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>