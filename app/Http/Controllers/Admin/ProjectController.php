<?php

namespace TTT\Http\Controllers\Admin;

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
        $this->middleware('auth');
    }

    /**
     * GET: Show an index of projects.
     *
     * @return \Illuminate\Contracts\View
     */
    public function index()
    {
        return view('admin.project.index', ['projects' => Project::paginate()]);
    }

    /**
     * GET: Show a create project form.
     *
     * @return \Illuminate\Contracts\View
     */
    public function create()
    {
        return $this->edit(new Project);
    }

    /**
     * POST: Create a project.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $project = Project::create($request->only(['title', 'slug', 'description', 'url_github', 'url_demo', 'path_docs']) + ['user_id' => $request->user()->id]);

        if ($request->has('tags')) {
            $project->tag($request->input('tags'));
        }

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
        $tags = Project::getAllTags();
        return view('admin.project.edit', compact('project', 'tags'));
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
        $project->update($request->only(['title', 'slug', 'description', 'url_github', 'url_demo', 'path_docs']));

        if ($request->input('tags') != $project->tagList) {
            if (!$request->has('tags')) {
                $project->untag();
            } else {
                $project->retag($request->input('tags'));
            }
        }

        return redirect($project->editRoute)->with('success', 'Your project has been updated successfully.');
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

        return redirect('admin/project')->with('success', 'Your project has been deleted successfully.');
    }
}
