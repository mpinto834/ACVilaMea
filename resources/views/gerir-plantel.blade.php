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
                    <li class="nav-item"><a href="news" class="nav-link text-white">Notícias</a></li>
                    <li class="nav-item"><a href="plantel" class="nav-link text-white">Plantel</a></li>
                    <li class="nav-item"><a href="store" class="nav-link text-white">Loja</a></li>
                    <li class="nav-item"><a href="calendar" class="nav-link text-white">Calendário</a></li>
                    <li class="nav-item"><a href="galery" class="nav-link text-white">Galeria</a></li>
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

        <!-- Seção Novo Jogador -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Novo Jogador</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('plantel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label">Nome do Jogador</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="numero" class="form-label">Número</label>
                            <input type="number" class="form-control" id="numero" name="numero" min="1" max="99" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="posicao" class="form-label">Posição</label>
                            <select class="form-select" id="posicao" name="posicao" required>
                                <option value="">Selecione...</option>
                                <option value="Guarda Redes">Guarda Redes</option>
                                <option value="Defesa">Defesa</option>
                                <option value="Médio">Médio</option>
                                <option value="Avançado">Avançado</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto do Jogador</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Jogador</button>
                </form>
            </div>
        </div>

        <!-- Lista de Jogadores -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Plantel Atual</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nome</th>
                                <th>Número</th>
                                <th>Posição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jogadores as $jogador)
                                <tr>
                                    <td>
                                        <img src="{{ Storage::url($jogador->foto) }}" 
                                             alt="Foto do Jogador" 
                                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                    </td>
                                    <td>{{ $jogador->nome }}</td>
                                    <td>{{ $jogador->numero }}</td>
                                    <td>{{ $jogador->posicao }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editJogador{{ $jogador->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('plantel.destroy', $jogador->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Tem certeza que deseja remover este jogador?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal de Edição -->
                                <div class="modal fade" id="editJogador{{ $jogador->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Jogador</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('plantel.update', $jogador->id) }}" 
                                                  method="POST" 
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="editNome{{ $jogador->id }}" class="form-label">Nome</label>
                                                        <input type="text" 
                                                               class="form-control" 
                                                               id="editNome{{ $jogador->id }}" 
                                                               name="nome" 
                                                               value="{{ $jogador->nome }}" 
                                                               required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editNumero{{ $jogador->id }}" class="form-label">Número</label>
                                                        <input type="number" 
                                                               class="form-control" 
                                                               id="editNumero{{ $jogador->id }}" 
                                                               name="numero" 
                                                               value="{{ $jogador->numero }}" 
                                                               min="1" 
                                                               max="99" 
                                                               required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editPosicao{{ $jogador->id }}" class="form-label">Posição</label>
                                                        <select class="form-select" 
                                                                id="editPosicao{{ $jogador->id }}" 
                                                                name="posicao" 
                                                                required>
                                                            <option value="Guarda Redes" {{ $jogador->posicao == 'Guarda Redes' ? 'selected' : '' }}>Guarda Redes</option>
                                                            <option value="Defesa" {{ $jogador->posicao == 'Defesa' ? 'selected' : '' }}>Defesa</option>
                                                            <option value="Médio" {{ $jogador->posicao == 'Médio' ? 'selected' : '' }}>Médio</option>
                                                            <option value="Avançado" {{ $jogador->posicao == 'Avançado' ? 'selected' : '' }}>Avançado</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editFoto{{ $jogador->id }}" class="form-label">Nova Foto (opcional)</label>
                                                        <input type="file" 
                                                               class="form-control" 
                                                               id="editFoto{{ $jogador->id }}" 
                                                               name="foto" 
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