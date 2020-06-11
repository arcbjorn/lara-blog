@component('mail::message')
# Welcome to LaraBlog

This is a community of fellow explorers and we love that you joined us.

@component('mail::button', ['url' => ''])
Check it out
@endcomponent

All the best,<br>
{{ config('app.name') }}
@endcomponent
