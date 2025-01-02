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
                    <!-- Items will be dynamically added here -->
                </ul>
                <h4>Total: <span id="checkout-cart-total">0</span> €</h4>
            </div>
            <div class="col-md-4">
                <h4>Informações de Pagamento</h4>
                <form action="{{ route('checkout.process') }}" method="POST" id="payment-form">
                    @csrf
                    <input type="hidden" name="cart" id="cart-input">
                    <input type="hidden" name="amount" id="amount-input">
                    <input type="hidden" name="payment_method" id="payment-method">
                    <div class="mb-3">
                        <label for="card-holder-name" class="form-label">Nome no Cartão</label>
                        <input id="card-holder-name" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="card-element" class="form-label">Cartão de Crédito ou Débito</label>
                        <div id="card-element" class="form-control"></div>
                    </div>
                    <button id="card-button" class="btn btn-primary mt-3" data-secret="{{ $intent->client_secret }}">
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
        const clientSecret = cardButton.dataset.secret;

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const { paymentIntent, error } = await stripe.confirmCardPayment(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                console.error(error.message);
                alert(error.message);
            } else if (paymentIntent.status === 'succeeded') {
                document.getElementById('cart-input').value = JSON.stringify(cart);
                document.getElementById('payment-method').value = paymentIntent.payment_method;
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