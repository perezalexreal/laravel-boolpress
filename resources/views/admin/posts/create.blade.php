@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">      Aggiungi un nuovo post
                  
                </div>
      
                
                <div class="card-body">
                    <form action="{{ route('admin.posts.store') }}" method="post" class="row g-3">
                      @csrf
                    
                      <div class="mb-3">
                        <label class="form-label">Titolo</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old("title")}}" required> 
                        @error("title")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    
                      <div class="mb-3">
                        <label class="form-label">Contenuto</label>
                        <textarea class="form-control  @error('content') is-invalid @enderror" name="content" cols="30" rows="10"  >{{ old("title")}}</textarea>
                        @error("content")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                      </div>
                    
                      <div class="d-flex">
                        <button class="btn btn-outline-secondary me-3" type="reset">Svuota dati</button>
                        <button class="btn btn-success" type="submit">Crea</button>
                      </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
