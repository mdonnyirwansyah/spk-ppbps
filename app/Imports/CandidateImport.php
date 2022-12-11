<?php

namespace App\Imports;

use App\Models\Assessment;
use App\Models\Candidate;
use App\Models\Recruitment;
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

                $recruitment = Recruitment::find($this->recruitment);
                $criterias = $recruitment->criterias()->get();

                foreach ($criterias as $index => $criteria) {
                    Assessment::updateOrCreate([
                        'candidate_id' => $row[0],
                        'criteria_id' => $criteria->id,
                    ], [
                        'weight' => $row[$index + 2]
                    ]);
                }
            });
        }
    }
}
