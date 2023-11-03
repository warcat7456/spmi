<?php

use Illuminate\Database\Seeder;
use App\StaticPage;
use Illuminate\Support\Str;

class StaticPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'title' => 'Tentang',
                'content' => '<p>Halaman tentang.</p>',
            ],
            [
                'title' => 'Visi & Misi',
                'content' => '',
            ],
            [
                'title' => 'Struktur',
                'content' => '',
            ],
            [
                'title' => 'PPEP',
                'content' => '',
            ],
            [
                'title' => 'Hubungi Kami',
                'content' => '',
            ],
        ];

        foreach ($pages as $pageData) {
            $pageData['slug'] = Str::slug($pageData['title']);
            StaticPage::create($pageData);
        }
    }
}
