<?php

namespace TTT\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TTT\Http\Controllers\Controller;
use TTT\Models\Page;

class PageController extends Controller
{
    /**
     * Create a new page admin controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * GET: Show an index of pages.
     *
     * @return \Illuminate\Contracts\View
     */
    public function index()
    {
        return view('admin.page.index', ['pages' => Page::paginate()]);
    }

    /**
     * GET: Show a create page form.
     *
     * @return \Illuminate\Contracts\View
     */
    public function create()
    {
        return $this->edit(new Page);
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
     * GET: Display an edit page form.
     *
     * @param  Page  $page
     * @return \Illuminate\Contracts\View
     */
    public function edit(Page $page)
    {
        return view('admin.page.edit', compact('page'));
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

        return redirect('admin/page')->with('success', 'Your page has been deleted successfully.');
    }
}
