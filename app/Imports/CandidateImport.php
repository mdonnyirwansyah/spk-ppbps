<?php

namespace App\Imports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class CandidateImport implements ToModel
{

    public function __construct(int $recruitment)
    {
        $this->recruitment = $recruitment;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $slug = Str::slug($row[0]);
        $countSlug = Candidate::where('slug', $slug)->count();

        if ($countSlug >= 1) {
            $slug = Str::slug($row[0].'-'.$countSlug);
        }

        return new Candidate([
            'recruitment_id' => $this->recruitment,
            'name' => $row[0],
            'slug' => $slug
        ]);
    }
}
