<?php

namespace App\Imports;

use App\Models\Assessment;
use App\Models\Candidate;
use App\Models\Recruitment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;

class CandidateImport implements ToCollection, WithValidation
{

    public function __construct(int $recruitment)
    {
        $this->recruitment = $recruitment;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $slug = Str::slug($row[0]);
            $countSlug = Candidate::where('slug', $slug)->count();

            if ($countSlug >= 1) {
                $slug = Str::slug($row[0].'-'.$countSlug);
            }

            DB::transaction(function() use ($row, $slug) {
                Candidate::create([
                    'id' => $row[0],
                    'recruitment_id' => $this->recruitment,
                    'name' => $row[1],
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

    public function rules(): array
    {
        return [
             '0' => Rule::unique('candidates', 'id')
        ];
    }

    public function customValidationAttributes()
    {
        return ['0' => ''];
    }
}
