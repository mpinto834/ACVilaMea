<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Checkout</h1>

        <div class="row">
            <div class="col-md-8">
                <h4>Produtos no Carrinho</h4>
                <ul id="cart-items" class="list-group mb-4">
                    <!-- Items will be dynamically added here -->
                </ul>
                <h4>Total: <span id="cart-total">0</span> €</h4>
            </div>
            <div class="col-md-4">
                <h4>Informações de Pagamento</h4>
                <form action="{{ route('checkout.process') }}" method="POST" id="payment-form">
                    @csrf
                    <input type="hidden" name="cart" id="cart-input">
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

            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                // Display error.message in your UI.
                alert(error.message);
            } else {
                // The card has been verified successfully...
                document.getElementById('cart-input').value = localStorage.getItem('cart');
                form.submit();
            }
        });

        // Load cart items from local storage
        document.addEventListener('DOMContentLoaded', () => {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartItems = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');
            let total = 0;

            cart.forEach(item => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.innerText = `Produto ID: ${item.id}, Quantidade: ${item.quantidade}, Tamanho: ${item.tamanho}`;
                const price = 20; // Replace with actual price
                total += price * item.quantidade;
                const priceSpan = document.createElement('span');
                priceSpan.innerText = `${price * item.quantidade} €`;
                listItem.appendChild(priceSpan);
                cartItems.appendChild(listItem);
            });

            cartTotal.innerText = total.toFixed(2);
        });
    </script>
</body>
</html>