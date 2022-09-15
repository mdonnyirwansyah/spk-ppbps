<?php

namespace App\Exports;

use App\Models\Assessment;
use App\Models\Recruitment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AssessmentsExport implements FromView
{

    public function __construct(int $recruitment)
    {
        $this->recruitment = $recruitment;
    }

    public function view(): View
    {
        return view('app.report.excel', [
            'recruitment' => Recruitment::find($this->recruitment),
            'sawResults' => Assessment::dss_saw($this->recruitment)
        ]);
    }
}
