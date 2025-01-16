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
    @include('layouts.header')
    @include('layouts.cartmodal')

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
                                <div class="mb-2 fs-5">
                                    <a href="{{ route('tickets.purchase', ['game_id' => $game->id]) }}" class="btn btn-primary">Comprar Bilhetes</a>
                                </div>
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
            <p class="text-center">Não há jogos anteriores registados.</p>
        @endif
    </div>

    @include('layouts.storescript')
</body>
</html>