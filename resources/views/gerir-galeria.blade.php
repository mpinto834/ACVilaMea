<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerir Galeria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header')

    <div class="container my-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Seção Nova Foto -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Nova Foto</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('galeria.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Selecionar Imagem</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" required>
                    </div>
                    <div class="mb-3">
                        <label for="legenda" class="form-label">Legenda</label>
                        <input type="text" class="form-control" id="legenda" name="legenda" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Foto</button>
                </form>
            </div>
        </div>

        <!-- Lista de Fotos -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Fotos Existentes</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Legenda</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fotos as $foto)
                                <tr>
                                    <td>
                                        <img src="{{ Storage::url($foto->imagem) }}" 
                                             alt="Imagem da Galeria" 
                                             style="width: 100px; height: 60px; object-fit: cover;">
                                    </td>
                                    <td>{{ $foto->legenda }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editFoto{{ $foto->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('galeria.destroy', $foto) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Tem certeza que deseja excluir esta foto?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal de Edição -->
                                <div class="modal fade" id="editFoto{{ $foto->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Foto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('galeria.update', $foto->id) }}" 
                                                  method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="editLegenda{{ $foto->id }}" class="form-label">Legenda</label>
                                                        <input type="text" 
                                                               class="form-control" 
                                                               id="editLegenda{{ $foto->id }}" 
                                                               name="legenda" 
                                                               value="{{ $foto->legenda }}" 
                                                               required>
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