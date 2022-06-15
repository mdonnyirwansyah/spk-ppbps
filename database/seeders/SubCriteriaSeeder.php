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
            ['criteria_id' => 1, 'name' => '19-24', 'rating' => 'Sangat Rendah', 'weight' => 1],
            ['criteria_id' => 1, 'name' => '25-30', 'rating' => 'Rendah', 'weight' => 2],
            ['criteria_id' => 1, 'name' => '31-36', 'rating' => 'Cukup', 'weight' => 3],
            ['criteria_id' => 1, 'name' => '37-42', 'rating' => 'Tinggi', 'weight' => 4],
            ['criteria_id' => 1, 'name' => '43-48', 'rating' => 'Sangat Tinggi', 'weight' => 5],
            ['criteria_id' => 2, 'name' => 'SMP/Sederajat', 'rating' => 'Sangat Rendah', 'weight' => 1],
            ['criteria_id' => 2, 'name' => 'Tamat SLTA/Sederajat', 'rating' => 'Rendah', 'weight' => 2],
            ['criteria_id' => 2, 'name' => 'Tamat DI/D-II/D-III', 'rating' => 'Cukup', 'weight' => 3],
            ['criteria_id' => 2, 'name' => 'Tamat S-1/D-IV', 'rating' => 'Tinggi', 'weight' => 4],
            ['criteria_id' => 2, 'name' => 'Tamat S-2/S-3', 'rating' => 'Sangat Tinggi', 'weight' => 5],
            ['criteria_id' => 3, 'name' => '0', 'rating' => 'Sangat Rendah', 'weight' => 1],
            ['criteria_id' => 3, 'name' => '1', 'rating' => 'Rendah', 'weight' => 2],
            ['criteria_id' => 3, 'name' => '2', 'rating' => 'Cukup', 'weight' => 3],
            ['criteria_id' => 3, 'name' => '3', 'rating' => 'Tinggi', 'weight' => 4],
            ['criteria_id' => 3, 'name' => '>=4', 'rating' => 'Sangat Tinggi', 'weight' => 5],
            ['criteria_id' => 4, 'name' => '<=60', 'rating' => 'Sangat Rendah', 'weight' => 1],
            ['criteria_id' => 4, 'name' => '70-61', 'rating' => 'Rendah', 'weight' => 2],
            ['criteria_id' => 4, 'name' => '80-71', 'rating' => 'Cukup', 'weight' => 3],
            ['criteria_id' => 4, 'name' => '90-81', 'rating' => 'Tinggi', 'weight' => 4],
            ['criteria_id' => 4, 'name' => '>=90', 'rating' => 'Sangat Tinggi', 'weight' => 5]
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
