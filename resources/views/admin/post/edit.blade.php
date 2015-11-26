@extends ('layouts.default')

@if ($post->exists)
    @section ('title', "Edit {$post->title}")
@else
    @section ('title', "Create new post")
@endif

@section ('splash')
    @if ($post->exists)
        <h1>{{ $post->title }}</h1>
        <span>You're editing this post</span>
    @else
        <h1>New post</h1>
    @endif
@stop

@section ('content')
    @if ($post->exists)
        <div class="row">
            <div class="col-xs-12 text-right">
                <a class="btn btn-success" href="{{ $post->route }}"><i class="fa fa-file-text"></i> View Post</a> <a class="btn btn-danger" href="#delete-item-{{ $post->id }}" data-toggle="modal" data-target="#delete-item-{{ $post->id }}"><i class="fa fa-times"></i> Delete Post</a>
            </div>
        </div>
        <hr>
    @endif
    <div class="well">
        <form action="{{ $post->exists ? route('admin.post.update', $post->id) : route('admin.post.store') }}" method="post" class="form-horizontal">
            {!! csrf_field() !!}
            {!! $post->exists ? method_field('patch') : '' !!}

            <div class="form-group{{ ($errors->has('title')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="title">Title</label>
                <div class="col-lg-8 col-md-8 col-sm-5 col-xs-10">
                    <input name="title" value="{{ !is_null(old('title')) ? old('title') : $post->title }}" type="text" class="form-control">
                    {!! ($errors->has('title') ? $errors->first('title') : '') !!}
                </div>
            </div>

            <div class="form-group{{ ($errors->has('body')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="body">Body</label>
                <div class="col-lg-6 col-md-8 col-sm-9 col-xs-12">
                    <textarea name="body" type="text" class="form-control" data-provide="markdown" rows="10">{!! !is_null(old('body')) ? old('body') : $post->body !!}</textarea>
                    {!! ($errors->has('body') ? $errors->first('body') : '') !!}
                </div>
            </div>

            <div class="form-group{{ ($errors->has('title')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="title">Tags</label>
                <div class="col-lg-8 col-md-8 col-sm-5 col-xs-10">
                    <input name="tags" value="{{ !is_null(old('tags')) ? old('tags') : $post->tagList }}" type="text" class="form-control">
                    {!! ($errors->has('tags') ? $errors->first('tags') : '') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
                    <a href="{{ url('admin/post') }}" class="btn btn-default">Cancel</a>
                    <button class="btn btn-primary pull-right" type="submit"><i class="fa fa-rocket"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
@stop

@section ('bottom')
    @include ('partials.modal.delete', ['item' => $post])

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
