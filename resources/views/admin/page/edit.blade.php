@extends ('layouts.default')

@if ($page->exists)
    @section ('title', "Edit {$page->title}")
@else
    @section ('title', "Create new page")
@endif

@section ('splash')
    @if ($page->exists)
        <h1>{{ $page->title }}</h1>
        <span>You're editing this page</span>
    @else
        <h1>New Page</h1>
    @endif
@stop

@section ('content')
    @if ($page->exists)
        <div class="row">
            <div class="col-xs-12 text-right">
                <a class="btn btn-success" href="{{ route('page.show', $page->slug) }}"><i class="fa fa-file-text"></i> View Page</a> <a class="btn btn-danger" href="#delete-item-{{ $page->id }}" data-toggle="modal" data-target="#delete-item-{{ $page->id }}"><i class="fa fa-times"></i> Delete Page</a>
            </div>
        </div>
        <hr>
    @endif
    <div class="well">
        <form action="{{ $page->exists ? route('admin.page.update', $page->id) : route('admin.page.store') }}" method="post" class="form-horizontal">
            {!! csrf_field() !!}
            {!! $page->exists ? method_field('patch') : '' !!}

            <div class="form-group{{ ($errors->has('title')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="title">Title</label>
                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
                    <input name="title" id="title" value="{{ !is_null(old('title')) ? old('title') : $page->title }}" type="text" class="form-control" placeholder="Title">
                    {!! ($errors->has('title') ? $errors->first('title') : '') !!}
                </div>
            </div>

            <div class="form-group{{ ($errors->has('slug')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="slug">Slug</label>
                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-10">
                    <input name="slug" id="slug" value="{{ !is_null(old('slug')) ? old('slug') : $page->slug }}" type="text" class="form-control" placeholder="Slug">
                    {!! ($errors->has('slug') ? $errors->first('slug') : '') !!}
                </div>
            </div>

            <div class="form-group{{ ($errors->has('content')) ? ' has-error' : '' }}">
                <label class="col-md-2 col-sm-3 col-xs-10 control-label" for="content">Content</label>
                <div class="col-lg-6 col-md-8 col-sm-9 col-xs-12">
                    <textarea name="content" id="content" class="form-control" placeholder="Page content" rows="8">{!! !is_null(old('content')) ? old('content') : $page->content !!}</textarea>
                    {!! ($errors->has('content') ? $errors->first('content') : '') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-sm-offset-3 col-sm-10 col-xs-12">
                    <a href="{{ url('admin/page') }}" class="btn btn-default">Cancel</a>
                    <button class="btn btn-primary pull-right" type="submit"><i class="fa fa-rocket"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
@stop

@section ('bottom')
    @include ('partials.modal.delete', ['item' => $page])
@stop
