@php
  global $wp_query;
  $home_id = $wp_query->post->ID;
  $post = get_post($home_id);
  $title = $post->post_title;
  $content = $post->post_content;

  $has_content = false;
  ob_start(); // start output buffering
@endphp


@if(have_rows('testimonial'))
  @while(have_rows('testimonial')) @php the_row() @endphp
  <section class="testimonials">
    <div class="container">
      @php $testimonialDescription = trim(get_sub_field('description')); @endphp

      <div class="testimonial">
        @if( !empty($testimonialDescription) )
          <div class="content">
            <p>{{ the_sub_field('description')}}</p>
          </div>

          @php $has_content = true; @endphp
        @endif

        @if(have_rows('testimonial_repeater'))
        <div class="videos">
            @while(have_rows('testimonial_repeater')) @php the_row() @endphp
            <div class="video">
                @if(get_sub_field('show_play_button'))
                <div class="youtube_play"></div>
                @endif

                  @if(get_sub_field('video_link'))
                  <a href="{{ the_sub_field('video_link') }}" class="image fancybox-youtube" data-autoplay="true" data-vbtype="video" aria-label="Video">

                  @php $has_content = true; @endphp
                  @endif

                    @if( get_sub_field('image'))
                      @php $image = get_sub_field('image'); @endphp
                      <img src="{{ $image['url'] }}" alt="{{$image['alt']}}" >

                      @php $has_content = true; @endphp
                    @endif

                  @if(get_sub_field('video_link'))
                  </a>
                  @endif

                  @if(get_sub_field('body'))
                    <p>{{ the_sub_field('body')}}</p>

                    @php $has_content = true; @endphp
                  @endif

                </div>
            @endwhile
          </div>
        @endif
      </div>

    </div>
  </section>
  @endwhile
@endif

@php
// get the content of the buffer and clear it
$content = ob_get_clean();

if ($has_content) {
  echo $content;
}
@endphp