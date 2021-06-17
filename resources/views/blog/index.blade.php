@extends('layouts.bootstrap')
@section('title','Post List')
@section('content')
    <h3>Posts List</h3>

    <div class="row">
        <a class="btn btn-primary" href="{{route('blog.create')}}"><i class="fas fa-plus-circle"></i>&nbsp;New</a> <!--Ruta en web.php, que dirige a BlogController create()-->
    </div>
    <div class="row">
        @if(session()->get('success'))  <!--Detecta si existen mensajes success, si existen los despliega en el div-->
            <div class="alert alert-success text-center">
                {{ session()->get('success') }}
            </div>
        @endif
        <table class="table table-striped table-hover table-secondary">
            <tr>
                <th>ID</th>
                <th>TITLE</th>
                <th>CONTENT</th>
                <th>IMAGE</th>
                <th>USERNAME</th>
                <th>OPTIONS</th>
            </tr>

            @foreach($post as $p)
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->title}}</td>
                    <td>{{$p->content}}</td>
                    <td>{{$p->image}}</td>
                    <td>{{$p->user->name}}</td>
                    <td>
                        <a href="{{route('blog.edit',$p->id)}}" title="edit"><i class="far fa-edit"></i></a>
                        &nbsp;&nbsp;&nbsp;
                        <form action="{{route('blog.destroy',$p->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <!--<a href="{{route('blog.destroy',$p->id)}}" title="delete"><i class="far fa-trash-alt"></i></a>-->
                            <button type="submit">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <table class="table table-striped table-hover">
            <tr>
                <td>ID POST</td>
                <td>COMMENT</td>
            </tr>
            @foreach($comments as $c)
            <tr>
                <td>{{$c->post_id}}</td>
                <td>{{$c->comment}}</td>
            </tr>
            @endforeach
        </table>
    </div>


@endsection
