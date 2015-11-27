<?php

namespace TTT\Http\Controllers;

use Markdown;
use TTT\Http\Controllers\Controller;
use TTT\Models\Project;

class DocsController extends Controller
{
    /**
     * GET: Show a specific project's documentation.
     *
     * @param  string  $slug
     * @param  string  $paths
     * @return \Illuminate\Contracts\View|\Illuminate\Http\RedirectResponse
     */
    public function show($slug, $paths = '')
    {
        $project = Project::where('path_docs', '!=', '')->orWhereNotNull('path_docs')->slug($slug)->firstOrFail();
        $dir = $project->path_docs;

        $navigation = file_exists("{$dir}/navigation.md") ? Markdown::convertToHtml(file_get_contents("{$dir}/navigation.md")) : "";

        if (empty($paths) && file_exists("{$dir}/introduction.md")) {
            return redirect("docs/{$project->slug}/introduction.md", 301);
        }

        if (file_exists("{$dir}/{$paths}") && !is_dir("{$dir}/{$paths}")) {
            $content = Markdown::convertToHtml(file_get_contents("{$dir}/{$paths}"));
            return view('docs.show', compact('project', 'navigation', 'content'));
        }

        abort(404);
    }
}
