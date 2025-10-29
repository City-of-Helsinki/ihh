{{--
  Template Name: Events
--}}

@php
  $template = get_page_template_slug(get_queried_object_id());
  $target_groups = App\get_target_groups();
  $page_for_posts = get_permalink(get_option('page_for_posts'));
@endphp

@extends('layouts.app')

@section('content')

  <section class="content-block container">
    @include('partials.content.header')

    @while(have_posts()) @php the_post() @endphp
      <div class="content-block-content">
        @include('partials.content.page')
      </div>
    @endwhile

    <h2>@php pll_e('All events'); @endphp</h2>

    {!! App\filter_events() !!}

    <div id="blog-events-container">
        @include ('partials.content.blog-events-list')
    </div>
    

   

    <div class="sr-only status" aria-live="polite"></div>

    @php wp_reset_postdata(); @endphp

      @php

        $args_past = array(
            'posts_per_page' => -1,
            'post_type' => 'event',
            'meta_key' => 'start_time',
            'orderby' => 'meta_value',
            'order' => 'DESC',
            'post_status' => 'publish',
            'meta_query' => array(
              'relation' => 'OR',
              [
                    'key'     => 'end_time',
                    'value'   => date( 'Y-m-d H:i:s' ),
                    'compare' => '<=',
                    'type'    => 'DATETIME',
                ],
            ),
        );

        $the_query = new WP_Query( $args_past );

        if ( $the_query->have_posts() ) {
          @endphp
          <a id="show_past_events_btn" class="btn mt-4 mb-4" href=""><span class="inline-svg"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32.6 32.1" xml:space="preserve" role="presentation"><path style="fill-rule:evenodd;clip-rule:evenodd" d="M32.6 16.1 16.5 0l-2.8 2.8 11.4 11.3H0v4h25L13.7 29.3l2.8 2.8z"></path></svg></span>@php pll_e('Past events'); @endphp</a>

          <div id="past-events" class="">
            <h2 class="mt-5">@php pll_e('Past events'); @endphp</h2>
          <div class="list posts-container">
          @php
          while ( $the_query->have_posts() ) {
            $the_query->the_post();
            @endphp
            
              @include ('partials.content.grid')
            
            @php
          }
          @endphp
          </div>
          @php
        }
      @endphp
    </div>

  </section>
@endsection
