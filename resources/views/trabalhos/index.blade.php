@extends('principal')

@section('cabecalho')
<div id="m_texto">
        <img src=" {{ url('/img/curso_ico.png') }}" >
        &nbsp;Trabalhos de Apresentação
</div>
@stop

@section('conteudo')

@if(Auth::user()->type==2 || Auth::user()->type==3)
    <form class="form-inline" action="{{route('trabalhos.store')}}" method="post" enctype="multipart/form-data">
        <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
        <div class="row">
                <input type="text" name="titulo" class="form-control" placeholder="Título">
                <input type="text" name="descricao" class="form-control" placeholder="Descrição">
                <input type="text" name="autor" class="form-control" placeholder="Autor"> 
                <input type="file" name="file" class="form-control">           
        </div>
        <br>
        <div class="row">
            <button type="submit" class="btn btn-primary btn-block">Submeter Arquivo</button> 
        </div>           
    </form>
@endif
    <br><br>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Descricao</th>
                <th>Autor</th>
                <th>Tipo</th>
                <th>Tamanho (Kb)</th>
                @if(Auth::user()->type==2 || Auth::user()->type==3)
                <th>AÇÃO</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach ($arquivos as $dados)
            <tr>
                <td>{{ $dados->titulo }}</td>
                <td>{{ $dados->descricao }}</td>
                <td>{{ $dados->autor }}</td>
                <td>{{ $dados->type }}</td>
                <td>{{ $dados->size }}Kbs</td>
                <td>
                    <a target="blank" href="{{ action('FileController@show', ['id' => $dados->id]) }}"><img src="/img/checked.png" height="16" width="16"></a>
                    <a href="{{ action('FileController@destroy', ['id' => $dados->id]) }}"><img src="/img/delete_ico.png" height="16" width="16"></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
