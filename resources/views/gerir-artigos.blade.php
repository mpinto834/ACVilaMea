<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerir Artigos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header')

    <div class="container my-4">
        <!-- Mensagens de Feedback -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Seção Novo Artigo -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Novo Artigo</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('artigos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
    <label for="tipo_artigo" class="form-label">Tipo de Artigo</label>
    <select class="form-control" id="tipo_artigo" name="tipo_artigo_id" required onchange="toggleTamanhos()">
        <option value="">Selecione um tipo</option>
        @foreach($tipos_artigos as $tipo)
            <option value="{{ $tipo->id }}" data-tem-tamanho="{{ $tipo->tem_tamanho }}">{{ $tipo->nome }}</option>
        @endforeach
    </select>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Artigo</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3" id="stock_div">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" min="0" required>
        </div>
    </div>
</div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem do Artigo</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" class="form-control" id="preco" name="preco" step="0.01" min="0" required>
                    </div>

                    <div class="mb-3" id="tamanhos_div" style="display: none;">
                        <label class="form-label">Tamanhos e Quantidades</label>
                        <div class="row g-3">
                            <div class="col-md-2">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input tamanho-checkbox" id="xs" name="tamanhos[]" value="XS">
                                    <label class="form-check-label" for="xs">XS</label>
                                </div>
                                <input type="number" class="form-control tamanho-quantidade" name="quantidade[XS]" min="0" value="0" disabled>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input tamanho-checkbox" id="s" name="tamanhos[]" value="S">
                                    <label class="form-check-label" for="s">S</label>
                                </div>
                                <input type="number" class="form-control tamanho-quantidade" name="quantidade[S]" min="0" value="0" disabled>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input tamanho-checkbox" id="m" name="tamanhos[]" value="M">
                                    <label class="form-check-label" for="m">M</label>
                                </div>
                                <input type="number" class="form-control tamanho-quantidade" name="quantidade[M]" min="0" value="0" disabled>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input tamanho-checkbox" id="l" name="tamanhos[]" value="L">
                                    <label class="form-check-label" for="l">L</label>
                                </div>
                                <input type="number" class="form-control tamanho-quantidade" name="quantidade[L]" min="0" value="0" disabled>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input tamanho-checkbox" id="xl" name="tamanhos[]" value="XL">
                                    <label class="form-check-label" for="xl">XL</label>
                                </div>
                                <input type="number" class="form-control tamanho-quantidade" name="quantidade[XL]" min="0" value="0" disabled>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Artigo</button>
                </form>
            </div>
        </div>

        <!-- Após a seção "Novo Artigo" e antes da "Lista de Artigos" -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Tipos de Artigos</h5>
            </div>
            <div class="card-body">
                <!-- Formulário para adicionar novo tipo -->
                <form action="{{ route('tipos-artigos.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="nome_tipo" class="form-label">Nome do Tipo</label>
                                <input type="text" class="form-control" id="nome_tipo" name="nome" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="tem_tamanho" name="tem_tamanho" value="1">
                                    <label class="form-check-label" for="tem_tamanho">Tem tamanhos?</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Adicionar Tipo</button>
                        </div>
                    </div>
                </form>

                <!-- Tabela de tipos existentes -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Tem Tamanhos</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tipos_artigos as $tipo)
                                <tr>
                                    <td>{{ $tipo->nome }}</td>
                                    <td>{{ $tipo->tem_tamanho ? 'Sim' : 'Não' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editTipo{{ $tipo->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('tipos-artigos.destroy', $tipo->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Tem certeza que deseja excluir este tipo?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal de Edição do Tipo -->
                                <div class="modal fade" id="editTipo{{ $tipo->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Tipo de Artigo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('tipos-artigos.update', $tipo->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="editNomeTipo{{ $tipo->id }}" class="form-label">Nome do Tipo</label>
                                                        <input type="text" 
                                                               class="form-control" 
                                                               id="editNomeTipo{{ $tipo->id }}" 
                                                               name="nome" 
                                                               value="{{ $tipo->nome }}" 
                                                               required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" 
                                                                   class="form-check-input" 
                                                                   id="editTemTamanho{{ $tipo->id }}" 
                                                                   name="tem_tamanho" 
                                                                   value="1" 
                                                                   {{ $tipo->tem_tamanho ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="editTemTamanho{{ $tipo->id }}">
                                                                Tem tamanhos?
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Lista de Artigos -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Artigos Existentes</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Stock</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($artigos as $artigo)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $artigo->imagem) }}" 
                                             alt="{{ $artigo->nome }}" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td>{{ $artigo->nome }}</td>
                                    <td>{{ number_format($artigo->preco, 2) }}€</td>
                                    <td>
                                        @if($artigo->tipoArtigo->tem_tamanho)
                                            @php
                                                $tamanhos_stock = json_decode($artigo->tamanhos_stock, true) ?? [];
                                                $total_stock = array_sum($tamanhos_stock);
                                            @endphp
                                            {{ $total_stock }}
                                            <button type="button" 
                                                    class="btn btn-sm btn-info ms-2" 
                                                    data-bs-toggle="popover" 
                                                    data-bs-trigger="hover"
                                                    title="Stock por Tamanho" 
                                                    data-bs-content="@foreach($tamanhos_stock as $tamanho => $quantidade){{ $tamanho }}: {{ $quantidade }}&#10;@endforeach">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        @else
                                            {{ $artigo->stock }}
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editArtigo{{ $artigo->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('artigos.destroy', $artigo->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Tem certeza que deseja excluir este artigo?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal de Edição -->
                                <div class="modal fade" id="editArtigo{{ $artigo->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Artigo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('artigos.update', $artigo->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="editNome{{ $artigo->id }}" class="form-label">Nome do Artigo</label>
                                                        <input type="text" 
                                                               class="form-control" 
                                                               id="editNome{{ $artigo->id }}" 
                                                               name="nome" 
                                                               value="{{ $artigo->nome }}" 
                                                               required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editStock{{ $artigo->id }}" class="form-label">Stock</label>
                                                        <input type="number" 
                                                               class="form-control" 
                                                               id="editStock{{ $artigo->id }}" 
                                                               name="stock" 
                                                               value="{{ $artigo->stock }}" 
                                                               min="0" 
                                                               required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editImagem{{ $artigo->id }}" class="form-label">Nova Imagem (opcional)</label>
                                                        <input type="file" 
                                                               class="form-control" 
                                                               id="editImagem{{ $artigo->id }}" 
                                                               name="imagem" 
                                                               accept="image/*">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Preço</label>
                                                        <input type="number" class="form-control" name="preco" value="{{ $artigo->preco }}" step="0.01" min="0" required>
                                                    </div>

                                                    @if($artigo->tipoArtigo->tem_tamanho)
                                                        <div class="mb-3">
                                                            <label class="form-label">Tamanhos e Quantidades</label>
                                                            <div class="row g-3">
                                                                @php
                                                                    $tamanhos_stock = $artigo->tamanhos_stock ? json_decode($artigo->tamanhos_stock, true) : [];
                                                                @endphp
                                                                <div class="col-md-2">
                                                                    <div class="form-check mb-2">
                                                                        <input type="checkbox" class="form-check-input tamanho-checkbox" 
                                                                               name="tamanhos[]" value="XS" 
                                                                               {{ isset($tamanhos_stock['XS']) ? 'checked' : '' }}>
                                                                        <label class="form-check-label">XS</label>
                                                                    </div>
                                                                    <input type="number" class="form-control tamanho-quantidade" 
                                                                           name="quantidade[XS]" min="0" 
                                                                           value="{{ $tamanhos_stock['XS'] ?? 0 }}"
                                                                           {{ isset($tamanhos_stock['XS']) ? '' : 'disabled' }}>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check mb-2">
                                                                        <input type="checkbox" class="form-check-input tamanho-checkbox" 
                                                                               name="tamanhos[]" value="S" 
                                                                               {{ isset($tamanhos_stock['S']) ? 'checked' : '' }}>
                                                                        <label class="form-check-label">S</label>
                                                                    </div>
                                                                    <input type="number" class="form-control tamanho-quantidade" 
                                                                           name="quantidade[S]" min="0" 
                                                                           value="{{ $tamanhos_stock['S'] ?? 0 }}"
                                                                           {{ isset($tamanhos_stock['S']) ? '' : 'disabled' }}>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check mb-2">
                                                                        <input type="checkbox" class="form-check-input tamanho-checkbox" 
                                                                               name="tamanhos[]" value="M" 
                                                                               {{ isset($tamanhos_stock['M']) ? 'checked' : '' }}>
                                                                        <label class="form-check-label">M</label>
                                                                    </div>
                                                                    <input type="number" class="form-control tamanho-quantidade" 
                                                                           name="quantidade[M]" min="0" 
                                                                           value="{{ $tamanhos_stock['M'] ?? 0 }}"
                                                                           {{ isset($tamanhos_stock['M']) ? '' : 'disabled' }}>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check mb-2">
                                                                        <input type="checkbox" class="form-check-input tamanho-checkbox" 
                                                                               name="tamanhos[]" value="L" 
                                                                               {{ isset($tamanhos_stock['L']) ? 'checked' : '' }}>
                                                                        <label class="form-check-label">L</label>
                                                                    </div>
                                                                    <input type="number" class="form-control tamanho-quantidade" 
                                                                           name="quantidade[L]" min="0" 
                                                                           value="{{ $tamanhos_stock['L'] ?? 0 }}"
                                                                           {{ isset($tamanhos_stock['L']) ? '' : 'disabled' }}>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check mb-2">
                                                                        <input type="checkbox" class="form-check-input tamanho-checkbox" 
                                                                               name="tamanhos[]" value="XL" 
                                                                               {{ isset($tamanhos_stock['XL']) ? 'checked' : '' }}>
                                                                        <label class="form-check-label">XL</label>
                                                                    </div>
                                                                    <input type="number" class="form-control tamanho-quantidade" 
                                                                           name="quantidade[XL]" min="0" 
                                                                           value="{{ $tamanhos_stock['XL'] ?? 0 }}"
                                                                           {{ isset($tamanhos_stock['XL']) ? '' : 'disabled' }}>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function toggleTamanhos() {
    const selectTipo = document.getElementById('tipo_artigo');
    const tamanhosDiv = document.getElementById('tamanhos_div');
    const stockDiv = document.getElementById('stock_div');
    const selectedOption = selectTipo.options[selectTipo.selectedIndex];
    
    if (selectedOption.dataset.temTamanho === "1") {
        tamanhosDiv.style.display = 'block';
        stockDiv.style.display = 'none';
        document.getElementById('stock').removeAttribute('required');
    } else {
        tamanhosDiv.style.display = 'none';
        stockDiv.style.display = 'block';
        document.getElementById('stock').setAttribute('required', 'required');
    }
}

        // Gerenciar checkbox de tamanhos e campos de quantidade
        document.querySelectorAll('.tamanho-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const quantidadeInput = this.closest('div').nextElementSibling;
                quantidadeInput.disabled = !this.checked;
                if (!this.checked) {
                    quantidadeInput.value = 0;
                }
            });
        });

        // Chamar toggleTamanhos quando a página carrega e quando o select muda
        document.getElementById('tipo_artigo').addEventListener('change', toggleTamanhos);
        toggleTamanhos();

        // Ativar popovers do Bootstrap
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl, {
                html: true
            })
        })
    });
    </script>
</body>
</html> 