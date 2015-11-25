@extends ('layouts.default')

@section ('title', 'Pages')

@section ('splash')
    <h1><i class="fa fa-file-code-o fa-fw"></i> Projects</h1>
@stop

@section ('content')
    <div class="row">
        <div class="col-xs-12">
            <a class="btn btn-success" href="{{ route('admin.project.create') }}"><i class="fa fa-plus fa-fw"></i> New Project</a>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th><th>Slug</th><th>Created by</th><th>Last updated</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td><a href="{{ $project->route }}">{{ $project->title }}</a></td>
                        <td>{{ $project->slug }}</td>
                        <td>{{ $project->owner->name }} ({{ $project->owner->email }}) {{ $project->created_at->diffForHumans() }}</span></td>
                        <td>{{ $project->updated_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ $project->editRoute }}">Edit</a>
                            <a href="#delete-item-{{ $project->id }}" data-toggle="modal" data-target="#delete-item-{{ $project->id }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include ('partials.pagination', ['items' => $projects])
@stop

@section ('bottom')
    @foreach ($projects as $project)
        @include ('partials.modal.delete', ['item' => $project])
    @endforeach
@stop
