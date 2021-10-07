@if ($media_categories = \App\Controllers\App::get_media_categories() )

  <section class="media-categories @if ($style == 'accordion') media-categories--accordion @else container @endif">
    <div class="container" style="padding: 0px;">
    @if ($media_title = \App\Controllers\App::get_media_category_title(null) )

      @if ($style == 'accordion')
        <h3><strong>{{$media_title}}</strong></h3>
      @else
        <h2>{{$media_title}}</h2>
      @endif

    @endif
    <div class="posts-container media-posts-container">
    @foreach($media_categories as $media)

      <div class="media-grid-container post-grid-item">
      @if($media_file_link = \App\Controllers\App::get_media_category_link($media) )
        {!! $media_file_link !!}
      @endif
        <div class="media-container">
          <div class="image-wrap" {!! \App\Controllers\App::get_media_category_thumbnail($media)  !!}>
          </div> 
          <div class="title {{ \App\Controllers\App::get_media_category_bg($media) }}">               
            {!! \App\Controllers\App::get_media_category_icon($media) !!}
            <p>{{ get_the_title($media) }}</p>
          </div>
        </div>
      @if($media_file_link = \App\Controllers\App::get_media_category_link($media) )
        </a>
      @endif
      </div>
    @endforeach
    </div>
    </div>
  </section>
@endif