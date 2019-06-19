@extends('principal')

@section('cabecalho')
<div id="img">
        <img src="{{ url('/img/conceitop_ico.png') }}" >
        &nbsp;Registros de Frequências
</div>
@stop

@section('conteudo')

@if (old('cadastrar'))
    <div class="alert alert-success">
        <strong> Registrado com Sucesso! </strong>
    </div>
@endif

<div class='row'>
    <div class='col-sm-12' style="text-align: center">
        <a  href="{{ action('FrequenciaController@cadastrar') }}" type="button" class="btn btn-primary btn-block">
            <b>Realizar Novo Registro</b>
        </a>
    </div>
</div>
<br>

<br>
<table class='table table-striped'>
    <thead>
        <tr>
            <th>CAPÍTULO</th>
            <th>ABREVIATURA</th>
            <th>TURMA</th>
            <th>AÇÃO</th>
        </tr>
    </thead>
    <tbody>
        @foreach($demolay as $dm)
            @foreach($capitulo  as $cap)
                @if( $cap->id == $dm->id_capitulo)
                    <tr>
                        <td>{{ $dm->name }} </td>
                        <td>{{ $dm->email }} </td>
                        <td>{{ $cap->capitulo }}</td>
                        <td>
                            <a href="{{ action('FrequenciaController@listarCapitulo', ['id' => $cap->id]) }}"><img src="/img/add_ico.png" height="14" width="14"></span></a>
                        </td>
                    </tr>               
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>

@stop
