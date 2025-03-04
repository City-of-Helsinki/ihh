<nav class="navbar sticky-top navbar-expand-lg main-nav-container">
  <div class="container">
    <a class="navbar-brand" href="{{ home_url('/') }}">
      <img src="@asset('images/logo_color.svg')" width="175" height="60" class="d-inline-block align-top"
           alt="Frontpage">
    </a>
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
      <span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="main-navigation">

      @php
      if((has_nav_menu('primary_navigation'))){
        $menu_list = '';
        $theme_location = 'primary_navigation';
        if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
      
          $current_page_ID = get_the_ID();
          $menu_list  = '';
          $menu = get_term( $locations[$theme_location], 'nav_menu' );
          $menu_items = wp_get_nav_menu_items($menu->term_id);
          $mobile_quick_links = '';
          $submenu_id = "";

          $menu_list .= '<ul id="menu-paavalikko" class="navbar-nav menu">' ."\n";

          foreach( $menu_items as $menu_item ) {
            $menu_children_array = array();
            $submenu_count = 0; 
            $submenu_count_class = '';
            $quick_links_submenu = false;

            if( $menu_item->menu_item_parent == 0 ) {
              
              $parent = $menu_item->ID;
              
              $menu_array = array();
              foreach( $menu_items as $submenu ) {
                  $current_aria = '';
                  $active_class = '';
                  $menu_item_page_ID = get_post_meta( $submenu->ID, '_menu_item_object_id', true );
                  if($menu_item_page_ID == $current_page_ID){
                    $current_aria = 'aria-current="page"';
                    $active_class = 'active';
                  }

                  if( $submenu->menu_item_parent == $parent ) {
                      $menu_children_array[] .= $menu_item_page_ID;
                      $parents = $submenu->ID;
                      foreach($menu_items as $submenus){
                        $menu_item_page_ID = get_post_meta( $submenus->ID, '_menu_item_object_id', true );
                        if( $submenus->menu_item_parent == $parents ) {
                          if($menu_item_page_ID == $current_page_ID){
                            $active_class = 'active';
                          }
                        }
                      }

                      $bool = true;
                      if(get_field('quick_link', $submenu->ID)){
                        $quick_links_submenu = true;
                        $menu_array[] = '</li></ul><ul class="quick-link-ul"><li class="quick-link-li"><span class="quick-links">' . $submenu->title . '</span><ul class="dropdown-submenu">';
                        $mobile_quick_links .= '<span class="quick-links submenu_' . $parent . '">' . $submenu->title . '</span>';
                      }else{
                        $menu_array[] = '<li class="nav-item nav-item-top menu-item submenu menu-item-has-children ' . $active_class . '"><a class="nav-link" href="' . $submenu->url . '"  ' . $current_aria . '><span>' . $submenu->title . '</span></a><ul class="dropdown-submenu">';
                        $submenu_count++;
                      }

                      if($submenu_count > 4){
                        $submenu_count_class = 'submenu_big';
                      }
                      
                      foreach($menu_items as $submenus){
                        $current_aria = '';
                        $active_class = '';
                        $menu_item_page_ID = get_post_meta( $submenus->ID, '_menu_item_object_id', true );
                        if($menu_item_page_ID == $current_page_ID){
                          $current_aria = 'aria-current="page"';
                          $active_class = 'active';
                        }

                        if( $submenus->menu_item_parent == $parents ) {
                          $menu_children_array[] .= $menu_item_page_ID;
                          
                          $menu_array[] .= '<li class="nav-item menu-item ' . $active_class . '"><a class="nav-link" href="' . $submenus->url . '" ' . $current_aria . '><span>' . $submenus->title . '</span></a></li>';
                          if($quick_links_submenu){
                            $mobile_quick_links .= '<span class="quick-links submenu_' . $parent . '"><a class="nav-link" href="' . $submenus->url . '" ' . $current_aria . '><span>' . $submenus->title . '</span></a></span>';
                          }
                        }
                      }
                      $menu_array[] .= '</ul></li>';
                  }
              }

              $current_aria = '';
              $active_class = '';
              $menu_item_page_ID = get_post_meta( $menu_item->ID, '_menu_item_object_id', true );
              if($menu_item_page_ID == $current_page_ID){
                $current_aria = 'aria-current="page"';
                $active_class = 'active';
              }elseif(in_array($current_page_ID, $menu_children_array)){
                $active_class = 'active';
              }

              if( $bool == true && count( $menu_array ) > 0 ) {
                $submenu_id = 'submenu_' . $menu_item->ID;
                
                if($menu_item->url == '#pll_switcher'){
                  $menu_list .= '<li class="pll-parent-menu-item nav-item menu-item submenu menu-item-has-children">' ."\n";
                }else{
                  $menu_list .= '<li class="nav-item menu-item submenu menu-item-has-children ' . $active_class . '">' ."\n";
                }

                $menu_list .= '<a href="#" id="' . $submenu_id . '" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span>' . $menu_item->title . ' <b class="caret"></b></span></a>' ."\n";

                $menu_list .= '<ul class="dropdown-menu  ' . $submenu_count_class . '" aria-labelledby="navbarDropdownMenuLink"><li><ul class="dropdown-inner-menu">' ."\n";
                $menu_list .= implode( "\n", $menu_array );
                $menu_list .= '</ul></li></ul>' ."\n";
                
              } else {
                
                $menu_item_slug = 'menu-' . get_post_field( 'post_name', $menu_item_page_ID );
                $menu_list .= '<li class="nav-item nav-item-top menu-item ' . $menu_item_slug . ' ' . $active_class . '">' ."\n";
                $menu_list .= '<a class="nav-link" href="' . $menu_item->url . '" ' . $current_aria . '><span>' . $menu_item->title . '</span></a>' ."\n";
              }
              
            }
            
            $menu_list .= '</li>' ."\n";
          }
           
          $menu_list .= '<li class="mobile-search">' ."\n";
          $menu_list .= '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
  <label for="search-input">
    <span class="screen-reader-text">' . pll__('Search for') . '</span>
  </label>
  <input type="search" id="search-input" class="search-field" placeholder="' . pll__('Search...') . '" value="' . get_search_query() . '" name="s"/>
  <button type="submit" class="search-submit">' . pll__('Search') .'</button>
</form>';
          $menu_list .= '<div class="mobile-quick-links">' . $mobile_quick_links . '</div>';
          $menu_list .= '</li>' ."\n";
          $menu_list .= '</ul>' ."\n";
      
        } else {
            $menu_list = '';
        }
    
        echo $menu_list;
      }
      @endphp
    </div>
  </div>
</nav>
