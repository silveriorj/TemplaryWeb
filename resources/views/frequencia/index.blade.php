@extends('principal')
@section('menu')
    <ul class="nav navbar-nav">
        <li class="active">
            <a href="{{ url('/gestao') }}"> Gestão </a>
        </li>
    </ul>
@stop
@section('cabecalho')
<div id="img">
        <img src="{{ url('/img/conceitop_ico.png') }}" >
        &nbsp;Registros de Frequências
</div>
@stop

@section('conteudo')

    <form class="form" method="post" action="{{ route('frequencia.store') }}">
        <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
            <button type="submit" class="btn btn-primary btn-block">
                <b>Confirmar Lançamento</b>
            </button>
            <br>
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>DeMolay</th>
                        @foreach($tasks as $task)
                        <input type="hidden" name="id_task" value='{{$task->id}}''>
                            <th> {{ $task->name}} <br> {{ date("d/m/Y", strtotime($task->task_date))}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($demolay as $dm)
                    <tr>
                        <input type="hidden" name="id_user" value='{{$dm->id}}''>
                        <td><strong>{{ $dm->name }}</strong></td>
                        @foreach($tasks as $task)
                        <td>
                        <input type="checkbox" name="frequencia" class="form-controll" value="P">
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

@stop
