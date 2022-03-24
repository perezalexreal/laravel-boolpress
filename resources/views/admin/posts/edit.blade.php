@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">      Ultima modifica: {{ $post-> updated_at}}
              
                </div>
      
                
                <div class="card-body">
                    <form action="{{ route('admin.posts.update', $post->id) }}" method="post" class="row g-3" enctype="multipart/form-data">
                      @csrf
                        @method("put")
                      <div class="mb-3">
                        <label class="form-label">Titolo</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old("title", $post->title)}}" required> 
                        @error("title")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    
                      <div class="mb-3">
                        <label class="form-label">Contenuto</label>
                        <textarea class="form-control  @error('content') is-invalid @enderror" name="content" cols="30" rows="10"  >{{ old("content",$post->content)}}</textarea>
                        @error("content")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                      </div>
                      
                      <div class="mb-3">
                        <label class="form-label">URL Immagine</label>
                        <input type="file" class="form-control @error('coverImg') is-invalid @enderror" name="coverImg"> 
                        @error("coverImg")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <span>{{ old("coverImg", $post->coverImg)}}</span>
                      </div>

                      <div class="mb-3">
                        <label>Categoria</label>
                        <select name="category_id" class="form-select">
                          <option value="">-- Nessuna categoria --</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($post->category_id === $category->id) selected @endIf>
                              {{ $category->code }}</option>
                          @endforeach
                        </select>
                      </div>
                    

                                    <div class="mb-3">
                <label>Tags</label><br>

                {{-- @dump($post->tags) --}}
                {{-- <select name="tags" multiple>
                  <option value=""></option>

                  @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                  @endforeach
                </select> --}}
                @foreach ($tags as $tag)
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                      id="tag_{{ $tag->id }}" name="tags[]" {{ $post->tags->contains($tag) ? 'checked' : '' }}>
                    <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                  </div>
                @endforeach

                @error('tags')
                  <div class="text-red">{{ $message }}</div>
                @enderror
              </div>
                      
                    
                      <div class="d-flex">
                        <a href="{{ route('admin.posts.show', $post->slug)}}" class="btn btn-outline-secondary me-3"  > Annulla</a>
                        <button class="btn btn-success" type="submit">Aggiorna</button>
                      </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
