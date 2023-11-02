<?php

namespace App\Http\Controllers;

use App\Prodi;
use App\Fakultas;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::with('prodi')->orderBy('urutan')->get();
        if (Auth::user()->role == 'Prodi') {
            // dd(Auth::user());
            $prodi = Prodi::where('kode', Auth::user()->prodi_kode)->get()[0];
            return view('prodi.profil', [
                'p' => $prodi,
                'edit' => false
            ]);
        } else if (Auth::user()->role == 'Admin') {
            $prodi = Prodi::all();
            return view('dashboard.m2', [
                'f' => $fakultas,
                'p' => $prodi,
                'edit' => false
            ]);
        } else {

            return view('dashboard.m2', [
                'p' => Prodi::get(),
                'f' => $fakultas,
            ]);
        }
    }
}
