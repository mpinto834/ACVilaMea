<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerir Jogos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Gerir Jogos</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(Auth::user()->role === 1 || Auth::user()->role === 2)
            <!-- Formulário para adicionar jogos -->
            <form action="{{ route('games.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome do Jogo</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Data do Jogo</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <button type="submit" class="btn btn-primary">Adicionar Jogo</button>
            </form>

            <!-- Lista de jogos -->
            <h2 class="mt-4">Jogos</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Resultado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($games as $game)
                        <tr>
                            <td>{{ $game->name }}</td>
                            <td>{{ $game->date }}</td>
                            <td>{{ $game->result }}</td>
                            <td>
                                <!-- Formulário para atualizar resultado -->
                                <form action="{{ route('games.update', $game->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="result" value="{{ $game->result }}" required>
                                    <button type="submit" class="btn btn-sm btn-success">Atualizar</button>
                                </form>
                                <!-- Formulário para remover jogo -->
                                <form action="{{ route('games.destroy', $game->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este jogo?')">Remover</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você não tem permissão para gerenciar jogos.</p>
        @endif
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>