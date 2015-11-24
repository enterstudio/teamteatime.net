<?php

namespace TTT\Http\Controllers;

use Illuminate\Http\Request;
use TTT\Http\Controllers\Controller;
use TTT\Models\Post;

class PostController extends Controller
{
    /**
     * Create a new post controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'archive', 'show']]);
    }

    /**
     * GET: Show a list of posts.
     *
     * @return \Illuminate\Contracts\View
     */
    public function _list()
    {
        $posts = Post::all();

        return view('post.list', compact('posts'));
    }

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
            $with['posts'] = Post::withAnyTag([$tag])->get();
        } else {
            $with['posts'] = Post::paginate();
        }

        if (!is_null($year)) {
            $with['year'] = $year;
            if (!is_null($month)) {
                $with['month'] = date('F', mktime(0, 0, 0, $month, 10));
            }
            $with['posts'] = Post::fromArchive($year, $month)->get();
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
     * GET: Show a 'create post' form.
     *
     * @return \Illuminate\Contracts\View
     */
    public function create()
    {
        $tags = Post::getAllTags();

        return view('post.create', compact('tags'));
    }

    /**
     * POST: Create a post.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $post = Post::create($request->only(['title', 'body']) + ['user_id' => $request->user->id]);

        if ($request->has('tags')) {
            $post->tag($request->input('tags'));
        }

        return redirect($post->route)->with('success', 'Your blog post has been created successfully.');
    }

    /**
     * GET: Show a post.
     *
     * @return \Illuminate\Contracts\View
     */
    public function show($year, $id = 0, $slug = '')
    {
        if (!$id) {
            abort(404);
        }

        $post = Post::find($id);

        return view('post.show', compact('post'));
    }

    /**
     * GET: Show an 'edit post' form.
     *
     * @return \Illuminate\Contracts\View
     */
    public function edit(Post $post)
    {
        $tags = Post::getAllTags();

        return view('post.edit', compact('post', 'tags'));
    }

    /**
     * PATCH: Update a post.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Post $post, Request $request)
    {
        $post->update($request->only(['title', 'body']));

        if ($request->input('tags') != $post->tagList) {
            $post->retag($request->input('tags'));
        }

        return redirect($post->route)->with('success', 'Your blog post has been updated successfully.');
    }

    /**
     * DELETE: Delete a post.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('blog/posts')->with('success', 'Your blog post has been deleted successfully.');
    }
}
