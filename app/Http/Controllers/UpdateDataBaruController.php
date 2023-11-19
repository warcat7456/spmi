<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use App\Jenjang;
use App\L1;
use App\L2;
use App\L3;
use App\L4;
use App\Kriteria;
use App\Lembaga;
use App\Indikator;
use App\IndikatorLam;
use App\Element;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateDataBaruController extends Controller
{

    function update_new_indikator()
    {
        $ind = Indikator::with(['l1', 'l2', 'l3', 'l4'])->get()->toArray();
        $new_ind = [];

        foreach ($ind as $i) {
            $tmp = [
                'id' => $i['id'],
                // 'jenjang_id' => $i['jenjang_id'],
                'dec' => $i['dec'],
                'bobot' => $i['bobot'],
                'l1_id' => null,
                'l2_id' => null,
                'l3_id' => null,
                'l4_id' => null,
            ];
            // die();
            $l1 = $i['l1']['name'];
            $l1_kode = explode('. ', $l1, 2);
            $l1_name = !empty($l1_kode[1]) ? $l1_kode[1] : '';

            // echo $l1_kode[0];
            // echo $l1_name;
            // die();

            if (!empty($l1_kode[0]) && !empty($l1_name)) {
                $l1krite = Kriteria::whereRaw('BINARY kode = ?', $l1_kode[0])
                    ->whereRaw('BINARY name = ?', $l1_name)
                    ->where('jenjang_id', $i['jenjang_id'])
                    ->where('level', 1)
                    ->get();
                if ($l1krite->count() > 1) {
                    echo "data lebih dari 1";
                    dd($l1krite);
                };
                if (empty($l1krite[0])) {
                    dd($l1_kode);
                    dd($l1krite);
                }
                $tmp['l1_id'] = $l1krite[0]->id;
            } else {
                echo "Ade yg salah bro di L1";
                die();
            }
            if (!empty($i['l2']['name'])) {
                $l2 = $i['l2']['name'];
                $l2_kode = explode('. ', $l2, 2);
                $l2_name = isset($l2_kode[1]) ? $l2_kode[1] : '';
                $l2_tmp_kode = explode('.', $l2_kode[0]);
                $l2_tmp_kode = end($l2_tmp_kode);
                // echo $l2_name;
                // die();
                if (!empty($l2_tmp_kode) && !empty($l2_name)) {
                    $l2krite = Kriteria::whereRaw('BINARY kode = ?', $l2_tmp_kode)
                        ->whereRaw('BINARY name = ?', $l2_name)
                        ->where('level', 2)
                        ->where('parent_id', $l1krite[0]->id)
                        ->get();
                    if ($l2krite->count() > 1 || empty($l2krite[0])) {
                        echo "data lebih dari 1 L2 atau kosong";
                        dd($l2krite);
                    };
                    // dd($l2krite);
                    $tmp['l2_id'] = $l2krite[0]->id;

                    if (!empty($i['l3']['name'])) {
                        $l3 = $i['l3']['name'];
                        $l3_kode = explode('. ', $l3, 2);
                        $l3_name = isset($l3_kode[1]) ? $l3_kode[1] : '';
                        $l3_tmp_kode = explode('.', $l3_kode[0]);
                        $l3_tmp_kode = end($l3_tmp_kode);
                        // echo $l3_name;
                        // dd($l3krite);

                        // die();
                        if (!empty($l3_tmp_kode) && !empty($l3_name)) {
                            $l3krite = Kriteria::whereRaw('BINARY kode = ?', $l3_tmp_kode)
                                ->whereRaw('BINARY name = ?', $l3_name)
                                ->where('level', 3)
                                ->where('parent_id', $l2krite[0]->id)
                                ->get();
                            if ($l3krite->count() > 1 || empty($l3krite[0])) {
                                echo $l3_tmp_kode;
                                echo ($l3_name);
                                echo "data lebih dari 1 L3 atau kosong";
                                dd($i);
                                dd($l3krite);
                            };
                            // dd($l3krite->count());
                            $tmp['l3_id'] = $l3krite[0]->id;
                            // dd($l3krite);

                            if (!empty($i['l4']['name'])) {
                                $l4 = $i['l4']['name'];
                                $l4_kode = explode('. ', $l4, 2);
                                $l4_name = isset($l4_kode[1]) ? $l4_kode[1] : '';
                                $l4_tmp_kode = explode('.', $l4_kode[0]);
                                $l4_tmp_kode = end($l4_tmp_kode);
                                // echo $l4_name;
                                // dd($l4krite);

                                // die();
                                if (!empty($l4_tmp_kode) && !empty($l4_name)) {
                                    $l4krite = Kriteria::whereRaw('BINARY kode = ?', $l4_tmp_kode)
                                        ->whereRaw('BINARY name = ?', $l4_name)
                                        ->where('level', 4)
                                        ->where('parent_id', $l3krite[0]->id)
                                        ->get();
                                    if ($l4krite->count() > 1 || empty($l4krite[0])) {
                                        echo $l4_tmp_kode;
                                        echo $l4_name;
                                        // dd($l4krite);
                                        echo "data lebih dari 1 L4 atau kosong";
                                        dd($l4krite);
                                    };
                                    $tmp['l4_id'] = $l4krite[0]->id;

                                    // dd($l4krite->count());
                                    // dd($l4krite);
                                } else {
                                    echo "Ade yg salah bro di L4";
                                    die();
                                }
                            }
                        } else {
                            echo "Ade yg salah bro di L3";
                            die();
                        }
                    }
                } else {
                    echo "Ade yg salah bro di L2";
                    die();
                }
            }
            $new_ind[] = $tmp;
        }

        IndikatorLam::insert($new_ind);
        // dd($new_ind);
        // return;
    }

    function susun_level($l1, $l2, $l3, $l4)
    {
        $arr = [];
        foreach ($l1 as $lv1) {
            $arr[$lv1['kode']] = $lv1;
            $arr[$lv1['kode']]['lv2'] = [];
        }
        foreach ($l2 as $lv2) {
            $arr[$lv2['kode1']]['lv2'][$lv2['kode']] = $lv2;
            $arr[$lv2['kode1']]['lv2'][$lv2['kode']]['lv3'] = [];
        }
        foreach ($l3 as $lv3) {
            $arr[$lv3['kode1']]['lv2'][$lv3['kode2']]['lv3'][$lv3['kode']] = $lv3;
            $arr[$lv3['kode1']]['lv2'][$lv3['kode2']]['lv3'][$lv3['kode']]['lv4'] = [];
        }
        foreach ($l4 as $lv4) {
            $arr[$lv4['kode1']]['lv2'][$lv4['kode2']]['lv3'][$lv4['kode3']]['lv4'][$lv4['kode']] = $lv4;
        }

        return $arr;
    }

    function update_kriteria($jen)
    {
        $j = Jenjang::where('id', $jen)->orderBy('id', 'ASC')->first();
        Kriteria::where('jenjang_id', $j->id)->delete();
        // Kriteria::whereRaw('1 = 1')->delete();
        // dd($j->id);

        $l1 = L1::select('*')->selectRaw("TRIM(BOTH ' ' FROM SUBSTRING_INDEX(name, SUBSTRING_INDEX(name, ' ', 1), -1)) as s_name, SUBSTRING_INDEX(name, '.', 1) AS kode")->where('jenjang_id', $j->id)->orderBy('id', 'ASC')->get()->toArray(); //A
        $l2 = L2::select('*')->selectRaw("TRIM(BOTH ' ' FROM SUBSTRING_INDEX(name, SUBSTRING_INDEX(name, ' ', 1), -1)) as s_name, SUBSTRING_INDEX(name, '.', 1) AS kode1 ,SUBSTRING_INDEX(name, '.', 2) AS kode")->where('jenjang_id', $j->id)->orderBy('id', 'ASC')->get()->toArray(); // A.1.2.3
        $l3 = L3::select('*')->selectRaw("TRIM(BOTH ' ' FROM SUBSTRING_INDEX(name, SUBSTRING_INDEX(name, ' ', 1), -1)) as s_name, SUBSTRING_INDEX(name, '.', 1) AS kode1 ,SUBSTRING_INDEX(name, '.', 2) AS kode2 ,SUBSTRING_INDEX(name, '.', 3) AS kode")->where('jenjang_id', $j->id)->orderBy('id', 'ASC')->get()->toArray(); // A
        $l4 = L4::select('*')->selectRaw("TRIM(BOTH ' ' FROM SUBSTRING_INDEX(name, SUBSTRING_INDEX(name, ' ', 1), -1)) as s_name, SUBSTRING_INDEX(name, '.', 1) AS kode1 ,SUBSTRING_INDEX(name, '.', 2) AS kode2 ,SUBSTRING_INDEX(name, '.', 3) AS kode3 ,SUBSTRING_INDEX(name, '.', 4) AS kode")->where('jenjang_id', $j->id)->orderBy('id', 'ASC')->get()->toArray();

        $r = $this->susun_level($l1, $l2, $l3, $l4);

        // dd($l1);
        $arr = [];

        foreach ($r as $l1) {
            $tmplv1 = [
                'kode' => $l1['kode'],
                'name' => $l1['s_name'],
                'jenjang_id' => $l1['jenjang_id'],
                'level' => 1,
                'lembaga_id' => 1,
            ];
            $id1 = Kriteria::insertGetId($tmplv1);

            if (!empty($id1)) {
                foreach ($l1['lv2'] as $l2) {
                    // dd($k);
                    // dd(end($k));
                    if (!empty($l2)) {
                        $k = explode('.', $l2['kode']);
                        $tmplv2 = [
                            'kode' => end($k),
                            'name' => $l2['s_name'],
                            'parent_id' => $id1,
                            'level' => 2,
                        ];
                        $id2 = Kriteria::insertGetId($tmplv2);
                        // lv3 start
                        if (!empty($id2)) {
                            foreach ($l2['lv3'] as $l3) {
                                if (!empty($l3)) {
                                    $k = explode('.', $l3['kode']);
                                    $tmplv3 = [
                                        'kode' => end($k),
                                        'name' => $l3['s_name'],
                                        'parent_id' => $id2,
                                        'level' => 3,
                                    ];
                                    $id3 = Kriteria::insertGetId($tmplv3);
                                    // lv4 start
                                    if (!empty($id3)) {
                                        foreach ($l3['lv4'] as $l4) {
                                            if (!empty($l4)) {
                                                $k = explode('.', $l4['kode']);
                                                $tmplv4 = [
                                                    'kode' => end($k),
                                                    'name' => $l4['s_name'],
                                                    'parent_id' => $id3,
                                                    'level' => 4,
                                                ];
                                                $id4 = Kriteria::insertGetId($tmplv4);
                                            }
                                        }
                                    }
                                    // lv4 end
                                }
                            }
                        }
                        // lv3 end
                    }
                }
            }
        }
    }


    function update_elements()
    {
        $el = Element::with('indikator')->orderBy('id', 'desc')->get();

        $migrationFileName = '2023_11_08_165224_add_unique_index_to_elements_table';

        // Menjalankan perintah artisan untuk menjalankan fungsi down migrasi
        Artisan::call('migrate:rollback', [
            '--step' => 1, // Jumlah langkah mundur, sesuaikan dengan kebutuhan Anda
            '--path' => "database/migrations/2023_11_08_165224_add_unique_index_to_elements_table.php", // Path ke file migrasi
        ]);

        // Menampilkan output dari perintah artisan (opsional)
        $output = Artisan::output();
        // dd($output);

        foreach ($el as $e) {
            DB::table('elements')
                ->where('id', $e->id)
                ->update([
                    'l1_id' => $e->indikator->l1_id,
                    'l2_id' => $e->indikator->l2_id,
                    'l3_id' => $e->indikator->l3_id,
                    'l4_id' => $e->indikator->l4_id,
                ]);
        }
        // Schema::table('elements', function (Blueprint $table) {
        //     $table->unique(['prodi_id', 'l1_id', 'l2_id', 'l3_id', 'l4_id', 'indikator_id'], 'unique_index_elements');
        // });
    }

    public function update()
    {
        // Clear Duplikasi Spasi pada Level
        DB::statement("UPDATE l1_s SET name = REPLACE(name, '  ', ' ') WHERE name LIKE '%  %'");
        DB::statement("UPDATE l2_s SET name = REPLACE(name, '  ', ' ') WHERE name LIKE '%  %'");
        DB::statement("UPDATE l3_s SET name = REPLACE(name, '  ', ' ') WHERE name LIKE '%  %'");
        DB::statement("UPDATE l4_s SET name = REPLACE(name, '  ', ' ') WHERE name LIKE '%  %'");

        $this->update_kriteria(1);
        $this->update_kriteria(4);
        $this->update_new_indikator();
        // $this->update_elements();
    }
}
