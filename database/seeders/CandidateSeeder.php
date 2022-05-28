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
            ['recruitment_id' => 4, 'name' => 'Irwansyah'],
            ['recruitment_id' => 4, 'name' => 'Aby'],
            ['recruitment_id' => 4, 'name' => 'Yuda'],
            ['recruitment_id' => 4, 'name' => 'Anggara Putra'],
            ['recruitment_id' => 4, 'name' => 'Dion']
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
