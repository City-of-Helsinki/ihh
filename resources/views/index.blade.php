@php
  $is_news_or_events_page = true;
  $content = get_post(get_option('page_for_posts'))->post_content;
@endphp

@extends('layouts.app')

@section('content')
  <section class="content-block container">
    @include('partials.content.header')

    <div class="content-block-content">
      {!! apply_filters('the_content', $content) !!}
    </div>


    <h2>@php pll_e('All news'); @endphp</h2>

    <div id="blog-posts-container">
        @include ('partials.content.blog-post-list')
    </div>

    <div class="sr-only status" aria-live="polite"></div>

  </section>
@endsection
