<?php namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use Auth;
use Input;
use Redirect;
use View;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'archive', 'show']]);
        $this->repository = App::make('App\Repositories\BlogPosts');
    }

    /*
    |--------------------------------------------------------------------------
    | Resource methods
    |--------------------------------------------------------------------------
    */

    public function _list()
    {
        $posts = $this->repository->get();

        return View::make('blog.list', ['posts' => $posts]);
    }

    public function index($tag = null, $year = null, $month = null)
    {
        $with = array(
            'archive'   => $this->repository->getArchive(),
            'tags'      => $this->repository->getExistingTags()
        );

        if (!is_null($tag))
        {
            $with['tag'] = $tag;
            $with['posts'] = $this->repository->withTags($tag)->get();
        }
        else
        {
            $with['posts'] = $this->repository->get();
        }

        if (!is_null($year))
        {
            $with['year'] = $year;
            if (!is_null($month))
            {
                $with['month'] = date("F", mktime(0, 0, 0, $month, 10));
            }
            $with['posts'] = $this->repository->byArchive($year, $month)->get();
        }

        return View::make('blog.index', $with);
    }

    public function archive($year, $month = null)
    {
        return $this->index(null, $year, $month);
    }

    public function create()
    {
        $tags = $this->repository->getAllTags();

        return View::make('blog.create', ['tags' => $tags]);
    }

    public function store()
    {
        $input = array_merge($this->getInput(), ['user_id' => Auth::user()->id]);

        $post = $this->repository->create($input);

        if (Input::has('tags'))
        {
            $post->tag(Input::get('tags'));
        }

        return Redirect::to($post->route)->with('success', 'Your blog post has been created successfully.');
    }

    public function show($year, $id, $slug)
    {
        $post = $this->repository->find($id);

        return View::make('blog.show', ['post' => $post]);
    }

    public function edit($id)
    {
        $post = $this->repository->find($id);
        $tags = $this->repository->getAllTags();

        return View::make('blog.edit', ['post' => $post, 'tags' => $tags]);
    }

    public function update($id)
    {
        $input = $this->getInput();

        $post = $this->repository->find($id);
        $post->fill($input);
        $post->save();

        if (Input::get('tags') != $post->tagList)
        {
            $post->retag(Input::get('tags'));
        }

        return Redirect::to($post->route)->with('success', 'Your blog post has been updated successfully.');
    }

    public function destroy($id)
    {
        $post = $this->repository->find($id);
        $post->delete();

        return Redirect::to('/')->with('success', 'Your blog post has been deleted successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper methods
    |--------------------------------------------------------------------------
    */

    protected function getInput()
    {
        return [
            'title' => Input::get('title'),
            'body'  => Input::get('body')
        ];
    }

}
