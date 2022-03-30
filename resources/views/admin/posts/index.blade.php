@extends('layouts.menu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>All Posts</h1>
                <a class="btn btn-primary" href="{{route('admin.posts.create')}}">
                    Create new post
                </a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Category</th>
                        <th>Thumbnail</th>
                        <th>Tags</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->slug}}</td>
                        {{-- Questo ternario prima si chiede se è PRESENTE il metodo category() definito nel modello Post, se c'è stampa il nome, altrimenti stampa un "-"  segnaposto--}}
                        <td>{{$post->category ? $post->category->name : '-'}}</td>
                        {{-- Stesso principio del ternario soprastante --}}
                        <td>
                            @if(isset($post->image))
                            <img style="width:100px;" src="{{asset("storage/{$post->image}")}}" alt="{{$post->title}}">
                            @endif
                        </td>
                        {{-- Cicliamo i tag per vedere tutti quelli assegnati al post. Grazie alla tabella pivot, non c'è bisogno di usare un ternario/if poiché se uno dei due non è valorizzato, non lo è nemmeno l'altro all'interno della pivot --}}
                        <td>
                            @foreach ($post->tags as $tag) 
                                {{$tag->name}} 
                            @endforeach    
                        </td>
                        <td>
                            {{-- SHOW --}}
                            <a class="btn btn-info btn-sm" 
                            {{-- Il nostro link punterà allo show dei posts + l'id del singolo passato come parametro --}}
                            href="{{route('admin.posts.show', ['post'=>$post->id])}}">
                                <i class="bi bi-eye"></i>
                            </a>
                            
                            <a class="btn btn-warning btn-sm" href="{{route('admin.posts.edit', ['post'=>$post->id])}}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                       
                            <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection