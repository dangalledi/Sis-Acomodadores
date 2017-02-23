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
    </tr>
  </thead>
  <tbody>
    @foreach($funciones as $funcion)
    <tr>
      <td>{{ \Carbon\Carbon::parse($funcion->fecha)->toDateString() }}</td>
      <td>{{ $funcion->acomodadores }}</td>
      <td>{{ $funcion->comentario or 'no hay comentarios' }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
    </div>
</div>
@endsection
