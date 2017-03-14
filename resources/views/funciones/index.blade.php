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
          @if($funcion->acomodadores > $funcion->cantidad_participantes)
            <td>
              <form action="{{ url('/funciones/' . $funcion->id . '/participar') }}" method="POST">
                <button class="btn btn-primary" type="submit">participar</button>
              </form>
            </td>
          @else
            <td>
              <button class="btn btn-danger" type="submit">no quedan cupos</button>
            </td>
          @endif
          <td><a href="{{ route('funciones.show', $funcion->id) }}" class="btn btn-success" role="button">ver</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a class='btn btn-primary' role='button' href="{{ url('funciones/create' )}}"> agregar funcion </a>
  </div>
</div>
@endsection
