@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
  <div class="funcion-info">
    <p>Fecha: {{ \Carbon\Carbon::parse($funcion->fecha)->toDateString() }}</p>
    <p>Cantidad de acomodadores: {{ $funcion->acomodadores }}</p>
  </div>
  <h2>Participantes</h2>
    @if(count($participantes))
        <table class="table">
        <thead>
            <tr>
            <th>nombre</th>
            <th>apellido</th>
            </tr>
        </thead>
        <tbody>
            @foreach($participantes as $acomodador)
            <tr>
            <td>{{ $acomodador->nombre }}</td>
            <td>{{ $acomodador->apellido }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
    @else
        <p>No hay nadie inscrito</p>
    @endif
    <a class='btn btn-primary' role='button' href="{{ url('funciones' )}}"> volver </a>
  </div>
</div>
@endsection
