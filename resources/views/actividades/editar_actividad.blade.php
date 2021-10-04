@extends('layouts.app')
@section('content')
    	 <div class="justify-content-center">
  			{{ Form::open(array('url' => '/editar_actividad', 'method'=>'post', 'class'=>'border p-3 form')) }}
          @csrf
          <input type="hidden" name="id" id="id" value="{{ $actividad->id }}">
          <div class="row">
              <div class="col">
                <h1 class="text-center">EDITAR ACTIVIDAD</h1>
              </div>
            </div>
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label"><strong>Categoria</strong></label>
            <div class="col-sm-4">
              <select class="form-control" name="categoria">
                @forelse ($categorias as $categoria)
                  <option {{ ( $categoria->id == $actividad->categoria_id) ? 'selected' : '' }} value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @empty
                  <option disabled>No hay categorias.</option>
                @endforelse
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <input type="text" name="actividad" required value="{{ $actividad->actividad }}" class="form-control">
            </div>
          </div>
          <div class="row"><div class="col">&nbsp;</div></div>
          <div class="row form-group">
              <div class="col text-center">
                <input type="submit" value="Editar" class="btn btn-primary">
              </div>
            </div>
        {{ Form::close() }}
    	</div>
@endsection
