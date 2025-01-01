<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header')
    @include('layouts.cartmodal')

    <div class="container my-4">
        <h2 class="text-center mb-4">Pagamento Bem-Sucedido</h2>
        <div class="alert alert-success text-center">
            <p>O seu pagamento foi processado com sucesso!</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Voltar à Página Inicial</a>
        </div>
    </div>

    @include('layouts.storescript')
</body>
</html>