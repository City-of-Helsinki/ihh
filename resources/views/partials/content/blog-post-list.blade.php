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
    $target_group = isset($_GET['target_group']) && ( 'all' !== $_GET['target_group']) ? esc_attr( $_GET['target_group']) : 0;

    if($target_group === 0){
        $args = array(
            'post_type',
            'is_news_and_events_query' => true,
            'type' => 'post',
            'paged' => $paged,
            'meta_query' => $meta_query,
        );
    }else{
        $args = array(
            'post_type',
            'is_news_and_events_query' => true,
            'type' => 'post',
            'paged' => $paged,
            'meta_query' => $meta_query,
            'tax_query' => array( array ( 'taxonomy' => 'target_group', 'field' => 'slug', 'terms' => $target_group, )),
        );
    }

    query_posts($args);
    @endphp

    @while (have_posts()) @php the_post() @endphp
        @include ('partials.content.grid')
    @endwhile
</div>

<nav class="pagination" aria-label="@php pll_e('Pagination'); @endphp">
    @php
    echo paginate_links( array(
                'format' => '?paged=%#%',
                'prev_text'          => pll__('Newer posts'),
                'next_text'          => pll__('Older posts'),
                'type' => 'list'
            ) );
    @endphp
</nav>