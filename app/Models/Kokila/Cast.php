<?php

namespace App\Models\Kokila;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    protected $connection = 'kokila';

    public function operation()
    {
        return $this->hasMany(Operation::class, 'id_cast');
    }

    public function porder()
    {
        return $this->belongsTo(Porder::class, 'id_po');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'cast_material');
    }
}
