@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header-posts mb-5 d-flex justify-content-between align-items-center">
            <h1>Modifica post</h1>
            <div class="d-flex">
                <a class="btn btn-primary mx-2" href="{{ route('admin.posts.show', $post->id) }}">Torna al post</a>
                <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Torna alla lista</a>
            </div>
        </div>

        {{-- controllo --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            @foreach ($tags as $tag)
                <div class="form-check form-check-inline">

                    <input class="form-check-input ml-3  text-white  bg-dark" type="checkbox" id="tag-{{ $tag->id }}"
                        value="{{ $tag->id }}" name="tags[]" @if (in_array($tag->id, old('tags', $post_tags_ids))) checked @endif>

                    <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->label }}</label>
                </div>
            @endforeach

            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" value="{{ $post->title }}" class="form-control  text-white  bg-dark" id="title"
                    placeholder="Inserisci titolo" name="title">
            </div>

            <label for="category">Categoria</label>
            <select class="custom-select custom-select-lg mb-3  text-white  bg-dark" id="category" name="category_id">
                <option value="">--</option>
                @foreach ($categories as $category)
                    <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                        {{ $category->label }}</option>
                @endforeach
            </select>

            {{-- <div class="mb-3">
                <div class="d-flex align-items-center">
                    <label for="image" class="form-label">Immagine</label>
                    <input type="url" value="{{ $post->image }}" class="form-control mx-2 text-white  bg-dark" id="image"
                        placeholder="Inserisci titolo" name="image">
                    <img id="preview" class="border border-dark"
                        src="{{ $post->image ?? 'http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large_dark.jpg' }}"
                        width="150" alt="">
                </div>
            </div> --}}
            <div class="mb-3">
                <label for="content" class="form-label">Aggiungi descrizione</label>
                <textarea class="form-control text-white  bg-dark" id="content" rows="5"
                    name="content">{{ $post->content }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Carica un immagine</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-secondary">Modifica</button>
        </form>
    </div>
@endsection

@section('script')
    {{-- <script src="{{ asset('js/preview-img.js') }}"></script> --}}
@endsection
