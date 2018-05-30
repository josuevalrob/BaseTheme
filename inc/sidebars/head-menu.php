<?php 
function head_menu(){
  register_sidebar(array(
   'name' => 'Head Menu',
   'id' => 'head-menu',
   'description' => 'Sidebar para situar widgets del menú en el header de la página',
   'class' => 'sidebar head-menu',
   'before_widget' => '<div id="%1$s" class="widget %2$s">',
   'after_widget' => '</div>',
   'before_title' => '<h2 class="widget-title">',
   'after_title' => '</h2>',
  ));
}
add_action( 'widgets_init', 'head_menu');
?>