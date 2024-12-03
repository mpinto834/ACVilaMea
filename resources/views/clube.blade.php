<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantel - Clube Blue</title>
    <!-- Link do Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #000;
        }
        .navbar-brand img {
            height: 50px;
        }
        .nav-link {
            color: #fff;
            font-weight: bold;
            margin-right: 20px;
        }
        .nav-link:hover {
            color: red;
        }
        .player-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            background-color: #f9f9f9;
            text-align: center;
        }
        .player-card img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .player-name {
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 10px;
        }
        .player-position {
            color: #555;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Clube Blue">
                <span class="text-white">Clube Blue</span>
            </a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Clube</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Futebol</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Notícias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contactos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Plantel -->
    <div class="container mt-5">
        <h1 class="text-center mb-5">Plantel de Jogadores</h1>
        <div class="row g-4">
            <!-- Card do Jogador -->
            <div class="col-md-4">
                <div class="player-card">
                    <img src="jogador1.jpg" alt="Jogador 1">
                    <div class="player-name">João Silva</div>
                    <div class="player-position">Atacante</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="player-card">
                    <img src="jogador2.jpg" alt="Jogador 2">
                    <div class="player-name">Carlos Pereira</div>
                    <div class="player-position">Defensor</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="player-card">
                    <img src="jogador3.jpg" alt="Jogador 3">
                    <div class="player-name">Ricardo Santos</div>
                    <div class="player-position">Goleiro</div>
                </div>
            </div>
            <!-- Adicione mais jogadores aqui -->
        </div>
    </div>

    <!-- Link do Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>