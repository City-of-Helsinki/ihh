@extends('layouts.app')

@section('content')
@while(have_posts()) @php the_post() @endphp
    <div class="content-block container single-page-layout">
        <div class="row">
            <div class="col-md-8">
                <article class="content-block">
                    @include('partials.content.header')
                    @include('partials.content.page')

                    @include('components.employers-flexible-content')
                </article>
            </div>

            <div class="col-md-4 sidebar">
                @include('components.navigate-pages')
                @include('components.flexible-content-sidebar')
            </div>
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
