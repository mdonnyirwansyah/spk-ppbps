<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';

    protected $guarded = [];

    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class);
    }

    public function preferences()
    {
        return $this->hasMany(Preference::class);
    }
}
