@if (!have_posts())
      <div class="alert alert-warning">
        {{ pll__('Sorry, no news were found.') }}
      </div>
@endif

<div id="blog-posts" class="list posts-container">
    @php
    $meta_query[] = [
            'relation' => 'OR',
            [
                'relation' => 'OR',
                [
                    'key'     => 'end_time',
                    'value'   => date( 'Y-m-d H:i:s' ),
                    'compare' => '>=',
                    'type'    => 'DATETIME',
                ],
                [
                    'key'     => 'end_time',
                    'value'   => '',
                    'compare' => '==',
                ],
            ],
            [
                [
                    'key'     => 'end_time',
                    'compare' => 'NOT EXISTS',
                    'value'   => '',
                ],
            ],

    ];


    $paged = isset($_GET['paged']) && (!empty( (int) $_GET['paged'] ) ) ? esc_attr($_GET['paged']) : 1;

    $args = array(
      'posts_per_page'=> 6,
      'post_type'     => 'post',
      'paged'         => $paged,
      'meta_query'    => $meta_query,
      'post_status'   => 'publish',
    );

    $events_query = new WP_Query($args);
    @endphp

    @while ($events_query->have_posts()) @php $events_query->the_post() @endphp
        @include ('partials.content.grid')
    @endwhile
</div>

@php
  $has_more = ($events_query->max_num_pages > $paged);
  wp_reset_postdata();
@endphp

<div class="load-more-wrapper">
    <button
      id="load-more-news"
      class="btn ihh-cta"
      @if(!$has_more) style="display:none" @endif
      data-current-page="1"
      data-offset="6"
      data-per-page="9"
      data-nonce="{{ wp_create_nonce('load_more_news') }}"
    >
      @php pll_e('Show more news') @endphp
    </button>
</div>
