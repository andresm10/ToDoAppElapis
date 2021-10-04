@extends('layouts.app')
@section('content')
    	<div class="justify-content-center">
			{{ Form::open(array('url' => 'nueva_categoria', 'method'=>'post', 'class'=>'border p-3 form')) }}
        <div class="row">
          <div class="col">
            <h1 class="text-center">CATEGORIAS</h1>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <autocomplete-categorias></autocomplete-categorias>
          </div>
        </div>
        <div class="table-responsive-sm">
          <table class="table table-sm table-bordered table-hover">
            <thead class="thead-dark">
              <tr>
                <th>Nombre</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              
            @forelse ($categorias as $categoria)
              <tr>
                <td>{{ $categoria->nombre }}</td>
                <td>
                  <a href="/cargar_categoria/{{ $categoria->id }}" class="btn btn-link" title="Editar"><i class="material-icons">mode_edit</i></a>
                </td>
                <td>
                  <a href="/eliminar_categoria/{{ $categoria->id }}" class="btn btn-link" style="color:#dc3545;" title="Eliminar"><i class="material-icons">delete</i></a>
                </td>
              </tr>
  		        @empty
                  <tr><td colspan="3">No tiene categorias registradas.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
			{{ Form::close() }}
    	</div>
@endsection
