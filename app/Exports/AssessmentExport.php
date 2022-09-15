<?php

namespace App\Exports;

use App\Models\Assessment;
use App\Models\Recruitment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AssessmentExport implements FromView
{

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('app.report.excel', [
            'recruitment' => Recruitment::find($this->id),
            'sawResults' => Assessment::dss_saw($this->id)
        ]);
    }
}
