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
            ['id' => 1, 'recruitment_id' => 4, 'name' => 'Irwansyah'],
            ['id' => 2, 'recruitment_id' => 4, 'name' => 'Aby'],
            ['id' => 3, 'recruitment_id' => 4, 'name' => 'Yuda'],
            ['id' => 4, 'recruitment_id' => 4, 'name' => 'Anggara Putra'],
            ['id' => 5, 'recruitment_id' => 4, 'name' => 'Dion']
        ]);

        $candidate->each( function ($item) {
            Candidate::create([
                'recruitment_id' => $item['recruitment_id'],
                'name' => $item['name'],
                'slug' => Str::slug($item['name'].'-'.$item['id'])
            ]);
        });
    }
}
