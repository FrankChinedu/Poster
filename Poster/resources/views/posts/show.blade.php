@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    @auth
                    @if (Auth::id()== $post->user_id)
                    <form action="{{route('post-delete', $post->id)}}" class="mt-2" method="POST">
                        @csrf    
                        <input type="submit" class="btn btn-danger btn-sm" value="delete Post">    
                    </form>
                        
                    @endif

                    @endauth
                </div>

                <div class="card-body">
                    @if ($post->type == 'text')
                        <li class="list-group-item mt-3">{{$post->text}}</li>
                        
                        @elseif($post->type == 'video')
                        <video width="320" height="240" controls>
                        <source src="{{__('http://127.0.0.1:8000').$post->url}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @else
                        <li class="list-group-item mt-3">
                            <img src="{{__('http://127.0.0.1:8000').$post->url}}" class="img-thumbnail md-3" alt="">
                        </li>
                    @endif
                </div>

            </div>

            <div>
                <ul class="list-group mt-3">
                    @if (count($comments)> 0)
                    <h4>Comments about your post</h4>
                    @foreach ($comments as $comment)
                        <li class="list-group-item mt-2">
                            <b style="color:gray; font-style:italic; font-weight:bold">
                                {{$comment->name}}
                            </b>
                            <hr>
                            <p>{{$comment->comment}}</p>
                            @auth
                            @if (Auth::id() == $post->user_id)
                            <form action="{{route('comment-delete', $comment->id)}}" class="mt-2" method="POST">
                                @csrf
                                <input type="submit" class="btn btn-danger btn-sm" value="delete">    
                            </form>    
                                
                            @endif
                            @endauth
                        </li>
                    @endforeach
                    @else
                    <h3>NO comment for this Post</h3>
                    @endif
                    
                </ul>
            </div>
        </div>

        <div class=""> 
            <div class="col-md-12 mt-2">
                    <h5>Write your Comments</h5>
                <form action="{{route('comment-create', $post->id)}}" class="mt-2" method="POST">
                    @csrf
                    <input class="form-control form-control-sm {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required type="text" placeholder="your name">
                    <label for="exampleFormControlTextarea1" class="mt-2">Text Posts</label>
                    <textarea class="form-control {{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" required id="exampleFormControlTextarea1" rows="3" required></textarea>
                    @if ($errors->has('comment'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('comment') }}</strong>
                        </span>
                    @endif
                    <div class="clearfix">
                        <input type="submit" value="post" class="float-right mt-1 mb-3 btn btn-primary btn-sm">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
