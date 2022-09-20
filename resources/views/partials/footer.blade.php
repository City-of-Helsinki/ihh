@php
  $footer_img = wp_get_attachment_image_url( get_theme_mod( 'ihh_footer_image' ), 'full' );
  $youtube = App::get_some_link('youtube');
  $twitter = App::get_some_link('twitter');
  $linkedin = App::get_some_link('linkedin');
  $facebook = App::get_some_link('facebook');
@endphp

<footer class="footer container-wide">
  {{--  <img src="@asset('images/footer.jpg')" alt="">--}}

  @if($footer_img)
    <img src="{{ $footer_img }}" alt="">
  @endif

  <div class="container">
    <div class="footer-content">
      <div class="footer-content-some hide-on-mobile">
        <img src="@asset('images/ihh_logo_black.png')" alt="International House Helsinki" class="footer-logo">

        <ul class="some-icons">
          @if($twitter)
          <li><a class="no-blank-icon" href="{{$twitter}}" target="_blank"><i aria-hidden="true" class="fa fa-twitter"></i><span class="ihh-visually-hidden">External content: Twitter page for Internal House Helsinki</span></a></li>
          @endif
          @if($youtube)
          <li><a class="no-blank-icon" href="{{$youtube}}" target="_blank"><i aria-hidden="true" class="fa fa-youtube"></i><span class="ihh-visually-hidden">External content: Youtube page for Internal House Helsinki</span></a></li>
          @endif
          @if($facebook)
          <li><a class="no-blank-icon" href="{{$facebook}}" target="_blank"><i aria-hidden="true" class="fa fa-facebook-official"></i><span class="ihh-visually-hidden">External content: Facebook page for Internal House Helsinki</span></a></li>
          @endif
          @if($linkedin)
          <li><a class="no-blank-icon" href="{{$linkedin}}" target="_blank"><i aria-hidden="true" class="fa fa-linkedin"></i><span class="ihh-visually-hidden">External content: LinkedIn page for Internal House Helsinki</span></a></li>
          @endif
        </ul>
      </div>

      <div class="footer-content-info">
        {!! apply_filters('the_content', App::get_footer_text() )!!}
      </div>

      <div class="footer-content-contact">
        {!! apply_filters('the_content', App::get_footer_contact() )!!}
      </div>

      <div class="footer-content-some hide-on-desktop">
        <img src="@asset('images/ihh_logo_black.png')" alt="International House Helsinki" class="footer-logo">

        <ul class="some-icons">
          @if($twitter)
          <li><a class="no-blank-icon" href="{{$twitter}}" target="_blank"><i aria-hidden="true" class="fa fa-twitter"></i><span class="ihh-visually-hidden">External content: Twitter page for Internal House Helsinki</span></a></li>
          @endif
          @if($youtube)
          <li><a class="no-blank-icon" href="{{$youtube}}" target="_blank"><i aria-hidden="true" class="fa fa-youtube"></i><span class="ihh-visually-hidden">External content: Youtube page for Internal House Helsinki</span></a></li>
          @endif
          @if($facebook)
          <li><a class="no-blank-icon" href="{{$facebook}}" target="_blank"><i aria-hidden="true" class="fa fa-facebook-official"></i><span class="ihh-visually-hidden">External content: Facebook page for Internal House Helsinki</span></a></li>
          @endif
          @if($linkedin)
          <li><a class="no-blank-icon" href="{{$linkedin}}" target="_blank"><i aria-hidden="true" class="fa fa-linkedin"></i><span class="ihh-visually-hidden">External content: LinkedIn page for Internal House Helsinki</span></a></li>
          @endif
        </ul>
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
