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
        <div class="col-md">
            <article class="content-block print-area ihhce">
                @include('components.checklist-navigate')
                @include('partials.content.header')

                <div class="content-block container"
                    style="clear: both; padding-top: 1rem; padding-bottom: 1rem !important;">
                    @include('partials.content.page')
                </div>

                @php do_action('ihh_render_flexible_content', 'lift_100_wide' ); @endphp
            </article>
        </div>
    </div>
    <div class="row content-footer">
        <div class="col-lg-12">
            @include('components.navigate-pages')
        </div>
    </div>
</div>
<script type="text/javascript">
function addPrintEventListeners() {
    const printPageActions = document.querySelectorAll('.generate-content-pdf');
    printPageActions.forEach(function(value) {
        value.addEventListener('click', (e) => printLinkPage(e));
    });
}
addPrintEventListeners();

function printLinkPage(event) {
    openDetailsForPrinting();
    // Fallback remove classes
    const existingPrintArea = document.querySelectorAll('.article.container');
    existingPrintArea.forEach(function(value) {
        value.classList.remove("print-area");
    });

    const allAccordionContents = document.querySelectorAll('div.accordion-collapse');
    allAccordionContents.forEach(function(accordion) {
        const accordionContentId = accordion.getAttribute("id");
        collapse(`#${accordionContentId}`, 'show');
    });

    const printArea = document.querySelector('article');
    if (printArea) {
        printArea.classList.add("print-area");
    }

    const quickSearch = document.querySelector('.quick-seach-header');
    if (quickSearch) {
        quickSearch.classList.add("hide-from-print");
    }

    window.print();
    window.onafterprint = function() {
        printArea.classList.remove("print-area");
        allAccordionContents.forEach(function(accordion) {
            const accordionContentId = accordion.getAttribute("id");
            collapse(`#${accordionContentId}`, 'hide');
            closeDetailsAfterPrinting();
        });
    }
}
</script>
@endwhile
@endsection
