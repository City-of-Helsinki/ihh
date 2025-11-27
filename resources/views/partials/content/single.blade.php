@php
  $news_page = get_option('page_for_posts');
  $url = get_the_permalink();
  $title = get_the_title();
  $is_event = 'event' === get_post_type();
  $event_url_text = get_field('read_more_text') ?: pll__('Read more');
  $attachment_text = get_field('attachment_text') ?: pll__('Download attachment');
@endphp

<section class="single-container">
  <article @php post_class('content-block content-single') @endphp>
    <a href="{!! get_the_permalink($news_page) !!}" class="go-back" aria-label="{{ pll_e('Go back to News and Events') }}"><i class="fa fa-angle-left"></i></a>
    @if(!$is_event)
      <p>{{ get_the_date('j.n.Y') }}</p>
    @endif
    <h1>{!! $title !!}</h1>

    @if($is_event)
      <div class="event-meta">
        <p class="date"><img src="@asset('images/icons/time.png')" alt=""> {!! \App\format_event_date() !!}</p>
        <p class="location"><img src="@asset('images/icons/location.png')" alt="">{!! get_field('location') !!}</p>
      </div>
    @endif

    @if(has_post_thumbnail())
      <div class="article-image">
        <img src="{!! get_the_post_thumbnail_url(get_the_ID()) !!}" alt="">
      </div>
    @endif

    <div class="article-body">
      {{ the_content() }}

      @if($is_event && get_field('event_url'))
        <a href="{!! get_field('event_url') !!}" class="event-url" target="_blank">{{ $event_url_text }}</a>
      @endif
    </div>
  </article>
</section>
