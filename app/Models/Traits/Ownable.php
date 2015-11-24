<?php

namespace TTT\Models\Traits;

use TTT\Models\User;

trait Ownable
{
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getOwnerColumnAttribute()
    {
        return isset($this->owner_column) ? $this->owner_column : 'user_id';
    }

    public function getUserIsOwnerAttribute()
    {
        return auth()->user()->id == $this->ownerColumn;
    }
}
