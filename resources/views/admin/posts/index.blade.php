@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header-posts mb-5 d-flex justify-content-between align-items-center">
            <h1>I miei post</h1>
            <a class="btn btn-secondary" href="{{ route('admin.posts.create') }}">Aggiungi un post</a>
        </div>

        {{-- messaggi di avviso --}}
        @if (session('message'))
            <div class="alert alert-primary">
                {{ session('message') }}
            </div>
        @endif

        <main>
            <table class="table border text-white">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Categoria</th>
                       {{--  <th scope="col">Autore</th> --}}
                        <th scope="col">Tag</th>
                        <th scope="col">Creato il..</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>
                                @if ($post->category)
                                    {{ $post->category->label }}
                                @else
                                    -
                                @endif
                            </td>
                            {{-- <td>
                                @if($post->user)
                                {{ $post->user }}
                                @else
                                -
                                @endif
                            </td> --}}

                            <td>
                                @forelse($post->tags as $tag)
                                   <span class="badge text-white" style="background-color: {{ $tag->color }}">{{ $tag->label }}</span> 
                                @empty
                                    -
                                @endforelse
                            </td>

                            <td>{{ $post->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn btn-sm btn-primary mx-2"
                                    href="{{ route('admin.posts.show', $post->id) }}">Vedi</a>
                                    <a class="btn btn-sm btn-secondary mx-2"
                                    href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                        class="delete-form">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger " type="submit">Cancella</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                <h2>non ci sono post</h2>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- numeri pagine --}}
            @if ($posts->hasPages())
                {{ $posts->links() }}
            @endif
        </main>
    </div>
@endsection

@section('script')
    <script>
        const deleteForm = document.querySelectorAll('.delete-form');
        deleteForm.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const confirmation = confirm('Sei sicuro di eliminare il post?');
                if (confirmation) e.target.submit();
            });
        });
    </script>
@endsection
