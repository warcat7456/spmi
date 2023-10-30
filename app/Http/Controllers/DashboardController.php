<?php

namespace App\Http\Controllers;

use App\Prodi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Prodi') {
            // dd(Auth::user());
            $prodi = Prodi::where('kode', Auth::user()->prodi_kode)->get()[0];
            // // dd($prodi);
            return view('prodi.profil', [
                'p' => $prodi,
                'edit' => false
            ]);
        } else if (Auth::user()->role == 'Admin') {
            $prodi = Prodi::all();
            return view('dashboard.index', [
                'p' => $prodi,
                'edit' => false
            ]);
        } else {

            return view('dashboard.index', [
                'p' => Prodi::get(),
            ]);
        }
    }
}
