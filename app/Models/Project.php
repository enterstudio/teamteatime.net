<?php

namespace TTT\Models;

use Eloquent;
use TTT\Models\Traits\Ownable;
use TeamTeaTime\Filer\AttachableTrait;

class Project extends Eloquent
{
    use Ownable;

    protected $fillable = ['user_id', 'title', 'slug', 'description'];

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
        return route('project.show', ['slug' => $this->slug]);
    }

    public function getEditRouteAttribute()
    {
        return route('project.edit', ['project' => $this->id]);
    }
}
