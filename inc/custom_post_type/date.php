<?php
/*****Post personalizados tipo date****/
/*Este tipo de entradas es necesario para que funcione el shortcode timeline*/
add_action( 'init', 'my_custom_date' );/*Función para iniciar el tipo de entrada*/
function my_custom_date() {
	/*Etiquetas visibles de la entrada*/
	$labels = array(
		'name' => _x( 'Fecha', 'post type general name' ),
        'singular_name' => _x( 'Fecha', 'post type singular name' ),
        'add_new' => _x( 'Añadir Nuevo', 'book' ),
        'add_new_item' => __( 'Añadir Nueva Fecha' ),
        'edit_item' => __( 'Editar Fecha' ),
        'new_item' => __( 'Nueva Fecha' ),
        'view_item' => __( 'Ver Fecha' ),
        'search_items' => __( 'Buscar Fechas' ),
        'not_found' =>  __( 'No se han encontrado Fechas' ),
        'not_found_in_trash' => __( 'No se han encontrado Fechas en la papelera' ),
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
		'menu_icon' => 'dashicons-calendar',  /*Icono que se mostrará en el menú de WordPress*/
		/*Tipo de características de WordPress habilitadas incluye title, editor, thumbnail, excerpt, author, comments*/
        'supports' => array( 'title', 'thumbnail', 'excerpt'),				  
		/*Tipo de taxonomías habilitadas, incluye category, tag y taxonomías personalizadas*/
		'taxonomies' => array('category'),
    ); 
    register_post_type( 'date', $args ); /*Nombre con el que registramos tipo de entrada*/
}
?>
<?php 
/******Año*******/
/*Agregamos una entrada de número para el año que ordenará el timeline*/
function year_date_meta_box() {
	add_meta_box(
		'year_date_meta_box', // $id
		'Año', // Título visible
		'show_year_date_meta_box', // $callback
		'date', // nombe del custom post type
		'side', // lugar en el que lo emplazamos
		'high' // prioridad
	);
}
add_action( 'add_meta_boxes', 'year_date_meta_box' );/*Registramos caja donde irá el campo de entrada*/
function show_year_date_meta_box() {
	global $post;  
	/*Función para registrar los metadatos*/
	$meta = get_post_meta( $post->ID, 'year_date', true );
	?>
	<input type="hidden" name="your_year_date_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
	<div>
		<label for="year_date[year]">Año</label>
		<input class="large-text" type="number" name="year_date[year]" value="<?php if (isset($meta['year'])){ echo $meta['year']; } ?>">
	</div>
  <?php
}
/*Función para salvar los metadatos*/
function save_your_year_date_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_year_date_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	/*Comprobamos el salvado automático*/
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	/*Comprobamos los permisos de edición*/
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}	
	/*Comprobamos valores antiguos y actuales y actualizamos si es necesario*/
	$old = get_post_meta( $post_id, 'year_date', true );
	$new = $_POST['year_date'];
	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'year_date', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'year_date', $old );
	}
}
add_action( 'save_post', 'save_your_year_date_meta' );
?>