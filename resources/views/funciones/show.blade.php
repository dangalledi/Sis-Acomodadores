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
            @if($user->rol == 0)
                <th>eliminar</th>
            @endif
            </tr>
        </thead>
        <tbody>
            @foreach($participantes as $acomodador)
            <tr>
            <td>{{ $acomodador->nombre }}</td>
            <td>{{ $acomodador->apellido }}</td>
            @if($user->rol == 0)
                <td>
                    <form action="{{ url('/funciones/' . $funcion->id . '/participantes/' . $acomodador->id) }}" method="POST">
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-danger" type="submit">eliminar</button>
                    </form>
                </td>
            @endif
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
