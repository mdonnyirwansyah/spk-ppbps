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
            ['recruitment_id' => 1, 'name' => 'Usia', 'type' => 'Cost', 'weight' => 0.15],
            ['recruitment_id' => 1, 'name' => 'Pendidikan', 'type' => 'Benefit', 'weight' => 0.10],
            ['recruitment_id' => 1, 'name' => 'Pengalaman', 'type' => 'Benefit', 'weight' => 0.35],
            ['recruitment_id' => 1, 'name' => 'Pra-Test', 'type' => 'Benefit', 'weight' => 0.40],
        ]);

        $criteria->each( function ($item) {
            Criteria::create([
                'recruitment_id' => $item['recruitment_id'],
                'name' => $item['name'],
                'type' => $item['type'],
                'weight' => $item['weight'],
                'slug' => Str::slug($item['name'].'-'.$item['recruitment_id'])
            ]);
        });
    }
}
