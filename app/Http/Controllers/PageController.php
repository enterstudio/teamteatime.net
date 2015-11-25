<?php

namespace TTT\Http\Controllers;

use Illuminate\Http\Request;
use TTT\Http\Controllers\Controller;
use TTT\Models\Page;

class PageController extends Controller
{
    /**
     * GET: Show the default page.
     *
     * @return \Illuminate\Contracts\View
     */
    public function home()
    {
        $page = Page::slug(config('pages.default'))->firstOrFail();

        return view('page.show', compact('page'));
    }

    /**
     * GET: Show a page.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\View
     */
    public function show($slug)
    {
        $page = Page::slug($slug)->firstOrFail();

        return view('page.show', compact('page'));
    }
}
