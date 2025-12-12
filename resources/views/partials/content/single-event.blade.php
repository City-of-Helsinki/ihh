@php
  $news_page = get_option('page_for_posts');
  $url = get_the_permalink();
  $title = get_the_title();
  $is_event = 'event' === get_post_type();
  $event_url_text = get_field('read_more_text') ?: pll__('Read more');
  $attachment_text = get_field('attachment_text') ?: pll__('Download attachment');

  $thumb_id  = get_post_thumbnail_id(get_the_ID());
  $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
  $caption = wp_get_attachment_caption($thumb_id);

  $event_type = get_field('event_type');
  $location   = get_field('location');

  // Is this event past or upcoming? Same logic as in archive query
  $end_time      = get_field('end_time');
  $is_past_event = $end_time && $end_time < current_time('mysql');

  // Get all pages using Events template (e.g. upcoming + past)
  $pages = get_pages([
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'views/template-events.blade.php',
  ]);

  $events_page_id = 0;

  // Select the page whose ACF pastupcoming_events matches the event's status
  foreach ($pages as $page) {
      $is_past_page = (bool) get_field('pastupcoming_events', $page->ID);

      if ($is_past_page === $is_past_event) {
          $events_page_id = $page->ID;
          break;
      }
  }

  // Fallback: if no match was found, use the first Events page
  if (!$events_page_id && !empty($pages)) {
      $events_page_id = $pages[0]->ID;
  }

@endphp

<section class="event-container">
  <article @php post_class('content-block content-single') @endphp>
    <a href="{!! get_the_permalink($events_page_id) !!}" class="go-back" aria-label="{{ pll_e('Go back to Events') }}"><i class="fa fa-angle-left"></i></a>

    <div class="event-top">
      @if(has_post_thumbnail())
        <div class="event-image" style="background-image: url('{{ esc_url($thumb_url) }}');">
        @if ($caption)
            <span class="event-image__caption">{{ esc_html($caption) }}</span>
        @endif
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
                <td>
                    @if ($event_type === 'Online')
                        {{ pll__('Online') }}
                    @elseif ($event_type === 'In person')
                        {{ esc_html($location) }}
                    @elseif ($event_type === 'Hybrid')
                        {{ pll__('Online') }} / {{ esc_html($location) }}
                    @else
                        {{ esc_html($location) }}
                    @endif
                </td>
              </tr>
            </tbody>
          </table>

          @if($is_event && get_field('attachment'))
            <a class="attachment-link" href="{!! get_field('attachment') !!}" target="_blank">{{ $attachment_text }}</a>
          @endif

          @if(get_field('event_url'))
            <a class="btn ihh-cta sign-up" href="{!! get_field('event_url') !!}" target="_blank">{{ $event_url_text }}</a>
          @endif

        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="event-body">
      <div class="event-body-content">
        @include('components.activity-banner')
        @if($is_event && get_field('description'))
        <div class="event-description">
          <h2>{{ pll_e('Description') }}</h2>
          {!! get_field('description') !!}
        </div>
        @endif
        @if($is_event && get_field('streaming'))
        <div class="event-streaming">
          <h2>{{ pll_e('Streaming') }}</h2>
          {!! get_field('streaming') !!}
        </div>
        @endif
        @if($is_event && get_field('program'))
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
