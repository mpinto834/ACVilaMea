<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria do Clube</title>
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
            <a href="/login" class="user-icon fs-4" style="cursor: pointer; text-decoration: none; color: white;">👤</a>
        </div>
    </header>

    <!-- Galeria -->
    <div class="container my-4">
        <h2 class="text-center mb-4">Galeria de Imagens</h2>
        <p class="text-center text-muted">Confira momentos marcantes do nosso clube.</p>

        <!-- Galeria Responsiva -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Imagem 1 -->
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/galeria/foto1.jpg') }}" class="card-img-top" alt="Foto 1">
                    <div class="card-body">
                        <p class="card-text">Legenda da imagem 1: Torcida vibrando durante o jogo.</p>
                    </div>
                </div>
            </div>
            <!-- Imagem 2 -->
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/galeria/foto2.jpg') }}" class="card-img-top" alt="Foto 2">
                    <div class="card-body">
                        <p class="card-text">Legenda da imagem 2: Jogadores em comemoração.</p>
                    </div>
                </div>
            </div>
            <!-- Imagem 3 -->
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/galeria/foto3.jpg') }}" class="card-img-top" alt="Foto 3">
                    <div class="card-body">
                        <p class="card-text">Legenda da imagem 3: Momento de vitória em campo.</p>
                    </div>
                </div>
            </div>
            <!-- Imagem 4 -->
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/galeria/foto4.jpg') }}" class="card-img-top" alt="Foto 4">
                    <div class="card-body">
                        <p class="card-text">Legenda da imagem 4: Ações de treino do clube.</p>
                    </div>
                </div>
            </div>
            <!-- Imagem 5 -->
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/galeria/foto5.jpg') }}" class="card-img-top" alt="Foto 5">
                    <div class="card-body">
                        <p class="card-text">Legenda da imagem 5: Retrato oficial da equipa.</p>
                    </div>
                </div>
            </div>
            <!-- Imagem 6 -->
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('images/galeria/foto6.jpg') }}" class="card-img-top" alt="Foto 6">
                    <div class="card-body">
                        <p class="card-text">Legenda da imagem 6: Celebração com a torcida.</p>
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
