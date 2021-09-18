@extends('layouts.posts')


@section('content')
  
<form action="/posts" method="POST" style="padding:50px"  enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" 
          name="title"
          value="{{old('title')}}"
        id="title" placeholder="title">
        </div>
        <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control"
         name="content"
         
        id="content" rows="3">{{old('content')}}</textarea>
        </div>
 
        <div class="mb-3">
            <label for="postimage" class="form-label">Post Image</label>
            <input type="file" name="postimage" class="form-control">
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <select name="author"
             id="author" 
             class="form-control"
             >
                <option value="">choose</option>
                @foreach ($authors as $author )
                   <option value="{{$author->id}}"
                     @if (old('author') == $author->id)
                        selected="selected" 
                     @endif
                    > {{$author->name}}</option>
                @endforeach
            </select>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{$error}}</li> 
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>

  </form>
  
@endsection