<div class="sidebar-offcanvas  visible-xs visible-sm">
      <div class="offcanvas-inner panel panel-offcanvas">
              <div class="offcanvas-heading panel-heading clearfix">
                  <button data-toggle="offcanvas" class="btn btn-primary btn-xs pull-right" type="button"> <span class="fa fa-times"></span></button>
              </div>
              <div class="offcanvas-footer panel-footer">
                  <div id="offcanvas-search" class="input-group">
                    <?php get_search_form(); ?>
                  </div>
              </div> 
              <div class="offcanvas-body panel-body">
                       <?php if( dynamic_sidebar( 'offcanvas-left' ) ) : ?>
                            <?php dynamic_sidebar( 'offcanvas-left' ); ?>
                        <?php else : ?>
                      
                        <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
                            <?php
                            $args = array(  'theme_location' => 'mainmenu',
                                'container_class' => 'navbar-collapse',
                                'menu_class' => 'wpo-menu-top nav navbar-nav',
                                'fallback_cb' => '',
                                'menu_id' => 'main-menu-offcanvas',
                                'walker' => new Wpo_Megamenu_Offcanvas()
                            );
                            wp_nav_menu($args);
                            ?>
                        </nav>
                        <?php endif; ?>
              </div>
       </div> 
 </div> 
