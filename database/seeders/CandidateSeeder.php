<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candidate = collect([
            ['recruitment_id' => 4, 'name' => 'Ade Febrianto'],
            ['recruitment_id' => 4, 'name' => 'Ade Indrayadi Pulungan'],
            ['recruitment_id' => 4, 'name' => 'Siti Hafsah'],
            ['recruitment_id' => 4, 'name' => 'Vela Yunita'],
            ['recruitment_id' => 4, 'name' => 'Vieny Meiliani'],
            ['recruitment_id' => 4, 'name' => 'Vina Ika Ratma'],
            ['recruitment_id' => 4, 'name' => 'Wiwik Widiawati'],
            ['recruitment_id' => 4, 'name' => 'Yandrizon'],
            ['recruitment_id' => 4, 'name' => 'Yopa Surayati'],
            ['recruitment_id' => 4, 'name' => 'Zaipul']
        ]);

        $candidate->each( function ($item) {
            Candidate::create([
                'recruitment_id' => $item['recruitment_id'],
                'name' => $item['name'],
                'slug' => Str::slug($item['name'])
            ]);
        });
    }
}
