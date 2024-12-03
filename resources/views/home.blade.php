<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Link do Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #000; /* Fundo preto */
        }
        .navbar-brand img {
            height: 50px; /* Ajustar tamanho do logotipo */
        }
        .nav-link {
            color: #fff; /* Texto branco */
            font-weight: bold;
            margin-right: 20px; /* Espaço entre links */
        }
        .nav-link.active {
            border-bottom: 2px solid red; /* Destaque vermelho */
        }
        .nav-link:hover {
            color: red; /* Texto vermelho ao passar o mouse */
        }
        .search-icon {
            color: #fff; /* Ícone de busca branco */
            font-size: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logotipo -->
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="ACVilaMea">
                <span class="text-white">ACVilaMea</span>
            </a>
            <!-- Botão do menu no mobile -->
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Links da navbar -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/clube">Clube</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Futebol</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Notícias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Multimédia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contactos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-search search-icon"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Link do Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Link para Font Awesome (para o ícone de busca) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>