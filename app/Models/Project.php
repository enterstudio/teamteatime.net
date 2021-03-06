<?php

namespace TTT\Models;

use Eloquent;
use Markdown;
use TTT\Models\Traits\Ownable;
use TTT\Models\Traits\Taggable;

class Project extends Eloquent
{
    use Ownable, Taggable;

    protected $fillable = ['user_id', 'title', 'slug', 'description', 'url_github', 'url_demo', 'path_docs'];

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

    public function getDescriptionParsedAttribute()
    {
        return Markdown::convertToHtml($this->description);
    }

    public function getEditRouteAttribute()
    {
        return route('admin.project.edit', ['project' => $this->id]);
    }

    public function getDeleteRouteAttribute()
    {
        return route('admin.project.destroy', ['project' => $this->id]);
    }
}
