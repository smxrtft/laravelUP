<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        // Логика для отображения формы редактирования пользователя
    }

    public function update(Request $request, User $user)
    {
        // Логика для обновления пользователя
    }

    public function ban(User $user)
    {
        $user->update(['banned' => true]);
        return redirect()->back()->with('success', 'Пользователь успешно забанен.');
    }

    public function unban(User $user)
    {
        $user->update(['banned' => false]);
        return redirect()->back()->with('success', 'Пользователь успешно разбанен.');
    }
}