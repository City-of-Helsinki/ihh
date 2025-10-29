@php
    $cur_type = get_query_var('type');
    $cur_targetgroup = get_query_var('events_target_group');
    $lang = 'en';
    if (function_exists('pll_current_language')){
        $lang = pll_current_language();
    }
    $current_targetgroup = '';
    if(isset($_GET['events_target_group'])){
        $current_targetgroup = $_GET['events_target_group'];
    }
@endphp
<div class="post-filter">
    <form action="{{$ajax_url}}" method="GET" id="filter-events" class="filters d-flex flex-wrap" data-group="type" aria-label="@php pll_e('Filter Events'); @endphp">
        <input type="hidden" name="base" value="{{$base}}" />
        <div class="js-filter-events"><input type="radio" name="type" value="event" id="type_event" checked hidden></div>

        <fieldset>
            <legend>@php pll_e('Target group'); @endphp</legend>
            <ul class="list-unstyled list-group list-group-horizontal" aria-labelledby="content_type">
                <li class="js-filter-events"><input type="radio" name="events_target_group" value="all" checked id="events_target_group_all" /><label for="events_target_group_all">@php pll_e('All groups'); @endphp</label></li>
                    @foreach ($target_groups as $term)
                        <li class="filter-item js-filter-events">
                            <input type="radio" name="events_target_group" value="{{ $term->slug }}"  id="events_target_group_{{ $term->term_id  }}" @php echo ($term->slug === $current_targetgroup ) ? 'checked' : '' @endphp/>
                            <label for="events_target_group_{{ $term->term_id }}">{{ $term->name }}</label>
                        </li>
                    @endforeach
            </ul>
        </fieldset>
        <input type="hidden" name="lang" value="{{$lang}}">
        <input type="hidden" name="action" value="myfilter">
    </form>
</div>
