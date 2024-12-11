<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerir Utilizadores</title>
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

        <!-- Lista de Utilizadores -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Gestão de Utilizadores</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Username</th>
                                <th>Função Atual</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        @if($user->role === 0)
                                            Utilizador
                                        @elseif($user->role === 1)
                                            Editor
                                        @elseif($user->role === 2)
                                            Administrador
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::user()->role === 2 && Auth::id() !== $user->id)
                                            <button class="btn btn-sm btn-primary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editRole{{ $user->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Modal de Edição de Função -->
                                <div class="modal fade" id="editRole{{ $user->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Alterar Função do Utilizador</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('users.update.role', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nova Função</label>
                                                        <select class="form-select" name="role" required>
                                                            <option value="0" {{ $user->role === 0 ? 'selected' : '' }}>Utilizador</option>
                                                            <option value="1" {{ $user->role === 1 ? 'selected' : '' }}>Editor</option>
                                                            <option value="2" {{ $user->role === 2 ? 'selected' : '' }}>Administrador</option>
                                                        </select>
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