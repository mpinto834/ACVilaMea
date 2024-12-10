<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja do Clube</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
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

    <!-- Loja -->
    <div class="container my-4">
        <h2 class="text-center mb-4">Loja Oficial</h2>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Produto 1 -->
            <div class="col">
                <div class="card h-100 border rounded shadow-sm">
                    <img src="{{ asset('images/produtos/camisola.jpg') }}" class="card-img-top p-3" alt="Camisola Oficial">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-2">Camisola Oficial</h5>
                        <p class="text-muted">Preço: €35.00</p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <!-- Produto 2 -->
            <div class="col">
                <div class="card h-100 border rounded shadow-sm">
                    <img src="{{ asset('images/produtos/cachecol.jpg') }}" class="card-img-top p-3" alt="Cachecol do Clube">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-2">Cachecol do Clube</h5>
                        <p class="text-muted">Preço: €15.00</p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <!-- Produto 3 -->
            <div class="col">
                <div class="card h-100 border rounded shadow-sm">
                    <img src="{{ asset('images/produtos/boné.jpg') }}" class="card-img-top p-3" alt="Boné Oficial">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-2">Boné Oficial</h5>
                        <p class="text-muted">Preço: €20.00</p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
            <!-- Produto 4 -->
            <div class="col">
                <div class="card h-100 border rounded shadow-sm">
                    <img src="{{ asset('images/produtos/bandeira.jpg') }}" class="card-img-top p-3" alt="Bandeira do Clube">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-2">Bandeira do Clube</h5>
                        <p class="text-muted">Preço: €25.00</p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <!-- Produto 5 -->
            <div class="col">
                <div class="card h-100 border rounded shadow-sm">
                    <img src="{{ asset('images/produtos/bola.jpg') }}" class="card-img-top p-3" alt="Bola Personalizada">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-2">Bola Personalizada</h5>
                        <p class="text-muted">Preço: €30.00</p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
            <!-- Produto 6 -->
            <div class="col">
                <div class="card h-100 border rounded shadow-sm">
                    <img src="{{ asset('images/produtos/chaveiro.jpg') }}" class="card-img-top p-3" alt="Chaveiro">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-2">Chaveiro do Clube</h5>
                        <p class="text-muted">Preço: €5.00</p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="bg-dark text-white py-3 text-center">
        <p>&copy; 2024 AC Vila Meã. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
