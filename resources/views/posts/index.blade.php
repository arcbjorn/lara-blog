@extends('layouts.app')

@section('content')
<div class="container">
  @foreach ($posts as $post)
    <div class="row">
      <div class="col-6 offset-3">
        <a href="/profile/{{ $post->user->id }}">
          <img src="/storage/{{ $post->image }}" class="w-100">
        </a>
      </div>
    </div>
    <div class="row pt-2 pb-4">
      <div class="col-8 offset-2">
        <div>
          <p>{{ $post->caption }}</p>
        </div>
      </div>
    </div>
  @endforeach

  <div class="row">
    <div class="col-12 d-flex justify-content-center">
      {{ $posts->links() }}
    </div>
  </div>
</div>
@endsection
