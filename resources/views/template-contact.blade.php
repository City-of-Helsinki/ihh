{{--
  Template Name: Contact
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
  <article class="content-block container">
    @include('partials.content.header')
    @include('partials.content.page')
  </article>
  @if(have_rows('links'))
    <section class="about-services">
      <div class="container">
        <div class="row">
          @while(have_rows('links')) @php the_row() @endphp
          <div class="service-link">
            <a href="{{the_sub_field('link')}}" target="_blank">
              @php
                $image = get_sub_field('logo');
              @endphp
              <img src="{{ $image['url'] }}" alt="{{$image['alt']}}" >
            </a>
          </div>
          @endwhile
        </div>
      </div>
    </section>
  @endif
  <article class="content-block container">
    @if( get_field('title_contact') )
    <h2>{{the_field('title_contact')}}</h2>
    @endif
    <section class="contact-location">
      <div class="contact-location-body">
        <div class="contact-location-body-section">
          <img src="@asset('images/icons/location.png')" alt="">
          <p>
            {{the_field('basic_address')}} <br>
            <a href="{{the_field('basic_map_link')}}" target="_blank">{!! pll__('Show address on a map') !!}</a>
          </p>
        </div>
        <div class="contact-location-body-section">
          <img src="@asset('images/icons/time.png')" alt="">
          {{ the_field('basic_opening_hours') }}
        </div>
      </div>
      <div class="contact-location-map">
        <img src="{{the_field('basic_map_image')}}" alt="">
      </div>
    </section>

    <div class="contact-info-box" @if(get_field('multilingual_color')) style="background-color: {!! get_field('multilingual_color') !!}" @endif>
      <img src="@asset('images/icons/customer.png')" alt="">
      <div class="contact-info-box-body">
        <h2>{{the_field('multilingual_title')}}</h2>
        {{the_field('multilingual_body')}}
      </div>
    </div>

    <div class="contact-info-box" @if(get_field('advisory_color')) style="background-color: {!! get_field('advisory_color') !!}" @endif>
      <img src="@asset('images/icons/corporative.png')" alt="">
      <div class="contact-info-box-body">
        <h2>{{the_field('advisory_title')}}</h2>
        {{the_field('advisory_body')}}
      </div>
    </div>

    <div class="contact-info-box" @if(get_field('media_color')) style="background-color: {!! get_field('media_color') !!}" @endif>
      <img src="@asset('images/icons/media.png')" alt="">
      <div class="contact-info-box-body">
        <h2>{{the_field('media_title')}}</h2>
        {{the_field('media_body')}}
      </div>
    </div>

  </article>
  @endwhile
@endsection
