<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Tablas', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'), // Asigna una contraseña por defecto o ajusta según tus necesidades
        ]);

        return redirect()->route('tablas');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('tablas');
    }
}