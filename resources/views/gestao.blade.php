@extends('principal')

@section('cabecalho')
<div>
        <img src=" {{ url('/img/turma_ico.png') }}" >
        &nbsp;Gestões Cadastradas
</div>
@stop

@section('conteudo')

@if (old('cadastrar'))
    <div class="alert alert-success">
        <strong> Gestão {{ old('gestao') }} </strong>: Cadastrado com Sucesso!
    </div>
@endif

@if (old('editar'))
    <div class="alert alert-success">
        <strong> Gestão {{ old('gestao') }} </strong>: Editado com Sucesso!
    </div>
@endif

@if (old('cadastro'))
    <div class="alert alert-success">
        <strong> DeMolay {{ old('name') }} </strong>: Cadastrado com Sucesso!
    </div>
@endif

@if (old('editado'))
    <div class="alert alert-success">
        <strong> DeMolay {{ old('name') }} </strong>: Editado com Sucesso!
    </div>
@endif

@if(Auth::user()->type==3)
    <div class='row'>
        <div class='col-sm-12' style="text-align: center">
            <a  href="{{ action('GestaoController@cadastrar') }}" type="button" class="btn btn-primary btn-block">
                <b>Cadastrar Nova Gestão</b>
            </a>
        </div>
    </div>
@endif

<br>
<table class='table table-striped'>
    <thead>
        <tr>
            <th>ID</th>
            <th>CAPITULO</th>
            <th>ANO</th>
            <th>AÇÃO</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($gestao as $dados)
        <tr>
            <td>{{ $dados->id }}</td>
            <td>{{ $dados->descricao }}</td>
            <td>
                @foreach($capitulo as $data)
                    @if($data->id == $dados->id_capitulo)
                        {{ $dados->gestao }}
                    @endif
                @endforeach
            </td>
            <td>
                <a href="{{ action('GestaoController@listarDemolays', ['id' => $dados->id]) }}"><img src="/img/add_ico.png" height="14" width="14"></a>
                &nbsp;
                @if(Auth::user()->type==3)
                    <a href="{{ action('GestaoController@editar', ['id' => $dados->id]) }}"><img src="/img/edit_ico.png" height="14" width="14"></a>
                    &nbsp;
                    <a href="{{ action('GestaoController@remover', ['id' => $dados->id]) }}"><img src="/img/delete_ico.png" height="14" width="14"></a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@stop