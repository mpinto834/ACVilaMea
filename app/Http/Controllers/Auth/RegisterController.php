<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Mail\VerifyAccountMail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos campos
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|min:10|max:15',
            'birth_date' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Processa a foto de perfil
        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        // Gera token de verificação
        $verificationToken = Str::random(64);

        // Cria o usuário
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'birth_date' => $request->birth_date,
            'password' => Hash::make($request->password),
            'profile_photo' => $profilePhotoPath,
            'email_verification_token' => $verificationToken,
            'email_verified_at' => null,
        ]);

        // Gera URL de verificação
        $verificationUrl = url("/verify-email/{$verificationToken}");

        // Envia o email de verificação
        Mail::to($user->email)->send(new VerifyAccountMail($verificationUrl, $user->first_name));

        // Redireciona com mensagem
        return redirect('/login')->with('success', 'Conta criada com sucesso! Por favor, verifique seu email para ativar sua conta.');
    }
}