<!DOCTYPE html>
<html>
<body>
    <h2>Olá {{ $userName }},</h2>
    <p>Por favor, verifique sua conta clicando no link abaixo:</p>
    <a href="{{ $verificationUrl }}">Verificar minha conta</a>
    <p>Se você não criou uma conta, ignore este email.</p>
</body>
</html> 