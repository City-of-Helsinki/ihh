@if (is_front_page())

  @php
    $home_id = get_option('page_on_front');
    $post = get_post($home_id);
    $title = $post->post_title;
    $content = $post->post_content;
  @endphp

  <section class="title-area">
    <div class="container">
      <div class="title">
        <h1>{{ $title }}</h1>
        {!! apply_filters('the_content', $content) !!}
      </div>
    </div>
  </section>

@else

  <div class="content-header">
    <h1>{!! \App\Controllers\App::title() !!}</h1>
  </div>

@endif
