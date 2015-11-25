@extends ('layouts.default')

@section ('title', $project->title)

@section ('splash')
    <h1>{{ $project->title }}</h1>
    <span>
        Added {{ $project->created_at->diffForHumans() }}.
    </span>
@stop

@section ('content')
    <div id="project" class="col-md-8 col-md-offset-2">
        @if (Auth::check())
            <div class="text-right">
                <a class="btn btn-info" href="{{ $project->editRoute }}"><i class="fa fa-pencil-square-o"></i> Edit Project</a>
                <a class="btn btn-danger" href="#delete-item-{{ $project->id }}" data-toggle="modal" data-target="#delete-item-{{ $project->id }}"><i class="fa fa-times"></i> Delete Project</a>
            </div>
            <hr>
        @endif

        @if (!empty($project->tagged))
            <p class="text-center">
                <i class="fa fa-tags fa-fw middle text-muted"></i>
                @foreach ($project->tagged as $tag)
                    <a href="{{ route('blog.tag.index', ['tag' => $tag->tag_slug]) }}" class="label label-primary">{{ $tag->tag_name }}</a>
                @endforeach
            </p>
        @endif

        <div class="body">
            {!! $project->descriptionParsed !!}
        </div>

        <hr>

        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES * * */
            var disqus_shortname = 'team-tea-time';

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
    </div>
@stop

@if (Auth::check())
    @section ('bottom')
        @include ('partials.modal.delete', ['item' => $project])
    @stop
@endif