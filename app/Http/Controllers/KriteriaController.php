<?php

namespace App\Http\Controllers;

use App\Jenjang;
use App\L1;
use App\L2;
use App\L3;
use App\L4;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $j = Jenjang::where('kode', '<>', 'NULL')->get();
        return view('kriteria.m2', [
            'j' => $j,
        ]);
    }

    // public function index(Request $request)
    // {
    //     $kode = basename($request->path());
    //     $j = Jenjang::where('kode', $kode)->first();
    //     $c = L1::where('jenjang_id', $j->id)->orderBy('id', 'ASC')->get();

    //     return view('kriteria.index', [
    //         'j' => $j,
    //         'c' => $c,
    //     ]);
    // }

    // Menampilkan per jenjang
    public function detail($jenjang)
    {
        $j = Jenjang::where('kode', $jenjang)->first();
        // $c = L1::where('jenjang_id', $j->id)->orderBy('id', 'ASC')->get()->toArray();
        $l1 = L1::select('*')->selectRaw("TRIM(BOTH ' ' FROM SUBSTRING_INDEX(name, SUBSTRING_INDEX(name, ' ', 1), -1)) as s_name, SUBSTRING_INDEX(name, '.', 1) AS kode1")->where('jenjang_id', $j->id)->orderBy('id', 'ASC')->get()->toArray(); //A
        $l2 = L2::select('*')->selectRaw("TRIM(BOTH ' ' FROM SUBSTRING_INDEX(name, SUBSTRING_INDEX(name, ' ', 1), -1)) as s_name, SUBSTRING_INDEX(name, '.', 1) AS kode1 ,SUBSTRING_INDEX(name, '.', 2) AS kode2")->where('jenjang_id', $j->id)->orderBy('id', 'ASC')->get()->toArray(); // A.1.2.3
        $l3 = L3::select('*')->selectRaw("TRIM(BOTH ' ' FROM SUBSTRING_INDEX(name, SUBSTRING_INDEX(name, ' ', 1), -1)) as s_name, SUBSTRING_INDEX(name, '.', 1) AS kode1 ,SUBSTRING_INDEX(name, '.', 2) AS kode2 ,SUBSTRING_INDEX(name, '.', 3) AS kode3")->where('jenjang_id', $j->id)->orderBy('id', 'ASC')->get()->toArray(); // A
        $l4 = L4::select('*')->selectRaw("TRIM(BOTH ' ' FROM SUBSTRING_INDEX(name, SUBSTRING_INDEX(name, ' ', 1), -1)) as s_name, SUBSTRING_INDEX(name, '.', 1) AS kode1 ,SUBSTRING_INDEX(name, '.', 2) AS kode2 ,SUBSTRING_INDEX(name, '.', 3) AS kode3 ,SUBSTRING_INDEX(name, '.', 4) AS kode4")->where('jenjang_id', $j->id)->orderBy('id', 'ASC')->get()->toArray();
        // dd($l1);
        $r = $this->susun_level($l1, $l2, $l3, $l4);
        return view('kriteria.detail', [
            'j' => $j,
            'r' => $r,
        ]);
    }

    public function search($lv, $id)
    {
        if ($lv == 1) {
            $data = L1::select('*')->where('id', $id)->get()->first()->toArray(); //A
        } else    if ($lv == 2) {
            $data = L2::select('*')->where('id', $id)->get()->first()->toArray(); //A
        } else    if ($lv == 3) {
            $data = L3::select('*')->where('id', $id)->get()->first()->toArray(); //A
        } else    if ($lv == 4) {
            $data = L4::select('*')->where('id', $id)->get()->first()->toArray(); //A
        }

        if (!empty($data)) {;
            $data['lv'] = $lv;
            echo json_encode(['error' => false, 'data' => $data]);
        } else
            echo json_encode(['error' => true, 'message' => "Data tidak ditemukan"]);
    }

    function susun_level($l1, $l2, $l3, $l4)
    {
        $arr = [];
        foreach ($l1 as $lv1) {
            $arr[$lv1['kode1']] = $lv1;
            $arr[$lv1['kode1']]['lv2'] = [];
        }
        foreach ($l2 as $lv2) {
            $arr[$lv2['kode1']]['lv2'][$lv2['kode2']] = $lv2;
            $arr[$lv2['kode1']]['lv2'][$lv2['kode2']]['lv3'] = [];
        }
        foreach ($l3 as $lv3) {
            $arr[$lv3['kode1']]['lv2'][$lv3['kode2']]['lv3'][$lv3['kode3']] = $lv3;
            $arr[$lv3['kode1']]['lv2'][$lv3['kode2']]['lv3'][$lv3['kode3']]['lv4'] = [];
        }
        foreach ($l4 as $lv4) {
            $arr[$lv4['kode1']]['lv2'][$lv4['kode2']]['lv3'][$lv4['kode3']]['lv4'][$lv4['kode4']] = $lv4;
        }

        return $arr;
    }
    public function show($jenjang)
    {
        $j = Jenjang::where('kode', $jenjang)->first();
        $c = L1::where('jenjang_id', $j->id)->orderBy('id', 'ASC')->get();

        return view('kriteria.index', [
            'j' => $j,
            'c' => $c,
        ]);
    }

    public function store(Request $request)
    {
        $url = $request->url;
        L1::create([
            'name' => $request->name,
            'jenjang_id' => $request->jenjang,
        ]);
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Ditambahkan</strong>
    </div>');
        return redirect()->to($url);
    }

    public function delete(Request $request)
    {
        // $l1->delete();
        $req = $request->input();
        if ($req['lv'] == 1) {
            L1::where('id', $req['id'])->delete();
        } else if ($req['lv'] == 2) {
            L2::where('id', $req['id'])->delete();
        } else if ($req['lv'] == 3) {
            L3::where('id', $req['id'])->delete();
        } else if ($req['lv'] == 4) {
            L4::where('id', $req['id'])->delete();
        }
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dihapus</strong>
    </div>');
        echo json_encode(['error' => false]);
        // $url = $request->url;
        // return redirect()->to($url);
    }
    public function tambah(Request $request)
    {
        $req = $request->input();
        $data = [
            'jenjang_id' => $req['jenjang'],
            'name' => $req['name'],
        ];
        if ($req['lv'] == 1) {
            // echo "S";
            L1::insert($data);
        } else if ($req['lv'] == 2) {
            $data['l1_id'] = $req['parent'];
            L2::insert($data);
        } else if ($req['lv'] == 3) {
            $data['l2_id'] = $req['parent'];
            L3::insert($data);
        } else if ($req['lv'] == 4) {
            $data['l3_id'] = $req['parent'];
            L4::insert($data);
        }
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Ditambah</strong>
    </div>');
        echo json_encode(['error' => false]);
    }
    public function rubah(Request $request)
    {
        $req = $request->input();
        if ($req['lv'] == 1) {
            L1::where('id', $req['id'])->update(['name' => $req['name']]);
        } else if ($req['lv'] == 2) {
            L2::where('id', $req['id'])->delete();
        } else if ($req['lv'] == 3) {
            L3::where('id', $req['id'])->delete();
        } else if ($req['lv'] == 4) {
            L4::where('id', $req['id'])->delete();
        }
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dirubah</strong>
    </div>');
        echo json_encode(['error' => false]);
    }

    public function hapus(L1 $l1, Request $request)
    {
        $l1->delete();
        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Dihapus</strong>
    </div>');
        $url = $request->url;
        return redirect()->to($url);
    }

    public function put(L1 $l1, Request $request)
    {
        $l1->update([
            'name' => $request->name,
        ]);

        session()->flash('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Data Berhasil Diperbaharui</strong>
    </div>');
        $url = $request->url;
        return redirect()->to($url);
    }
}
