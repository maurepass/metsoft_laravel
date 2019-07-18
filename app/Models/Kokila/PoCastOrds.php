<?php

namespace App\Models\Kokila;

use Illuminate\Database\Eloquent\Model;

class PoCastOrds extends Model
{
    protected $connection = 'kokila';

    protected $table = 'pocastords';

    public function porder()
    {
        return $this->belongsTo(Porder::class, 'id_po');
    }
}
