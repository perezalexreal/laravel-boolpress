@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">Lista dei Post
                    <a href="{{ route('admin.posts.create')}}" class="ms-auto"> Aggiungi un post</a>
                </div>
      
                
                <div class="card-body">
                    <ul class="list-group">
                    @foreach ($posts as $post )
                    <a  class="d-flex flex-column text-decoration-none" href="{{ route('admin.posts.show', $post-> slug)}}"class="ms-auto">  <li class="list-group-item"><h3>{{$post->title}}</h3>
                        {{-- <a href="{{ route('admin.posts.show', $post->slug) }}">Mostra</a> --}}
                        <div  class="d-flex flex-column ">       
                        <div><small class="fst-italic">{{ $post->created_at }} - {{ $post->user->name }} - {{ isset($post->category) ? $post->category->code : "senza categoria" }}</small></div>
                    </div>

              
         
                      </li>
                    </a>
                      @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
