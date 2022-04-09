<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //prendo il percorso url
        $params = $request->query();

        //se mi arriva un parametro con 'category_id' e non è nullo, lo prendo, altrimenti è una stringa vuota (non lo prendo)
        $category_id = $params['category_id'] ?? '';

        //return response()->json($params);

        $query = Post::with('category', 'tags')->orderBy('updated_at', 'DESC');

        //se il category_id c'è lo prendo 
        if ($category_id) $query->where('category_id', $category_id);

        //quindi prendo il tutto e lo assegno alla variabile posts per portala giù in pagina per stampare i risultati in pagina
        $posts = $query->get();

        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        if (!$post) return response('Post Not Found', 404);

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
