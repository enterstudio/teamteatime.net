@extends('layouts.default')

@section('title')
    Create Page
@stop

@section('splash')
    <h1>Create Page</h1>
@stop

@section('content')
    <div class="well">
        <?php
        $form = ['url' => URL::route('pages.store'),
            'method' => 'POST',
            'button' => 'Create New Page',
            'defaults' => [
                'title' => '',
                'slug' => '',
                'content' => ''
        ], ];
        ?>
        @include('pages.form')
    </div>
@stop

@section('css')
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/js/bootstrap-switch.min.js"></script>
    <script>
    $(document).ready(function () {
        $('.make-switch').bootstrapSwitch();
        var title = $('#title');
        title.keyup(function (e) {
            val = title.val();
            $('#nav_title').val(val);
            var slug = val.replace(/[^a-zA-Z0-9\s]/g, '')
                     .replace(/^\s+|\s+$/, '')
                     .replace(/\s+/g, '-')
                     .toLowerCase();
            $('#slug').val(slug);
        });
    });
    </script>
@stop
