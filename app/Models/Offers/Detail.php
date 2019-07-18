<?php

namespace App\Models\Offers;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'details';
     
    protected $guarded = ['action'];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'mat_id');
    }

    public function machining()
    {
        return $this->belongsTo(Machining::class, 'machining_id');
    }
}
