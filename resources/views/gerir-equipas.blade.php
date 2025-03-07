<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerir Equipas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header')

    <div class="container my-4">
        <!-- Mensagens de Feedback -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Seção Nova Equipa -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Nova Equipa</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('equipas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Equipa</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo da Equipa</label>
                        <input type="file" class="form-control" id="logo" name="logo" required>
                    </div>
                    <div class="mb-3">
                        <label for="pontos" class="form-label">Pontos</label>
                        <input type="number" class="form-control" id="pontos" name="pontos" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Equipa</button>
                </form>
            </div>
        </div>

        <!-- Lista de Equipas -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Equipas Existentes</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Logo</th>
                                <th>Pontos</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($equipas as $equipa)
                                <tr>
                                    <td>{{ $equipa->nome }}</td>
                                    <td><img src="{{ Storage::url($equipa->logo) }}" alt="{{ $equipa->nome }}" style="width: 50px; height: auto;"></td>
                                    <td>{{ $equipa->pontos }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editEquipa{{ $equipa->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('equipas.destroy', $equipa->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta equipa?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal de Edição -->
                                <div class="modal fade" id="editEquipa{{ $equipa->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Equipa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('equipas.update', $equipa->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="editNome{{ $equipa->id }}" class="form-label">Nome da Equipa</label>
                                                        <input type="text" class="form-control" id="editNome{{ $equipa->id }}" name="nome" value="{{ $equipa->nome }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editLogo{{ $equipa->id }}" class="form-label">Nova Logo (opcional)</label>
                                                        <input type="file" class="form-control" id="editLogo{{ $equipa->id }}" name="logo" accept="image/*">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editPontos{{ $equipa->id }}" class="form-label">Pontos</label>
                                                        <input type="number" class="form-control" id="editPontos{{ $equipa->id }}" name="pontos" value="{{ $equipa->pontos }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 