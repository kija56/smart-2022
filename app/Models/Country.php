<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use Uuid;

    protected $guarded = ['id'];

    public function records()
    {
        return $this->hasMany(Record::class);
    }
    public function scopeAgeAverage($query)
    {
        return $query->addSelect([
            'age' => Record::selectRaw('round(AVG(life_expectancy),0) as age')
            ->whereColumn('records.country_id', 'countries.id'),
        ]);
    }
}
