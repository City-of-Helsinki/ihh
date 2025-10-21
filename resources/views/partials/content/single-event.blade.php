@php
  $news_page = get_option('page_for_posts');
  $url = get_the_permalink();
  $title = get_the_title();
  $is_event = 'event' === get_post_type();
  $event_url_text = get_field('read_more_text') ?: pll__('Read more');
  $attachment_text = get_field('attachment_text') ?: pll__('Download attachment');

  $pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'views/template-events.blade.php',
    'posts_per_page' => 1
  ));
  foreach($pages as $page){
      $events_page_id = $page->ID;
  }

@endphp

<section class="event-container">
  <article @php post_class('content-block content-single') @endphp>
    <a href="{!! get_the_permalink($events_page_id) !!}" class="go-back" aria-label="{{ pll_e('Go back to Events') }}"><i class="fa fa-angle-left"></i></a>

    <div class="event-top">
      @if(has_post_thumbnail())
        <div class="event-image" style="background-image: url('{!! get_the_post_thumbnail_url(get_the_ID()) !!}');">
        </div>
      @endif
      <div class="event-details">
        <h1>{!! $title !!}</h1>
        <div class="event-short-description">{!! get_field('event_short_description') !!}</div>
        <div class="event-meta">
          <table>
            <thead></thead>
            <tbody>
              <tr>
                <td>{{ pll_e('Date') }}</td>
                <td>{!! \App\format_event_date_only() !!}</td>
              </tr>

              <tr>
                <td>{{ pll_e('Time') }}</td>
                <td>{!! \App\format_event_time_only() !!}</td>
              </tr>

              <tr>
                <td>{{ pll_e('Paikka') }}</td>
                <td>{!! get_field('location') !!}</td>
              </tr>

              @if($is_event && get_field('attachment'))
              <tr>
                <td>{{ $attachment_text }}</td>
                <td><a href="{!! get_field('attachment') !!}" target="_blank">{{ $attachment_text }}</a></td>
              </tr>
              @endif
            </tbody>
          </table>

          @if(get_field('event_url'))
            <a class="btn ihh-cta sign-up" href="{!! get_field('event_url') !!}" target="_blank">{{ $event_url_text }}</a>
          @endif

        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="event-body">
      <div class="event-body-content">
        @if($is_event && get_field('description'))
        <a name="description"></a>
        <div class="event-description">
          <h2>{{ pll_e('Description') }}</h2>
          {!! get_field('description') !!}
        </div>
        @endif
        @if($is_event && get_field('streaming'))
        <a name="streaming"></a>
        <div class="event-streaming">
          <h2>{{ pll_e('Streaming') }}</h2>
          {!! get_field('streaming') !!}
        </div>
        @endif
        @if($is_event && get_field('program'))
        <a name="program"></a>
        <div class="event-program">
          <h2>{{ pll_e('Program') }}</h2>
          {!! get_field('program') !!}
        </div>
        @endif
      </div>
      <div class="clear"></div>
    </div>
    @if($is_event && get_field('event_url'))
    <div class="event-read-more">
      <div class="event-read-more-cta">
        <a href="{!! get_field('event_url') !!}" class="event-url btn ihh-cta" target="_blank">{{ $event_url_text }}</a>
      </div>
    </div>
    @endif
  </article>
</section>
