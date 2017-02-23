@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <form method="post" action="{{ url('funciones') }}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="fecha">fecha</label>
          <input type="text" name='fecha' class="form-control" id="fecha" placeholder="año/dia/mes">
        </div>
        <div class="form-group">
          <label for="acomodadores">acomodadores</label>
          <input type="text" name='acomodadores' class="form-control" id="acomodadores" placeholder="numero de acomodadores">
        </div>
        <div class="form-group">
          <label for="comentario">comentario</label>
          <textarea class="form-control" name="comentario" id="comentario" placeholder="agregar comentario"></textarea>
        </div>
        <button type="submit" class="btn btn-default">agregar funcion</button>
    </form>
  </div>
</div>
@endsection
