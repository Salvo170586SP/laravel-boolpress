<h1>Il tuo post è stato pubblicato</h1>

<h2>Titolo: {{ $post->title }}</h2>
<p>Testo:  {{ $post->content }}</p>
<img src="{{ $post->image }}" alt="{{ $post->title }}">
<span>Data pubblicazione: {{ $post->created_at }}</span>