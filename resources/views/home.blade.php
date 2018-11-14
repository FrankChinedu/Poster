@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>
                        All Posts
                    </span> 

                    @auth
                        <a href="{{route('post-create')}}" class="btn btn-primary btn-sm">Create Post</a>
                    @endauth
                </div>
                  
            </div>

            @if (count($posts)> 0 || count($videos) > 0 )
            
                @foreach ($posts as $p)
                    <div class="card mt-3">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item mt-3">{{$p->text}}</li>
                                {{-- <b>Comments-{{ count($p->comments) }}</b> --}}
                                
                                <a href="{{route('post-show', $p->id)}}" class="btn btn-primary btn-sm">view</a>
                            </ul>
                        </div>
                        <hr>
                    </div>        
                @endforeach

                @foreach ($videos as $v)
                <div class="card mt-3">
                        <div class="card-body">
                            <ul class="list-group">
                                <video width="320" height="240" controls>
                                <source src="{{url('/').$v->url}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                {{-- <b>Comments-{{ count($p->comments) }}</b> --}}
                                <a href="{{route('video-show', $v->id)}}" class="btn btn-primary btn-sm">view</a>
                            </ul>
                        </div>
                        <hr>
                    </div>
                    
                @endforeach
                
                @else
                    <h4>No Posts yet start creating post</h4>
                @endif

                  
        </div>
    </div>
</div>
@endsection
