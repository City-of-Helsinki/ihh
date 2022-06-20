{{--
  Template Name: Employers - Defaul Content page
--}}

@extends('layouts.app')

@section('content')
    @while(have_posts()) @php the_post() @endphp
    <div class="content-block container">
        <div class="row">
            <div class="col-md-8">
                <article class="content-block">
                @include('partials.content.header')
                @include('partials.content.page')

                @include('components.employers-flexible-content')
                </article>

                @include('components.home.testimonials')

                @include('components.employers.employers-contact')
                @include('components.employers.employers-faq')
                @include('components.employers.employers-events')
                @include('partials.media-category')
            </div>

            <div class="col-md-4 sidebar">
                @include('components.navigation-boxes')
            </div>
        </div>

        <div class="row content-footer">
            <div class="col-md-12">
                @include('components.navigation-boxes')
            </div>
        </div>
    </div>
  @endwhile
@endsection
