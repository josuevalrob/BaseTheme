<?php 
function registrar_sidebarRight(){
  register_sidebar(array(
   'name' => 'Sidebar Derecho',
   'id' => 'sidebar-right',
   'description' => 'Sidebar para situar los Widgets de la derecha',
   'class' => 'sidebar',
   'before_widget' => '<div id="%1$s" class="widget %2$s">',
   'after_widget' => '</div>',
   'before_title' => '<h2 class="widget-title">',
   'after_title' => '</h2>',
  ));
}
add_action( 'widgets_init', 'registrar_sidebarRight');
?>