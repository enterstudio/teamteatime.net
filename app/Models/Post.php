<?php

namespace TTT\Models;

use Datetime;
use Eloquent;
use Markdown;
use TTT\Libraries\Utils;
use TTT\Models\Traits\Archivable;
use TTT\Models\Traits\Ownable;
use TTT\Models\Traits\Taggable;

class Post extends Eloquent
{
    use Archivable, Ownable, Taggable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_posts';

    protected $fillable = ['user_id', 'title', 'body'];

    public function getBodyParsedAttribute()
    {
        return Markdown::convertToHtml($this->body);
    }

    public function getSummaryAttribute()
    {
        return Markdown::convertToHtml(str_limit($this->body, 250));
    }

    public function getRouteAttribute()
    {
        $slug = Utils::urlEncode($this->title);
        return route('blog.post.show', ['year' =>  $this->created_at->year, 'id' => $this->id, 'slug' => $slug]);
    }

    public function getEditRouteAttribute()
    {
        return route('blog.post.edit', ['post' => $this->id]);
    }
}
