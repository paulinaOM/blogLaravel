@extends('layouts.bootstrap')
@section('title','Create Post')
@section('content')
    <h3>New Post</h3>

     <div class="row">
        {!! Form::open(['url' => 'blog', 'method' => 'post', 'files'=> true]) !!} <!--Especificar que se van a usar archivos con una bandera-->

         <div class="form-group">
             {{Form::label('title', 'Title')}}
             {{Form::text('title', null, ['class'=>'form-control','placeholder'=>'Title'])}} <!--Nombre del campo, valor por default, arreglo de atributos-->
         </div>
        <div class="form-group">
            {{Form::label('content', 'Content')}}
            {{Form::textarea('content',null, ['class'=>'form-control','placeholder'=>'Content'])}}
        </div>
        <!--<div class="form-group">
            {{Form::label('username', 'Username')}}
            {{Form::text('username',null, ['class'=>'form-control','placeholder'=>'Username'])}}
        </div>-->
        <div class="form-group">
            {{Form::label('image', 'Image')}}
            {{Form::file('image',null, ['class'=>'form-control','placeholder'=>'Image'])}}
        </div>
        <div class="form-group">
            {{Form::submit('Send', ['class'=>'btn btn-primary'])}} <!--Texto, arreglo de atributos-->
            <a class="btn btn-secondary" href="{{route('blog.index')}}"><i class="fas fa-arrow-circle-left"></i>&nbsp;Cancel</a> <!--Ruta en web.php, que dirige a BlogController create() -->
        </div>
        {!! Form::close() !!}
    </div>




@endsection
