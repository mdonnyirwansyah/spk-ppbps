<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = 'criterias';

    protected $guarded = [];

    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class);
    }

    public function sub_criterias()
    {
        return $this->hasMany(SubCriteria::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}
