<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Exibe o formulário de login
    public function showLoginForm()
    {
        return view('login');  // Certifique-se de ter a view 'login.blade.php' para o formulário de login
    }

    // Processa o login do usuário
    public function login(Request $request)
    {
        // Validação dos dados de login
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();  // Retorna os erros de validação
        }

        // Tentativa de login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Se o login for bem-sucedido, redireciona para a página principal
            return redirect()->intended('/');  // Ou qualquer outra página de destino
        }

        // Se o login falhar, retorna com erro
        return back()->withErrors(['email' => 'Credenciais inválidas'])->withInput();
    }

    // Desfaz o login do usuário
    public function logout(Request $request)
    {
        Auth::logout();  // Desloga o usuário

        // Redireciona após o logout
        return redirect('/');
    }

}
