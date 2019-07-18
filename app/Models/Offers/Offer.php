<?php

namespace App\Models\Offers;

use Illuminate\Database\Eloquent\Model;
use App\AuthUser;

class Offer extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'status_id' => 1,
    ];

    public function detail()
    {
        return $this->hasMany(Detail::class);
    }

    public function offer_status()
    {
        return $this->belongsTo(OfferStatus::class, 'status_id');
    }

    public function user_mark()
    {
        return $this->belongsTo(AuthUser::class, 'user_mark_id');
    }

    public function user_tech()
    {
        return $this->belongsTo(AuthUser::class, 'user_tech_id');
    }
}
