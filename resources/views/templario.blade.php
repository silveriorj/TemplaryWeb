@extends('principal')

@section('cabecalho')
<div id="m_texto">
        <img src=" {{ url('/img/logo_home.jpg') }}" >
        &nbsp;Menu Principal
</div>
@stop

@section('conteudo')
<div class='row'>

    <div class='col-sm-3' style="text-align: center">
        <a href="/curso">
            <img src="{{ url('/img/curso_ico.png') }}">
        </a>
        <h3> Trabalhos </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/turma">
            <img src="{{ url('/img/logo_home.jpg') }}">
        </a>
        <h3> Gestão </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/demolay">
            <img src="{{ url('/img/user_demolay.jpg') }}">
        </a>
        <h3> DeMolay </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/disciplina">
            <img src="{{ url('/img/disciplina_ico.png') }}">
        </a>
        <h3> Financeiro </h3>
    </div>
</div>
<br>
<div class='row'>
    <div class='col-sm-3' style="text-align: center">
        <a href="/conceito">
            <img src="{{ url('/img/conceito_ico.png') }}">
        </a>
        <h3> Registro de Presença</a> </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/relatorio">
            <img src="{{ url('/img/relatorio_ico.png') }}">
        </a>
        <h3> Relatório </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/importar">
            <img src="{{ url('/img/importar_ico.png') }}">
        </a>
        <h3> Importar </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/exportar">
            <img src="{{ url('/img/exportar_ico.png') }}">
        </a>
        <h3> Exportar </h3>
    </div>

</div>

@stop