<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
    }

    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            
            $validated = $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'birth_date' => ['nullable', 'date'],
                'phone_number' => ['nullable', 'string', 'max:15'],
            ]);

            $user->update($validated);

            return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar o perfil.');
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $user = Auth::user();

            $request->validate([
                'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('A senha atual está incorreta.');
                    }
                }],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required'],
            ]);

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->back()->with('success', 'Senha atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar a senha.');
        }
    }

    public function updatePhoto(Request $request)
    {
        try {
            $request->validate([
                'photo' => ['required', 'image', 'max:2048'], // Máximo 2MB
            ]);

            $user = Auth::user();

            if ($request->hasFile('photo')) {
                // Deleta a foto antiga se existir
                if ($user->profile_photo) {
                    Storage::disk('public')->delete($user->profile_photo);
                }

                // Armazena a nova foto
                $path = $request->file('photo')->store('profile-photos', 'public');
                
                $user->update([
                    'profile_photo' => $path
                ]);

                return redirect()->back()->with('success', 'Foto de perfil atualizada com sucesso!');
            }

            return redirect()->back()->with('error', 'Nenhuma foto foi enviada.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar a foto: ' . $e->getMessage());
        }
    }
}
