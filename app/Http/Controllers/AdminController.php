<?php

namespace App\Http\Controllers;

use App\Prodi;
use App\User;
use App\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(User $user)
    {
        return view('users.index', [
            'users' => $user->all(),
        ]);
    }

    public function tambahAdmin()
    {
        return view('users.tambah.admin');
    }
    public function tambahUser()
    {

        $fakultas = Fakultas::with('prodi')->orderBy('urutan')->get();
        return view(
            'users.form',
            [
                'edit' => false,
                'f' => $fakultas
            ],
        );
    }
    public function tambahLpm()
    {
        new Prodi;
        return view('users.tambah.lpm', [
            'prodi' => Prodi::NotIn(),
        ]);
    }

    public function tambahKaprodi()
    {
        new Prodi;
        return view('users.tambah.kaprodi', [
            'prodi' => Prodi::NotIn(),
        ]);
    }

    public function tambahDosen()
    {
        return view('users.tambah.dosen');
    }

    public function tambahUpps()
    {
        return view('users.tambah.upps');
    }

    public function tambahMhsAlm()
    {
        new Prodi;
        return view('users.tambah.mhsalm', [
            'prodi' => Prodi::NotIn(),
        ]);
    }

    public function store(Request $request)
    {
        if ($request->role == 'Dosen') {

            $att = [
                'name' => $request->name,
                'role' => $request->role,
                'prodi_kode' => $request->prodi_kode,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            $prodi = Prodi::where('kode', $request->prodi_kode)->first();
            $att['prodi_name'] = $prodi->name;
        } else {
            $att = [
                'name' => $request->name,
                'role' => $request->role,
                'prodi_kode' => '',
                'prodi_name' => '',
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
        }


        User::create($att);
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Ditambahkan</strong>
    </div>');
        return redirect()->route('users');
    }

    public function edit(User $user)
    {
        $fakultas = Fakultas::with('prodi')->orderBy('urutan')->get();
        return view('users.form', [
            'edit' => true,
            'f' => $fakultas,
            'i' => $user,
        ]);
    }

    public function put(User $user, Request $request)
    {

        if ($request->role == 'Dosen') {
            $att = [
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'prodi_kode' => $request->prodi_kode,
            ];
            $prodi = Prodi::where('kode', $request->prodi_kode)->first();
            $att['prodi_name'] = $prodi->name;
        } else {
            $att = [
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'prodi_kode' => '',
                'prodi_name' => '',
            ];
        }
        if (!empty($request->password)) {
            $att['password'] = Hash::make($request->password);
        }
        $user->update($att);
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dibaharui</strong>
    </div>');
        return redirect()->route('users');
    }

    public function hapus(User $user)
    {
        $user->delete();
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dihapus</strong>
    </div>');
        return redirect()->route('users');
    }
}
