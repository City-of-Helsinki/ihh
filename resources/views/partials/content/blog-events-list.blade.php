@php
$paged = isset($_GET['paged-events']) && (!empty( (int) $_GET['paged-events'] ) ) ? esc_attr($_GET['paged-events']) : 1;
$events_target_group = isset($_GET['events_target_group']) && ( 'all' !== $_GET['events_target_group']) ? esc_attr( $_GET['events_target_group']) : 0;

if($events_target_group === 0){
    $args = array(
        'posts_per_page' => 6,
        'post_type',
        'is_news_and_events_query' => true,
        'type' => 'event',
        'paged' => $paged,
    );
}else{
    $args = array(
        'posts_per_page' => 6,
        'post_type',
        'is_news_and_events_query' => true,
        'type' => 'event',
        'paged' => $paged,
        'tax_query' => array( array ( 'taxonomy' => 'target_group', 'field' => 'slug', 'terms' => $events_target_group, )),
    );
}
query_posts($args);
@endphp


@if (!have_posts())
      <div class="alert alert-warning">
        {{ pll__('Sorry, no news were found.') }}
      </div>
@endif

<div id="blog-events" class="list posts-container">
    @while (have_posts()) @php the_post() @endphp
        @include ('partials.content.grid')
    @endwhile
</div>

<nav class="pagination-events" aria-label="@php pll_e('Pagination'); @endphp">
    @php
    echo paginate_links( array(
                'format' => '?paged-events=%#%',
                'prev_text'          => pll__('Newer events'),
                'next_text'          => pll__('Older events'),
                'type' => 'list'
            ) );
    @endphp
</nav>