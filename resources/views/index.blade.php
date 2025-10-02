@php
  $content = get_post(get_option('page_for_posts'))->post_content;
  $target_groups = App\get_target_groups();
  $page_for_posts = get_permalink(get_option('page_for_posts'));
@endphp

@extends('layouts.app')

@section('content')
  <section class="content-block container">
    @include('partials.content.header')

    <div class="content-block-content">
      {!! apply_filters('the_content', $content) !!}
    </div>


    <h2>@php pll_e('All news'); @endphp</h2>

    {!! App\filter_posts() !!}

    <div id="blog-posts-container">
        @include ('partials.content.blog-post-list')
    </div>
    
    {{-- <br/><br/> --}}

    {{-- <h2>@php pll_e('All events'); @endphp</h2> --}}

    {{-- {!! App\filter_events() !!} --}}

    {{-- <div id="blog-events-container"> --}}
    {{--  @include ('partials.content.blog-events-list') --}}
    {{-- </div> --}}
    

   

    <div class="sr-only status" aria-live="polite"></div>

  </section>
@endsection
