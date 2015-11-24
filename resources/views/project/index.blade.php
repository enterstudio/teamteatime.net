@extends('layouts.default')

@section('title', 'Projects')

@section('splash')
    <h1>Our Projects</h1>
@stop

@section('content')
    @if(Auth::check())
        <div class="row">
            <div class="col-xs-12 text-right">
                <a class="btn btn-success" href="{{ route('projects.create') }}"><i class="fa fa-plus fa-fw"></i> New Project</a>
            </div>
        </div>
        <hr>
    @endif

    <div class="row">
        <div class="col-md-8">
            @foreach ($projects as $project)
                <h2><a href="{{ $project->route }}">{!! $project->title !!}</a></h2>

                {!! $project->summary !!}
                <hr>

                @if (Auth::check())
                    <div class="pull-right">
                        <ul class="list-inline">
                            <li><a href="{!! $project->editRoute !!}">Edit Post</a></li>
                            <li><a class="text-danger" href="#delete-post-{!! $project->id !!}" data-toggle="modal" data-target="#delete-post-{!! $project->id !!}">Delete Post</a></li>
                        </ul>
                    </div>
                @endif
            @endforeach
            <div class="clearfix"></div>
            @include('partials.pagination', ['items' => $projects])
        </div>
        <div class="col-md-4 text-right">
            @if (isset($tags))
                <h3>Tags</h3>
                @foreach ($tags as $tag)
                    <a href="{{ route('blog.tag.index', ['tag' => $tag->slug]) }}" class="label label-primary">{{ $tag->name }}</a>
                @endforeach
            @endif
        </div>
    </div>
@stop

@if (Auth::check())
    @section('bottom')
        @foreach ($projects as $project)
            @include('projects.delete', ['id' => "delete-project-{$project->id}"])
        @endforeach
    @stop
@endif
