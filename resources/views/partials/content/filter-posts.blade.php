@php
    $cur_type = get_query_var('type');
    $cur_targetgroup = get_query_var('targetgroup');
@endphp
<div class="post-filter">
    <form action="{{$ajax_url}}" method="GET" id="filter" class="filters d-flex flex-wrap" data-group="type" aria-label="Filter News and Events">
        <input type="hidden" name="base" value="{{$base}}" />
        <fieldset>
            <legend>Content type</legend>
            <ul class="list-unstyled list-group list-group-horizontal" aria-labelledby="content_type">
                <li class="js-filter"><input type="radio" name="type" value="all" checked id="type_all" /><label for="type_all">All content</label></li>
                    @foreach( $categories as $category )
                        <li class="js-filter"><input type="radio" data-category="{{ $category->name }}" name="type" value="{{ $category->slug }}" id="type_post_{{ $category->term_id }}" @php echo ($category->slug === $cur_type ) ? 'checked' : '' @endphp /><label for="type_post_{{ $category->term_id }}">{{ $category->name }}</label></li>
                    @endforeach
                <li class="js-filter"><input type="radio" name="type" value="event" id="type_event" @php echo ('event' === $cur_type ) ? 'checked' : '' @endphp /><label for="type_event">Event</label></li>
            </ul>
        </fieldset>


        <fieldset>
            <legend>Target group</legend>
            <ul class="list-unstyled list-group list-group-horizontal" aria-labelledby="content_type">
                <li class="js-filter"><input type="radio" name="targetgroup" value="all" checked id="target_group_all" /><label for="target_group_all">All groups</label></li>
                    @foreach ($target_groups as $term)
                        <li class="filter-item js-filter">
                            <input type="radio" name="targetgroup" value="{{ $term->slug }}"  id="target_group_{{ $term->term_id  }}" @php echo ($term->slug === $cur_targetgroup ) ? 'checked' : '' @endphp/>
                            <label for="target_group_{{ $term->term_id }}">{{ $term->name }}</label>
                        </li>
                    @endforeach
            </ul>
        </fieldset>

        <input type="hidden" name="action" value="myfilter">
    </form>

</div>