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
