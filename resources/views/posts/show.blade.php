@extends('layouts.posts')


@section('content')
  
  <div class="container" style="padding:50px;">
        <div class="row justify-content-center">
            <div class="col-md-7">
              <div class="card" style="padding:30px;">
                 <div class="card-body">   
                   
                    <span class="bg-danger text-white" style="padding:2px">
                    {{$newcheck}}</span>
                    <h2 class="card-title">{{$post[0]->title}}</h2>
                    <p class="text-secondary">{{$post[0]->created_at}}</p>
                    <img src="{{asset($post[0]->postimage)}}" alt=""> 
                    <p class="card-text">{{$post[0]->content}}</p>
                    <p><b>Author:</b></p>
                    <p><b>Name:</b> {{$post[0]->author->name}}</p>
                     <p><b>Email:</b> {{$post[0]->author->email}}</p>
                 </div>
              </div>
            </div>
        </div>
  </div>

@endsection