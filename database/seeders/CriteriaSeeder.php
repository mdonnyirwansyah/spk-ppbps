<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criteria = collect([
            ['recruitment_id' => 4, 'name' => 'Usia', 'weight' => 0.10],
            ['recruitment_id' => 4, 'name' => 'Pendidikan', 'weight' => 0.10],
            ['recruitment_id' => 4, 'name' => 'Pengalaman', 'weight' => 0.20],
            ['recruitment_id' => 4, 'name' => 'Tes Teknikal', 'weight' => 0.30],
            ['recruitment_id' => 4, 'name' => 'Wawancara', 'weight' => 0.30]
        ]);

        $criteria->each( function ($item) {
            Criteria::create([
                'recruitment_id' => $item['recruitment_id'],
                'name' => $item['name'],
                'weight' => $item['weight'],
                'slug' => Str::slug($item['name'].'-'.$item['recruitment_id'])
            ]);
        });
    }
}
