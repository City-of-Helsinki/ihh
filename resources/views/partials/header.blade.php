@php wp_reset_postdata() @endphp

@php
  $id = is_home() ? get_option('page_for_posts') : get_the_ID();

  if(is_archive()){
    $id = get_option('page_for_posts');
  }

  $header_img = has_post_thumbnail($id) ? get_the_post_thumbnail_url($id) : \App\get_default_image();
  if(is_search()){
    $search_main_id = get_page_by_path('search');
    $content_id = pll_get_post($search_main_id->ID);
    $header_img = get_the_post_thumbnail_url($search_main_id);
  }

  $is_events_template = $template === 'views/template-events.blade.php';
@endphp

@if(is_front_page())
  @include('components.notifications')
@endif

@if(!is_singular(['post', 'event']) && !$is_events_template)
  <header class="header-area container-wide">
    <img src="{{ $header_img }}" alt="">
    @include('components.wave')
  </header>
@endif

<div class="container breadcrumbs-container @if($is_events_template) mt-4 @endif">
@php
  if ( function_exists('yoast_breadcrumb') and !is_front_page() ) {
    yoast_breadcrumb( '<nav id="breadcrumbs">','</nav>' );
  }
@endphp
</div>
