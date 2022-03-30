@extends('layouts.menu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Edit Post</h1>
                <a class="btn btn-primary" href="{{route('admin.posts.index')}}">
                    <i class="bi bi-arrow-left"></i> Back to posts
                </a>
            </div>
            <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Insert your title" value="{{old('title', $post->title)}}" required>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" cols="30" rows="10" required>{{old('content', $post->content)}}</textarea>
                </div>
                {{-- Select con categorie --}}
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">-- select a category --</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">
                            {{$category->id == old('category_id', $post->category_id) ? 'selected' : ''}}
                            {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </div>  
                {{-- tag --}}
                <div class="form-group">
                    <label for="">Tags</label>
                    @foreach ($tags as $tag)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}"
                            
                            {{-- {{$post->tags->contains($tag) ? "checked" : ""}}> --}}
                            {{-- Gestione dell'old: se ci sono errori, vediamo se l'id del tag è presente nell'array --}}
                            @if ($errors->any())
                                {{in_array($tag->id, old('tags', [])) ? "checked" : ""}}
                            @endif>
                            <label class="form-check-label" for="{{$tag->slug}}">
                                {{$tag->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        Save updates
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection