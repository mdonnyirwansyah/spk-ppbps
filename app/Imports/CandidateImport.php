<?php

namespace App\Imports;

use App\Models\Assessment;
use App\Models\Candidate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;

class CandidateImport implements ToCollection
{

    public function __construct(int $recruitment)
    {
        $this->recruitment = $recruitment;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row)
        {
            $slug = Str::slug($row[0]);
            $countSlug = Candidate::where('slug', $slug)->count();

            if ($countSlug >= 1) {
                $slug = Str::slug($row[0].'-'.$countSlug);
            }

            DB::transaction(function() use ($key, $row, $slug) {
                Candidate::create([
                    'recruitment_id' => $this->recruitment,
                    'name' => $row[0],
                    'slug' => $slug
                ]);

                Assessment::updateOrCreate([
                    'candidate_id' => $key+1,
                    'criteria_id' => 1,
                ], [
                    'weight' => $row[1]
                ]);

                Assessment::updateOrCreate([
                    'candidate_id' => $key+1,
                    'criteria_id' => 2,
                ], [
                    'weight' => $row[2]
                ]);

                Assessment::updateOrCreate([
                    'candidate_id' => $key+1,
                    'criteria_id' => 3,
                ], [
                    'weight' => $row[3]
                ]);

                Assessment::updateOrCreate([
                    'candidate_id' => $key+1,
                    'criteria_id' => 4,
                ], [
                    'weight' => $row[4]
                ]);
            });
        }
    }
}
