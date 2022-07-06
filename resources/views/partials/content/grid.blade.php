<div @php post_class('post-grid-item') @endphp>
  <a href="{{the_permalink()}}">
    <span class="sr-only">{!! get_the_title() !!}</span>
  </a>
    <header>
        @if(has_post_thumbnail())
          <img src="{{get_the_post_thumbnail_url(get_the_ID(), 'lift')}}" alt="{{the_title()}}">
        @else
          <img role="presentation" src="{{ \App\get_default_image('lift') }}" alt="">
        @endif
    </header>
    <div class="post-content d-flex">
      <h2 class="order-2">{!! get_the_title() !!}</h2>
      <p class="order-1">Placeholder category</p>
      @if('event' === get_post_type())
        <div class="post-content-event-meta d-inline-flex flex-column order-3">
          @if($date = get_field('start_time'))
            <p class="date order-2"> {{\App\format_event_date_short()}}</p>
          @endif
          @if($location = get_field('location'))
            <p class="location order-1"> {{$location}}</p>
          @endif
        </div>
      @endif
    </div>
</div>
