<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerir Jogos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header')

    <div class="container my-4">
        <h1>Gerir Jogos</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(Auth::user()->role === 1 || Auth::user()->role === 2)
            <!-- Formulário para adicionar jogos -->
            <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="game_type" class="form-label">Tipo de Jogo</label>
                            <select class="form-control" id="game_type" name="game_type" required>
                                <option value="home">Jogo em Casa</option>
                                <option value="away">Jogo Fora</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="team2_name" class="form-label">Nome da Equipa Adversária</label>
                            <input type="text" class="form-control" id="team2_name" name="team2_name" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="team2_photo" class="form-label">Logo da Equipa Adversária</label>
                            <input type="file" class="form-control" id="team2_photo" name="team2_photo" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="location" class="form-label">Local do Jogo</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_time" class="form-label">Data e Hora do Jogo</label>
                            <input type="datetime-local" class="form-control" id="date_time" name="date_time" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Adicionar Jogo</button>
            </form>

            <!-- Lista de jogos -->
            <h2 class="mt-4">Jogos</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Equipa Casa</th>
                            <th>Equipa Visitante</th>
                            <th>Local</th>
                            <th>Data e Hora</th>
                            <th>Resultado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $game)
                            <tr>
                                <td>
                                    <img src="{{ asset($game->team1_photo) }}" alt="Logo Casa" style="width: 30px">
                                    {{ $game->team1_name }}
                                </td>
                                <td>
                                    <img src="{{ asset($game->team2_photo) }}" alt="Logo Visitante" style="width: 30px">
                                    {{ $game->team2_name }}
                                </td>
                                <td>{{ $game->location }}</td>
                                <td>{{ $game->date_time->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if(!$game->result)
                                        <form action="{{ route('games.update', $game->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="result" class="form-control form-control-sm d-inline" style="width: 100px">
                                            <button type="submit" class="btn btn-sm btn-success">Salvar</button>
                                        </form>
                                    @else
                                        {{ $game->result }}
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este jogo?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>Você não tem permissão para gerenciar jogos.</p>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script></body>
</html>