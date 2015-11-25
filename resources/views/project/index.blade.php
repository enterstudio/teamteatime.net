@extends ('layouts.default')

@section ('title', "Tea Time Projects")

@section ('splash')
    <h1>Tea Time Projects</h1>
@stop

@section ('content')
    <div class="row">
        @foreach ($projects as $project)
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $project->title }}</h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            @foreach ($project->tagged as $tag)
                                <span class="label label-default">{{ $tag->tag_name }}</span>
                            @endforeach
                        </p>
                        <p>{{ $project->description }}</p>
                        <div class="pull-right">
                            @if ($project->url_github)
                                <a href="{{ $project->url_github }}" class="btn btn-primary">View source on GitHub <i class="fa fa-github fa-fw"></i></a>
                            @endif
                            @if ($project->url_demo)
                                <a href="{{ $project->url_demo }}" class="btn btn-primary">View demo <i class="fa fa-search fa-fw"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop
