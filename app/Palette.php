<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Palette extends Model
{
    protected $guarded = [];

    public function likes()
    {
        return $this->hasMany(PaletteLikes::class);
    }
}
