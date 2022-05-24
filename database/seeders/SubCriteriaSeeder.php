<?php

namespace Database\Seeders;

use App\Models\SubCriteria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_criteria = collect([
            ['criteria_id' => 1, 'name' => '19-24', 'rating' => 'Sangat Tinggi', 'weight' => 1],
            ['criteria_id' => 1, 'name' => '25-30', 'rating' => 'Tinggi', 'weight' => 2],
            ['criteria_id' => 1, 'name' => '31-36', 'rating' => 'Cukup', 'weight' => 3],
            ['criteria_id' => 1, 'name' => '37-42', 'rating' => 'Rendah', 'weight' => 4],
            ['criteria_id' => 1, 'name' => '43-48', 'rating' => 'Sangat Rendah', 'weight' => 5]
        ]);

        $sub_criteria->each( function ($item) {
            SubCriteria::create([
                'criteria_id' => $item['criteria_id'],
                'name' => $item['name'],
                'rating' => $item['rating'],
                'weight' => $item['weight'],
                'slug' => Str::slug($item['name'].'-'.$item['criteria_id'])
            ]);
        });
    }
}
