<?php 
function registrar_sidebarLeft(){
  register_sidebar(array(
   'name' => 'Sidebar Izquierdo',
   'id' => 'sidebar-left',
   'description' => 'Sidebar para situar los Widgets de la izquierda',
   'class' => 'sidebar',
   'before_widget' => '<div id="%1$s" class="widget %2$s">',
   'after_widget' => '</div>',
   'before_title' => '<h2 class="widget-title">',
   'after_title' => '</h2>',
  ));
}
add_action( 'widgets_init', 'registrar_sidebarLeft');
?>