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
@if(Auth::user()->type==2 || Auth::user()->type==3)
    <div class='row'>
        <div class='col-sm-8' style="text-align: center">
        <a  href="{{ action('DemolayController@cadastrar') }}" type="button" class="btn btn-primary btn-block">
            <b>Cadastrar Novo DeMolay</b>
        </a>
    </div>
@endif
@if(Auth::user()->type==0)
    <div class='row'>
        <div class='col-sm-8' style="text-align: center">
        <a disabled type="button" class="btn btn-primary btn-block">
            <b>Cadastrar Novo DeMolay</b>
        </a>
    </div>
@endif

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
            <img src="/img/search_ico.png" width="16" height="16">
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
            <th>CARGO</th>
            @if(Auth::user()->type==2 || Auth::user()->type==3)
                <th>AÇÃO</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($demolay as $dados)
            <tr>
                <td>{{ $dados->id }}</td>
                <td>{{ $dados->name }}</td>
                <td>{{ $dados->email }}</td>
                <?php if($dados->id_cargo == null){ ?>
                    <td> </td>
                <?php } ?>
                @foreach($cargos as $cargo)
                    <?php if($cargo->id == $dados->id_cargo){?> 
                        <td>{{$cargo->sigla}} - {{$cargo->descricao}}</td>
                    <?php } ?>
                @endforeach
                
                @if(Auth::user()->type==2 || Auth::user()->type==3)
                    <td>
                        <a href="{{ action('DemolayController@editar', ['id' => $dados->id]) }}"><img src="/img/edit_ico.png" height="16" width="16"></a>
                        &nbsp;
                        <a href="{{ action('DemolayController@remover', ['id' => $dados->id]) }}"><img src="/img/delete_ico.png" height="16" width="16"></a>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

@stop