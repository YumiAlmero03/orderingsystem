<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="ap">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('table.index') }}">{{ __('Table') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('food.index') }}">{{ __('Food') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('category.index') }}">{{ __('Category') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container center">
                <div class="box center">
            @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
<script>
$(document).ready( function () {
    var table = $('#costumer-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url" : 'https://8001-e95be19b-2f27-4bd8-8195-659118abe105.ws-ap01.gitpod.io/api/costumers',
                "dataSrc": ''
            },
            "columns":[
                {"data" : 'status'},
                {"data" : 'action',
                    "searchable": false,
                    "orderable":false,
                    "render": function (data, type, row) {
                        if ({data:"status"} === 'done') {
                            return '<img src="image/valid.png" style="width:15px" />';}
                            else {
                                return '<img src="image/error.png" style="width:15px" />';
                            }
                        }
                },

                {"data" : 'status'},

                {"data" : 'status'},

                {"data" : 'status'},
            ]

        }
    );
} );

</script>
</html>
