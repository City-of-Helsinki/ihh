@extends('layouts.app')

@section('content')
@while(have_posts()) @php the_post() @endphp
<div class="content-block single-page-layout">
    <div class="row">
        <div class="col-md">
            <article class="content-block ihhce">
                @include('components.navigate-pages')
                @include('partials.content.header')
                @if (!is_front_page())
                    @include('partials.content.page')
                @endif
            </article>
        </div>
        @include('components.home.testimonials')
        {{-- @include('components.employers-flexible-content') --}}
    </div>
    <section class="full_flexible_content">
        @php do_action('ihh_render_flexible_content', 'lift_100_wide' ); @endphp
    </section>
    <div class="row content-footer">
        <div class="col-lg-12">
            @include('components.navigate-pages')
        </div>
    </div>
</div>
@endwhile
@endsection
