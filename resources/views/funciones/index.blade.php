@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <table class="table">
      <thead>
        <tr>
          <th>fecha</th>
          <th>acomodadores</th>
          <th>comentario</th>
          <th>participar</th>
          <th>ver</th>
        </tr>
      </thead>
      <tbody>
        @foreach($funciones as $funcion)
        <tr>
          <td>{{ \Carbon\Carbon::parse($funcion->fecha)->toDateString() }}</td>
          <td>{{ $funcion->acomodadores }}</td>
          <td>{{ $funcion->comentario or 'no hay comentarios' }}</td>
          <td>
            <form action="{{ url('/funciones/' . $funcion->id . '/participar') }}" method="POST">
              <button class="btn btn-primary" type="submit">Participar!</button>
            </form>
          </td>
          <td><a href="{{ route('funciones.show', $funcion->id) }}" class="btn btn-success" role="button">Ver</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a class='btn btn-primary' role='button' href="{{ url('funciones/create' )}}"> agregar funcion </a>
  </div>
</div>
@endsection
