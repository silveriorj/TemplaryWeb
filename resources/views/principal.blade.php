<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SGT - Sistema de Gestão de Trabalhos</title>

        <!-- Latest compiled and minified CSS -->

        <!-- Bootstrap URL - CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Custom styles for this template -->
        <link href="{{ url('/themes/theme.css') }}" rel="stylesheet">
        <!-- Ajax Script -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        @yield('script')

    </head>

    <body role="document">
        <!-- Fixed navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand">SGT - Sistema de Gestão de  Trabalhos</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active">
                                <a href="{{ url('/') }}">
                                    Home
                                </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container theme-showcase" role="main">
            <br>
            <div class="page-header">

                <div class="page-header">
                    <h1 class="form-signin-heading">
                        @yield('cabecalho')
                    </h1>
                </div>
                @yield('conteudo')
            </div>

            <div class="page-header">
            <center>
                <b>&copy;2019
                    &nbsp;&nbsp;&raquo;&nbsp;&nbsp;
                    Raul J. S. Silverio
                    &nbsp;&nbsp;&raquo;&nbsp;&nbsp;
                    versão 1.0
                </b>
                </center>
            </div>
    </body>
</html>
