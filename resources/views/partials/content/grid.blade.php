<div @php post_class('post-grid-item') @endphp role="listitem">
  <a href="{{the_permalink()}}">
    <header>
        @if(has_post_thumbnail())
          <img src="{{get_the_post_thumbnail_url(get_the_ID(), 'lift')}}" alt="">
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

      <span class="mb-2">
        {{ \App\Controllers\App::get_category() }}
        @if('post' === get_post_type())
          {{ get_the_date('j.n.Y') }}
        @endif
      </span>

      <h2>{!! get_the_title() !!}</h2>

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
