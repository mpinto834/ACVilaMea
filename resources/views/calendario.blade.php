<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário de Jogos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Cabeçalho -->
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
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
            <div class="user-icon fs-4">👤</div>
        </div>
    </header>

    <!-- Calendário -->
    <div class="container my-4">
        <h2 class="text-center mb-4">Próximos Jogos</h2>
        <p class="text-center text-muted">Confira as datas e informações sobre os próximos jogos do clube.</p>

        <div class="row row-cols-1 g-4">
            <!-- Jogo 1 -->
            <div class="col">
                <div class="card border-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">AC Vila Meã vs FC Porto B</h5>
                        <p class="card-text">
                            <strong>Data:</strong> 15 de Dezembro, 2024<br>
                            <strong>Hora:</strong> 16:00<br>
                            <strong>Local:</strong> Estádio Municipal de Vila Meã
                        </p>
                        <a href="#" class="btn btn-primary">Mais Informações</a>
                    </div>
                </div>
            </div>

            <!-- Jogo 2 -->
            <div class="col">
                <div class="card border-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">AC Vila Meã vs Sporting CP Sub-23</h5>
                        <p class="card-text">
                            <strong>Data:</strong> 22 de Dezembro, 2024<br>
                            <strong>Hora:</strong> 18:30<br>
                            <strong>Local:</strong> Estádio José Alvalade (Lisboa)
                        </p>
                        <a href="#" class="btn btn-success">Mais Informações</a>
                    </div>
                </div>
            </div>

            <!-- Jogo 3 -->
            <div class="col">
                <div class="card border-warning shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">AC Vila Meã vs GD Chaves</h5>
                        <p class="card-text">
                            <strong>Data:</strong> 5 de Janeiro, 2025<br>
                            <strong>Hora:</strong> 15:00<br>
                            <strong>Local:</strong> Estádio Municipal de Chaves
                        </p>
                        <a href="#" class="btn btn-warning">Mais Informações</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="bg-dark text-white py-3 text-center">
        <p>&copy; 2024 AC Vila Meã. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
