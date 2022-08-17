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

<div class="pagination">
    @php
    echo paginate_links( array(
                'format' => '?paged=%#%',
                'prev_text'          => __( 'Newer posts', 'ihh' ),
                'next_text'          => __( 'Older posts', 'ihh' ),
            ) );
    @endphp
</div>
<div class="sr-only status" aria-live="polite"></div>