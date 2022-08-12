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


    @if (!have_posts())
      <div class="alert alert-warning">
        {{ pll__('Sorry, no news were found.') }}
      </div>
    @endif



    <div class="posts-container">
      @while (have_posts()) @php the_post() @endphp
        @include('partials.content.grid')
      @endwhile
    </div>

    <hr>

    {!! App\filter_posts() !!}

    <div id="blog-posts" class="list posts-container">
        @while (have_posts()) @php the_post() @endphp
          @include ('partials.content.grid')
        @endwhile
    </div>

    @php

        echo '<button class="load-more" data-page="1">Older posts</button>';

    @endphp

    <div class="sr-only status" aria-live="polite"></div>

    {!! get_the_posts_navigation() !!}
  </section>
@endsection
