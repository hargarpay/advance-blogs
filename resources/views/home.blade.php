@extends('layouts.app')
@section('content')
<section id="post" class="padding-top">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-7">
      @forelse($posts as $post)
        <div class="post_item padding-bottom">
          <h2>{{$post->title}}</h2>
          <ul class="comments">
             <li><a href="#.">{{$post->created_at_format}}</a></li>
             <!-- <li><a href="#."><i class="icon-chat-2"></i>5</a></li> -->
          </ul>
          <p>{{substr($post->description, 0,  100)}}</p>
          <a class="btn btn-primary" href="{{route('view.single.post', ['post' => $post->id, 'slug' => str_slug($post->title)])}}">Read more</a>
        </div>
    @empty
    @endforelse
        @include('pagination.default', ['paginator' => $posts] )
      </div>
    </div>
  </div>
</section>
@endsection
