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

    public function getNameAttribute()
    {
        return $this->title;
    }

    public function getRouteAttribute()
    {
        return route('page.show', ['slug' => $this->slug]);
    }

    public function getEditRouteAttribute()
    {
        return route('admin.page.edit', ['page' => $this->id]);
    }

    public function getDeleteRouteAttribute()
    {
        return route('admin.page.destroy', ['page' => $this->id]);
    }
}
