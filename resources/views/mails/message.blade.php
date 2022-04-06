@component('mail::message')

<p>Email: {{ $contact['email'] }}</p>
<p>Testo: {{ $contact['message'] }}</p>

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }} --}}
@endcomponent
