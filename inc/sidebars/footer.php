<?php 
function registrar_footer(){
  register_sidebar(array(
   'name' => 'Pie de Página',
   'id' => 'sidebar-footer',
   'description' => 'Sidebar para situar los Widgets del pie de página',
   'class' => 'sidebar footer',
   'before_widget' => '<div id="%1$s" class="widget %2$s">',
   'after_widget' => '</div>',
   'before_title' => '<h2 class="widget-title">',
   'after_title' => '</h2>',
  ));
}
add_action( 'widgets_init', 'registrar_footer');
?>