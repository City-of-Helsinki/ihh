@php
  $content = get_post(get_option('page_for_posts'))->post_content;
  $arrow_right = '<svg class="hds-arrow-right" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><rect width="24" height="24"></rect><polygon fill="currentColor" points="10.5 5.5 12 7 8 11 20.5 11 20.5 13 8 13 12 17 10.5 18.5 4 12" transform="matrix(-1 0 0 1 24.5 0)"></polygon></g></svg>';
@endphp

@extends('layouts.app')

@section('content')
  <section class="content-block container">
    @include('partials.content.header')
    <div class="filters row d-flex">
      <div class="content-type col-lg-6 flex-sm-column">
        <h3>Content type</h3>
          <a href="" class="btn btn-outline-primary rounded-pill px-4 mr-3 text-decoration-none text-dark" >All content</a>
          <a href="" class="btn btn-outline-primary rounded-pill px-4 mr-3 text-decoration-none text-dark" >News</a>
          <a href="" class="btn btn-outline-primary rounded-pill px-4 mr-3 text-decoration-none text-dark" >Events</a>
      </div>
      <div class="target-group col-lg-6 flex-sm-column">
        <h3>Target group</h3>
        <a href="" class="btn btn-outline-primary rounded-pill px-4 mr-3 text-decoration-none text-dark">All groups</a>
        @foreach (App::get_target_groups() as $term )
          {!! App::format_term($term) !!}
        @endforeach
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

    <div class="posts-nav w-100">
      {!! get_the_posts_navigation() !!}
    </div>
  </section>
@endsection
