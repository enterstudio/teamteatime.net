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
        return view('project.index', ['projects' => Project::orderBy('weight', 'asc')->orderBy('created_at', 'desc')->get()]);
    }
}
