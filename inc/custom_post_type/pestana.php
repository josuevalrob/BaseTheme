<?php
/*Cargamos configuración general del tema*/
$value = get_option('type_config');
/*Comprobamos si el tema tiene una navegación por pestañas*/
if ($value['theme'] == 'tabNavigation') {
	/*****Post personalizados tipo pestana****/
	/*Este tipo de entradas es necesario para que funcione el tema por pestañas*/
	add_action( 'init', 'my_custom_pestana' );/*Función para iniciar el tipo de entrada*/
	/*Etiquetas visibles de la entrada*/
	function my_custom_pestana() {
		$labels = array(
		'name' => _x( 'Pestañas', 'post type general name' ),
			'singular_name' => _x( 'Pestaña', 'post type singular name' ),
			'add_new' => _x( 'Añadir Nueva', 'book' ),
			'add_new_item' => __( 'Añadir Nueva Pestaña' ),
			'edit_item' => __( 'Editar Pestaña' ),
			'new_item' => __( 'Nueva Pestaña' ),
			'view_item' => __( 'Ver Pestaña' ),
			'search_items' => __( 'Buscar Pestañas' ),
			'not_found' =>  __( 'No se han encontrado Pestañas' ),
			'not_found_in_trash' => __( 'No se han encontrado Pestañas en la papelera' ),
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
			'menu_position' => 5, /*La posición se edita en el functions.php en la función my_move_post*/
			'menu_icon' => 'dashicons-editor-kitchensink', /*Icono que se mostrará en el menú de WordPress*/
			/*Tipo de características de WordPress habilitadas incluye title, editor, thumbnail, excerpt, author, comments*/
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', ),
			/*Tipo de taxonomías habilitadas, incluye category, tag y taxonomías personalizadas*/
			'taxonomies' => array( 'category' ),
		);
		register_post_type( 'pestana', $args ); /*Nombre con el que registramos tipo de entrada*/
	}
}
?>
<?php
/*******************Orden en el que se muestran las pestañas*********************/
function pestana_orden_meta_box() {
	add_meta_box(
		'pestana_orden_meta_box', // $id
		'Orden', // Título visible
		'show_pestana_orden_meta_box', // $callback
		'pestana', // nombe del custom post type
		'side', // lugar en el que lo emplazamos
		'high' // prioridad
	);
}
add_action( 'add_meta_boxes', 'pestana_orden_meta_box' );/*Registramos caja donde irá el campo de entrada*/
function show_pestana_orden_meta_box() {
	global $post;  
	/*Función para registrar los metadatos*/
	$meta = get_post_meta( $post->ID, 'pestana_orden', true );
	?>
	<input type="hidden" name="your_pestana_orden_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
	<div>
		<label for="pestana_orden[pestana_orden]">Orden</label>
		<input type="text" name="pestana_orden[pestana_orden]" value="<?php if (isset($meta['pestana_orden'])){ echo $meta['pestana_orden']; } ?>">
	</div>
  <?php
}
/*Función para salvar los metadatos*/
function save_your_pestana_orden_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_pestana_orden_meta_box_nonce'], basename(__FILE__) ) ) {
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
	$old = get_post_meta( $post_id, 'pestana_orden', true );
	$new = $_POST['pestana_orden'];
	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'pestana_orden', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'pestana_orden', $old );
	}
}
add_action( 'save_post', 'save_your_pestana_orden_meta' );
?>