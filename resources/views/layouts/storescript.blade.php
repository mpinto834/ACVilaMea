<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

function adicionarAoCarrinho(id, name, price) {
    const quantidade = parseInt(document.getElementById('quantidade-' + id).value);
    const produto = {
        id: id,
        name: name,
        quantidade: quantidade,
        price: price
    };

    // Check if the product already exists in the cart
    const existingProductIndex = cart.findIndex(item => item.id === id);
    if (existingProductIndex !== -1) {
        // Update the quantity and total price of the existing product
        cart[existingProductIndex].quantidade += quantidade;
    } else {
        // Add the new product to the cart
        cart.push(produto);
    }

    sessionStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    updateCartModal();

    alert('Produto adicionado ao carrinho!');
    // Fecha o modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('modal-' + id));
    modal.hide();
}

function removeFromCart(index) {
    cart.splice(index, 1);
    sessionStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    updateCartModal();
    updateCheckoutPage();
}

function updateCartCount() {
    document.getElementById('cart-count').innerText = cart.length;
}

function updateCartModal() {
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = '';
    cart.forEach((item, index) => {
        const totalPrice = item.price * item.quantidade;
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
        listItem.innerHTML = `
            Produto: ${item.name}, Quantidade: ${item.quantidade}, Preço Total: €${totalPrice.toFixed(2)}
            <button class="btn btn-danger btn-sm" onclick="removeFromCart(${index})">Remover</button>
        `;
        cartItems.appendChild(listItem);
    });
}

function updateCheckoutPage() {
    const cartItems = document.getElementById('checkout-cart-items');
    const cartTotal = document.getElementById('checkout-cart-total');
    const cartInput = document.getElementById('cart-input');
    cartItems.innerHTML = '';
    let total = 0;

    if (cart.length === 0) {
        cartItems.innerHTML = '<li class="list-group-item">Carrinho vazio</li>';
        cartTotal.innerText = '0';
    } else {
        cart.forEach((item, index) => {
            const totalPrice = item.price * item.quantidade;
            total += totalPrice;
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            listItem.innerHTML = `
                Produto: ${item.name}, Quantidade: ${item.quantidade}, Preço Total: €${totalPrice.toFixed(2)}
                <button class="btn btn-danger btn-sm" onclick="removeFromCart(${index})">Remover</button>
            `;
            cartItems.appendChild(listItem);
        });
        cartTotal.innerText = total.toFixed(2);
        cartInput.value = JSON.stringify(cart);
    }
}

// Atualiza o carrinho ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    updateCartModal();
    if (document.getElementById('checkout-cart-items')) {
        updateCheckoutPage();
    }
});
</script>