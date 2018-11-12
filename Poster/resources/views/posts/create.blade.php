@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>
                        My Posts
                    </span>

                <a href="{{route('post-create')}}" class="btn btn-primary btn-sm">Create Post</a>

                </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            
                        </div>
                    @endif

                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Text</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Video/Picture</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="mt-4">
                                <form action="{{route('post-add-text')}}" method="POST">
                                    @csrf
                                    <label for="exampleFormControlTextarea1">Text Posts</label>
                                    <textarea class="form-control {{ $errors->has('text') ? ' is-invalid' : '' }}" name="text" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                    @if ($errors->has('text'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('text') }}</strong>
                                        </span>
                                    @endif
                                    <div class="clearfix">
                                        <input type="submit" value="post" class="float-right mt-3 btn btn-primary btn-sm">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="mt-4">
                                <form action="{{route('post-add-media')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="exampleFormControlTextarea1">Posts Video / Picture</label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        <input type="file" class="custom-file-input {{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" required>
                                        @if ($errors->has('file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="clearfix">
                                        <input type="submit" value="post" class=" float-right mt-3 btn btn-primary btn-sm">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
