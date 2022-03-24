@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                
                        Lista dei Post
                        <div class="ms-auto">    <a href="{{ route('admin.posts.index')}}" class="ms-auto me-3"> Torna indietro</a>
                            <a href="{{ route('admin.posts.edit', $post->slug)}}" class="ms-auto">Modifica </a></div>
                    
                </div>
      
                
                <div class="card-body">
                    <ul class="list-group">
                    <li class="list-group-item">
                        <h3>{{$post->title}}</h3>
                        <img src="{{ asset("storage/". $post->coverImg) }}" class="img-fluid" alt="">
                        <p>{{$post->content}}</p>
                        <div  class="d-flex flex-column ">       
                            <div><small class="fst-italic">{{ $post->user->name }} - {{ isset($post->category) ? $post->category->code : "senza categoria" }}</small></div>
                        </div>
                        {{-- <a href="{{ route('admin.posts.show', $post->slug) }}">Mostra</a> --}}
                        {{-- <a href="{{ route('admin.posts.show', $post->slug)}}"> Vedi post</a> --}}

                        @php
                        // use Carbon\Carbon;
                        $dateFormat = 'd/m/Y H:i';
                      @endphp
        
                      Data creazione: {{ $post->created_at->format($dateFormat) }}<br>
                 
                      <i> Ultima modifica: {{ $post->updated_at->format($dateFormat) }} ({{ $post->updated_at->diffForHumans(date(0)) }})</i>

                      </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
