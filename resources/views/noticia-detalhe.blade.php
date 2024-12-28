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
    @include('layouts.header')

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