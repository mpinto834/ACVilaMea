<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário de Jogos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Calendário de Jogos</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($games as $game)
                <div class="col">
                    <div class="card border-warning shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $game->name }}</h5>
                            <p class="card-text">
                                <strong>Data:</strong> {{ \Carbon\Carbon::parse($game->date)->format('d de F, Y') }}<br>
                                <strong>Hora:</strong> {{ \Carbon\Carbon::parse($game->date)->format('H:i') }}<br>
                                <strong>Local:</strong> {{ $game->location ?? 'Local não especificado' }}
                            </p>
                            <a href="#" class="btn btn-warning">Mais Informações</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="bg-dark text-white py-3 text-center">
        <p>&copy; 2024 AC Vila Meã. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>