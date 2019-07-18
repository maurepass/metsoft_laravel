<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthGroup extends Model
{
    protected $table = 'auth_group';

    
    public function user()
    {
        return $this->belongsToMany(AuthUser::class, 'auth_user_groups', 'group_id', 'user_id');
    }
}
