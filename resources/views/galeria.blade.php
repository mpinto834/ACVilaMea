<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria - Site Esportivo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header')

    @include('layouts.cartmodal')

    <div class="container my-4">
        <h2 class="text-center mb-4">Galeria de Fotos</h2>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($fotos as $foto)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ Storage::url($foto->imagem) }}" 
                             class="card-img-top" 
                             alt="{{ $foto->legenda }}"
                             style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text text-center">{{ $foto->legenda }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('layouts.storescript')
</body>
</html>
