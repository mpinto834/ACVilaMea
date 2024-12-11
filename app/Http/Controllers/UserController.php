<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**Mostra a lista de utilizadores*/
  public function index()
{
    $users = User::all();
    return view('gerir-utilizadores', compact('users'));
}

public function updateRole(Request $request, User $user)
{
    // Verifica se o usuário atual é admin
    if (Auth::user()->role !== 2) {
        return back()->with('error', 'Não tem permissão para realizar esta ação');
    }

    // Verifica se não está tentando alterar o próprio papel
    if (Auth::id() === $user->id) {
        return back()->with('error', 'Não é possível alterar sua própria função');
    }

    // Valida o input
    $request->validate([
        'role' => 'required|in:0,1,2'
    ]);

    try {
        // Atualiza o papel do usuário
        $user->role = $request->input('role');
        $user->save();

        return back()->with('success', 'Função do usuário atualizada com sucesso');
    } catch (\Exception $e) {
        return back()->with('error', 'Erro ao atualizar a função do usuário: ' . $e->getMessage());
    }
}
public function destroy(User $user)
{
    // Verifica se o usuário atual é admin
    if (Auth::user()->role !== 2) {
        return back()->with('error', 'Não tem permissão para realizar esta ação');
    }

    // Verifica se não está tentando excluir a si mesmo
    if (Auth::id() === $user->id) {
        return back()->with('error', 'Não é possível excluir a si mesmo');
    }

    try {
        $user->delete();
        return back()->with('success', 'Usuário excluído com sucesso');
    } catch (\Exception $e) {
        return back()->with('error', 'Erro ao excluir o usuário: ' . $e->getMessage());
    }
}
}