@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <table class="table">
      <thead>
        <tr>
          <th>nombre</th>
          <th>apellido</th>
          <th>email</th>
          <th>rol</th>
          <th>cambiar rol</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{ $user->nombre }}</td>
          <td>{{ $user->apellido }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ ($user->rol == 0) ? 'Administrador' : 'Acomodador' }}</td>
          <td>
            <form action="{{ url('/users/' . $user->id . '/cambio-rol') }}" method="POST">
                @if($user->rol == 0)
                    <input type="hidden" name="rol" value="1">
                    <button class="btn btn-danger" type="submit">Degradar a acomodador</button>
                @else
                    <input type="hidden" name="rol" value="0">
                    <button class="btn btn-primary" type="submit">Promover a administrador</button>
                @endif
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
