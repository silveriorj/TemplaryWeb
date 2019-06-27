@extends('principal')

@section('cabecalho')
<div id="img">
        <img src="{{ url('/img/conceitop_ico.png') }}" >
        &nbsp;Registros de Frequências
</div>
@stop

@section('conteudo')

    <form class="form" method="post"  action="{{ action('FrequenciaController@salvar', 0) }}">
            <button type="submit" class="btn btn-primary btn-block">
                <b>Confirmar Lançamento</b>
            </button>
            <br>
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>DeMolay</th>
                        @foreach($task as $tasks)
                        <input type="hidden" name="id_task" value='{{$tasks->id}}''>
                            <th>{{ date("d/m/Y", strtotime($tasks->task_date))}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($demolay as $dm)
                    <tr>
                        <input type="hidden" name="id_user" value='{{$dm->id}}''>
                        <td name="id_user"><strong>{{ $dm->name }}</strong></td>
                        @foreach($task as $tasks)
                        <td>
                            <select name="frequencia" class="form">
                                <option disabled="true" selected="true"> </option>
                                    <option value='0'>0</option>
                                    <option value='1'>1</option>
                            </select>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

@stop
