<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .header { margin-bottom: 30px; }
        .greeting { color: #2c5282; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
        .total { font-size: 18px; margin-top: 20px; }
        .footer { margin-top: 40px; color: #666; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>AC Vila Meã</h2>
    </div>

    <div class="greeting">
        <h2>Olá {{ $user->first_name }},</h2>
        <p>Muito obrigado pela sua compra! Segue em anexo a fatura do seu pedido.</p>
    </div>
    
    <div class="order-details">
        <h3>Detalhes do seu Pedido</h3>
        
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>€{{ number_format($product->price, 2) }}</td>
                    <td>€{{ number_format($product->price * $product->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <strong>Total do Pedido: €{{ number_format($total, 2) }}</strong>
        </div>
    </div>

    <div class="footer">
        <p>Se tiver alguma dúvida sobre seu pedido, não hesite em nos contactar.</p>
        <p>Atenciosamente,<br>AC Vila Meã</p>
    </div>
</body>
</html> 