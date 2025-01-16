<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Bilhetes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
@include('layouts.header')
@include('layouts.cartmodal')
@include('layouts.storescript')
    <div class="container my-4">
        <h1 class="text-center mb-4">Compra de Bilhetes</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-body">
                <h2 class="mb-3">{{ $game->team1_name }} vs {{ $game->team2_name }}</h2>
                <p><strong>Data:</strong> {{ $game->date_time->format('d/m/Y H:i') }}</p>
                <p><strong>Local:</strong> {{ $game->location }}</p>
                <p><strong>Preço:</strong> 10,00€</p>

                <form action="{{ route('tickets.handlePurchase') }}" method="POST" id="payment-form">
                    @csrf
                    <input type="hidden" name="game_id" value="{{ $game->id }}">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantidade de Bilhetes</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="card-holder-name" class="form-label">Nome no Cartão</label>
                        <input id="card-holder-name" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="card-element" class="form-label">Cartão de Crédito ou Débito</label>
                        <div id="card-element" class="form-control"></div>
                    </div>
                    <input type="hidden" name="stripeToken" id="stripeToken">
                    <button id="card-button" class="btn btn-primary mt-3">Comprar</button>
                </form>
            </div>
        </div>
    </div>
   
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const { token, error } = await stripe.createToken(cardElement, {
                name: cardHolderName.value,
            });

            if (error) {
                console.error(error.message);
                alert(error.message);
            } else {
                document.getElementById('stripeToken').value = token.id;
                form.submit();
            }
        });
    </script>
</body>
</html>