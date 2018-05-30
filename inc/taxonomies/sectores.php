<?php
add_action( 'init', 'create_topics_hierarchical_taxonomy', 0 );
 
//create a custom taxonomy name it topics for your posts
function create_topics_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $labels = array(
    'name' => _x( 'Sectores', 'taxonomy general name' ),
    'singular_name' => _x( 'Sector', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Sectores' ),
    'all_items' => __( 'Todos los Sectores' ),
    'parent_item' => __( 'Sector Padre' ),
    'parent_item_colon' => __( 'Sector Padre:' ),
    'edit_item' => __( 'Editar Sector' ), 
    'update_item' => __( 'Actualizar Sector' ),
    'add_new_item' => __( 'Añadir Nuevo Sector' ),
    'new_item_name' => __( 'Nuevo Sector' ),
    'menu_name' => __( 'Sectores' ),
  );    
 
// Now register the taxonomy
 
  register_taxonomy('sectores', array('logos, proyecto, diapositiva'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'sectores' ),
  ));
 
}
?>