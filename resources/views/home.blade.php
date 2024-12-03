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
    <!-- Cabeçalho -->
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <img src="images/AC-VILA-MEA.ico" alt="Logo do Clube" style="width: 50px; height: auto;">
        </div>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a href="#" class="nav-link text-white">Notícias</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Plantel</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Loja</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Calendário</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Galeria</a></li>
                </ul>
            </nav>
            <div class="user-icon fs-4">👤</div>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="container my-4">
        <div class="row">
            <!-- Coluna Esquerda -->
            <div class="col-md-8">
                <!-- Próximo Jogo -->
                <section class="next-game mb-4">
                    <h2 class="text-center">Próximo Jogo</h2>
                    <div class="row align-items-center text-center py-3 border rounded bg-light">
                        <div class="col-md-4 fs-5 fw-bold">Porto</div>
                        <div class="col-md-4">
                            <p class="mb-1">10 de Dezembro de 2025</p>
                            <p class="mb-1">20:00</p>
                            <p>Estádio do Dragão</p>
                        </div>
                        <div class="col-md-4 fs-5 fw-bold">Benfica</div>
                    </div>
                </section>

                <!-- Resultado do Último Jogo -->
                <section class="last-result mb-4">
                    <h2 class="text-center">Resultado do Último Jogo</h2>
                    <div class="row align-items-center text-center py-3 border rounded bg-light">
                        <div class="col-md-4 fs-5 fw-bold">Porto</div>
                        <div class="col-md-4 fs-4 fw-bold text-primary">34 - 33</div>
                        <div class="col-md-4 fs-5 fw-bold">Benfica</div>
                    </div>
                </section>
            </div>

            <!-- Coluna Direita -->
            <div class="col-md-4">
                <!-- Ranking -->
                <section class="ranking mb-4">
                    <h2 class="text-center">Hyundai Pro League</h2>
                    <ul class="list-group">
                        <li class="list-group-item d-flex align-items-center px-3">
                            <div class="d-flex align-items-center me-auto">
                                <img src="images/AC-VILA-MEA.ico" alt="AC Vila Mea" class="img-fluid" style="width: 30px; height: auto;">
                                <div class="ms-2">AC Vila Mea</div>
                            </div>
                            <span class="fw-bold">21</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center px-3">
                            <div class="d-flex align-items-center me-auto">
                                <img src="benfica_logo.png" alt="Benfica" class="img-fluid" style="width: 30px; height: auto;">
                                <div class="ms-2">Benfica</div>
                            </div>
                            <span class="fw-bold">21</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center px-3">
                            <div class="d-flex align-items-center me-auto">
                                <img src="sporting_logo.png" alt="Sporting" class="img-fluid" style="width: 30px; height: auto;">
                                <div class="ms-2">Sporting</div>
                            </div>
                            <span class="fw-bold">21</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center px-3">
                            <div class="d-flex align-items-center me-auto">
                                <img src="braga_logo.png" alt="Braga" class="img-fluid" style="width: 30px; height: auto;">
                                <div class="ms-2">Braga</div>
                            </div>
                            <span class="fw-bold">21</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center px-3">
                            <div class="d-flex align-items-center me-auto">
                                <img src="guimaraes_logo.png" alt="Guimarães" class="img-fluid" style="width: 30px; height: auto;">
                                <div class="ms-2">Guimarães</div>
                            </div>
                            <span class="fw-bold">21</span>
                        </li>
                    </ul>
                </section>
            </div>
        </div>

        <!-- Últimas Notícias -->
        <section class="latest-news">
            <h2 class="text-center">Últimas Notícias</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="logo.png" alt="Notícia" class="card-img-top p-3">
                        <div class="card-body text-center">
                            <p class="text-muted mb-1">20 de Novembro, 2024</p>
                            <h5 class="card-title">Vitória Importante Contra o X</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="logo.png" alt="Notícia" class="card-img-top p-3">
                        <div class="card-body text-center">
                            <p class="text-muted mb-1">18 de Novembro, 2024</p>
                            <h5 class="card-title">Jogador X é Destaque no Campeonato</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="logo.png" alt="Notícia" class="card-img-top p-3">
                        <div class="card-body text-center">
                            <p class="text-muted mb-1">15 de Novembro, 2024</p>
                            <h5 class="card-title">Preparativos para o Jogo Decisivo</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-primary">Ver Mais Notícias</button>
            </div>
        </section>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>