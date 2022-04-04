<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use App\Mail\PublishedPostMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
 

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
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

        $request->validate([
            'title' => 'required|string|unique:posts|min:5|max:100',
            'content' => 'string',
            'image' => 'image|nullable',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ], [
            'title.required' => 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve avere almeno 5 caratteri',
            'title.max' => 'Il titolo può avere massimo 100 caratteri',
            'title.unique' => "Esiste già un titolo con il nome $request->title",
        ]);

        $data = $request->all();
        $post = new Post();

        //raccolgo immagine, la salvo nella cartella e restituisco l'url
        if (array_key_exists('image', $data)) {
            $img_url = Storage::put('post_images', $data['image']);
            $data['image'] = $img_url;
        };

        $post->fill($data);
        $post->slug = Str::slug($post->title, '-');
        $post->save();

        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);

        //mando la mail di conferma
        $mail = new PublishedPostMail($post);
        $receiver = Auth::user()->email;
        Mail::to($receiver)->send($mail);

        return redirect()->route('admin.posts.index', compact('post'))->with('message', 'Post creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
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
        $post_tags_ids = $post->tags->pluck('id')->toArray();

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'post_tags_ids'));
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
        $request->validate([
            'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'min:5', 'max:100'],
            'content' => 'string',
            'image' => 'nullable|image',
            'tags' => 'nullable|exists:tags,id',

        ], [
            'title.required' => 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve avere almeno 5 caratteri',
            'title.max' => 'Il titolo può avere massimo 100 caratteri',
            'title.unique' => "Esiste già un titolo con il nome $request->title",
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title, '-');

        //raccolgo immagine, elimino ll'immagine precedente, salvo la nuova immagine nella cartella e restituisco l'url
        if (array_key_exists('image', $data)) {
            if($post->image) Storage::delete($post->image);
            $img_url = Storage::put('post_images', $data['image']);
            $data['image'] = $img_url;
        };


        $post->update($data);

        if (!array_key_exists('tags', $data)) $post->tags()->detach();
        else $post->tags()->sync($data['tags']);

        return redirect()->route('admin.posts.index', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        //elimino eventuale immagine
        if($post->image) Storage::delete($post->image);

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
