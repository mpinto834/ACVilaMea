<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header')
    @include('layouts.cartmodal')

    <div class="container my-4">
        <h2 class="text-center mb-4">Checkout</h2>
        <div class="row">
            <div class="col-md-8">
                <h4>Produtos no Carrinho</h4>
                <ul id="checkout-cart-items" class="list-group mb-4">
                    @foreach ($cart as $item)
                        <li class="list-group-item">
                            {{ $item['name'] }} - {{ $item['quantity'] }} x €{{ $item['price'] }}
                        </li>
                    @endforeach
                </ul>
                <h4>Total: <span id="checkout-cart-total">{{ $total }}</span> €</h4>
            </div>
            <div class="col-md-4">
                <h4>Informações de Pagamento</h4>
                <form action="{{ route('checkout.process') }}" method="POST" id="payment-form">
                    @csrf
                    <input type="hidden" name="cart" id="cart-input" value="{{ json_encode($cart) }}">
                    <input type="hidden" name="amount" id="amount-input" value="{{ $amountInCents }}">
                    <input type="hidden" name="stripeToken" id="stripeToken">
                    <div class="mb-3">
                        <label for="card-holder-name" class="form-label">Nome no Cartão</label>
                        <input id="card-holder-name" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="card-element" class="form-label">Cartão de Crédito ou Débito</label>
                        <div id="card-element" class="form-control"></div>
                    </div>
                    <button id="card-button" class="btn btn-primary mt-3">
                        Pagar
                    </button>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.storescript')

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

            // Disable the button to prevent multiple submissions
            cardButton.disabled = true;

            const { token, error } = await stripe.createToken(cardElement, {
                name: cardHolderName.value,
            });

            if (error) {
                console.error(error.message);
                alert(error.message);
                cardButton.disabled = false; // Re-enable the button on error
            } else {
                document.getElementById('stripeToken').value = token.id;
                form.submit();
            }
        });
        // Update the amount input field with the total amount
        document.addEventListener('DOMContentLoaded', () => {
            const totalAmount = document.getElementById('checkout-cart-total').innerText;
            document.getElementById('amount-input').value = parseFloat(totalAmount) * 100; // Convert to cents
        });
    </script>
</body>
</html>