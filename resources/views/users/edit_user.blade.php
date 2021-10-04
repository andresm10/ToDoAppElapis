@extends('layouts.app')

@section('content')

	<div class="content container-fluid">
		@include('users.toolbar')

		{{ Form::open(array('url' => '/editar_usuario', 'method'=>'post')) }}
          @csrf

          	<input type="hidden" name="id" id="id" value="{{ $user->id }}">
	        <div class="row">
	          	<div class="col">
	          		<h1 class="text-center">EDITAR USUARIO</h1>
	          	</div>
          	</div>

          	<div class="row form-group">

	          	<div class="col-2">
	          		<label for="documentNumber">N&uacute;mero de Documento</label>
	          	</div>
	          	<div class="col-4">
	          		<input type="text" name="documentNumber" id="documentNumber" required value="{{ $user->numero_documento }}" class="form-control">
	          	</div>
          	</div>


          	<div class="row form-group">
	          	<div class="col-2">
	          		<label for="nameOne">Primer Nombre</label>
	          	</div>
	          	<div class="col-4">
	          		<input type="text" name="nameOne" id="nameOne" required value="{{ $user->primer_nombre }}" class="form-control">
	          	</div>

	          	<div class="col-2">
	          		<label for="nameTwo">Segundo Nombre</label>
	          	</div>
	          	<div class="col-4">
	          		<input type="text" name="nameTwo" id="nameTwo" value="{{ $user->segundo_nombre }}" class="form-control">
	          	</div>
          	</div>


          	<div class="row form-group">
	          	<div class="col-2">
	          		<label for="nameThree">Primer Apellido</label>
	          	</div>
	          	<div class="col-4">
	          		<input type="text" name="nameThree" id="nameThree" required value="{{ $user->primer_apellido }}" class="form-control">
	          	</div>

	          	<div class="col-2">
	          		<label for="nameFour">Segundo Apellido</label>
	          	</div>
	          	<div class="col-4">
	          		<input type="text" name="nameFour" id="nameFour" value="{{ $user->segundo_apellido }}" class="form-control">
	          	</div>
          	</div>



          	<div class="row form-group">
	          	<div class="col-2">
	          		<label for="email">E-mail</label>
	          	</div>
	          	<div class="col-4">
	          		<input type="email" name="email" id="email" required value="{{ $user->email }}" class="form-control">
	          	</div>

          		<div class="col-2">
	          		<label for="active">Activo</label>
	          	</div>
	          	<div class="col-4">
	          		<select class="form-control" name="active">
	          			<option {{ ( $user->activo == 1) ? 'selected' : '' }} value="1">Si</option>
	          			<option {{ ( $user->activo == 0) ? 'selected' : '' }} value="0">No</option>
	          		</select>
	          	</div>

	          	
          	</div>

          	<div class="row form-group">
	          	<div class="col text-center">
	          		<input type="submit" name="createUser" value="Editar" class="btn btn-primary">
	          	</div>
          	</div>


		{{ Form::close() }}
	</div>
@endsection
