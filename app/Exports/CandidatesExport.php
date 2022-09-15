<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class CandidatesExport implements FromArray
{

    protected $candidates;

    public function __construct(array $candidates)
    {
        $this->candidates = $candidates;
    }

    public function array(): array
    {
        return $this->candidates;
    }
}
