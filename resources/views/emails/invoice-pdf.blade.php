<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>AC Vila Meã</h1>
    <p>Fatura</p>
    <p>Data: {{ date('d/m/Y') }}</p>

    <div class="customer-info">
        <p><strong>Cliente:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>€{{ number_format($product->price, 2) }}</td>
                    <td>€{{ number_format($product->price * $product->quantity, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhum produto encontrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <h3>Total: €{{ number_format($total, 2) }}</h3>
    </div>
</body>
</html> 