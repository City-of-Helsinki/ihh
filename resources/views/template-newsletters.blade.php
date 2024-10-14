{{--
  Template Name: Newsletters
--}}

@extends('layouts.app')

@section('content')

  <section class="content-block container">
    @include('partials.content.header')

    @while(have_posts()) @php the_post() @endphp
      <div class="content-block-content">
        @include('partials.content.page')
      </div>
    @endwhile

    <div id="" class="list posts-container">
      <!-- https://ihh.local/wp-content/uploads/dvv-ukraine-swedish-pdf.jpg -->
      @php
      $args = array(
            'posts_per_page' => -1,
            'post_type' => 'newsletter',
      );

      $the_query = new WP_Query( $args );

      if ( $the_query->have_posts() ) {
          while ( $the_query->have_posts() ) {
              $the_query->the_post();
              $title = get_the_title();
              $date = get_the_date( 'j.n.Y' );

              $file = get_field('newsletter_pdf');
              if( $file ){

                $url = $file['url'];
                $post_thumbnail = get_the_post_thumbnail_url(get_the_ID(),'lift');
                $pdf_thumbnail = wp_get_attachment_image_src ( $file['ID'], 'lift' );
                if($post_thumbnail){
                  $icon = $post_thumbnail;
                }elseif($pdf_thumbnail){
                  $icon = $pdf_thumbnail[0];
                }else{
                  $icon = $file['icon'];
                }
              }

              @endphp

              <div class="post-grid-item newsletter-post-grid-item">
                <a href="@php echo esc_attr($url); @endphp" title="@php echo esc_attr($title); @endphp" target="_blank">
                  <header>
                    <img src="@php echo esc_attr($icon); @endphp" />
                  </header>

                  <div class="post-content">

                    <h2>@php echo esc_html($title); @endphp</h2>

                    <div class="post-content-event-meta">
                      <p class="date">@php echo $date; @endphp</p>
                    </div>

                  </div>
                  
                </a>
              </div>

              @php

          }
      }
      wp_reset_postdata();

      @endphp
    </div>

  </section>
  <section>
      @php do_action('ihh_render_flexible_content', 'lift_100_wide' ); @endphp
  </section>
@endsection