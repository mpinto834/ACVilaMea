<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Últimas Notícias</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- Mantém o estilo customizado -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header')
    @include('layouts.cartmodal')

    <div class="container my-4">
        <h2 class="text-center mb-4">Últimas Notícias</h2>
        <div class="row g-4">
            @foreach($noticias as $noticia)
            <div class="col-md-4">
                <a href="{{ route('noticias.show', $noticia->slug) }}" class="text-decoration-none text-dark">
                    <div class="card h-100">
                        <img src="{{ Storage::url($noticia->image) }}" 
                             alt="{{ $noticia->title }}" 
                             class="card-img-top p-3"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $noticia->title }}</h5>
                            <p class="card-text">{{ Str::limit($noticia->content, 100) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    @include('layouts.storescript')
</body>
</html>
