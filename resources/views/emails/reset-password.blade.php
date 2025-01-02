<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h2>Olá!</h2>
    <p>Você está recebendo este email porque recebemos uma solicitação de redefinição de senha para sua conta.</p>
    
    <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}" class="button">
        Redefinir Senha
    </a>

    <p>Este link de redefinição de senha expirará em 60 minutos.</p>
    
    <p>Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.</p>
    
    <p>Atenciosamente,<br>AC Vila Meã</p>
</body>
</html> 