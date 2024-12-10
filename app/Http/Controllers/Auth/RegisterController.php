<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos campos, incluindo a foto de perfil
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'nullable|string|max:15',
            'birth_date' => 'nullable|date',
            'password' => 'required|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validação para a foto
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Verifica se foi enviado um arquivo de foto de perfil
        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            // Armazena a foto na pasta "profile-photos" dentro do diretório público
            $profilePhotoPath = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        // Criação do usuário
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'birth_date' => $request->birth_date,
            'password' => Hash::make($request->password),
            'profile_photo' => $profilePhotoPath, // Salva o caminho da foto de perfil no banco de dados
        ]);

        // Autentica o usuário após o registro
        \Illuminate\Support\Facades\Auth::login($user);

        // Redireciona para a página de login com uma mensagem de sucesso
        return redirect('/login')->with('success', 'Conta criada com sucesso!');
    }
}