<!DOCTYPE html>
<html>
<body>
    <h2>Obrigado pela sua compra, {{ $user->name }}!</h2>
    
    <h3>Detalhes do Pedido</h3>
    
    <table>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>€{{ number_format($product->price, 2) }}</td>
        </tr>
        @endforeach
    </table>

    <h4>Total: €{{ number_format($total, 2) }}</h4>
</body>
</html> 