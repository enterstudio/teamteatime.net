<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield ('title') - TeamTeaTime</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    @yield ('head')
</head>
<body class="language-php">
    <div id="wrap">
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-primary">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">TeamTeaTime</a>
                </div>
                <div id="navbar-primary" class="collapse navbar-collapse">
                    <div id="main-nav">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('blog') }}">Blog</a></li>
                            <li><a href="{{ url('projects') }}">Projects</a></li>
                        </ul>
                    </div>
                    <div id="bar-nav">
                        <ul class="nav navbar-nav navbar-right">
                            @if (Auth::check())
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        {{ Auth::user()->email }} <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('admin/page') }}"><i class="fa fa-files-o fa-fw"></i> Pages</a></li>
                                        <li><a href="{{ url('admin/project') }}"><i class="fa fa-file-code-o fa-fw"></i> Projects</a></li>
                                        <li><a href="{{ url('admin/post') }}"><i class="fa fa-font fa-fw"></i> Blog Posts</a></li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="{{ url('auth/logout') }}">
                                                <i class="fa fa-power-off fa-fw"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="body">
            @if (isset($__env->getSections()['splash']))
                <div id="splash">
                    <div class="container">
                    @section ('splash')
                    @show
                    </div>
                </div>
            @endif
            <div class="container">
            @include ('partials.notifications')
            @section ('content')
            @show
            </div>
        </div>
        <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-8">
                        <p class="text-muted credit">
                            Built on <a href="http://laravel.com/">Laravel 5</a> with inspiration from <a href="https://github.com/BootstrapCMS/CMS">BootstrapCMS</a>
                        </p>
                    </div>
                    <div class="col-xs-4 text-right">
                        <p class="text-muted credit">
                            Generated in {{ round((microtime(1) - LARAVEL_START), 4) }} sec.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ elixir('js/app.js') }}"></script>
    @section ('bottom')
    @show
    <script>
    $(document).ready(function () {
        $('#main-nav li a').each(function () {
            var href = this.pathname;
            if (href === window.location.pathname) {
                $(this).parent('li').addClass('active');
            }
        });

        $('[data-method]:not(.disabled)').on('click', function (event) {
            $('<form action="' + $(this).data('route') + '" method="POST">' +
            '<input type="hidden" name="_method" value="' + $(this).data('method') + '">' +
            '<input type="hidden" name="_token" value="{{ Session::getToken() }}"' +
            '</form>').submit();

            event.preventDefault();
        });
    });
    </script>
</body>
</html>
