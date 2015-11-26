@extends ('layouts.default')

@if ($project->exists)
    @section ('title', "Edit {$project->title}")
@else
    @section ('title', "Create project")
@endif

@section ('splash')
    @if ($project->exists)
        <h1>{{ $project->title }}</h1>
        <span>You're editing this project</span>
    @else
        <h1>New Project</h1>
    @endif
@stop

@section ('content')
    @if ($project->exists)
        <div class="row">
            <div class="col-xs-12 text-right">
                <a class="btn btn-success" href="{{ $project->route }}"><i class="fa fa-file-text"></i> View Project</a> <a class="btn btn-danger" href="#delete-item-{{ $project->id }}" data-toggle="modal" data-target="#delete-item-{{ $project->id }}"><i class="fa fa-times"></i> Delete Project</a>
            </div>
        </div>
        <hr>
    @endif
    <div class="well">
        <form action="{{ $project->exists ? route('admin.project.update', $project->id) : route('admin.project.store') }}" method="post" class="form-horizontal">
            {!! csrf_field() !!}
            {!! $project->exists ? method_field('patch') : '' !!}

            <div class="form-group{{ ($errors->has('title')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="title">Title</label>
                <div class="col-lg-8 col-md-8 col-sm-5 col-xs-10">
                    <input name="title" value="{{ !is_null(old('title')) ? old('title') : $project->title }}" type="text" class="form-control">
                    {!! ($errors->has('title') ? $errors->first('title') : '') !!}
                </div>
            </div>

            <div class="form-group{{ ($errors->has('slug')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="slug">Slug</label>
                <div class="col-lg-8 col-md-8 col-sm-5 col-xs-10">
                    <input name="slug" value="{{ !is_null(old('slug')) ? old('slug') : $project->slug }}" type="text" class="form-control">
                    {!! ($errors->has('slug') ? $errors->first('slug') : '') !!}
                </div>
            </div>

            <div class="form-group{{ ($errors->has('description')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="description">Description</label>
                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">
                    <textarea name="description" type="text" class="form-control" data-provide="markdown" rows="10">{!! !is_null(old('description')) ? old('description') : $project->description !!}</textarea>
                    {!! ($errors->has('description') ? $errors->first('description') : '') !!}
                </div>
            </div>

            <div class="form-group{{ ($errors->has('url_github')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="url_github">GitHub URL</label>
                <div class="col-lg-8 col-md-8 col-sm-5 col-xs-10">
                    <input name="url_github" value="{{ !is_null(old('url_github')) ? old('url_github') : $project->url_github }}" type="text" class="form-control">
                    {!! ($errors->has('url_github') ? $errors->first('url_github') : '') !!}
                </div>
            </div>

            <div class="form-group{{ ($errors->has('url_demo')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="url_demo">Demo URL</label>
                <div class="col-lg-8 col-md-8 col-sm-5 col-xs-10">
                    <input name="url_demo" value="{{ !is_null(old('url_demo')) ? old('url_demo') : $project->url_demo }}" type="text" class="form-control">
                    {!! ($errors->has('url_demo') ? $errors->first('url_demo') : '') !!}
                </div>
            </div>

            <div class="form-group{{ ($errors->has('path_docs')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="path_docs">Documentation system path</label>
                <div class="col-lg-8 col-md-8 col-sm-5 col-xs-10">
                    <input name="path_docs" value="{{ !is_null(old('path_docs')) ? old('path_docs') : $project->path_docs }}" type="text" class="form-control">
                    <span class="help-block">If specified, documentation URLs will be generated from directories and markdown files in this location</span>
                    {!! ($errors->has('path_docs') ? $errors->first('path_docs') : '') !!}
                </div>
            </div>

            <div class="form-group{{ ($errors->has('tags')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="tags">Tags</label>
                <div class="col-lg-8 col-md-8 col-sm-5 col-xs-10">
                    <input name="tags" value="{{ !is_null(old('tags')) ? old('tags') : $project->tagList }}" type="text" class="form-control">
                    {!! ($errors->has('tags') ? $errors->first('tags') : '') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
                    <a href="{{ url('admin/project') }}" class="btn btn-default">Cancel</a>
                    <button class="btn btn-primary pull-right" type="submit"><i class="fa fa-rocket"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
@stop

@section ('bottom')
    @if ($project->exists)
        @include ('partials.modal.delete', ['item' => $project])
    @endif
    <script>
    $(document).ready(function() {
        $('input[name=tags]').tagsinput({
          typeahead: {
               source: {!! $tags !!}
          }
        });
    });
    </script>
@stop
