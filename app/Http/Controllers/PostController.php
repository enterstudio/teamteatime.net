<?php

namespace TTT\Http\Controllers;

use Illuminate\Http\Request;
use TTT\Http\Controllers\Controller;
use TTT\Models\Post;

class PostController extends Controller
{
    /**
     * GET: Show an index of posts.
     *
     * @return \Illuminate\Contracts\View
     */
    public function index($tag = null, $year = null, $month = null)
    {
        $with = [
            'archive'   => Post::archive()->get(),
            'tags'      => Post::existingTags()
        ];

        if (!is_null($tag)) {
            $with['tag'] = $tag;
            $with['posts'] = Post::withAnyTag([$tag])->orderBy('created_at', 'desc')->paginate();
        } else {
            $with['posts'] = Post::orderBy('created_at', 'desc')->paginate();
        }

        if (!is_null($year)) {
            $with['year'] = $year;
            if (!is_null($month)) {
                $with['month'] = date('F', mktime(0, 0, 0, $month, 10));
            }
            $with['posts'] = Post::fromArchive($year, $month)->paginate();
        }

        return view('post.index', $with);
    }

    /**
     * GET: Show an index of archived posts.
     *
     * @return \Illuminate\Contracts\View
     */
    public function archive($year, $month = null)
    {
        return $this->index(null, $year, $month);
    }

    /**
     * GET: Show a post.
     *
     * @return \Illuminate\Contracts\View
     */
    public function show($year, $id = 0, $slug = '')
    {
        return view('post.show', ['post' => Post::findOrFail($id)]);
    }
}
