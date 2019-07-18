<?php

namespace App\Models\Kokila;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $connection = 'kokila';

    public function cast()
    {
        return $this->belongsTo(Cast::class, 'id_cast');
    }

    public function operation_dict()
    {
        return $this->belongsTo(OperationDict::class, 'id_opdict');
    }

    public function accordance_dict()
    {
        return $this->belongsTo(AccordanceDict::class, 'accordance');
    }
}
