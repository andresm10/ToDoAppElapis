@extends('layouts.app')
@section('content')
    	<div class="justify-content-center">
			{{ Form::open(array('url' => 'nueva_actividad', 'method'=>'post', 'class'=>'border p-3 form')) }}
        <div class="row">
          <div class="col">
            <h1 class="text-center">ACTIVIDADES</h1>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label"><strong>Categoria</strong></label>
          <div class="col-sm-4">
            <select class="form-control" name="categoria">
              @forelse ($categorias as $categoria)
              <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
              @empty
                <option disabled>No hay categorias.</option>
              @endforelse
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <autocomplete-actividades></autocomplete-actividades>
          </div>
        </div>
        <div class="table-responsive-sm" id="container_actividades">
          <table class="table table-sm table-bordered table-hover">
            <thead class="thead-dark">
              <tr>
                <th>&nbsp;</th>
                <th>Categoria</th>
                <th>Actividad</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
              
            @forelse ($actividades as $actividad)
            <tr>
              <td>
                <input type="checkbox" name="check_actividad" id="actividad{{ $actividad->actividad_id  }}" title="Finalizar" onclick="finalizarActividad({{ $actividad->actividad_id }})" style="cursor: pointer;" {{ ( $actividad->estado == 1) ? 'checked' : '' }}>
              </td>  
              <td>{{ $actividad->nombre }}</td>
              <td>{{ $actividad->actividad }}</td>
              <td>
                <a href="/cargar_actividad/{{ $actividad->actividad_id }}" class="btn btn-link" title="Editar"><i class="material-icons">mode_edit</i></a>
              </td>
              <td>
                <a href="/eliminar_actividad/{{ $actividad->actividad_id }}" class="btn btn-link" style="color:#dc3545;" title="Eliminar"><i class="material-icons">delete</i></a>
              </td>
            </tr>
		        @empty
                <tr><td colspan="5">No tiene actividades registradas.</td></tr>
            @endforelse
            </tbody>
          </table>
        </div>
        <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
			{{ Form::close() }}
    	</div>
@endsection
