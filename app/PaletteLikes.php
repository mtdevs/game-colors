<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaletteLikes extends Model
{
    protected $guarded = [];

    public function palette()
    {
        return $this->belongsTo(Palette::class);
    }
}
