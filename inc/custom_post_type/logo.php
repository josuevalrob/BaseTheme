<?php
/*****Post personalizados tipo logo****/
add_action( 'init', 'my_custom_logos' );/*Función para iniciar el tipo de entrada*/
/*Etiquetas visibles de la entrada*/
function my_custom_logos() {
	$labels = array(
	'name' => _x( 'Logos', 'post type general name' ),
        'singular_name' => _x( 'Logo', 'post type singular name' ),
        'add_new' => _x( 'Añadir Nuevo', 'book' ),
        'add_new_item' => __( 'Añadir Nuevo Logo' ),
        'edit_item' => __( 'Editar Logo' ),
        'new_item' => __( 'Nuevo Logo' ),
        'view_item' => __( 'Ver Logo' ),
        'search_items' => __( 'Buscar Logos' ),
        'not_found' =>  __( 'No se han encontrado Logos' ),
        'not_found_in_trash' => __( 'No se han encontrado Logos en la papelera' ),
        'parent_item_colon' => ''
    );
	/*Características de la entrada*/
    $args = array( 'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,		
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 10, /*La posición se edita en el functions.php en la función my_move_post*/
		'menu_icon' => 'dashicons-format-image', /*Icono que se mostrará en el menú de WordPress*/
		/*Tipo de características de WordPress habilitadas incluye title, editor, thumbnail, excerpt, author, comments*/
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt'),
		/*Tipo de taxonomías habilitadas, incluye category, tag y taxonomías personalizadas*/
		'taxonomies' => array( 'sectores', 'category' ),
    ); 
    register_post_type( 'logo', $args ); /*Nombre con el que registramos tipo de entrada*/
}
?>