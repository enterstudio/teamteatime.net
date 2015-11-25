@extends ('layouts.default')

@section ('title', 'Blog Posts')

@section ('splash')
<h1><i class="fa fa-font fa-fw"></i> Blog Posts</h1>
@stop

@section ('content')
    <div class="row">
        <div class="col-xs-12">
            <a class="btn btn-success" href="{{ route('admin.post.create') }}"><i class="fa fa-plus fa-fw"></i> New Post</a>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th><th>Created by</th><th>Last updated</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td><a href="{{ $post->route }}">{{ $post->title }}</a></td>
                        <td>{{ $post->owner->name }} ({{ $post->owner->email }}) {{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ $post->editRoute }}">Edit</a>
                            <a href="#delete-item-{{ $post->id }}" data-toggle="modal" data-target="#delete-item-{{ $post->id }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include ('partials.pagination', ['items' => $posts])
@stop

@section ('bottom')
    @foreach ($posts as $post)
        @include ('partials.modal.delete', ['item' => $post])
    @endforeach
@stop
