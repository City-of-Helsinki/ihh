@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content.single-'.get_post_type())

    <div class="single-container">
      <div class="content-single">
        @include('components.employers-flexible-content')
      </div>
    </div>
  @endwhile
@endsection