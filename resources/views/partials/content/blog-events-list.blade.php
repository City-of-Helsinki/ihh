@php
  $is_past_events_page = get_field("pastupcoming_events");
  $events_page_button_color = get_field("events_page_button_color");
  $button_style = $events_page_button_color ? 'style="background-color:' . esc_attr($events_page_button_color) . ';"' : "";

  $base_args = [
    'posts_per_page'            => 6,
    'post_type'                 => 'event',
    'type'                      => 'event',
    'paged'                     => 1,
    'post_status'               => 'publish',
  ];

  if ($is_past_events_page) {
    $base_args['meta_query'] = [
      [
        'key'     => 'end_time',
        'value'   => current_time('mysql'),
        'compare' => '<',
        'type'    => 'DATETIME',
      ],
    ];
    $base_args['meta_key'] = 'end_time';
    $base_args['orderby']  = 'meta_value';
    $base_args['order']    = 'DESC';
  } else {
    $base_args['meta_query'] = [
      [
        'key'     => 'end_time',
        'value'   => current_time('mysql'),
        'compare' => '>=',
        'type'    => 'DATETIME',
      ],
    ];
    $base_args['meta_key'] = 'start_time';
    $base_args['orderby']  = 'meta_value';
    $base_args['order']    = 'ASC';
  }

  $events_query = new WP_Query($base_args);
  $posts_per_page = $base_args['posts_per_page'];
@endphp


@if (!$events_query->have_posts())
    <div class="alert alert-warning">
      {{ pll__('Sorry, no events were found.') }}
    </div>
@else
    <div id="blog-events" class="list posts-container">
        @while ($events_query->have_posts()) @php $events_query->the_post() @endphp
          @include('partials.content.grid')
        @endwhile
    </div>

    @php
      $has_more = ($events_query->post_count >= $posts_per_page);
      wp_reset_postdata();
    @endphp

    <div class="load-more-wrapper">
        <button
          id="load-more-events"
          class="btn ihh-cta"
          @if(!$has_more) style="display:none" @endif
          data-current-page="1"
          data-offset="{{ $posts_per_page }}"
          data-per-page="9"
          data-range="{{ $is_past_events_page ? 'past' : 'upcoming' }}"
          data-nonce="{{ wp_create_nonce('load_more_events') }}"
          {!! $button_style !!}
        >
          @php pll_e('Show more events') @endphp
        </button>
    </div>
@endif
