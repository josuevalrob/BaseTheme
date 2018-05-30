<?php
/*****Post personalizados tipo portada****/
/*Este tipo de entradas es necesario para mostrar entradas en la página principal*/
add_action( 'init', 'my_custom_portada' );/*Función para iniciar el tipo de entrada*/
/*Etiquetas visibles de la entrada*/
function my_custom_portada() {
	$labels = array(
	'name' => _x( 'Portadas', 'post type general name' ),
        'singular_name' => _x( 'Portada', 'post type singular name' ),
        'add_new' => _x( 'Añadir Nueva', 'book' ),
        'add_new_item' => __( 'Añadir Nueva Portada' ),
        'edit_item' => __( 'Editar Portada' ),
        'new_item' => __( 'Nueva Portada' ),
        'view_item' => __( 'Ver Portada' ),
        'search_items' => __( 'Buscar Portadas' ),
        'not_found' =>  __( 'No se han encontrado Portadas' ),
        'not_found_in_trash' => __( 'No se han encontrado Portadas en la papelera' ),
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
		'menu_icon' => 'dashicons-format-aside', /*Icono que se mostrará en el menú de WordPress*/
		/*Tipo de características de WordPress habilitadas incluye title, editor, thumbnail, excerpt, author, comments*/
        'supports' => array( 'title', 'editor', 'author', 'thumbnail' ),
		/*Tipo de taxonomías habilitadas, incluye category, tag y taxonomías personalizadas*/
		'taxonomies' => array( 'category' ),
    ); 
    register_post_type( 'portada', $args ); /*Nombre con el que registramos tipo de entrada*/
}
?>
<?php
/******Apariencia Portada*******/
function apariencia_portada_meta_box() {
    add_meta_box(
        'apariencia_portada_meta_box', // $id
        'Apariencia Portada', // Título visible
        'show_apariencia_portada_meta_box', // $callback
        'portada', // nombe del custom post type
        'side', // lugar en el que lo emplazamos
        'high' // prioridad
    );
}
add_action( 'add_meta_boxes', 'apariencia_portada_meta_box' ); /*Registramos caja donde irá el campo de entrada*/
function show_apariencia_portada_meta_box() {
    global $post;
	/*Función para registrar los metadatos*/
    $meta = get_post_meta( $post->ID, 'apariencia_portada', true );
	?>
    <input type="hidden" name="your_apariencia_portada_meta_box" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
	<div class="adminCheckbox">
		<div>
			<label for="apariencia_portada[title]">Mostrar título</label>
			<input type="radio" name="apariencia_portada[title]" value="mostrar" <?php if (isset($meta['title'])){if ( $meta['title'] == 'mostrar' ) echo "checked";} ?>>
		</div>
		<div>
			<label for="apariencia_portada[title]">Ocultar título</label>
			<input type="radio" name="apariencia_portada[title]" value="ocultar" 
				<?php if (isset($meta['title'])){if ( $meta['title'] == 'ocultar' ) echo "checked";} ?>>
		</div>
	</div>
	<div class="adminCheckbox">
		<div>
			<label for="apariencia_portada[back]">Activar imagen destacada como fondo</label>
			<input type="checkbox" name="apariencia_portada[back]" value="active" <?php if (isset($meta['back'])){if ( $meta['back'] == 'active' ) echo "checked";} ?>>
		</div> 
		<div>
			<label for="apariencia_portada[back]">Parallax Imagen de fondo</label>
			<input type="checkbox" name="apariencia_portada[parallax]" value="active" <?php if (isset($meta['parallax'])){if ( $meta['parallax'] == 'active' ) echo "checked";} ?>>
		</div>            
	</div>
	<?php
}
/*Función para salvar los metadatos*/
function save_your_apariencia_portada_fields_meta( $post_id ) {   
    // verify nonce
    if ( !wp_verify_nonce( $_POST['your_apariencia_portada_meta_box'], basename(__FILE__) ) ) {
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
    $old = get_post_meta( $post_id, 'apariencia_portada', true );
    $new = $_POST['apariencia_portada'];
    if ( $new && $new !== $old ) {
        update_post_meta( $post_id, 'apariencia_portada', $new );
    } elseif ( '' === $new && $old ) {
        delete_post_meta( $post_id, 'apariencia_portada', $old );
    }
}
add_action( 'save_post', 'save_your_apariencia_portada_fields_meta' );
?>