<?php

namespace TTT\Models;

use Eloquent;
use TTT\Models\Traits\Ownable;

class Page extends Eloquent
{
    use Ownable;

    protected $fillable = ['user_id', 'title', 'slug', 'content'];

    /**
     * Scope a query to select by slug.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function getRouteAttribute()
    {
        return route('pages.show', ['slug' => $this->slug]);
    }

    public function getEditRouteAttribute()
    {
        return route('pages.edit', ['pages' => $this->id]);
    }
}
