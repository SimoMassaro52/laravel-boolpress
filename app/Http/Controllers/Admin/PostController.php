<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Tag;
//Ricorda di usare use quando richiami il modello nel controller
use App\Category;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //Chiudiamo le validation in una variabile in modo da richiamarla facilmente e risparmiare codice più tardi
    protected $validations = [
        'title'=>'required|max:20',
        'content'=>'required',
        'category_id'=>'nullable|exists:categories,id',
        'image'=>'nullable|image|mimes:jpeg,bmp,png|max:2048',
        //Stessa validation delle categorie
        'tags'=>'nullable|exists:tags,id'
    ]; 

    // Facciamo lo stesso con la funzione di creazione dello slug
    protected function slug($title = "", $id = ""){
        $tmp = Str::slug($title);
        $counter = 1;
        while(Post::where('slug', $tmp)->where('id', '!=', $id)->first()){
            $tmp = Str::slug($title)."-".$counter;
            $counter++;
        }
        return $tmp;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        // Recuperiamo tutti i tag
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validations);
        
        $form_data = $request->all();

        if(isset($form_data['image'])){
            $img_path = Storage::put('uploads', $form_data['image']);
            $form_data['image'] = $img_path;
        }

        $form_data['slug'] = $this->slug($form_data['title']);

        $new_post = new Post();
        $new_post->fill($form_data);
        $new_post->save();

        //Riprendiamo il metodo tags() definito nel model che sincronizza con sync i dati spediti dal form ossia l'array tags[]
        // $new_post->tags()->sync($form_data['tags']);
        //Ternario per gestire la non assegnazione di nessun tag alla creazione
        $new_post->tags()->sync(isset($form_data['tags']) ? $form_data['tags'] : []);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Injection model+var
    public function show(Post $post)
    {
        //Visualizza il singolo post
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validations);

        $form_data = $request->all(); 

        $form_data['slug'] = ($post->title == $form_data['title']) ? $post->slug : $this->slug($data['title'], $post->id);

        $post->update($form_data);

        //Non importa dove inseriamo il sync in questo caso poiché il post arriva già completo dall'injection sull'update()
        //NB!!! Dobbiamo gestire anche il caso in cui tutti i tag venissero rimossi
        $post->tags()->sync(isset($form_data['tags']) ? $form_data['tags'] : []);
        return redirect()->route('admin.posts.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
