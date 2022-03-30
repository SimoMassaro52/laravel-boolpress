@extends('layouts.menu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center"">
                <h1>Create New Post</h1>
                <a class="btn btn-primary" href="{{route('admin.posts.index')}}">
                    <i class="bi bi-arrow-left"></i> Back to posts
                </a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titolo</th>
                        <th>Slug</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Tags</th>
                        {{-- <th class="text-center">Azioni</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->slug}}</td>
                        <td>{{$post->content}}</td>
                        <td>@if($post->image) <img src="{{asset("storage/{$post->image}")}}" alt="{{$post->title}}"> @endif</td>
                        <td>
                            @foreach($post->tags as $tag)
                                {{$tag->name}}
                            @endforeach
                        </td>
                        <td>
                            {{-- <a class="btn btn-warning btn-sm" href="{{route('admin.posts.edit', ['post'=>$post->id])}}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                       
                            <form action="{{route('admin.post.destroy', ['posts' => $post->id])}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form> --}}
                        </td>
                    </tr>    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection