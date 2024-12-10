<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Esportivo</title>
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
                <img src="images/AC-VILA-MEA.ico" alt="Logo do Clube" style="width: 50px; height: auto;">
            </a>
        </div>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a href="noticias" class="nav-link text-white">Notícias</a></li>
                    <li class="nav-item"><a href="plantel" class="nav-link text-white">Plantel</a></li>
                    <li class="nav-item"><a href="loja" class="nav-link text-white">Loja</a></li>
                    <li class="nav-item"><a href="calendario" class="nav-link text-white">Calendário</a></li>
                    <li class="nav-item"><a href="galeria" class="nav-link text-white">Galeria</a></li>
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
    <div class="container my-4">
        <h2 class="text-center mb-4">Plantel Completo</h2>

        <!-- Guarda-Redes -->
        <h3 class="text-center mb-3">Guarda-Redes</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <!-- Exemplo de guarda-redes -->
            <div class="col">
                <div class="card h-100 border rounded shadow-sm">
                    <img src="{{ asset('images/jogadores/guarda-redes1.jpg') }}" class="card-img-top p-3" alt="Guarda-Redes 1">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-0">Nome do Guarda-Redes</h5>
                        <p class="text-muted">#Número</p>
                    </div>
                </div>
            </div>
            <!-- Repita o bloco acima para cada guarda-redes -->
        </div>

        <!-- Defesas -->
        <h3 class="text-center mb-3">Defesas</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <!-- Exemplo de defesa -->
            <div class="col">
                <div class="card h-100 border rounded shadow-sm">
                    <img src="{{ asset('images/jogadores/defesa1.jpg') }}" class="card-img-top p-3" alt="Defesa 1">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-0">Nome do Defesa</h5>
                        <p class="text-muted">#Número</p>
                    </div>
                </div>
            </div>
            <!-- Repita o bloco acima para cada defesa -->
        </div>

        <!-- Médios -->
        <h3 class="text-center mb-3">Médios</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <!-- Exemplo de médio -->
            <div class="col">
                <div class="card h-100 border rounded shadow-sm">
                    <img src="{{ asset('images/jogadores/medio1.jpg') }}" class="card-img-top p-3" alt="Médio 1">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-0">Nome do Médio</h5>
                        <p class="text-muted">#Número</p>
                    </div>
                </div>
            </div>
            <!-- Repita o bloco acima para cada médio -->
        </div>

        <!-- Avançados -->
        <h3 class="text-center mb-3">Avançados</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <!-- Exemplo de avançado -->
            <div class="col">
                <div class="card h-100 border rounded shadow-sm">
                    <img src="{{ asset('images/jogadores/avancado1.jpg') }}" class="card-img-top p-3" alt="Avançado 1">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-0">Nome do Avançado</h5>
                        <p class="text-muted">#Número</p>
                    </div>
                </div>
            </div>
            <!-- Repita o bloco acima para cada avançado -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>