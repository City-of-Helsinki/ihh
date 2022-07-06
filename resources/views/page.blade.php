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

            <div class="col-lg-4 sidebar">
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
