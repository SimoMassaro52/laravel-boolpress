@extends('layouts.menu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center"">
                <h1>Create New Post</h1>
                <a class="btn btn-primary" href="{{route('admin.posts.index')}}">
                    <i class="bi bi-arrow-left"></i> Back to posts
                </a>
            </div>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form action="{{route('admin.posts.store')}}" method="POST"
            {{-- Inseriamo questo attributo in modo da gestire la consegna dei file --}}
            enctype="multipart/form-data">
            
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Insert your title" value="{{old('title')}}" required>
                    @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" cols="30" rows="10" required>{{old('content')}}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">-- select a category --</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">
                            {{$category->id == old('category_id') ? 'selected' : ''}}
                            {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Checkbox per gestire i tag --}}
                <div class="form-group">
                    <label for="">Tags</label>
                    @foreach ($tags as $tag)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="{{$tag->slug}}"
                            {{-- Gestione old su errore: verifichiamo che quel tag sia effetivaemtne checckato e presente nell'array --}}
                            {{ old('tags') && in_array($tag->id, old('tags')) ? "checked" : ""}}
                            {{-- Tutti i tag checckati verranno mandati a questo array che arriva al controller--}}
                            name="tags[]">
                            <label class="form-check-label" for="{{$tag->slug}}">
                                {{$tag->name}}
                            </label>  
                        </div>
                    @endforeach
                </div>  

                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        Create post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection