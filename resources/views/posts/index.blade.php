@extends('layouts.posts')


@section('content')
 
   <div class="container" style="padding:50px;">
      @if ($message = Session::get('success'))
          <div class="alert alert-success" role="alert">
               <strong>{{$message}}</strong>
          </div>
      @endif
       <div class="row">
           @foreach ($posts as $post)
            <div class="col-md-4" style="margin-bottom: 15px;">
               <div class="card">
                  
                   <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                       <p class="card-text">{{\Illuminate\Support\Str::limit($post->content,150,$end='...')}}</p>
                   </div>
                   <div class="card-footer d-flex justify-content-evenly">
                       <a href="/posts/{{$post->id}}"
                       class="btn btn-primary">Read more</a>
                       <a href="/posts/{{$post->id}}/edit"
                       class="btn btn-success">Edit</a>
            
                       <form action="/posts/{{$post->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">
                           Delete
                        </button>
                        
                      </form>
                                     
                   </div>
               </div>
           </div>
           @endforeach

           {{$posts->links()}}
          
           
       </div>
   </div>

@endsection