<?php

namespace TTT\Http\Controllers;

use Illuminate\Http\Request;
use TTT\Http\Controllers\Controller;
use TTT\Models\Project;

class ProjectController extends Controller
{
    /**
     * GET: Show an index of projects.
     *
     * @return \Illuminate\Contracts\View
     */
    public function index()
    {
        return view('project.index', ['projects' => Project::orderBy('created_at', 'desc')->get()]);
    }

    /**
     * GET: Show a project.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\View
     */
    public function show($slug)
    {
        $project = Project::slug($slug)->firstOrFail();

        return view('project.show', compact('project'));
    }
}
