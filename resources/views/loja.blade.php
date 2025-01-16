<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja do Clube</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @include('layouts.header')
    @include('layouts.cartmodal')

    <div class="container my-4">
        <h2 class="text-center mb-4">Loja do Clube</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($products as $product)

                <div class="col">
                    <div class="card mb-4">
                    <img src="{{ Storage::url($product->imagem) }}" class="card-img-top" alt="{{ $product->nome }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nome }}</h5>
                            <p class="card-text">{{ $product->descricao }}</p>
                            <p class="card-text">Preço: €{{ number_format($product->preco , 2) }}</p>
                            <p class="card-text">Desconto de Sócio: {{ number_format($desconto * 100) }}%</p>
                            @php
                            if ($desconto > 0) {
                            $product->preco = $product->preco - ($product->preco * $desconto);
                            }
                            @endphp
                            <p class="card-text">Preço Final: €{{ number_format($product->preco , 2) }}</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-{{ $product->id }}">Comprar</button>
                        </div>
                    </div>
                </div>

                <!-- Modal de Compra -->
                <div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel-{{ $product->id }}">{{ $product->nome }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ Storage::url($product->imagem) }}" class="card-img-top" alt="{{ $product->nome }}">
                                <p>{{ $product->descricao }}</p>
                                <div class="mb-3">
                                    <label for="quantidade-{{ $product->id }}" class="form-label">Quantidade</label>
                                    <input type="number"
                                           class="form-control"
                                           id="quantidade-{{ $product->id }}"
                                           value="1"
                                           min="1"
                                           step="1"
                                           pattern="\d*"
                                           inputmode="numeric"
                                           onkeydown="return event.keyCode !== 69 && event.keyCode !== 189 && event.keyCode !== 109"
                                    >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary" onclick="adicionarAoCarrinho('{{ $product->id }}', '{{ $product->nome }}', '{{ $product->preco }}')">
                                    Adicionar ao Carrinho
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('layouts.storescript')
    @section('scripts')
        <script src="{{ asset('js/quantity.js') }}"></script>
        <script src="{{ asset('js/cart.js') }}"></script>
    @endsection
</body>
</html>
