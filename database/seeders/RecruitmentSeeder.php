<?php

namespace Database\Seeders;

use App\Models\Recruitment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RecruitmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recruitment = collect([
            'Petugas Sensus Ekonomi 2016',
            'Petugas Pemetaan SP2020',
            'Petugas Pemetaan Wilkerstat ST2023',
            'Petugas Pendata Lapangan SP2020 Lanjutan',
        ]);

        $recruitment->each( function ($item) {
            Recruitment::create([
                'title' => $item,
                'slug' => Str::slug($item)
            ]);
        });
    }
}
