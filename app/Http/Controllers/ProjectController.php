<?php

namespace TTT\Http\Controllers;

use Illuminate\Http\Request;
use TTT\Http\Controllers\Controller;
use TTT\Models\Project;

class ProjectController extends Controller
{
    /**
     * Create a new project controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * GET: Show a list of projects.
     *
     * @return \Illuminate\Contracts\View
     */
    public function _list()
    {
        $projects = Project::all();

        return view('project.list', compact('projects'));
    }

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
     * GET: Show a create project form.
     *
     * @return \Illuminate\Contracts\View
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * POST: Create a project.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $project = Project::create($request->only(['title', 'slug', 'content']) + ['user_id' => $request->user->id]);

        return redirect($project->route)->with('success', 'Your project has been created successfully.');
    }

    /**
     * GET: Display an edit project form.
     *
     * @param  Project  $project
     * @return \Illuminate\Contracts\View
     */
    public function edit(Project $project)
    {
        return view('project.edit', compact('project'));
    }

    /**
     * PATCH: Update a project.
     *
     * @param  Project  $project
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Project $project, Request $request)
    {
        $project->update($request->only(['title', 'slug', 'content']));

        return redirect($project->route)->with('success', 'Your project has been updated successfully.');
    }

    /**
     * DELETE: Delete a project.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('projects')->with('success', 'Your project has been deleted successfully.');
    }
}
