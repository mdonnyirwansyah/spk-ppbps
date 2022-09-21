<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $table = 'assessments';

    protected $guarded = [];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class);
    }

    public static function get_max_min($criterias)
    {
        $arr=[];
        foreach ($criterias as $key => $criteria) {
            $decoded = json_decode($criteria->assessments,true);
            $arr[$criteria['id']] = [
                'name'=>$criteria['name'],
                'type'=>$criteria['type'],
                'max_weight'=>max(array_column($decoded, 'weight')),
                'min_weight'=>min(array_column($decoded, 'weight'))
            ];
        }
        return $arr;
    }

    public static function dss_saw($recruitment)
    {
        $criterias = Criteria::where('recruitment_id', $recruitment)->orderBy('id','Asc')->has('assessments')->with('sub_criterias')->get();
        $candidates = Candidate::where('recruitment_id', $recruitment)->orderBy('name','Asc')->has('assessments')->with('assessments')->get();
        $arr = [];
        $score=[];
        $minmax =  self::get_max_min($criterias);

        foreach($candidates as $index => $candidate) {
            $arr[$index] = [
                'id' => $candidate->id,
                'name' => $candidate->name,
                'status' => $candidate->status,
                'slug' => $candidate->slug
            ];
             foreach($criterias as $key => $criteria) {
                 foreach($candidate->assessments as $assessment) {
                    if($assessment->criteria_id==$criteria->id) {
                        $arr[$index]['criteria'][$criteria->id] = [
                            'name'=>$criteria->name,
                            'type'=>$criteria->type,
                            'weight'=>$assessment->weight,
                        ];

                        if ($criteria->type=='Benefit') {
                            $result=$assessment->weight/$minmax[$criteria->id]['max_weight'];
                        } else if ($criteria->type=='Cost') {
                            $result=$minmax[$criteria->id]['min_weight']/$assessment->weight;
                        }

                        $arr[$index]['criteria'][$criteria->id]['result'] = $result;
                        $score[$index][] = $result*$criteria->weight;
                    }
                }
            }

            $arr[$index]['score'] = array_sum($score[$index]);
        }

        foreach ($arr as $key => $row)
        {
            $score[$key] = $row['score'];
        }

        array_multisort($score, SORT_DESC, $arr);
        return $arr;
    }
}
