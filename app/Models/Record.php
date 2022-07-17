<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use Uuid;

    protected $guarded = ['id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
