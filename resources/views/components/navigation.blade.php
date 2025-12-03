<nav class="navbar sticky-top navbar-expand-lg main-nav-container">
  <div class="container">
    <a class="navbar-brand" href="{{ home_url('/') }}">
      <img src="@asset('images/logo_color.svg')" width="175" height="60" class="d-inline-block align-top"
           alt="Frontpage">
    </a>
    <div class="collapse navbar-collapse" id="main-navigation">

      @php
      if ( has_nav_menu('primary_navigation') ) {
        $menu_list = '';
        $theme_location = 'primary_navigation';

        if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {

          $current_page_ID     = get_the_ID();
          $menu_list           = '';
          $menu                = get_term( $locations[$theme_location], 'nav_menu' );
          $menu_items          = wp_get_nav_menu_items($menu->term_id);
          $mobile_quick_links  = '';
          $submenu_id          = "";

          $menu_list .= '<ul id="menu-paavalikko" class="navbar-nav menu menu-level-0">' . "\n";

          foreach ( $menu_items as $menu_item ) {
            $menu_children_array = array();
            $submenu_count       = 0;
            $submenu_count_class = '';
            $quick_links_submenu = false;

            if ( $menu_item->menu_item_parent == 0 ) {

              $parent           = $menu_item->ID;
              $menu_array       = array();
              $has_submenu      = false;
              $has_nav_heading  = false;

              /**
               * BEFORE building the actual structure: count the number of columns
               * and calculate their width percentages. (also for cases without headings)
               */
              $columns_total = 0;

              foreach ( $menu_items as $scan ) {
                if ( $scan->menu_item_parent != $parent ) {
                  continue;
                }

                $scan_is_heading   = get_field( 'menu_section_title', $scan->ID );
                $scan_is_quicklink = get_field( 'quick_link', $scan->ID );

                if ( $scan_is_heading ) {
                  // Columns from the heading's children
                  foreach ( $menu_items as $colscan ) {
                    if ( $colscan->menu_item_parent != $scan->ID ) {
                      continue;
                    }
                    // quick_link-level columns are not "main columns"
                    if ( get_field( 'quick_link', $colscan->ID ) ) {
                      continue;
                    }
                    $columns_total++;
                  }
                } else {
                  if ( ! $scan_is_quicklink ) {
                    $columns_total++;
                  }
                }
              }

              if ( $columns_total < 1 ) {
                $columns_total = 1;
              }
              $column_width = 100 / $columns_total;

              /**
               * Actual dropdown structure
               */
              foreach ( $menu_items as $submenu ) {
                $current_aria      = '';
                $active_class      = '';
                $menu_item_page_ID = get_post_meta( $submenu->ID, '_menu_item_object_id', true );

                if ( $menu_item_page_ID == $current_page_ID ) {
                  $current_aria = 'aria-current="page"';
                  $active_class = 'active';
                }

                if ( $submenu->menu_item_parent == $parent ) {

                  $menu_children_array[] .= $menu_item_page_ID;

                  // ACF fields for this 2nd level item
                  $is_menu_section_title = get_field( 'menu_section_title', $submenu->ID );
                  $is_quick_link         = get_field( 'quick_link', $submenu->ID );

                  /**
                   * 1) HEADING (menu_section_title = true)
                   */
                  if ( $is_menu_section_title ) {

                    // Ensure this is a level 2 item (child of main menu item)
                    if ( $menu_item->menu_item_parent == 0 && $submenu->menu_item_parent == $parent ) {

                      $has_submenu = true; // This menu has a submenu
                      $has_nav_heading = true;

                      // Collect heading columns into their own array
                      $heading_columns = array();

                      foreach ( $menu_items as $column ) {
                        if ( $column->menu_item_parent != $submenu->ID ) {
                          continue;
                        }
                        // Quick_link-level columns are not included here
                        if ( get_field( 'quick_link', $column->ID ) ) {
                          continue;
                        }
                        $heading_columns[] = $column;
                      }

                      $heading_span = count( $heading_columns );
                      if ( $heading_span < 1 ) {
                        $heading_span = 1;
                      }

                      // Heading takes this much space relative to the entire dropdown
                      $heading_width        = ( $heading_span / $columns_total ) * 100;
                      $heading_column_width = 100 / $heading_span;

                      // Heading has children only if it has at least one column item
                      $heading_has_children      = count( $heading_columns ) > 0;
                      $heading_children_class    = $heading_has_children ? 'has-children' : 'no-children';

                      $heading_html  = '<li class="nav-item nav-item-top menu-item submenu menu-item-heading ' . $heading_children_class . ' ' . $active_class . '" style="width: ' . $heading_width . '%">';
                      $heading_html .= '<span class="nav-heading"><span>' . $submenu->title . '</span></span>';
                      $heading_html .= '<ul class="dropdown-submenu menu-level-3">';

                      // Render columns inside the heading
                      foreach ( $heading_columns as $column ) {

                        $current_aria_col      = '';
                        $active_class_col      = '';
                        $menu_item_page_ID_col = get_post_meta( $column->ID, '_menu_item_object_id', true );

                        if ( $menu_item_page_ID_col == $current_page_ID ) {
                          $current_aria_col = 'aria-current="page"';
                          $active_class_col = 'active';
                        }

                        $submenu_count++;
                        if ( $submenu_count > 4 ) {
                          $submenu_count_class = 'submenu_big';
                        }

                        // Column has children only if it has at least one item
                        $column_has_children   = false;
                        foreach ( $menu_items as $leaf_check ) {
                          if ( $leaf_check->menu_item_parent == $column->ID ) {
                            $column_has_children = true;
                            break;
                          }
                        }
                        $column_children_class = $column_has_children ? 'has-children' : 'no-children';

                        $heading_html .= '<li class="nav-item nav-item-top menu-item submenu menu-item-has-children ' . $column_children_class . ' ' . $active_class_col . '" style="width: ' . $heading_column_width . '%">';
                        $heading_html .= '<a class="nav-link" href="' . $column->url . '" ' . $current_aria_col . '><span>' . $column->title . '</span></a>';
                        $heading_html .= '<ul class="dropdown-submenu menu-level-3">';

                        // Children of the column = actual listing
                        foreach ( $menu_items as $leaf ) {

                          if ( $leaf->menu_item_parent != $column->ID ) {
                            continue;
                          }

                          $current_aria_leaf      = '';
                          $active_class_leaf      = '';
                          $menu_item_page_ID_leaf = get_post_meta( $leaf->ID, '_menu_item_object_id', true );

                          if ( $menu_item_page_ID_leaf == $current_page_ID ) {
                            $current_aria_leaf = 'aria-current="page"';
                            $active_class_leaf = 'active';
                          }

                          $menu_children_array[] .= $menu_item_page_ID_leaf;

                          $heading_html .= '<li class="nav-item menu-item no-children ' . $active_class_leaf . '"><a class="nav-link" href="' . $leaf->url . '" ' . $current_aria_leaf . '><span>' . $leaf->title . '</span></a></li>';
                        }

                        $heading_html .= '</ul></li>'; // close column
                      }

                      $heading_html .= '</ul></li>'; // close heading

                      $menu_array[] = $heading_html;
                    }

                    // Heading processed – continue to the next $submenu
                    continue;
                  }

                  /**
                   * 2) QUICK LINK or normal 2nd level item
                   *    (old logic remains, but width is applied to the column)
                   */
                  $parents = $submenu->ID;

                  foreach ( $menu_items as $submenus ) {
                    $menu_item_page_ID = get_post_meta( $submenus->ID, '_menu_item_object_id', true );
                    if ( $submenus->menu_item_parent == $parents ) {
                      if ( $menu_item_page_ID == $current_page_ID ) {
                        $active_class = 'active';
                      }
                    }
                  }

                  // Check if this submenu actually has children
                  $submenu_has_children = false;
                  foreach ( $menu_items as $child_check ) {
                    if ( $child_check->menu_item_parent == $submenu->ID ) {
                      $submenu_has_children = true;
                      break;
                    }
                  }

                  $has_submenu = true;

                  if ( $is_quick_link ) {

                    $quick_links_submenu = true;
                    $menu_array[]        = '</li></ul><ul class="quick-link-ul menu-level-2"><li class="quick-link-li"><span class="quick-links">' . $submenu->title . '</span><ul class="dropdown-submenu menu-level-3">';
                    $mobile_quick_links .= '<span class="quick-links submenu_' . $parent . '">' . $submenu->title . '</span>';

                  } else {

                    // normal 2nd level column without headings
                    $children_class = $submenu_has_children ? 'has-children' : 'no-children';

                    $menu_array[] = '<li class="nav-item nav-item-top menu-item submenu menu-item-has-children ' . $children_class . ' ' . $active_class . '" style="width: ' . $column_width . '%"><a class="nav-link" href="' . $submenu->url . '"  ' . $current_aria . '><span>' . $submenu->title . '</span></a><ul class="dropdown-submenu menu-level-3">';
                    $submenu_count++;
                  }

                  if ( $submenu_count > 4 ) {
                    $submenu_count_class = 'submenu_big';
                  }

                  foreach ( $menu_items as $submenus ) {
                    $current_aria         = '';
                    $active_class         = '';
                    $menu_item_page_ID    = get_post_meta( $submenus->ID, '_menu_item_object_id', true );
                    if ( $menu_item_page_ID == $current_page_ID ) {
                      $current_aria = 'aria-current="page"';
                      $active_class = 'active';
                    }

                    if ( $submenus->menu_item_parent == $parents ) {
                      $menu_children_array[] .= $menu_item_page_ID;

                      $menu_array[] .= '<li class="nav-item menu-item no-children ' . $active_class . '"><a class="nav-link" href="' . $submenus->url . '" ' . $current_aria . '><span>' . $submenus->title . '</span></a></li>';
                      if ( $quick_links_submenu ) {
                        $mobile_quick_links .= '<span class="quick-links submenu_' . $parent . '"><a class="nav-link" href="' . $submenus->url . '" ' . $current_aria . '><span>' . $submenus->title . '</span></a></span>';
                      }
                    }
                  }

                  $menu_array[] .= '</ul></li>'; // close submenu item
                }
              }

              $current_aria      = '';
              $active_class      = '';
              $menu_item_page_ID = get_post_meta( $menu_item->ID, '_menu_item_object_id', true );

              if ( $menu_item_page_ID == $current_page_ID ) {
                $current_aria = 'aria-current="page"';
                $active_class = 'active';
              } elseif ( in_array( $current_page_ID, $menu_children_array ) ) {
                $active_class = 'active';
              }

              if ( $has_submenu == true && count( $menu_array ) > 0 ) {
                  $submenu_id = 'submenu_' . $menu_item->ID;

                  $menu_list .= '<li class="nav-item menu-item submenu menu-item-has-children has-children ' . $active_class . '">' . "\n";

                  // columns_total calculated above – clamp between 1–4
                  $columns_for_class = max( 1, min( 4, (int) $columns_total ) );
                  $columns_class     = 'columns-' . $columns_for_class;

                  // DEFAULT: normal text-based title
                  $menu_item_label = $menu_item->title . ' <b class="caret"></b>';

                  $menu_list .= '<a href="#" id="' . $submenu_id . '" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span>' . $menu_item_label . '</span></a>' . "\n";

                  $inner_menu_class = 'dropdown-inner-menu menu-level-2';
                  if ( $has_nav_heading ) {
                    $inner_menu_class .= ' has-nav-heading';
                  }

                  $menu_list .= '<ul class="dropdown-menu menu-level-1 ' . $submenu_count_class . ' ' . $columns_class . '" aria-labelledby="navbarDropdownMenuLink"><li><ul class="' . $inner_menu_class . '">' . "\n";

                  $menu_list .= implode( "\n", $menu_array );
                  $menu_list .= '</ul></li></ul>' . "\n"; // Close dropdown menu

              } else {

                $menu_item_page_ID = get_post_meta( $menu_item->ID, '_menu_item_object_id', true );
                $menu_item_slug    = 'menu-' . get_post_field( 'post_name', $menu_item_page_ID );
                $menu_list        .= '<li class="nav-item nav-item-top menu-item ' . $menu_item_slug . ' no-children ' . $active_class . '">' . "\n";
                $menu_list        .= '<a class="nav-link" href="' . $menu_item->url . '" ' . $current_aria . '><span>' . $menu_item->title . '</span></a>' . "\n";
              }
            }

            $menu_list .= '</li>' . "\n"; // Close main menu item
          }

          $menu_list .= '<li class="mobile-search no-children">' . "\n";
          $menu_list .= '
            <form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
              <label for="search-input">
                <span class="screen-reader-text">' . pll__('Search for') . '</span>
              </label>
              <input type="search" id="search-input" class="search-field" placeholder="' . pll__('Search...') . '" value="' . get_search_query() . '" name="s"/>
              <button type="submit" class="search-submit">' . pll__('Search') .'</button>
            </form>';
          $menu_list .= '<div class="mobile-quick-links">' . $mobile_quick_links . '</div>';
          $menu_list .= '</li>' . "\n"; // Close mobile search item
          $menu_list .= '</ul>' . "\n"; // Close main menu ul

        } else {
          $menu_list = '';
        }

        echo $menu_list;
      }
      @endphp
    </div> <!-- Close main-nav-container -->

    <div class="lang-hamburger-container">
      <form role="search" method="get" class="desktop-search-form" action="@php echo esc_url( home_url( '/' ) ); @endphp">

        <label for="desktop-search-input" class="screen-reader-text">
          @php pll_e('Search for') @endphp
        </label>

        <div class="search-input-group">
          <input
            type="search"
            id="desktop-search-input"
            class="search-field"
            placeholder="@php pll_e('Search...') @endphp"
            value="@php echo get_search_query(); @endphp"
            name="s"
          />

          <button
            type="submit"
            class="search-submit"
            aria-label="@php pll_e('Search') @endphp"
          >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
              </svg>

          </button>
        </div>

      </form>

      @php
        $languages = pll_the_languages([
          'raw'          => 1, // get languages as an array
          'hide_current' => 0, // show current language in the list
          'show_flags'   => 0, // do not show flags
          'show_names'   => 1, // show language names
        ]);

        // Find the current language
        $currentLang = null;
        foreach ($languages as $lang) {
          if (!empty($lang['current_lang'])) {
            $currentLang = $lang;
            break;
          }
        }
      @endphp

      @if (!empty($languages))
        <nav class="language-menu">
          <button class="language-menu__toggle">
            <span class="language-menu__label">@php pll_e("Language") @endphp</span>
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="lang-globe-icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
              </svg>

              <span class="language-menu__current">
                {{ $currentLang['name'] ?? '' }}
              </span>

              <span class="language-menu__icon-caret"></span>
            </div>
          </button>

          <ul class="language-menu__list">
            @foreach ($languages as $lang)
              <li class="language-menu__item {{ $lang['current_lang'] ? 'is-current' : '' }}">
                <a href="{{ $lang['url'] }}"
                  hreflang="{{ $lang['slug'] }}"
                  class="language-menu__link">
                  {{ $lang['name'] }}
                </a>
              </li>
            @endforeach
          </ul>
        </nav>
      @endif

      @php
        $lang_class = 'lang-' . pll_current_language ();
      @endphp
      <button class="navbar-toggler collapsed @php echo $lang_class; @endphp"
              type="button"
              data-toggle="collapse"
              data-target="#main-navigation"
              aria-controls="navbarNav"
              aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="label">Menu</span>
        <span class="icon">
        </span>
      </button>
    </div> <!-- Close lang-hamburger-container -->

  </div>
</nav>
