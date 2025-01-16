<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Compras - AC Vila Meã</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header')
    @include('layouts.cartmodal')

    <div class="container my-4">
        <h2 class="mb-4">Minhas Compras</h2>

        @if($orders->isEmpty())
            <div class="alert alert-info">
                Você ainda não realizou nenhuma compra.
            </div>
        @else
            @foreach($orders as $order)
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Pedido</span>
                            <span>Data: {{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Produtos:</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Preço Unitário</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(json_decode($order->products) as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->quantidade }}</td>
                                            <td>€{{ number_format($product->price, 2) }}</td>
                                            <td>€{{ number_format($product->price * $product->quantidade, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                        <td><strong>€{{ number_format($order->amount, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Voltar ao Perfil
            </a>
        </div>
    </div>

    @include('layouts.storescript')
</body>
</html> 