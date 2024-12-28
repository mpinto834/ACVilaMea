<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

    function adicionarAoCarrinho(id, name, price) {
        const quantidade = document.getElementById('quantidade-' + id).value;
        const produto = {
            id: id,
            name: name,
            quantidade: quantidade,
            price : price
        };

        // Adiciona o produto ao carrinho
        cart.push(produto);
        sessionStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        updateCartModal();

        alert('Produto adicionado ao carrinho!');
        // Fecha o modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('modal-' + id));
        modal.hide();
    }

    function updateCartCount() {
        document.getElementById('cart-count').innerText = cart.length;
    }

    function updateCartModal() {
        const cartItems = document.getElementById('cart-items');
        cartItems.innerHTML = '';
        cart.forEach(item => {
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item';
            listItem.innerText = `Produto: ${item.name}, Quantidade: ${item.quantidade}, Preço: €${item.price}`;
            cartItems.appendChild(listItem);
        });
    }

    // Atualiza o carrinho ao carregar a página
    document.addEventListener('DOMContentLoaded', () => {
        updateCartCount();
        updateCartModal();
    });
    </script>