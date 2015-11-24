<?php

namespace TTT\Models\Traits;

use Conner\Tagging\TaggableTrait;

trait Taggable
{
    use TaggableTrait;

    public function getTagListAttribute()
    {
        return implode(',', $this->tagNames());
    }

    public static function getAllTags($jsonEncode = true)
    {
        $tags = self::existingTags();

        $tagNames = [];
        foreach ($tags as $tag) {
            $tagNames[] = $tag->name;
        }

        if ($jsonEncode) {
            return json_encode($tagNames);
        }

        return $tagNames;
    }
}
