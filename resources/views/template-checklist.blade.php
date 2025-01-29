{{--
  Template Name: Checklist
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
  <style>
    #faqs .question-box form {
      display: block;
      padding: 0 0 0 25px;
    }
    #faqs .question-box .input-checkbox {
        transform: scale(1.5);
    }
    .question-box {
      display: flex;
      align-items: center;
    }
    .accordion-link-list {
      border: 2px solid #000;
      padding: 10px 20px 20px 20px;
    }
    .accordion-link-list span {
      display: block;
    }
    .accordion-link-list strong {
      display: block;
      margin-top: 10px;
      margin-bottom: 10px;
    }
    .accordion-link-list span a {
      display: flex;
      align-items: center;
      padding: 4px 0;
    }
    .accordion-link-list span a span svg {
      fill: #000;
    }
  </style>
  <div class="content-block container single-page-layout">
      <div class="row">
          <div class="col-md-8">
              <article class="content-block">
                  @include('partials.content.header')
                  @include('partials.content.page')

                  @php do_action('ihh_render_flexible_content', 'lift_100_wide' ); @endphp
              </article>
          </div>

          <div class="col-md-4 sidebar">
              @include('components.navigate-pages')
              @include('components.flexible-content-sidebar')
          </div>
      </div>
      <div class="row content-footer">
          <div class="col-lg-12">
              @include('components.navigate-pages')
          </div>
      </div>
  </div>
  @endwhile
@endsection
