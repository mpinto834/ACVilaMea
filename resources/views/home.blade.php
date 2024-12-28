<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AC Vila Meã</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- Mantém o estilo customizado -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header')

    @include('layouts.cartmodal')

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
                <img src="{{ asset($nextGame->team1_photo) }}" alt="Logo {{ $nextGame->team1_name }}" style="width: 80px; height: auto;">
                <div class="mt-2 fs-5 fw-bold">{{ $nextGame->team1_name }}</div>
            </div>
            <div class="col-md-4">
                <p class="mb-1">{{ $nextGame->date_time->format('d/m/Y') }}</p>
                <p class="mb-1">{{ $nextGame->date_time->format('H:i') }}</p>
                <p class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ $nextGame->location }}</p>
            </div>
            <div class="col-md-4">
                <img src="{{ asset($nextGame->team2_photo) }}" alt="Logo {{ $nextGame->team2_name }}" style="width: 80px; height: auto;">
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
                @if($previousGame->result)
                    <div class="game-result">{{ $previousGame->result }}</div>
                @endif
                <p class="mb-1">{{ $previousGame->date_time->format('d/m/Y') }}</p>
                <p class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ $previousGame->location }}</p>
            </div>
            <div class="col-md-4">
                <img src="{{ asset($previousGame->team2_photo) }}" alt="Logo {{ $previousGame->team2_name }}" style="width: 80px; height: auto;">
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
                        @foreach($equipas as $equipa)
                            <li class="list-group-item d-flex align-items-center px-3">
                                <div class="d-flex align-items-center me-auto">
                                    <img src="{{ Storage::url($equipa->logo) }}" alt="{{ $equipa->nome }}" class="img-fluid" style="width: 30px; height: auto;">
                                    <div class="ms-2">{{ $equipa->nome }}</div>
                                </div>
                                <span class="fw-bold">{{ $equipa->pontos }}</span>
                            </li>
                        @endforeach
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

    @include('layouts.storescript')
</body>
</html>