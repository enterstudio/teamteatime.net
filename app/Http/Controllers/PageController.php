<?php

namespace TTT\Http\Controllers;

use Illuminate\Http\Request;
use TTT\Http\Controllers\Controller;
use TTT\Models\Page;

class PageController extends Controller
{
    /**
     * Create a new page controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * GET: Show a list of pages.
     *
     * @return \Illuminate\Contracts\View
     */
    public function _list()
    {
        $pages = Page::all();

        return view('page.list', compact('pages'));
    }

    /**
     * GET: Show the default page.
     *
     * @return \Illuminate\Contracts\View
     */
    public function index()
    {
        $page = Page::slug(config('pages.default'))->first();

        return view('page.show', compact('page'));
    }

    /**
     * GET: Show a create page form.
     *
     * @return \Illuminate\Contracts\View
     */
    public function create()
    {
        return view('page.create');
    }

    /**
     * POST: Create a page.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $page = Page::create($request->only(['title', 'slug', 'content']) + ['user_id' => $request->user->id]);

        return redirect($page->route)->with('success', 'Your page has been created successfully.');
    }

    /**
     * GET: Show a page.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\View
     */
    public function show($slug)
    {
        $page = Page::slug($slug)->first();

        return view('page.show', compact('page'));
    }

    /**
     * GET: Display an edit page form.
     *
     * @param  Page  $page
     * @return \Illuminate\Contracts\View
     */
    public function edit(Page $page)
    {
        return view('page.edit', compact('page'));
    }

    /**
     * PATCH: Update a page.
     *
     * @param  Page  $page
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Page $page, Request $request)
    {
        $page->update($request->only(['title', 'slug', 'content']));

        return redirect($page->route)->with('success', 'Your page has been updated successfully.');
    }

    /**
     * DELETE: Delete a page.
     *
     * @param  Page  $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect('pages')->with('success', 'Your page has been deleted successfully.');
    }
}
