<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja do Clube</title>
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
                <a href="/login" class="user-icon fs-4" style="cursor: pointer; text-decoration: none; color: white;">👤</a>
            @endif
        </div>
    </header>

    <div class="container my-4">
        <h2 class="text-center mb-4">Loja do Clube</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($artigos as $artigo)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $artigo->imagem) }}" 
                             class="card-img-top" 
                             alt="{{ $artigo->nome }}" 
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $artigo->nome }}</h5>
                            <p class="card-text">Preço: {{ number_format($artigo->preco, 2) }}€</p>
                            <p class="card-text">Stock: {{ $artigo->stock }}</p>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-{{ $artigo->id }}">Comprar</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modais -->
    @foreach($artigos as $artigo)
    <div class="modal fade" id="modal-{{ $artigo->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $artigo->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel-{{ $artigo->id }}">{{ $artigo->nome }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $artigo->imagem) }}" 
                                 class="img-fluid" 
                                 alt="{{ $artigo->nome }}">
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $artigo->nome }}</h5>
                            <p class="fw-bold">Preço: {{ number_format($artigo->preco, 2) }}€</p>
                            
                            @if($artigo->tipoArtigo->tem_tamanho)
                                <div class="mb-3">
                                    <label for="tamanho-{{ $artigo->id }}" class="form-label">Tamanho:</label>
                                    <select class="form-select" id="tamanho-{{ $artigo->id }}" required>
                                        <option value="">Selecione o tamanho</option>
                                        @php
                                            $tamanhos_stock = json_decode($artigo->tamanhos_stock, true) ?? [];
                                        @endphp
                                        @foreach($tamanhos_stock as $tamanho => $quantidade)
                                            @if($quantidade > 0)
                                                <option value="{{ $tamanho }}">{{ $tamanho }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="quantidade-{{ $artigo->id }}" class="form-label">Quantidade:</label>
                                <input type="number" class="form-control" id="quantidade-{{ $artigo->id }}" value="1" min="1" max="{{ $artigo->stock }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="adicionarAoCarrinho('{{ $artigo->id }}')">Adicionar ao Carrinho</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function adicionarAoCarrinho(id) {
        const quantidade = document.getElementById('quantidade-' + id).value;
        const tamanho = document.getElementById('tamanho-' + id) ? document.getElementById('tamanho-' + id).value : null;
        
        // Aqui você pode adicionar a lógica para adicionar ao carrinho
        // Por exemplo, fazer uma requisição AJAX para o servidor
        
        alert('Produto adicionado ao carrinho!');
        // Fecha o modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('modal-' + id));
        modal.hide();
    }
    </script>
</body>
</html>
