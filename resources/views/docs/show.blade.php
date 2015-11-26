@extends ('layouts.default')

@section ('head')
    <base href="{{ route('docs.show', ['slug' => $project->slug]) }}/">
@stop

@section ('title', "{$project->name} Documentation")

@section ('splash')
    <h1>{{ $project->name }} Documentation</h1>
@stop

@section ('content')
    <div id="docs" class="row">
        <div class="col-sm-3 navigation">
            <div class="well hidden-xs">
                {!! $navigation !!}
            </div>
            <nav class="navbar navbar-default visible-xs-block">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span>Table of contents</span>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        {!! $navigation !!}
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-sm-9 body">
            {!! $content !!}
        </div>
    </div>
@stop

@section ('bottom')
    <script>
    $(document).ready(function () {
        $('#docs .navigation li a').each(function () {
            var href = this.pathname;
            if (href === window.location.pathname) {
                $(this).parent('li').addClass('active');
            }
        });
    });
    </script>
@stop
