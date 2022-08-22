<div @php post_class('post-grid-item') @endphp>
  <a href="{{the_permalink()}}">
    <header>
        @if(has_post_thumbnail())
          <img src="{{get_the_post_thumbnail_url(get_the_ID(), 'lift')}}" alt="{{the_title()}}">
        @else
          <img role="presentation" src="{{ \App\get_default_image('lift') }}" alt="">
        @endif
    </header>
    <div class="post-content">
      @if('event' === get_post_type())
          <div class="post-content-event-meta">
            @if($location = get_field('location'))
                <p class="location"> {{$location}}</p>
            @endif
          </div>
      @endif

      <h2>{!! get_the_title() !!}</h2>
      <span class="order-1 mb-3">
        {{ \App\Controllers\App::get_category() }}
      </span>

      @if('event' === get_post_type())
        <div class="post-content-event-meta">
          @if($date = get_field('start_time'))
            <p class="date"> {!! \App\ihh_inline_svg('icons/clock_outlines') !!} {{\App\format_event_date()}}</p>
          @endif
        </div>
      @endif
    </div>
  </a>
</div>
