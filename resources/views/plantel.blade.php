<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Esportivo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- Mantém o estilo customizado -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header')
    @include('layouts.cartmodal')

    <div class="container my-4">
        <h2 class="text-center mb-4">Plantel Completo</h2>

        <!-- Guarda-Redes -->
        <h3 class="text-center mb-3">Guarda Redes</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($jogadores->where('posicao', 'Guarda Redes') as $jogador)
                <div class="col">
                    <div class="card h-100 border rounded shadow-sm">
                        <img src="{{ Storage::url($jogador->foto) }}" class="card-img-top p-3" alt="{{ $jogador->nome }}">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-0">{{ $jogador->nome }}</h5>
                            <p class="text-muted">#{{ $jogador->numero }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Defesas -->
        <h3 class="text-center mb-3">Defesas</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($jogadores->where('posicao', 'Defesa') as $jogador)
                <div class="col">
                    <div class="card h-100 border rounded shadow-sm">
                        <img src="{{ Storage::url($jogador->foto) }}" class="card-img-top p-3" alt="{{ $jogador->nome }}">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-0">{{ $jogador->nome }}</h5>
                            <p class="text-muted">#{{ $jogador->numero }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Médios -->
        <h3 class="text-center mb-3">Médios</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($jogadores->where('posicao', 'Médio') as $jogador)
                <div class="col">
                    <div class="card h-100 border rounded shadow-sm">
                        <img src="{{ Storage::url($jogador->foto) }}" class="card-img-top p-3" alt="{{ $jogador->nome }}">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-0">{{ $jogador->nome }}</h5>
                            <p class="text-muted">#{{ $jogador->numero }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Avançados -->
        <h3 class="text-center mb-3">Avançados</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($jogadores->where('posicao', 'Avançado') as $jogador)
                <div class="col">
                    <div class="card h-100 border rounded shadow-sm">
                        <img src="{{ Storage::url($jogador->foto) }}" class="card-img-top p-3" alt="{{ $jogador->nome }}">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-0">{{ $jogador->nome }}</h5>
                            <p class="text-muted">#{{ $jogador->numero }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('layouts.storescript')
</body>
</html>