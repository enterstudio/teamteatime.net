<?php

namespace TTT\Models;

use Eloquent;
use Markdown;
use TTT\Models\Traits\Ownable;
use TTT\Models\Traits\Taggable;
use TeamTeaTime\Filer\AttachableTrait as Attachable;

class Project extends Eloquent
{
    use Attachable, Ownable, Taggable;

    protected $fillable = ['user_id', 'title', 'slug', 'description', 'url_github', 'url_demo', 'url_docs_repo'];

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

    public function getRouteAttribute()
    {
        return route('project.show', ['slug' => $this->slug]);
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
