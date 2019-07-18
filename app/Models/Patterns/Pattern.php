<?php

namespace App\Models\Patterns;

use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    protected $guarded = [];

    public function pattern_status()
    {
        return $this->belongsTo(PatternStatus::class, 'status_id');
    }

    public function pattern_history()
    {
        return $this->hasMany(PatternHistory::class);
    }
}
