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
                    <li class="list-group-item mt-3">{{$post->text}}</li>
                </div>

            </div>

            <div>
                <ul class="list-group mt-3">
                    @if (count($post->comments)> 0)
                    <h4>Comments about your post</h4>
                    @foreach ($post->comments->reverse() as $comment)
                        <li class="list-group-item mt-2">
                            
                            <p>{{$comment->body}}</p>
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
                <form action="{{route('create-post-comment', $post->id)}}" class="mt-2" method="POST">
                    @csrf
                    <label for="exampleFormControlTextarea1" class="mt-2">Text Posts</label>
                    <textarea class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}" name="body" required id="exampleFormControlTextarea1" rows="3" required></textarea>
                    @if ($errors->has('body'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('body') }}</strong>
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
