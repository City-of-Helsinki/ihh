@php
  $content = get_post(get_option('page_for_posts'))->post_content;
@endphp

@extends('layouts.app')

@section('content')
  <section class="content-block container">
    @include('partials.content.header')
    <div class="filters row d-flex">
      <div class="content-type col-6">
        <h3>Content type</h3>
        <div class="btn-group" role="group">
          <button type="button" class="btn btn-outline-primary rounded-pill px-4 mr-3">All content</button>
          <button type="button" class="btn btn-outline-primary rounded-pill px-4 mr-3">News</button>
          <button type="button" class="btn btn-outline-primary rounded-pill px-4 mr-3">Events</button>
      </div>
      <div class="target-group">
        <h3>Target group</h3>
      </div>
    </div>
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

    {!! get_the_posts_navigation() !!}
  </section>
@endsection
