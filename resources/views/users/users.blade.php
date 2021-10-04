@extends('layouts.app')

	@section('content')

		<div class="row">
			<div class="col text-center">
				<h1>USUARIOS</h1>
			</div>
		</div>
		@include('users.toolbar')
        <div class="table-responsive-sm">
          <table class="table table-sm table-bordered table-hover">
				<thead class="thead-dark">
			    	<tr>
						<th scope="col" class="text-center">#</th>
						<th scope="col" class="text-center">Nombre</th>
						<th scope="col" class="text-center">E-mail</th>
						<th scope="col" class="text-center">Usuario</th>
						<th scope="col" class="text-center">Activo</th>
						<th scope="col" class="text-center">&nbsp;</th>
			    	</tr>
			  	</thead>

				<tbody>
			  		@php($i = 1)
						@forelse ($users as $user)
						    <tr>
								<th scope="row">{{ $i++ }}</th>
								<td>{{ $user->primer_nombre.' '.$user->segundo_nombre.' '.$user->primer_apellido.' '.$user->segundo_apellido }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->nombre_usuario }}</td>
								<td>{{ ( $user->activo == 1) ? 'Si' : 'No' }}</td>
								<td><a href="cargar_usuario/{{ $user->id }}" class="btn btn-link"><i class="material-icons">mode_edit</i></a></td>
						    </tr>
				        @empty
				        	<tr>
				        		<td colspan="5">
				            		<p>No hay usuarios registrados.</p>
				        		</td>
				        	</tr>
				        @endforelse
				</tbody>
			</table>
		</div>
	@endsection