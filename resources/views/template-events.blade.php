{{--
  Template Name: Events
--}}

@php
  $is_news_or_events_page = true;
  $is_past_events_page = get_field("pastupcoming_events");
@endphp

@extends('layouts.app')

@section('content')

  <section class="content-block container ihhce">
    @include('partials.content.header')

    @while(have_posts()) @php the_post() @endphp
      <div class="content-block-content">
        @include('partials.content.page')
      </div>
    @endwhile

    <div id="blog-events-container">
        @include ('partials.content.blog-events-list')
    </div>

    <div class="sr-only status" aria-live="polite"></div>

    @if(!$is_past_events_page)
      <div id="show_past_events_wrapper">
        <a id="show_past_events_btn" href="{{ esc_url(get_field("past_events_page")) }}" class="">
          <span class="inline-svg">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve" role="presentation">
              <path style="fill-rule:evenodd;clip-rule:evenodd" d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path>
            </svg>
          </span>@php pll_e('Past events') @endphp
        </a>
      </div>
    @endif
  </section>
@endsection
