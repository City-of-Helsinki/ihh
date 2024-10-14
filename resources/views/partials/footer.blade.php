@php
  $footer_img = wp_get_attachment_image_url( get_theme_mod( 'ihh_footer_image' ), 'full' );
  $youtube = App::get_some_link('youtube');
  $twitter = App::get_some_link('twitter');
  $linkedin = App::get_some_link('linkedin');
  $facebook = App::get_some_link('facebook');

  $footer = get_field('footer', 'option');
  $footerimg = $footer['footer_image'];
  if (function_exists('pll_current_language')){
    $lang = pll_current_language();
  }
@endphp

<footer class="footer container-wide">
  {{--  <img src="@asset('images/footer.jpg')" alt="">--}}

  @php 
    if( $footer['footer_image'] ):
      $image = $footer['footer_image'];
      $size = 'full'; // (thumbnail, medium, large, full or custom size)
      if( $image ) {
        echo wp_get_attachment_image( $image, $size );
      }
    endif;
  @endphp

  <div class="container">
    <div class="footer-content">
      <div class="footer-content-some hide-on-mobile">
        <img src="@asset('images/ihh_logo_black.png')" alt="International House Helsinki" class="footer-logo">

        @php if( have_rows('footer', 'option') ): while ( have_rows('footer', 'option') ) : the_row();  @endphp

          <ul class="some-icons">

          @php if( have_rows('social_media_links') ): while ( have_rows('social_media_links') ) : the_row(); @endphp  
            
                <li><a class="no-blank-icon" href="{{ the_sub_field('url')}}" target="_blank">
                  <img src="{{ the_sub_field('icon')}}" />
                  <span class="ihh-visually-hidden">External content: {{ the_sub_field('name')}} page for Internal House Helsinki</span>
                </a></li>

            @php endwhile; endif; @endphp

          </ul>

        @php endwhile; endif; @endphp

      </div>

      <div class="footer-content-info">
        @php 
          if( $lang == 'fi' ):
            if( $footer['footer_text_fi'] ):
              echo $footer['footer_text_fi']; 
            endif;
          else:
            if( $footer['footer_text_en'] ):
              echo $footer['footer_text_en']; 
            endif;
          endif;
        @endphp

        @php if( have_rows('footer', 'option') ): while ( have_rows('footer', 'option') ) : the_row();  @endphp

        <div class="d-flex justify-content-start footer-logos mt-4">

          @php if( have_rows('list_of_logos') ): while ( have_rows('list_of_logos') ) : the_row(); @endphp  
          
            <div class="footer-logo align-self-center">
                @php 
                  if( get_sub_field('logo') ):
                    if(get_sub_field('url_optional')):
                      echo '<a href="' . get_sub_field('url_optional') . '" target="_blank">';
                    endif;
                    $image = get_sub_field('logo');
                    $size = 'medium'; // (thumbnail, medium, large, full or custom size)
                    if( $image ) {
                      echo wp_get_attachment_image( $image, $size );
                    }
                    if(get_sub_field('url_optional')):
                      echo '<span class="ihh-visually-hidden">External content: ' . get_post_meta($image, '_wp_attachment_image_alt', TRUE) . '</span>';
                      echo '</a>';
                    endif;
                  endif;
                @endphp
            </div>


          @php endwhile; endif; @endphp

        </div>

        @php endwhile; endif; @endphp

      </div>

      <div class="footer-content-contact">
        @php 
          if( $lang == 'fi' ):
            if( $footer['contact_text_fi'] ):
              echo $footer['contact_text_fi']; 
            endif;
          else:
            if( $footer['contact_text_en'] ):
              echo $footer['contact_text_en']; 
            endif;
          endif;
        @endphp
      </div>

      <div class="footer-content-some hide-on-desktop">
        <img src="@asset('images/ihh_logo_black.png')" alt="International House Helsinki" class="footer-logo">

        @php if( have_rows('footer', 'option') ): while ( have_rows('footer', 'option') ) : the_row();  @endphp

          <ul class="some-icons">

          @php if( have_rows('social_media_links') ): while ( have_rows('social_media_links') ) : the_row(); @endphp  
            
                <li><a class="no-blank-icon" href="{{ the_sub_field('url')}}" target="_blank">
                  <img src="{{ the_sub_field('icon')}}" />
                  <span class="ihh-visually-hidden">External content: {{ the_sub_field('name')}} page for Internal House Helsinki</span>
                </a></li>

            @php endwhile; endif; @endphp

          </ul>

        @php endwhile; endif; @endphp
      </div>

    </div>
  </div>
  @php
    $misc = get_field('miscellaneous', 2);
    $token = $misc['feedbackly_oid'] ?? false;
  @endphp
  @if($token)
    <script>
      (function(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.defer = true; s.src = 'https://survey.feedbackly.com/dist/plugin-v4.min.js'; var e = document.getElementsByTagName('body')[0] || document.getElementsByTagName('head')[0]; e.appendChild(s); window._fblyConf={oid: '@php echo $token @endphp',pth: 'https://survey.feedbackly.com',dmn:'default'}; window.FBLY = window.FBLY || {evbuf: []}; window.FBLY.action = window.FBLY.action || function(a,b,c){window.FBLY.evbuf.push([a,b,c])}; ['addProperty', 'clearProperty', 'setLanguage', 'open', 'addMeta'].forEach(function(m){ window.FBLY[m] = window.FBLY[m] || function(a, c){window.FBLY.evbuf.push([m,a,c])} });
      })();
    </script>
  @endif

</footer>
