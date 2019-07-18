<?php

namespace App\Models\Offers;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = [];

    public function rel_mat_group()
    {
        return $this->belongsTo(MaterialGroup::class, 'mat_group_id');
    }
}
