<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Illuminate\Routing\Controller as BaseController;

class ProfileController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
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

            $user->first_name = $validated['first_name'];
            $user->last_name = $validated['last_name'];
            $user->username = $validated['username'];
            $user->email = $validated['email'];
            $user->birth_date = $validated['birth_date'];
            $user->phone_number = $validated['phone_number'];
            $user->save();

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

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Senha atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar a senha.');
        }
    }

    public function updatePhoto(Request $request)
    {
        try {
            $request->validate([
                'photo' => ['required', 'image', 'max:10000'], // Máximo 2MB
            ]);

            $user = Auth::user();

            if ($request->hasFile('photo')) {
                // Deleta a foto antiga se existir
                if ($user->profile_photo) {
                    Storage::disk('public')->delete($user->profile_photo);
                }

                // Armazena a nova foto
                $path = $request->file('photo')->store('profile-photos', 'public');
                
                $user->profile_photo = $path; 
                $user->save();

                return redirect()->back()->with('success', 'Foto de perfil atualizada com sucesso!');
            }

            return redirect()->back()->with('error', 'Nenhuma foto foi enviada.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar a foto.');
        }
    }
}
