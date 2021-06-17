@extends('layouts.bootstrap')
@section('title','Post Detail')
@section('content')

    <div class="content" style="padding: 0 15%">
        <h3>Post Detail</h3>
        <br>
        <h4>{{$post->title}}</h4>
        <p>by <a href="">{{$post->username}}</a></p>
        <hr style="color:gray; background-color:gray">
        <p>Posted on {{$post->create_date}} </p>
        <hr style="color:gray; background-color:gray">
        <div id="post-image" style="width: 100%;">
            <img class="img-fluid rounded" src="{{asset('storage/'.$post->image)}}" width="100%" >
        </div>
        <p align="justify">{{$post->content}}</p>

        <div class="card bg-light">
            <h5 class="card-header"><strong>Leave a comment</strong></h5>
            <!--Card content-->
            <div class="card-body">
                <!-- Form -->
                {!! Form::open(['url' => 'comment', 'method' => 'post']) !!}
                <div class="form-group">
                    {{Form::label('comment', 'Comment')}}
                    {{Form::textarea('comment',null, ['class'=>'form-control','placeholder'=>'Comment','rows' => '5', 'resize' => 'none' ])}}
                    {{Form::hidden('post_id',$post->id, ['class'=>'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        @foreach($comments ?? '' as $c)
            <div class="content" style="padding: 10px;">
                <div class="row" style="padding: 10px 0; width: 100%;">
                    <div class="col-md-1">
                        <img src="https://www.weact.org/wp-content/uploads/2016/10/Blank-profile.png" width="100%" style="border-radius: 50%; border: #a0aec0 solid 1px;">
                    </div>
                    <div class="col-md-11">
                        <b>anonymous</b>
                        <br>
                        {{$c->comment}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
