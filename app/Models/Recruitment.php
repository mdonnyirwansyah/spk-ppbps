<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $table = 'recruitments';

    protected $guarded = [];

    public function criterias()
    {
        return $this->hasMany(Criteria::class);
    }
}
