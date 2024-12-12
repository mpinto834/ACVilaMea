<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário de Jogos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                        <img src="{{ Auth::user()->profile_photo ? Storage::url(Auth::user()->profile_photo) : 'images/default-avatar.png' }}" 
                             alt="Foto de Perfil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
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
            @endif
        </div>
    </header>

    <div class="container my-4">
        <h1 class="text-center mb-4">Calendário de Jogos</h1>
        
        <!-- Próximos Jogos -->
        <h2 class="mb-3">Próximos Jogos</h2>
        @if($futureGames->count() > 0)
            @foreach($futureGames as $game)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center text-center">
                            <div class="col-md-4">
                                <img src="{{ asset($game->team1_photo) }}" alt="Logo {{ $game->team1_name }}" style="width: 60px; height: auto;">
                                <div class="mt-2 fw-bold">{{ $game->team1_name }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-2 fs-5">{{ $game->date_time->format('d/m/Y') }}</div>
                                <div class="mb-2 fs-5">{{ $game->date_time->format('H:i') }}</div>
                                <div><i class="fas fa-map-marker-alt"></i> {{ $game->location }}</div>
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset($game->team2_photo) }}" alt="Logo {{ $game->team2_name }}" style="width: 60px; height: auto;">
                                <div class="mt-2 fw-bold">{{ $game->team2_name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">Não há jogos futuros agendados.</p>
        @endif

        <!-- Jogos Anteriores -->
        <h2 class="mb-3 mt-5">Jogos Anteriores</h2>
        @if($pastGames->count() > 0)
            @foreach($pastGames as $game)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center text-center">
                            <div class="col-md-4">
                                <img src="{{ asset($game->team1_photo) }}" alt="Logo {{ $game->team1_name }}" style="width: 60px; height: auto;">
                                <div class="mt-2 fw-bold">{{ $game->team1_name }}</div>
                            </div>
                            <div class="col-md-4 game-info-center">
                                @if($game->result)
                                    <div class="game-result">{{ $game->result }}</div>
                                @endif
                                <div class="mb-2">{{ $game->date_time->format('d/m/Y') }}</div>
                                <div class="mb-2">{{ $game->date_time->format('H:i') }}</div>
                                <div><i class="fas fa-map-marker-alt"></i> {{ $game->location }}</div>
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset($game->team2_photo) }}" alt="Logo {{ $game->team2_name }}" style="width: 60px; height: auto;">
                                <div class="mt-2 fw-bold">{{ $game->team2_name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">Não há jogos anteriores registrados.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>