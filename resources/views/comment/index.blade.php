@extends('layouts.bootstrap')
@section('title','Blog Page')
@section('content')

    <style>
        .post-content{
            overflow:hidden;
            white-space:nowrap;
            text-overflow: ellipsis;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }
    </style>

    <div class="content" style="margin: 0 20px">
        <h3>Blog Page</h3>
        @if(session()->get('success'))
        <div class="alert alert-success text-center">
            {{ session()->get('success') }}
        </div>
        @endif

        @foreach($post as $p)
            <div class="row" style="padding: 10px 0;">
                <div style="background: #f0f0f0; width: 100%; padding: 10px;">
                    <h2>{{$p->title}}</h2>
                    <p>by <a href="">{{$p->username}}</a></p>
                    <hr color="gray">
                    <p>Posted on {{$p->create_date}} </p>
                    <hr color="gray">
                    <div class="post-content"><p>{{$p->content}}</p></div>
                    <p><a href="{{route('comment.show',$p->id)}}">Read more</a></p>
                </div>
            </div>
        @endforeach
    </div>


@endsection
