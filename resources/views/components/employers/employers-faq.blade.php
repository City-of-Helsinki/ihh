@if(have_rows('question_group'))
  <section class="faqs faqs--employers faq-margin-top container">
    
    @while(have_rows('question_group')) @php the_row(); @endphp
      <h2>{{the_sub_field('title')}}</h2>
      <div id="faqs">
        @while(have_rows('questions')) @php the_row(); $id = get_row_index(); @endphp
        <div class="question" id="question_{{$id}}">
          <button class="question-header collapsed"
                  data-toggle="collapse"
                  data-target="#answer_{{$id}}"
                  aria-expanded="false"
                  aria-controls="answer_{{$id}}"
                  aria-owns="answer_{{$id}}">
            <span>{{the_sub_field('question')}}</span>
          </button>

          <div id="answer_{{$id}}"
              class="collapse question-answer"
              data-parent="#faqs">
            {{the_sub_field('answer')}}
            <button class="faq-answer-close-button" data-toggle="collapse"  data-target="#answer_{{$id}}">{!! pll__('Close') !!}</button>
          </div>
        </div>
        @endwhile
      </div>

    @endwhile
  </section>
@endif