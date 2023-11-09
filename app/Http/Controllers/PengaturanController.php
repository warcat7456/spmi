<?php

namespace App\Http\Controllers;

use App\Jenjang;
use App\Prodi;
use App\Fakultas;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function jenjang()
    {
        return view('jenjang.index', [
            'jenjang' => Jenjang::NotIn(),
        ]);
    }

    public function jenjangPost(Request $request, Jenjang $jenjang)
    {
        $request->validate([
            'name' => 'required',
            'kode' => 'required',
        ]);

        $att = $request->all();
        $jenjang->create($att);
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data ' . $request->name . ' Berhasil Ditambahkan</strong>
    </div>');
        return redirect()->route('jenjang');
    }

    public function jenjangDelete(Jenjang $jenjang)
    {

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data ' . $jenjang->name . ' Berhasil Dihapus</strong>
    </div>');
        $jenjang->delete();
        return redirect()->route('jenjang');
    }

    public function jenjangPut(Request $request, Jenjang $jenjang)
    {

        $jenjang->update([
            'name' => $request->name,
            'kode' => $request->kode,
        ]);

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Diedit</strong>
    </div>');
        return redirect()->route('jenjang');
    }

    public function prodi()
    {
        return view('prodi.index', [
            'prodi' => Prodi::NotIn(),
            'jenjang' => Jenjang::NotIn(),
            'fakultas' => Fakultas::all()
        ]);
    }

    public function prodiPost(Request $request, Prodi $prodi)
    {
        $request->validate([
            'name' => 'required',
            'kode' => 'required',
        ]);

        $att = $request->all();
        $prodi->create($att);
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data ' . $request->name . ' Berhasil Ditambahkan</strong>
    </div>');
        return redirect()->route('prodi');
    }

    public function prodiDelete(Prodi $prodi)
    {

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data ' . $prodi->name . ' Berhasil Dihapus</strong>
    </div>');
        $prodi->delete();
        return redirect()->route('prodi');
    }

    public function prodiPut(Request $request, Prodi $prodi)
    {

        $prodi->update([
            'name' => $request->name,
            'kode' => $request->kode,
            'jenjang_id' => $request->jenjang_id,
        ]);

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Diedit</strong>
    </div>');
        return redirect()->route('prodi');
    }


    public function fakultas()
    {
        return view('fakultas.index', [
            'fakultas' => Fakultas::NotIn(),
        ]);
    }

    public function fakultasProfil(Fakultas $fakultas)
    {
        return view('fakultas.form-profil', [
            'i' => $fakultas,
        ]);
    }
    public function fakultasPost(Request $request, Fakultas $fakultas)
    {
        $request->validate([
            'nama' => 'required',
            'singkatan' => 'required',
        ]);
        $att = $request->all();
        $fakultas->create($att);
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data ' . $request->nama . ' Berhasil Ditambahkan</strong>
    </div>');
        return redirect()->route('fakultas');
    }

    public function fakultasDelete(Fakultas $fakultas)
    {

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data ' . $fakultas->nama . ' Berhasil Dihapus</strong>
    </div>');
        $fakultas->delete();
        return redirect()->route('fakultas');
    }

    public function fakultasPut(Request $request, Fakultas $fakultas)
    {

        $attr = [
            'nama' => $request->nama,
            'singkatan' => $request->singkatan,
            'urutan' => $request->urutan,
        ];
        if (!empty($request->deskripsi)) $attr['deskripsi'] = $request->deskripsi;
        if (!empty($request->visi)) $attr['visi'] = $request->visi;
        if (!empty($request->misi)) $attr['misi'] = $request->misi;

        $fakultas->update($attr);

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Diedit</strong>
    </div>');
        return redirect()->route('fakultas');
    }
}
