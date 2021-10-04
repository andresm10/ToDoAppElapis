@extends('layouts.app')

@section('content')

	<div class="content container-fluid">
	@include('users.toolbar')
		{{ Form::open(array('url' => 'crear_usuario', 'method'=>'post')) }}
          @csrf

	        <div class="row">
	          	<div class="col">
	          		<h1 class="text-center">NUEVO USUARIO</h1>
	          	</div>
          	</div>

          	<div class="row form-group">

	          	<div class="col-2">
	          		<label for="documentNumber">N&uacute;mero de Documento</label>
	          	</div>
	          	<div class="col-4">
	          		<input type="text" name="documentNumber" id="documentNumber" required class="form-control">
	          	</div>
          	</div>


          	<div class="row form-group">
	          	<div class="col-2">
	          		<label for="nameOne">Primer Nombre</label>
	          	</div>
	          	<div class="col-4">
	          		<input type="text" name="nameOne" id="nameOne" required class="form-control">
	          	</div>

	          	<div class="col-2">
	          		<label for="nameTwo">Segundo Nombre</label>
	          	</div>
	          	<div class="col-4">
	          		<input type="text" name="nameTwo" id="nameTwo" class="form-control">
	          	</div>
          	</div>


          	<div class="row form-group">
	          	<div class="col-2">
	          		<label for="nameThree">Primer Apellido</label>
	          	</div>
	          	<div class="col-4">
	          		<input type="text" name="nameThree" id="nameThree" required class="form-control">
	          	</div>

	          	<div class="col-2">
	          		<label for="nameFour">Segundo Apellido</label>
	          	</div>
	          	<div class="col-4">
	          		<input type="text" name="nameFour" id="nameFour" class="form-control">
	          	</div>
          	</div>


          	<div class="row form-group">

	          	<div class="col-2">
	          		<label for="email">E-mail</label>
	          	</div>
	          	<div class="col-4">
	          		<input type="email" name="email" id="email" required class="form-control">
	          	</div>
          	</div>


          	<div class="row form-group">
	          	<div class="col text-center">
	          		<input type="submit" name="createUser" value="Crear" class="btn btn-primary">
	          	</div>
          	</div>
		{{ Form::close() }}
	</div>
	<script type="text/javascript" src="{{ asset('js/users.js') }}"></script>

@endsection
