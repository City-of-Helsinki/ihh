@php
  $content = get_post(get_option('page_for_posts'))->post_content;
@endphp

@extends('layouts.app')

@section('content')
  <section class="content-block container">
    @include('partials.content.header')
    <div class="content-block-content">
      {!! apply_filters('the_content', $content) !!}
    </div>

    {!! App\filter_posts() !!}

    <div id="blog-posts-container">
        @include ('partials.content.blog-post-list')
    </div>
    <div class="sr-only status" aria-live="polite"></div>

  </section>
@endsection
