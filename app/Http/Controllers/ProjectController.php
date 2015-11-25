<?php

namespace TTT\Http\Controllers;

use Illuminate\Http\Request;
use TTT\Http\Controllers\Controller;
use TTT\Models\Project;

class ProjectController extends Controller
{

    /**
     * GET: Show the default project.
     *
     * @return \Illuminate\Contracts\View
     */
    public function index()
    {
        $project = Project::slug(config('projects.default'))->first();

        return view('project.show', compact('project'));
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
