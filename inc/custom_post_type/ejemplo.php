<?php
/*****Post personalizados tipo ejemplos****/

add_action( 'init', 'my_custom_ejemplos' );

function my_custom_ejemplos() {
	$labels = array(
	'name' => _x( 'Ejemplos', 'post type general name' ),
        'singular_name' => _x( 'Ejemplo', 'post type singular name' ),
        'add_new' => _x( 'Añadir Nuevo', 'book' ),
        'add_new_item' => __( 'Añadir Nuevo Ejemplo' ),
        'edit_item' => __( 'Editar Ejemplo' ),
        'new_item' => __( 'Nuevo Ejemplo' ),
        'view_item' => __( 'Ver Ejemplo' ),
        'search_items' => __( 'Buscar Ejemplos' ),
        'not_found' =>  __( 'No se han encontrado Ejemplos' ),
        'not_found_in_trash' => __( 'No se han encontrado Ejemplos en la papelera' ),
        'parent_item_colon' => ''
    );

    $args = array( 'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,		
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 10,
		'menu_icon' => 'dashicons-products',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		'taxonomies' => array( 'sectores', 'category' ),
    );
 
   // register_post_type( 'ejemplo', $args ); /* Registramos y a funcionar */
}
?>

<?php
/*******************Imagen Única / Logo*********************/

function logo_ejemplo_meta_box() {
	add_meta_box(
		'logo_ejemplo_meta_box', // $id
		'Logo de la Ejemplo', // $title
		'show_logo_ejemplo_meta_box', // $callback
		'ejemplo', // $screen
		'side', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'logo_ejemplo_meta_box' );
function show_logo_ejemplo_meta_box() {
	global $post;  
	$meta = get_post_meta( $post->ID, 'logo_ejemplo', true );

?>
	<input type="hidden" name="your_logo_ejemplo_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
	<div class="adminLogo">
		<div id="image-preview-logo" class="image-preview">
			<img src="<?php if(isset($meta['logo'])){ echo $meta['logo'];} ?>" style="max-width: 250px;">
		</div>
		<div style="text-align:center;">
			<input type="hidden" name="logo_ejemplo[logo]" id="logo_ejemplo-logo" class="meta-image" value="<?php if(isset($meta['logo'])){ echo $meta['logo'];} ?>">
			<input type="button" id="image-upload-logo" class="button button-primary button-large image-upload" value="Buscar">
			<input type="button" class="borrar-logo button button-large" value="Borrar">
		</div>		
	</div>
	<script>
		jQuery('.borrar-logo').click(function(){
			jQuery('#logo_ejemplo-logo').attr('value', '');
			jQuery('#image-preview-logo').children('img').attr('src', '');
		});
	</script>
  <?php }
function save_your_logo_ejemplo_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_logo_ejemplo_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}
	
	$old = get_post_meta( $post_id, 'logo_ejemplo', true );
	$new = $_POST['ejemplo'];
	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'logo_ejemplo', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'logo_ejemplo', $old );
	}
}
add_action( 'save_post', 'save_your_logo_ejemplo_meta' );?>



<?php
/*******************Checkbox*********************/

function checkbox_ejemplo_meta_box() {
	add_meta_box(
		'checkbox_ejemplo_meta_box', // $id
		'Checkboxes del Ejemplo', // $title
		'show_checkbox_ejemplo_meta_box', // $callback
		'ejemplo', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'checkbox_ejemplo_meta_box' );
function show_checkbox_ejemplo_meta_box() {
	global $post;  
		$meta = get_post_meta( $post->ID, 'checkbox_ejemplo', true ); ?>

	<input type="hidden" name="your_checkbox_ejemplo_meta_box" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
		<div class="adminCheckbox">
			<div>
				<label for="checkbox_ejemplo[analiticas]"><i class="dimaticon line-graphic"></i>Analíticas</label>
				<input type="checkbox" name="checkbox_ejemplo[analiticas]" value="<i class=&quot;dimaticon line-graphic&quot;></i><?php echo __("[:es]Analíticas[:en]Analytics[:fr]Analytics[:pt]Analítica")?>"  <?php if (isset($meta['analiticas'])){if ( $meta['analiticas'] != "" ) echo "checked";} ?>>
			</div>
		</div>
  

  <?php }
function save_your_checkbox_ejemplo_fields_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_checkbox_ejemplo_meta_box'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}
	
	$old = get_post_meta( $post_id, 'checkbox_ejemplo', true );
	$new = $_POST['checkbox_ejemplo'];
	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'checkbox_ejemplo', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'checkbox_ejemplo', $old );
	}
}

add_action( 'save_post', 'save_your_checkbox_ejemplo_fields_meta' );
?>

<?php
/***************************Galería****************************/
function galeria_ejemplo_meta_box() {
	add_meta_box(
		'galeria_ejemplo_meta_box', // $id
		'Galería del Ejemplo', // $title
		'show_galeria_ejemplo_meta_box', // $callback
		'ejemplo', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'galeria_ejemplo_meta_box' );
function show_galeria_ejemplo_meta_box() {
	global $post;  
		$meta = get_post_meta( $post->ID, 'galeria_ejemplo', true ); ?>
	<input type="hidden" name="your_galeria_ejemplo_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
	<div class="galeriaImagenes">	
		<div>
			<div>
				<label for="galeria_ejemplo[galeria-1]">Subir imagen de galería</label><br>
				<input type="text" name="galeria_ejemplo[galeria-1]" id="galeria_ejemplo-1" class="meta-image regular-text " value="<?php  if (isset($meta['galeria-1'])){echo $meta['galeria-1'];} ?>">
				<input type="button" id="image-upload-1" class="button button-primary button-large image-upload" value="Buscar">
				<button type="button" class="button button-large menosGaleria" id="menosGaleria-1">Borrar Imagen</button>
			</div>
			<div id="image-preview-1" class="image-preview">
				<img src="<?php if (isset($meta['galeria-1'])){ echo $meta['galeria-1'];} ?>" style="max-width: 250px;">
			</div>
		</div>
		
		<?php 
		$n = 1;
		while ($n != 0) {
			$n = $n + 1;
			if (isset($meta['galeria-'.$n])){
				?>
				<div>
					<div>
						<label for="galeria_ejemplo[galeria-<?php echo $n ?>]">Subir imagen de galería</label><br>
						<input type="text" name="galeria_ejemplo[galeria-<?php echo $n ?>]" id="galeria_ejemplo-<?php echo $n ?>" class="meta-image regular-text" value="<?php echo $meta['galeria-'.$n]; ?>">
						<input type="button" id="image-upload-<?php echo $n ?>" class="button button-primary button-large image-upload" value="Buscar">
						<button type="button" class="button button-large menosGaleria" id="menosGaleria-<?php echo $n ?>">Borrar Imagen</button>
					</div>
					<div id="image-preview-<?php echo $n ?>" class="image-preview">
						<img src="<?php echo $meta['galeria-'.$n]; ?>" style="max-width: 250px;">
					</div>
				</div>
							
				<?php
			} else {
				$r = $n - 1;
				$n = 0;
			}
		}?>
		</div>
		<button type="button" class="button masGaleria" id="masGaleria-<?php echo $r ?>">Añadir Otra Imagen</button>	
		<script>
		jQuery('.masGaleria').bind( "click", function() {			
			var id = jQuery(this).attr('id');
			var num = id.split("-");
			var count = num[1];
			count++;			
			jQuery(this).attr("id", "masgaleria-"+count)
			var string = '<div><div><label for="galeria_ejemplo[galeria-'+ count +']">Subir imagen de galería</label><br><input type="text" id="galeria_ejemplo-'+ count +'" name="galeria_ejemplo[galeria-'+ count +']" class="meta-image regular-text" value=""><input type="button" id="image-upload-'+ count +'" class="button button-primary button-large image-upload" value="Buscar"><button type="button" class="button button-large menosGaleria" id="menosGaleria-'+ count +'">Borrar Imagen</button></div><div id="image-preview-'+ count +'" class="image-preview"><img src="" style="max-width: 250px;"></div></div>';
			jQuery(".galeriaImagenes").append(string);
		});
		</script>
		<script>
		jQuery(document).on('click', '.menosGaleria', function() {		
			var id = jQuery(this).attr('id');
			var num = id.split("-");
			var count = num[1];
			var sumcount = ++count;
			count--;
			jQuery(this).parent().parent().remove();
			jQuery('.meta-image').each(function(){
				var id = jQuery(this).attr('id');
				var num = id.split("-");
				var actualcount = num[1];
				if(actualcount == sumcount){
					jQuery(this).attr('id', 'galeria_ejemplo-'+count);
					jQuery(this).attr('name', 'galeria_ejemplo[galeria-'+count+']');
					jQuery(this).parent().children('label').attr('for', 'galeria_ejemplo[galeria-'+count+']');
					jQuery(this).parent().children('.image-upload').attr('id', 'image-upload-'+count);
					jQuery(this).parent().children('.menosGaleria').attr('id', 'menosGaleria-'+count);
					jQuery(this).parent().parent().children('.image-preview').attr('id', 'image-preview-'+count);
					sumcount++;
					count++;
				}
			});
		});
		</script>
		<script>
		jQuery(document).ready(function () {
			jQuery(document).on('click', '.image-upload', function () {
				var meta_image_frame;
				var meta_image_id = jQuery(this).attr('id');				
				var meta_num = meta_image_id.split("-");
				var meta_count = meta_num[2];
				var meta_image_preview  = jQuery('#image-preview-'+ meta_count);
				var meta_image = jQuery('#galeria_ejemplo-'+ meta_count);
				if (meta_image_frame) {
					meta_image_frame.open();
					return;
				}
				meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
					title: meta_image.title,
					button: {
						text: meta_image.button
					}
				});
				meta_image_frame.on('select', function () {
					var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
					meta_image.val(media_attachment.url);
					meta_image_preview.children('img').attr('src', media_attachment.url);
				});
				meta_image_frame.open();
			});
		});
		</script>
		<script>
		var error = true;
		jQuery('#publish').click(function(e) {
			if (error == true){
				e.preventDefault();
			} else {
				return true;
			}
			jQuery('.galeriaImagenes .meta-image').each(function(){
				var value = jQuery(this).attr('value');
				if(value == undefined || value == ""){
					alert('Los valores de imagen de la galería no pueden estar vacíos');
					error = true;
					return false;
				} else {
					error = false;
				}
			});
			if (error == true){
				return false;
			} else {
				jQuery(this).click();
			}
		});
		</script>
  <?php }
function save_your_galeria_ejemplo_fields_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_galeria_ejemplo_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}
	
	$old = get_post_meta( $post_id, 'galeria_ejemplo', true );
	$new = $_POST['galeria_ejemplo'];
	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'galeria_ejemplo', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'galeria_ejemplo', $old );
	}
}
add_action( 'save_post', 'save_your_galeria_ejemplo_fields_meta' );?>
<?php 
/******Color Picker*******/
function color_ejemplo_meta_box() {
	add_meta_box(
		'color_ejemplo_meta_box', // $id
		'Colores', // $title
		'show_color_ejemplo_meta_box', // $callback
		'ejemplo', // $screen
		'side', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'color_ejemplo_meta_box' );
function show_color_ejemplo_meta_box() {
	global $post;  
	$meta = get_post_meta( $post->ID, 'color_ejemplo', true );

?>
	<input type="hidden" name="your_color_ejemplo_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
	<div>
		<label for="color_ejemplo[background]">Color de Fondo</label>
		<input class="large-text" type="color" name="color_ejemplo[background]" value="<?php if (isset($meta['background'])){ echo $meta['background']; } ?>">
	</div>
  <?php }
function save_your_color_ejemplo_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_color_ejemplo_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}
	
	$old = get_post_meta( $post_id, 'color_ejemplo', true );
	$new = $_POST['color_ejemplo'];
	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'color_ejemplo', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'color_ejemplo', $old );
	}
}
add_action( 'save_post', 'save_your_color_ejemplo_meta' );
?>
<?php 
/******Combobox*******/
function ejemplo_combobox_meta_box() {
	add_meta_box(
		'ejemplo_combobox_meta_box', // $id
		'Combobox', // $title
		'show_ejemplo_combobox_meta_box', // $callback
		'ejemplo', // $screen
		'side', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'ejemplo_combobox_meta_box' );
function show_ejemplo_combobox_meta_box() {
	global $post;  
	$meta = get_post_meta( $post->ID, 'ejemplo_combobox', true );

?>
	<input type="hidden" name="your_ejemplo_combobox_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
	<div>
		<label for="ejemplo_combobox[combobox]">Combobox</label>		
		<select class="large-text" name="ejemplo_combobox[combobox]">
		<!--Repetir Option con los diferentes valores-->
			<option value="value_ejemplo" <?php if (isset($meta['combobox']) && ($meta['combobox'] == 'value_ejemplo')){ echo 'selected'; } ?>>Value Ejemplo</option>
		</select>
	</div>
  <?php }
function save_your_ejemplo_combobox_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_ejemplo_combobox_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}
	
	$old = get_post_meta( $post_id, 'ejemplo_combobox', true );
	$new = $_POST['ejemplo_combobox'];
	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'ejemplo_combobox', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'ejemplo_combobox', $old );
	}
}
add_action( 'save_post', 'save_your_ejemplo_combobox_meta' );
?>
