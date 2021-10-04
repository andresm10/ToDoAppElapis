@extends('layouts.app')
@section('content')
    	 <div class="justify-content-center">
  			{{ Form::open(array('url' => '/editar_categoria', 'method'=>'post', 'class'=>'border p-3 form')) }}
          @csrf
          <input type="hidden" name="id" id="id" value="{{ $categoria->id }}">
          <div class="row">
              <div class="col">
                <h1 class="text-center">EDITAR CATEGORIA</h1>
              </div>
            </div>
          <div class="row">
            <div class="col">
              <input type="text" name="categoria_nombre" required value="{{ $categoria->nombre }}" class="form-control">
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
