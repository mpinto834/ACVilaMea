<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AC Vila Meã</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- Mantém o estilo customizado -->
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
            @if(Auth::check())
            <div class="dropdown">
                <a class="text-white text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Auth::user()->profile_photo ? Storage::url(Auth::user()->profile_photo) : 'images/default-avatar.png' }}" alt="Foto de Perfil" 
                         class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                    <span class="ms-2">{{ Auth::user()->first_name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Sair</button>
                        </form>
                    </li>
                </ul>
            </div>
    @else
        <!-- Usuário não autenticado: Redirecionar para Login -->
        <a href="/login" class="user-icon fs-4" style="cursor: pointer; text-decoration: none; color: white;">👤</a>
    @endif
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
    @if($nextGame)
        <div class="row align-items-center text-center py-3 border rounded bg-light">
            <div class="col-md-4">
x                <img src="{{ asset('images/AC-VILA-MEA.ico') }}" alt="Logo {{ $nextGame->team1_name }}" style="width: 80px; height: auto;">
                <div class="mt-2 fs-5 fw-bold">{{ $nextGame->team1_name }}</div>
            </div>
            <div class="col-md-4">
                <p class="mb-1">{{ $nextGame->date_time->format('d/m/Y') }}</p>
                <p class="mb-1">{{ $nextGame->date_time->format('H:i') }}</p>
                <p class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ $nextGame->location }}</p>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $nextGame->team2_photo) }}" alt="Logo {{ $nextGame->team2_name }}" style="width: 80px; height: auto;">
                <div class="mt-2 fs-5 fw-bold">{{ $nextGame->team2_name }}</div>
            </div>
        </div>
    @else
        <p class="text-center">Nenhum próximo jogo agendado.</p>
    @endif
</section>

<!-- Resultado do Último Jogo -->
<section class="last-result mb-4">
    <h2 class="text-center">Resultado do Último Jogo</h2>
    @if($previousGame)
        <div class="row align-items-center text-center py-3 border rounded bg-light">
            <div class="col-md-4">
                <img src="{{ asset($previousGame->team1_photo) }}" alt="Logo {{ $previousGame->team1_name }}" style="width: 80px; height: auto;">
                <div class="mt-2 fs-5 fw-bold">{{ $previousGame->team1_name }}</div>
            </div>
            <div class="col-md-4 game-info-center">
                <div class="game-result">{{ $previousGame->result }}</div>
                <p class="mb-1">{{ $previousGame->date_time->format('d/m/Y') }}</p>
                <p class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ $previousGame->location }}</p>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $previousGame->team2_photo) }}" alt="Logo {{ $previousGame->team2_name }}" style="width: 80px; height: auto;">
                <div class="mt-2 fs-5 fw-bold">{{ $previousGame->team2_name }}</div>
            </div>
        </div>
    @else
        <p class="text-center">Nenhum resultado disponível.</p>
    @endif
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
        <section class="news-section">
            <div class="container">
                <h2 class="text-center">Últimas Notícias</h2>
                <div class="row">
                    @foreach($latestNews as $news)
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="{{ asset('storage/' . $news->image) }}" class="card-img-top" alt="{{ $news->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $news->title }}</h5>
                                    <p class="card-text">{{ Str::limit($news->content, 100) }}</p>
                                    <a href="{{ route('noticias.show', $news->slug) }}" class="btn btn-dark">Leia Mais</a>
                                 </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('news.index') }}" class="btn btn-dark">Ver Mais Notícias</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal de Login -->
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>