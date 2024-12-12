<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerir Artigos</title>
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
        <!-- Mensagens de Feedback -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Seção Novo Artigo -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Novo Artigo</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('artigos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome do Artigo</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem do Artigo</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" class="form-control" id="preco" name="preco" step="0.01" min="0" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Artigo</button>
                </form>
            </div>
        </div>

        <!-- Lista de Artigos -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Artigos Existentes</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Stock</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($artigos as $artigo)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $artigo->imagem) }}" 
                                             alt="{{ $artigo->nome }}" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>{{ $artigo->nome }}</td>
                                    <td>{{ number_format($artigo->preco, 2) }}€</td>
                                    <td>{{ $artigo->stock }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editArtigo{{ $artigo->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('artigos.destroy', $artigo->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Tem certeza que deseja excluir este artigo?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal de Edição -->
                                <div class="modal fade" id="editArtigo{{ $artigo->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Artigo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('artigos.update', $artigo->id) }}" 
                                                  method="POST" 
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="editNome{{ $artigo->id }}" class="form-label">Nome do Artigo</label>
                                                        <input type="text" 
                                                               class="form-control" 
                                                               id="editNome{{ $artigo->id }}" 
                                                               name="nome" 
                                                               value="{{ $artigo->nome }}" 
                                                               required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editStock{{ $artigo->id }}" class="form-label">Stock</label>
                                                        <input type="number" 
                                                               class="form-control" 
                                                               id="editStock{{ $artigo->id }}" 
                                                               name="stock" 
                                                               value="{{ $artigo->stock }}" 
                                                               min="0" 
                                                               required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editImagem{{ $artigo->id }}" class="form-label">Nova Imagem (opcional)</label>
                                                        <input type="file" 
                                                               class="form-control" 
                                                               id="editImagem{{ $artigo->id }}" 
                                                               name="imagem" 
                                                               accept="image/*">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Preço</label>
                                                        <input type="number" class="form-control" name="preco" value="{{ $artigo->preco }}" step="0.01" min="0" required>
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