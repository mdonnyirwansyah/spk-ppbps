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
            ['recruitment_id' => 4, 'name' => 'Usia', 'type' => 'Cost', 'weight' => 0.10],
            ['recruitment_id' => 4, 'name' => 'Pendidikan', 'type' => 'Benefit', 'weight' => 0.10],
            ['recruitment_id' => 4, 'name' => 'Pengalaman', 'type' => 'Benefit', 'weight' => 0.20],
            ['recruitment_id' => 4, 'name' => 'Tes Teknikal', 'type' => 'Benefit', 'weight' => 0.30],
            ['recruitment_id' => 4, 'name' => 'Wawancara', 'type' => 'Benefit', 'weight' => 0.30]
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
