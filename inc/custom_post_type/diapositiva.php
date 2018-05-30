<?php
/*****Post personalizados tipo diapositiva****/
/*Este tipo de entradas es necesario para que funcionen los sliders*/
add_action( 'init', 'my_custom_init' );/*Función para iniciar el tipo de entrada*/
/*Etiquetas visibles de la entrada*/
function my_custom_init() {
	$labels = array(
	'name' => _x( 'Slider', 'post type general name' ),
        'singular_name' => _x( 'Diapositiva Slider', 'post type singular name' ),
        'add_new' => _x( 'Añadir Nueva', 'book' ),
        'add_new_item' => __( 'Añadir Nueva Diapositiva' ),
        'edit_item' => __( 'Editar Diapositiva' ),
        'new_item' => __( 'Nueva Diapositiva' ),
        'view_item' => __( 'Ver Diapositiva' ),
        'search_items' => __( 'Buscar Diapositivas' ),
        'not_found' =>  __( 'No se han encontrado Diapositivas' ),
        'not_found_in_trash' => __( 'No se han encontrado Diapositivas en la papelera' ),
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
		'menu_icon' => 'dashicons-format-gallery',  /*Icono que se mostrará en el menú de WordPress*/
		/*Tipo de características de WordPress habilitadas incluye title, editor, thumbnail, excerpt, author, comments*/
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		/*Tipo de taxonomías habilitadas, incluye category, tag y taxonomías personalizadas*/
		'taxonomies' => array('category'),
    ); 
    register_post_type( 'diapositiva', $args ); /*Nombre con el que registramos tipo de entrada*/
}
?>
<?php 
/******Apariencia Diapositiva*******/
function diapositiva_config_meta_box() {
	add_meta_box(
		'diapositiva_config_meta_box', // $id
		'Apariencia de la diapositiva', // Título visible
		'show_diapositiva_config_meta_box', // $callback
		'diapositiva', // nombe del custom post type
		'side', // lugar en el que lo emplazamos
		'high' // prioridad
	);
}
add_action( 'add_meta_boxes', 'diapositiva_config_meta_box' );/*Registramos caja donde irá el campo de entrada*/
function show_diapositiva_config_meta_box() {
	global $post;  
	/*Función para registrar los metadatos*/
	$meta = get_post_meta( $post->ID, 'diapositiva_config', true );
	?>
	<input type="hidden" name="your_diapositiva_config_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
	<div>
		<label for="diapositiva_config[home]">Mostrar dispositiva en la página principal</label>
		<input name="diapositiva_config[home]" type="checkbox" value="activehome" <?php if (isset($meta['home']) && ($meta['home'] == 'activehome')){ echo 'checked'; } ?> />
	</div>
	<div>
		<label for="diapositiva_config[title]">Mostrar Título</label>
		<input name="diapositiva_config[title]" type="checkbox" value="active" <?php if (isset($meta['title']) && ($meta['title'] == 'active')){ echo 'checked'; } ?> />
	</div>
	<div>
		<label for="diapositiva_config[content]">Mostrar Contenido</label>
		<input name="diapositiva_config[content]" type="checkbox" value="active" <?php if (isset($meta['content']) && ($meta['content'] == 'active')){ echo 'checked'; } ?> />
	</div>
	<div>
		<label for="diapositiva_config[position]">Posición del Texto</label>
		<select class="large-text" name="diapositiva_config[position]">
			<option value="izquierda" <?php if (isset($meta['position']) && ($meta['position'] == 'izquierda')){ echo 'selected'; } ?>>Izquierda</option>
			<option value="derecha" <?php if (isset($meta['position']) && ($meta['position'] == 'derecha')){ echo 'selected'; } ?>>Derecha</option>
			<option value="arriba" <?php if (isset($meta['position']) && ($meta['position'] == 'arriba')){ echo 'selected'; } ?>>Arriba</option>
			<option value="abajo" <?php if (isset($meta['position']) && ($meta['position'] == 'abajo')){ echo 'selected'; } ?>>Abajo</option>			
			<option value="centro" <?php if (isset($meta['position']) && ($meta['position'] == 'centro')){ echo 'selected'; } ?>>Centro</option>
		</select>
	</div>
	<div>
		<label for="diapositiva_config[animation]">Animación del Texto</label>
		<select class="large-text" name="diapositiva_config[animation]">
			<option value="altura" <?php if (isset($meta['animation']) && ($meta['animation'] == 'altura')){ echo 'selected'; } ?>>Crecimiento Altura</option>
			<option value="anchura" <?php if (isset($meta['animation']) && ($meta['animation'] == 'anchura')){ echo 'selected'; } ?>>Crecimiento Anchura</option>
			<option value="fundido" <?php if (isset($meta['animation']) && ($meta['animation'] == 'fundido')){ echo 'selected'; } ?>>Fundido</option>
			<option value="desdearriba" <?php if (isset($meta['animation']) && ($meta['animation'] == 'desdearriba')){ echo 'selected'; } ?>>Desde Arriba</option>
			<option value="desdeabajo" <?php if (isset($meta['animation']) && ($meta['animation'] == 'desdeabajo')){ echo 'selected'; } ?>>Desde Abajo</option>
			<option value="desdederecha" <?php if (isset($meta['animation']) && ($meta['animation'] == 'desdederecha')){ echo 'selected'; } ?>>Desde Derecha</option>
			<option value="desdeizquierda" <?php if (isset($meta['animation']) && ($meta['animation'] == 'desdeizquierda')){ echo 'selected'; } ?>>Desde Izquierda</option>
		</select>
	</div>
  	<?php
}
/*Función para salvar los metadatos*/
function save_your_diapositiva_config_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_diapositiva_config_meta_box_nonce'], basename(__FILE__) ) ) {
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
	$old = get_post_meta( $post_id, 'diapositiva_config', true );
	$new = $_POST['diapositiva_config'];
	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'diapositiva_config', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'diapositiva_config', $old );
	}
}
add_action( 'save_post', 'save_your_diapositiva_config_meta' );
?>