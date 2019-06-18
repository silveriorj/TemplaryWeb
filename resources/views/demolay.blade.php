@extends('principal')

@section('cabecalho')
<div>
        <img src=" {{ url('/img/user_demolay_ico.png') }}" >
        &nbsp;DeMolays Cadastrados
</div>
@stop

@section('conteudo')

@if (old('cadastrar'))
    <div class="alert alert-success">
        <strong> {{ old('name') }} </strong>: Cadastrado com Sucesso!
    </div>
@endif

@if (old('editar'))
    <div class="alert alert-success">
        <strong> {{ old('name') }} </strong>: Alterado com Sucesso!
    </div>
@endif

<div class='row'>
    <div class='col-sm-8' style="text-align: center">
        <a  href="{{ action('DemolayController@cadastrar') }}" type="button" class="btn btn-primary btn-block">
            <b>Cadastrar Novo DeMolay</b>
        </a>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <input type="text" list="demolay" class="form-control" autocomplete="on" placeholder="buscar">
        <datalist id="demolay">
            @foreach ($demolay as $dados)
                <option value="{{ $dados->name }}">
            @endforeach
        </datalist>
    </div>

    <div class='col-sm-1' style="text-align: center">
        <button type="button" class="btn btn-default btn-block">
            <span class="glyphicon glyphicon-search"></span>
        </button>
    </div>
</div>
<br>
<table class='table table-striped'>
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>EMAIL</th>
            <th>CAPÍTULO</th>
            @if(Auth::user()->type==2 || Auth::user()->type==3)
                <th>AÇÃO</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach ($demolay as $dados)
        @foreach($capitulo as $cap)
            @if($cap->id == $dados->id_capitulo)
                <tr>
                    <td>{{ $dados->id }}</td>
                    <td>{{ $dados->name }}</td>
                    <td>{{ $dados->email }}</td>
                    <td>{{ $cap->capitulo }}</td>
                    @if(Auth::user()->type==2 || Auth::user()->type==3)
                        <td>
                            <a href="{{ action('DemolayController@editar', ['id' => $dados->id]) }}"><span class='glyphicon glyphicon-pencil'></span></a>
                            &nbsp;
                            <a href="{{ action('DemolayController@remover', ['id' => $dados->id]) }}"><span class='glyphicon glyphicon-remove'></span></a>
                        </td>
                     @endif
                </tr>
                @endif
            @endforeach
    @endforeach
    </tbody>
</table>

@stop