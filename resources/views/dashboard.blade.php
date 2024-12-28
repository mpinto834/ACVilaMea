<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Perfil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    @include('layouts.header')
    @include('layouts.cartmodal')

    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="container my-4">
        <div class="row">
            <!-- Coluna da Foto de Perfil -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="position-relative d-inline-block mb-3">
                                <img src="{{ Auth::user()->profile_photo ? Storage::url(Auth::user()->profile_photo) : 'images/default-avatar.png' }}" 
                                     alt="Foto de Perfil" 
                                     class="rounded-circle" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                                <label for="photo" class="position-absolute bottom-0 end-0 bg-dark text-white rounded-circle p-2" 
                                       style="cursor: pointer;">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <input type="file" id="photo" name="photo" class="d-none" accept="image/*" onchange="this.form.submit()">
                            </div>
                        </form>
                        <h4 class="mb-0">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                        <p class="text-muted">{{ Auth::user()->username }} - 
                            @switch(Auth::user()->role)
                                @case(1)
                                    Sócio
                                    @break
                                @case(2)
                                    Admin
                                    @break
                                @default
                                    Não Sócio
                            @endswitch
                        </p>
                                        </div>
                </div>

                <!-- Card de Gerenciamento movido para dentro da coluna -->
                @if(Auth::user()->role === 2)
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Gestão</h5>
                            <div class="d-grid gap-2">
                                <a href="/gerir-noticias" class="btn btn-outline-primary">Gerir Notícias</a>
                                <a href="/gerir-plantel" class="btn btn-outline-primary">Gerir Plantel</a>
                                <a href="/add-product" class="btn btn-outline-primary">Gerir Artigos</a>
                                <a href="/gerir-jogos" class="btn btn-outline-primary">Gerir Jogos</a>
                                <a href="/gerir-galeria" class="btn btn-outline-primary">Gerir Fotos</a>
                                <a href="/gerir-utilizadores" class="btn btn-outline-primary">Gerir Utilizadores</a>
                                <a href="/gerir-equipas" class="btn btn-outline-primary">Gerir Standings</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- Coluna das Informações -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Informações do Perfil</h5>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Primeiro Nome</label>
                                    <input type="text" class="form-control" name="first_name" 
                                           value="{{ Auth::user()->first_name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Último Nome</label>
                                    <input type="text" class="form-control" name="last_name" 
                                           value="{{ Auth::user()->last_name }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" 
                                       value="{{ Auth::user()->username }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" 
                                       value="{{ Auth::user()->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" name="birth_date" 
                                       value="{{ Auth::user()->birth_date }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Número de Telefone</label>
                                <input type="tel" class="form-control" name="phone_number" 
                                       value="{{ Auth::user()->phone_number }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </form>

                        <!-- Seção de Alteração de Senha -->
                        <hr class="my-4">
                        <h5 class="card-title mb-4">Alterar Senha</h5>
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Senha Atual</label>
                                <input type="password" class="form-control" name="current_password" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nova Senha</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirmar Nova Senha</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Alterar Senha</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @include('layouts.storescript')
</body>
</html>

