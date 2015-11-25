<?php

namespace TTT\Http\Controllers\Admin;

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
        $this->middleware('auth');
    }

    /**
     * GET: Show an index of posts.
     *
     * @return \Illuminate\Contracts\View
     */
    public function index()
    {
        return view('admin.post.index', ['posts' => Post::paginate()]);
    }

    /**
     * GET: Show a 'create post' form.
     *
     * @return \Illuminate\Contracts\View
     */
    public function create()
    {
        $tags = Post::getAllTags();

        return view('admin.post.create', compact('tags'));
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
     * GET: Show an 'edit post' form.
     *
     * @return \Illuminate\Contracts\View
     */
    public function edit(Post $post)
    {
        $tags = Post::getAllTags();

        return view('admin.post.edit', compact('post', 'tags'));
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
     * @param  Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('admin/post')->with('success', 'Your blog post has been deleted successfully.');
    }
}
