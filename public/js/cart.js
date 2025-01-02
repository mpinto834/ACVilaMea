function adicionarAoCarrinho(productId, productName, price) {
    const quantidadeInput = document.getElementById(`quantidade-${productId}`);
    let quantidade = parseInt(quantidadeInput.value);
    
    if (isNaN(quantidade) || quantidade < 1) {
        quantidade = 1;
        quantidadeInput.value = 1;
    }
    
    let carrinho = JSON.parse(localStorage.getItem('carrinho') || '{}');
    
    carrinho[productId] = {
        nome: productName,
        quantidade: quantidade,
        preco: price
    };
    
    localStorage.setItem('carrinho', JSON.stringify(carrinho));
    atualizarCarrinho();
}

function atualizarCarrinho() {
    let carrinho = JSON.parse(localStorage.getItem('carrinho') || '{}');
    let total = 0;
    let carrinhoHtml = '';
    
    for (let productId in carrinho) {
        let item = carrinho[productId];
        let subtotal = item.preco * item.quantidade;
        total += subtotal;
        
        carrinhoHtml += `
            <div class="cart-item">
                <span>${item.nome}</span>
                <input type="number" 
                       value="${item.quantidade}" 
                       min="1"
                       onchange="atualizarQuantidadeCarrinho('${productId}', this.value)"
                       class="form-control quantidade-carrinho">
                <span>€${subtotal.toFixed(2)}</span>
                <button onclick="removerDoCarrinho('${productId}')" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
    }
    
    document.getElementById('cart-items').innerHTML = carrinhoHtml;
    document.getElementById('cart-total').textContent = `Total: €${total.toFixed(2)}`;

    // Atualiza o botão de finalizar compra
    const modalFooter = document.querySelector('.modal-footer');
    if (modalFooter) {
        // Remove botão existente se houver
        const existingButton = modalFooter.querySelector('.btn-finalizar-compra');
        if (existingButton) {
            existingButton.remove();
        }

        // Adiciona novo botão se houver itens no carrinho
        if (Object.keys(carrinho).length > 0) {
            const finalizarCompraBtn = document.createElement('button');
            finalizarCompraBtn.className = 'btn btn-success btn-finalizar-compra';
            finalizarCompraBtn.textContent = 'Finalizar Compra';
            finalizarCompraBtn.onclick = function() {
                finalizarCompra();
            };
            modalFooter.appendChild(finalizarCompraBtn);
        }
    }
}

function finalizarCompra() {
    console.log('Iniciando finalização da compra...'); // Debug
    
    let carrinho = localStorage.getItem('carrinho');
    if (!carrinho) {
        alert('Seu carrinho está vazio!');
        return;
    }

    // Fecha o modal se estiver aberto
    const carrinhoModal = document.getElementById('carrinhoModal');
    if (carrinhoModal) {
        const modal = bootstrap.Modal.getInstance(carrinhoModal);
        if (modal) {
            modal.hide();
        }
    }

    try {
        // Redireciona para o checkout
        const checkoutUrl = `/checkout?carrinho=${encodeURIComponent(carrinho)}`;
        console.log('Redirecionando para:', checkoutUrl); // Debug
        window.location.href = checkoutUrl;
    } catch (error) {
        console.error('Erro ao redirecionar:', error); // Debug
        alert('Erro ao processar o checkout. Por favor, tente novamente.');
    }
}

function removerDoCarrinho(productId) {
    let carrinho = JSON.parse(localStorage.getItem('carrinho') || '{}');
    delete carrinho[productId];
    localStorage.setItem('carrinho', JSON.stringify(carrinho));
    atualizarCarrinho();
}

function atualizarQuantidadeCarrinho(productId, novaQuantidade) {
    let quantidade = parseInt(novaQuantidade);
    if (isNaN(quantidade) || quantidade < 1) {
        quantidade = 1;
    }

    let carrinho = JSON.parse(localStorage.getItem('carrinho') || '{}');
    if (carrinho[productId]) {
        carrinho[productId].quantidade = quantidade;
        localStorage.setItem('carrinho', JSON.stringify(carrinho));
        atualizarCarrinho();
    }
}

// Inicializa o carrinho quando a página carrega
document.addEventListener('DOMContentLoaded', function() {
    atualizarCarrinho();
});