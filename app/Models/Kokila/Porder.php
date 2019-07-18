<?php

namespace App\Models\Kokila;

use Illuminate\Database\Eloquent\Model;

class Porder extends Model
{
    protected $connection = 'kokila';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'zamawiajacy');
    }
}
