@extends('layouts.bootstrap')
@section('title','Edit Post')
@section('content')
    <h3>Edit Post</h3>

     <div class="row">
        {!! Form::open(['route'=>['blog.update',$post->id],'files'=> true]) !!} <!--Debe apuntar a la ruta de edición-->
        @method('PUT') <!--Especifica método del formulario (Verificar método de cada ruta)-->
         <div class="form-group">
             {{Form::label('title', 'Title')}}
             {{Form::text('title', $post->title, ['class'=>'form-control','placeholder'=>'Title'])}} <!--Nombre del campo, valor por default, arreglo de atributos-->
         </div>
        <div class="form-group">
            {{Form::label('content', 'Content')}}
            {{Form::textarea('content',$post->content, ['class'=>'form-control','placeholder'=>'Content'])}}
        </div>
            <div class="form-group">
                {{Form::label('image', 'Image')}}
                {{Form::file('image',null, ['class'=>'form-control','placeholder'=>'Image'])}}
            </div>

        <div class="form-group">
            {{Form::submit('Save', ['class'=>'btn btn-primary'])}} <!--Texto, arreglo de atributos-->
            <a class="btn btn-secondary" href="{{route('blog.index')}}"><i class="fas fa-arrow-circle-left"></i>&nbsp;Cancel</a> <!--Ruta en web.php, que dirige a BlogController create() -->
        </div>
        {!! Form::close() !!}
    </div>




@endsection
