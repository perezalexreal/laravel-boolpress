@extends('layouts.app')

@section('content')
<div class="card-header d-flex mb-3 bg-transparent">Lista dei Post
    <a href="{{ route('admin.posts.create')}}" class="ms-auto"> Aggiungi un post</a>
</div>
<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($posts as $post )
   
       
    <div class="col">
        <a class="text-decoration-none" href="{{ route('admin.posts.show', $post-> slug)}}">
      <div class="card  text-black">
          <div class="position-absolute bg-white" style="right:0; border-radius: 50px; margin: 10px">
            @include('partials.deleteBtn', [
                'id'=> $post->id,
                'route'=> "admin.posts.destroy"
            ])
          </div>
          @php
          // use Carbon\Carbon;
          $dateFormat = 'd/m/Y';
        @endphp
        
        <img src=" {{ $post->coverImg ?? null}}" class="card-img-top" alt="...">
        <i class="card-header"> {{ isset($post->category) ? $post->category->code : "Nessuna categoria" }}</i> 
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text ">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p  class="card-footer"> 
            <i>Creato il {{ $post->created_at->format($dateFormat) }} da {{ $post->user->name }} </i>        
            <i> Modificato ({{ $post->updated_at->diffForHumans(date(0)) }})</i></p>
            <i class=""> {{ $post->trashed()}}</i>
        </div>
      </div>
    </a>
    </div>

 




@endforeach
  </div>
@endsection
