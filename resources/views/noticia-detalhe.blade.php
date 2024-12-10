<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Últimas Notícias</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- Mantém o estilo customizado -->
</head>
<body>
    <!-- Cabeçalho -->
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <a href="/">
                <img src="{{ asset('images/AC-VILA-MEA.ico') }}" alt="Logo do Clube" style="width: 50px; height: auto;">
            </a>
        </div>
            <nav>
                <ul class="nav">
                    <li class="nav-item px-2"><a href="/news" class="nav-link text-white">Notícias</a></li>
                    <li class="nav-item px-2"><a href="/plantel" class="nav-link text-white">Plantel</a></li>
                    <li class="nav-item px-2"><a href="/store" class="nav-link text-white">Loja</a></li>
                    <li class="nav-item px-2"><a href="/calendar" class="nav-link text-white">Calendário</a></li>
                    <li class="nav-item px-2"><a href="/galery" class="nav-link text-white">Galeria</a></li>
                </ul>
            </nav>
            @if(Auth::check())
            <div class="dropdown">
                <a class="text-white text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Auth::user()->profile_photo ? Storage::url(Auth::user()->profile_photo) : 'images/default-avatar.png' }}" alt="Foto de Perfil" 
                         class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
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
    @else
        <!-- Usuário não autenticado: Redirecionar para Login -->
        <a href="/login" class="user-icon fs-4" style="cursor: pointer; text-decoration: none; color: white;">👤</a>
    @endif
        </div>
    </header>

    <div class="container my-5">
        <div class="row">
            <div class="col-12 mb-4">
                <h1 class="text-center">{{ $noticia->title }}</h1>
                <p class="text-muted text-center">{{ $noticia->created_at->format('d/m/Y') }}</p>
            </div>
            <div class="col-md-6">
                <img src="{{ Storage::url($noticia->image) }}" 
                     alt="{{ $noticia->title }}" 
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <div class="content">
                    {!! nl2br(e($noticia->content)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>