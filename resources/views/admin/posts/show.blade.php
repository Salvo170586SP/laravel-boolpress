@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header-content mb-5 d-flex justify-content-between align-items-center">
            <h1>Dettagli del post</h1>
            <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">Torna ai posts</a>
        </div>
        <div class="border border-secondary clearfix">
            <div class="float-left">
                @if($post->image)
                <figure style="width: 200px; height: 150px">
                    <img src="{{asset("storage/$post->image")}}"   style="width: 100%; height: 100%; object-fit: contain" alt="img">
                </figure>
                @else
                <img src="https://www.pulsecarshalton.co.uk/wp-content/uploads/2016/08/jk-placeholder-image.jpg" width="250" alt="placeholder">
                @endif
            </div>
            <div class="body-text float-left m-3">
                <h2>{{ $post->title }}</h2>
                @forEach($post->tags as $tag)
                <span class="badge text-white" style="background-color:{{ $tag->color }};">{{ $tag->label }}</span>
                @endforeach
                <hr>
                <p>{{ $post->content }}</p>
                <span>{{ $post->created_at }}</span>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-end">
            <a class="btn btn-secondary" href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
    
            <form class="m-2" action="{{ route('admin.posts.destroy', $post->id) }}"
                method="POST" id="delete-form" id="delete-form">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger " type="submit">Cancella</button>
            </form>
        </div>
    </div>

@endsection

@section('script')
<script>
    const deleteForm = document.getElementById('delete-form');
    deleteForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const confirmation = confirm('Sei sicuro di eliminare il post?');
        if(confirmation) e.target.submit();
    });
</script>
@endsection