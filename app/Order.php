<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $guarded = [];

    protected $attributes = [
        'status_id' => 2,
    ];

    public function tech_memb()
    {
        return $this->belongsTo(AuthUser::class, 'tech_memb_id');
    }
    
    public function ord_status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }
}
