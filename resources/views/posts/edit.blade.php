@extends('layouts.posts')


@section('content')
  
<form action="/posts/{{$post[0]->id}}" method="POST" style="padding:50px">
        @method('PUT')
        @csrf
        <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" 
          name="title"
          value="{{$post[0]->title}}"
        id="title" placeholder="title">
        </div>
        <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control"
         name="content"
         
        id="content" rows="3">{{$post[0]->content}}</textarea>
        </div>

        


        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <select name="author"
             id="author" 
             class="form-control"
             >
                <option value="{{$post[0]->author->id}}">{{$post[0]->author->name}}</option>
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
            <button type="submit" class="btn btn-success">Edit</button>
        </div>

  </form>
  
@endsection