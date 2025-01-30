<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    //
    public function index_profil()
    {
        // Ambil data pengguna yang sedang login
        $loginUser = Auth::user();

        // Query menggunakan Eloquent untuk mendapatkan data user berdasarkan name
        $user = User::where('name', $loginUser->name)
            ->select('name', 'email', 'password', 'position') // Pilih kolom yang diperlukan
            ->first();
// dd($user);
        // Compact data ke view
        return view('profil.index', compact('user'));
    }

}
