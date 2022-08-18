@if (!have_posts())
      <div class="alert alert-warning">
        {{ pll__('Sorry, no news were found.') }}
      </div>
@endif

<div id="blog-posts" class="list posts-container">

    @while (have_posts()) @php the_post() @endphp
        @include ('partials.content.grid')
    @endwhile
</div>

<nav class="pagination" aria-label="@php pll_e('Pagination'); @endphp">
    @php
    echo paginate_links( array(
                'format' => '?paged=%#%',
                'prev_text'          => __( 'Newer posts', 'ihh' ),
                'next_text'          => __( 'Older posts', 'ihh' ),
                'type' => 'list'
            ) );
    @endphp
</nav>