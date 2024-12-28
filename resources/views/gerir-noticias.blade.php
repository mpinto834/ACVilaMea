<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerir Notícias</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome para ícones -->
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

        <!-- Seção Nova Notícia -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Nova Notícia</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Conteúdo</label>
                        <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Publicar Notícia</button>
                </form>
            </div>
        </div>

        <!-- Lista de Notícias -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Notícias Existentes</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Título</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($noticias as $noticia)
                                <tr>
                                    <td>
                                        <img src="{{ Storage::url($noticia->image) }}" 
                                             alt="Imagem da Notícia" 
                                             style="width: 100px; height: 60px; object-fit: cover;">
                                    </td>
                                    <td>{{ $noticia->title }}</td>
                                    <td>{{ $noticia->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editNews{{ $noticia->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('noticias.destroy', $noticia->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Tem certeza que deseja excluir esta notícia?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal de Edição -->
                                <div class="modal fade" id="editNews{{ $noticia->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Notícia</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('noticias.update', $noticia->id) }}" 
                                                  method="POST" 
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="editTitle{{ $noticia->id }}" class="form-label">Título</label>
                                                        <input type="text" 
                                                               class="form-control" 
                                                               id="editTitle{{ $noticia->id }}" 
                                                               name="title" 
                                                               value="{{ $noticia->title }}" 
                                                               required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editContent{{ $noticia->id }}" class="form-label">Conteúdo</label>
                                                        <textarea class="form-control" 
                                                                  id="editContent{{ $noticia->id }}" 
                                                                  name="content" 
                                                                  rows="4" 
                                                                  required>{{ $noticia->content }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editImage{{ $noticia->id }}" class="form-label">Nova Imagem (opcional)</label>
                                                        <input type="file" 
                                                               class="form-control" 
                                                               id="editImage{{ $noticia->id }}" 
                                                               name="image" 
                                                               accept="image/*">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 