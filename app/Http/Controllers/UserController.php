<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Fakultas;

class UserController extends Controller
{
    public function edit(Request $request)
    {
        $fakultas = Fakultas::with('prodi')->orderBy('urutan')->get();
        return view('users.form', [
            'edit' => true,
            'f' => $fakultas,
            'i' => auth()->user(),
        ]);
    }
}
