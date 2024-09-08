<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        $l1Data = [
            [1, 'A. Kondisi Eksternal', 1],
            [2, 'B. Profil Unit Pengelola Program Studi', 1],
            [3, 'C. Kriteria', 1],
            [4, 'D. Analisis dan Penetapan Program Pengembangan', 1],
            [5, 'A. Kondisi Eksternal', 4],
            [6, 'B. Profil Unit Pengelola Program Studi', 4],
            [7, 'C. Kriteria', 4],
            [8, 'D. Analisis dan Penetapan Program Pengembangan', 4],
        ];

        $l2Data = [
            [1, 'C.1. Visi, Misi, Tujuan dan Strategi', 3, 1],
            [2, 'C.2. Tata Pamong, Tata Kelola dan Kerjasama', 3, 1],
            [3, 'C.3. Mahasiswa', 3, 1],
            [4, 'C.4. Sumber Daya Manusia', 3, 1],
            [5, 'C.5. Keuangan, Sarana dan Prasarana', 3, 1],
            [6, 'C.6. Pendidikan', 3, 1],
            [7, 'C.7. Penelitian', 3, 1],
            [8, 'C.8. Pengabdian kepada Masyarakat', 3, 1],
            [9, 'C.9. Luaran dan Capaian Tridharma', 3, 1],
            [10, 'D.1. Analisis dan Capaian Kinerja', 4, 1],
            [11, 'D.2. Analisis SWOT atau Analisis Lain yang Relevan', 4, 1],
            [12, 'D.3. Program Pengembangan', 4, 1],
            [13, 'D.4. Program Keberlanjutan', 4, 1],
            [14, 'C.1. Visi, Misi, Tujuan dan Strategi', 7, 4],
            [15, 'C.2. Tata Pamong, Tata Kelola dan Kerjasama', 7, 4],
            [16, 'C.3. Mahasiswa', 7, 4],
            [17, 'C.4. Sumber Daya Manusia', 7, 4],
            [18, 'C.5. Keuangan, Sarana dan Prasarana', 7, 4],
            [19, 'C.6. Pendidikan', 7, 4],
            [20, 'C.7. Penelitian', 7, 4],
            [21, 'C.8. Pengabdian Kepada Masyarakat', 7, 4],
            [22, 'C.9. Luaran dan Capaian Tridharma', 7, 4],
            [23, 'D.1. Analisis dan Capaian Kinerja', 8, 4],
            [24, 'D.2. Analisis SWOT atau Analisis Lain yang Relevan', 8, 4],
            [25, 'D.3. Program Pengembangan', 8, 4],
            [26, 'D.4. Program Keberlanjutan', 8, 4],
        ];

        $l3Data = [
            [1, 'C.1.4. Indikator Kinerja Utama', 1, 1],
            [2, 'C.2.4. Indikator Kinerja Utama', 2, 1],
            [3, 'C.2.5. Indikator Kinerja Tambahan', 2, 1],
            [4, 'C.2.6.  Evaluasi Capaian Kinerja', 2, 1],
            [5, 'C.2.7. Penjaminan Mutu', 2, 1],
            [6, 'C.2.8. Kepuasan Pemangku Kepentingan', 2, 1],
            [7, 'C.3.4. Indikator Kinerja Utama', 3, 1],
            [8, 'C.4.4. Indikator Kinerja Utama', 4, 1],
            [9, 'C.5.4. Indikator Kinerja Utama', 5, 1],
            [10, 'C.6.4. Indikator Kinerja Utama', 6, 1],
            [12, 'C.7.4. Indikator Kinerja Utama', 7, 1],
            [13, 'C.8.4. Indikator Kinerja Utama', 8, 1],
            [14, 'C.9.4. Indikator Kinerja Utama', 9, 1],
            [15, 'C.1.4. Indikator Kinerja Utama', 14, 4],
            [16, 'C.2.4. Indikator Kinerja Utama', 15, 4],
            [17, 'C.3.4. Indikator Kinerja Utama', 16, 4],
            [18, 'C.4.4. Indikator Kinerja Utama', 17, 4],
            [19, 'C.5.4. Indikator Kinerja Utama', 18, 4],
            [20, 'C.6.4. Indikator Kinerja Utama', 19, 4],
            [21, 'C.7.4. Indikator Kinerja Utama', 20, 4],
            [22, 'C.8.4. Indikator Kinerja Utama', 21, 4],
            [23, 'C.9.4. Indikator Kinerja Utama', 22, 4],
            [24, 'C.2.5. Indikator Kinerja Tambahan', 15, 4],
            [25, 'C.2.6. Evaluasi Capaian Kinerja', 15, 4],
            [26, 'C.2.7. Penjaminan Mutu', 15, 4],
            [27, 'C.2.8. Kepuasan Pemangku Kepentingan', 15, 4],
        ];

        $l4Data = [
            [1, 'C.2.4.a. Sistem Tata Pamong', 2, 1],
            [2, 'C.2.4.b. Kepemimpinan dan Kemampuan Manajerial', 2, 1],
            [3, 'C.2.4.c. Kerjasama', 2, 1],
            [5, 'C.3.4.a. Kualitas Input Mahasiswa', 7, 1],
            [6, 'C.3.4.b. Daya Tarik Program Studi', 7, 1],
            [7, 'C.3.4.c. Layanan Kemahasiswaan', 7, 1],
            [8, 'C.4.4.a. Profil Dosen', 8, 1],
            [9, 'C.4.4.b. Kinerja Dosen', 8, 1],
            [10, 'C.4.4.c.  Pengembangan Dosen', 8, 1],
            [11, 'C.4.4.d. Tenaga Kependidikan', 8, 1],
            [12, 'C.5.4.a. Keuangan', 9, 1],
            [13, 'C.5.4.b. Sarana dan Prasarana', 9, 1],
            [14, 'C.6.4.a. Kurikulum', 10, 1],
            [15, 'C.6.4.b. Karakteristik Proses Pembelajaran', 10, 1],
            [16, 'C.6.4.c. Rencana Proses Pembelajaran', 10, 1],
            [17, 'C.6.4.d. Pelaksanaan Proses Pembelajaran', 10, 1],
            [18, 'C.6.4.e. Monitoring dan Evaluasi Proses Pembelajaran', 10, 1],
            [19, 'C.6.4.f. Penilaian Pembelajaran', 10, 1],
            [20, 'C.6.4.g. Integrasi Kegiatan Penelitian dan PkM dalam Pembelajaran', 10, 1],
            [21, 'C.6.4.h. Suasana Akademik', 10, 1],
            [22, 'C.6.4.i. Kepuasan Mahasiswa', 10, 1],
            [23, 'C.7.4.a. Relevansi Penelitian', 12, 1],
            [24, 'C.7.4.b. Penelitian Dosen dan Mahasiswa', 12, 1],
            [25, 'C.8.4.a. Relevansi PkM', 13, 1],
            [26, 'C.8.4.b. PkM Dosen dan Mahasiswa', 13, 1],
            [27, 'C.9.4.a. Luaran Dharma Pendidikan', 14, 1],
            [28, 'C.9.4.b. Luaran Dharma Penelitian dan PkM', 14, 1],
            [29, 'C.2.4.a. Sistem Tata Pamong', 16, 4],
            [30, 'C.2.4.b. Kepemimpinan dan Kemampuan Manajerial', 16, 4],
            [31, 'C.2.4.c. Kerjasama', 16, 4],
            [32, 'C.3.4.a. Kualitas Input Mahasiswa', 17, 4],
            [33, 'C.3.4.b. Daya Tarik Program Studi', 17, 4],
            [34, 'C.3.4.c. Layanan Kemahasiswaan', 17, 4],
            [35, 'C.4.4.a. Profil Dosen', 18, 4],
            [36, 'C.4.4.b. Kinerja Dosen', 18, 4],
            [37, 'C.4.4.c. Pengembangan Dosen', 18, 4],
            [38, 'C.4.4.d. Tenaga Kependidikan', 18, 4],
            [39, 'C.5.4.a. Keuangan', 19, 4],
            [40, 'C.5.4.b. Sarana dan Prasarana', 19, 4],
            [41, 'C.6.4.a. Kurikulum', 20, 4],
            [42, 'C.6.4.b.  Karakteristik Proses Pembelajaran', 20, 4],
            [43, 'C.6.4.c. Rencana Proses Pembelajaran', 20, 4],
            [44, 'C.6.4.d. Pelaksanaan Proses Pembelajaran', 20, 4],
            [45, 'C.6.4.e. Monitoring dan Evaluasi Proses Pembelajaran', 20, 4],
            [46, 'C.6.4.f. Penilaian Pembelajaran', 20, 4],
            [47, 'C.6.4.g. Integrasi Kegiatan Penelitian dan PkM dalam Pembelajaran', 20, 4],
            [48, 'C.6.4.h. Suasana Akademik', 20, 4],
            [49, 'C.6.4.i. Kepuasan Mahasiswa', 20, 4],
            [50, 'C.7.4.a. Relevansi Penelitian', 21, 4],
            [51, 'C.7.4.b. Penelitian Dosen dan Mahasiswa', 21, 4],
            [52, 'C.8.4.a. Relevansi PkM', 22, 4],
            [53, 'C.9.4.a. Luaran Dharma Pendidikan', 23, 4],
            [54, 'C.9.4.b. Luaran Dharma Penelitian dan PkM', 23, 4],
        ];

        $kriteria = [];
        $idMap = [];

        // Insert L1 data
        foreach ($l1Data as $l1) {
            $newId = $this->insertKriteria($l1[1], substr($l1[1], 0, 1), 1, null, 1, $l1[2]);
            $idMap['L1_' . $l1[0]] = $newId;
        }

        // Insert L2 data
        foreach ($l2Data as $l2) {
            $parentId = $idMap['L1_' . $l2[2]];
            $kode = $this->extractCode($l2[1]);
            $newId = $this->insertKriteria($l2[1], $kode, 2, $parentId, 1, $l2[3]);
            $idMap['L2_' . $l2[0]] = $newId;
        }

        // Insert L3 data
        foreach ($l3Data as $l3) {
            $parentId = $idMap['L2_' . $l3[2]];
            $kode = $this->extractCode($l3[1]);
            $newId = $this->insertKriteria($l3[1], $kode, 3, $parentId, 1, $l3[3]);
            $idMap['L3_' . $l3[0]] = $newId;
        }

        // Insert L4 data
        foreach ($l4Data as $l4) {
            $parentId = $idMap['L3_' . $l4[2]];
            $kode = $this->extractCode($l4[1]);
            $this->insertKriteria($l4[1], $kode, 4, $parentId, 1, $l4[3]);
        }
    }

    private function insertKriteria($name, $kode, $level, $parentId, $lembagaId, $jenjangId)
    {
        return DB::table('kriteria')->insertGetId([
            'name' => $name,
            'kode' => $kode,
            'level' => $level,
            'parent_id' => $parentId,
            'lembaga_id' => $lembagaId,
            'jenjang_id' => $jenjangId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function extractCode($name)
    {
        preg_match('/^([A-Z]\.\d+(\.\d+)?(\.[a-z])?)/', $name, $matches);
        return $matches[1] ?? substr($name, 0, 1);
    }
}
