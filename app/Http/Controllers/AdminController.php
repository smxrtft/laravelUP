<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $advertisements = Advertisement::all(); 
        return view('layouts.index', compact('advertisements', 'users'));
    }

    public function approve(Advertisement $advertisement)
    {
        $advertisement->Status = 'Одобрено';
        $advertisement->save();

        return redirect()->back()->with('success', 'Объявление одобрено.');
    }

    public function reject(Advertisement $advertisement)
    {
        $advertisement->Status = 'Отклонено';
        $advertisement->save();

        return redirect()->back()->with('success', 'Объявление отклонено.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        // Передайте пользователя в представление для редактирования
        return view('layouts.edit_user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->Username = $request->input('Username');
        $user->Email = $request->input('Email');
        $user->Role = $request->input('Role');
        $user->save();

        // Перенаправление на страницу списка пользователей после обновления
        return redirect()->route('admin.index');
    }

    public function editAdvertisement($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $categories = Category::all();
        // Передайте объявление в представление для редактирования
        return view('layouts.edit_advertisement', compact('advertisement', 'categories'));
    }

    public function updateAdvertisement(Request $request, $id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->Title = $request->input('Title');
        $advertisement->Description = $request->input('Description');
        $advertisement->CategoryID = $request->input('CategoryID');
        $advertisement->Status = $request->input('Status');
        $advertisement->save();

        // Перенаправление на страницу списка объявлений после обновления
        return redirect()->route('admin.index');
    }
}
