{{--
  Template Name: Services
--}}

@extends('layouts.app')
@section('content')
  @while(have_posts()) @php the_post() @endphp
  <article class="content-block container">
    @include('partials.content.header')
    @include('partials.content.page')
    @include('components.services-accordion')
    @include('partials.media-category')
  </article>
  @endwhile
@endsection