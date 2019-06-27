@extends('principal')

@section('cabecalho')
<div>
        <img src=" {{ url('/img/user_demolay_ico.png') }}" >
        &nbsp;Calendário de Eventos
</div>
@stop

@section('conteudo')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

<div class='row'>
        <div class='col-sm-8  col-md-offset-2' style="text-align: center">
            <a  href="{{ route('tasks.create') }}" type="button" class="btn btn-primary btn-block">
                <b>Cadastrar Novo Evento</b>
            </a>
        </div>
    </div>
<br>
<center>
<div id='calendar' style="width:60%"></div>
</center>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            events : [
                @foreach($tasks as $task)
                {
                    title : '{{ $task->name }}',
                    start : '{{ $task->task_date }}',
                    url : '{{ route('tasks.edit', $task->id) }}'
                },
                @endforeach
            ]
        })
    });
</script>
@stop