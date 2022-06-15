<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;

    protected $table = 'preferences';

    protected $guarded = [];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function sub_criterias()
    {
        return $this->belongsToMany(SubCriteria::class);
    }
}
