<?php
/*******************Animaciones de entrada para los posts*********************/
function general_animacion_meta_box() {
	add_meta_box(
		'general_animacion_meta_box', // $id
		'Animación', // Título visible
		'show_general_animacion_meta_box', // $callback
		array('pestana', 'portada', 'page', 'post', 'date', 'logo'), // nombe del custom post type
		'side', // lugar en el que lo emplazamos
		'high' // prioridad
	);
}
add_action( 'add_meta_boxes', 'general_animacion_meta_box' );/*Registramos caja donde irá el campo de entrada*/
function show_general_animacion_meta_box() {
	global $post;  
	/*Función para registrar los metadatos*/
	$meta = get_post_meta( $post->ID, 'general_animacion', true );
	?>
	<input type="hidden" name="your_general_animacion_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
	<div>
		<label for="general_animacion[animacion]">Animación</label>
		<select class="large-text" name="general_animacion[animacion]">
			<option value="fade" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'fade')){ echo 'selected'; } ?>>Desvanecerse</option>
			<option value="fade-up" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'fade-up')){ echo 'selected'; } ?>>Desvanecerse hacia Arriba</option>
			<option value="fade-down" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'fade-down')){ echo 'selected'; } ?>>Desvanecerse hacia Abajo</option>
			<option value="fade-right" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'fade-right')){ echo 'selected'; } ?>>Desvanecerse hacia la Derecha</option>
			<option value="fade-left" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'fade-left')){ echo 'selected'; } ?>>Desvanecerse hacia la Izquierda</option>			
			<option value="fade-up-right" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'fade-up-right')){ echo 'selected'; } ?>>Desvanecerse hacia Arriba a la Derecha</option>
			<option value="fade-up-left" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'fade-up-left')){ echo 'selected'; } ?>>Desvanecerse hacia Arriba a la Izquierda</option>
			<option value="fade-down-right" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'fade-down-right')){ echo 'selected'; } ?>>Desvanecerse hacia Abajo a la Derecha</option>
			<option value="fade-down-left" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'fade-down-left')){ echo 'selected'; } ?>>Desvanecerse hacia Abajo la Izquierda</option>
			<option value="flip-up" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'flip-up')){ echo 'selected'; } ?>>Voltearse hacia Arriba</option>
			<option value="flip-down" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'flip-down')){ echo 'selected'; } ?>>Voltearse hacia Abajo</option>
			<option value="flip-right" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'flip-right')){ echo 'selected'; } ?>>Voltearse hacia la Derecha</option>
			<option value="flip-left" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'flip-left')){ echo 'selected'; } ?>>Voltearse hacia la Izquierda</option>
			<option value="slide-up" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'slide-up')){ echo 'selected'; } ?>>Deslizarse hacia Arriba</option>
			<option value="slide-down" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'slide-down')){ echo 'selected'; } ?>>Deslizarse hacia Abajo</option>
			<option value="slide-right" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'slide-right')){ echo 'selected'; } ?>>Deslizarse hacia la Derecha</option>
			<option value="slide-left" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'slide-left')){ echo 'selected'; } ?>>Deslizarse hacia la Izquierda</option>
			<option value="zoom-in" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'zoom-in')){ echo 'selected'; } ?>>Acercarse</option>
			<option value="zoom-in-up" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'zoom-in-up')){ echo 'selected'; } ?>>Acercarse hacia Arriba</option>
			<option value="zoom-in-down" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'zoom-in-down')){ echo 'selected'; } ?>>Acercarse hacia Abajo</option>
			<option value="zoom-in-right" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'zoom-in-right')){ echo 'selected'; } ?>>Acercarse hacia la Derecha</option>
			<option value="zoom-in-left" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'zoom-in-left')){ echo 'selected'; } ?>>Acercarse hacia la Izquierda</option>
			<option value="zoom-out" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'zoom-in')){ echo 'selected'; } ?>>Alejarse</option>
			<option value="zoom-out-up" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'zoom-in-up')){ echo 'selected'; } ?>>Alejarse hacia Arriba</option>
			<option value="zoom-out-down" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'zoom-in-down')){ echo 'selected'; } ?>>Alejarse hacia Abajo</option>
			<option value="zoom-out-right" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'zoom-in-right')){ echo 'selected'; } ?>>Alejarse hacia la Derecha</option>
			<option value="zoom-out-left" <?php if (isset($meta['animacion']) && ($meta['animacion'] == 'zoom-in-left')){ echo 'selected'; } ?>>Alejarse hacia la Izquierda</option>
		</select>
	</div>
	<div>
		<label for="general_animacion[anchor-placement]">Posición del Ancla</label>
		<select class="large-text" name="general_animacion[anchor-placement]">
			<option value="top-bottom" <?php if (isset($meta['anchor-placement']) && ($meta['anchor-placement'] == 'top-bottom')){ echo 'selected'; } ?>>Arriba Elemento - Abajo Ventana</option>
			<option value="top-center" <?php if (isset($meta['anchor-placement']) && ($meta['anchor-placement'] == 'top-center')){ echo 'selected'; } ?>>Arriba Elemento - Centro Ventana</option>
			<option value="top-top" <?php if (isset($meta['anchor-placement']) && ($meta['anchor-placement'] == 'top-top')){ echo 'selected'; } ?>>Arriba Elemento - Arriba Ventana</option>
			<option value="center-bottom" <?php if (isset($meta['anchor-placement']) && ($meta['anchor-placement'] == 'center-bottom')){ echo 'selected'; } ?>>Centro Elemento - Abajo Ventana</option>
			<option value="center-center" <?php if (isset($meta['anchor-placement']) && ($meta['anchor-placement'] == 'center-center')){ echo 'selected'; } ?>>Centro Elemento - Centro Ventana</option>
			<option value="center-top" <?php if (isset($meta['anchor-placement']) && ($meta['anchor-placement'] == 'center-top')){ echo 'selected'; } ?>>Centro Elemento - Arriba Ventana</option>
			<option value="bottom-bottom" <?php if (isset($meta['anchor-placement']) && ($meta['anchor-placement'] == 'bottom-bottom')){ echo 'selected'; } ?>>Abajo Elemento - Abajo Ventana</option>
			<option value="bottom-center" <?php if (isset($meta['anchor-placement']) && ($meta['anchor-placement'] == 'bottom-center')){ echo 'selected'; } ?>>Abajo Elemento - Centro Ventana</option>
			<option value="bottom-top" <?php if (isset($meta['anchor-placement']) && ($meta['anchor-placement'] == 'bottom-top')){ echo 'selected'; } ?>>Abajo Elemento - Arriba Ventana</option>
		</select>
	</div>
	<div>
		<label for="general_animacion[easing]">Aceleración de la Animación</label>
		<select class="large-text" name="general_animacion[easing]">
			<option value="linear" <?php if (isset($meta['easing']) && ($meta['easing'] == 'linear')){ echo 'selected'; } ?>>Linear</option>
			<option value="ease" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease')){ echo 'selected'; } ?>>Ease</option>
			<option value="ease-in" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-in')){ echo 'selected'; } ?>>Ease In</option>
			<option value="ease-out" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-out')){ echo 'selected'; } ?>>Ease Out</option>
			<option value="ease-in-out" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-in-out')){ echo 'selected'; } ?>>Ease In Out</option>
			<option value="ease-in-back" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-in-back')){ echo 'selected'; } ?>>Ease In Back</option>
			<option value="ease-out-back" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-out-back')){ echo 'selected'; } ?>>Ease Out Back</option>
			<option value="ease-in-out-back" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-in-out-back')){ echo 'selected'; } ?>>Ease In Out Back</option>
			<option value="ease-in-sine" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-in-sine')){ echo 'selected'; } ?>>Ease In Sine</option>
			<option value="ease-out-sine" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-out-sine')){ echo 'selected'; } ?>>Ease Out Sine</option>
			<option value="ease-in-out-sine" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-in-out-sine')){ echo 'selected'; } ?>>Ease In Out Sine</option>
			<option value="ease-in-quad" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-in-quad')){ echo 'selected'; } ?>>Ease In Quad</option>
			<option value="ease-out-quad" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-out-quad')){ echo 'selected'; } ?>>Ease Out Quad</option>
			<option value="ease-in-out-quad" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-in-out-quad')){ echo 'selected'; } ?>>Ease In Out Quad</option>
			<option value="ease-in-cubic" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-in-cubic')){ echo 'selected'; } ?>>Ease In Cubic</option>
			<option value="ease-out-cubic" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-out-cubic')){ echo 'selected'; } ?>>Ease Out Cubic</option>
			<option value="ease-in-out-cubic" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-in-out-cubic')){ echo 'selected'; } ?>>Ease In Out Cubic</option>
			<option value="ease-in-quart" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-in-quart')){ echo 'selected'; } ?>>Ease In Quart</option>
			<option value="ease-out-quart" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-out-quart')){ echo 'selected'; } ?>>Ease Out Quart</option>
			<option value="ease-in-out-quart" <?php if (isset($meta['easing']) && ($meta['easing'] == 'ease-in-out-quart')){ echo 'selected'; } ?>>Ease In Out Quart</option>
		</select>
	</div>
	<div>
		<label for="general_animacion[duracion]">Duración en milisegundos</label>
		<input class="large-text" type="number" name="general_animacion[duracion]" value="<?php if (isset($meta['duracion'])){ echo $meta['duracion']; } ?>">
	</div>
  <?php
}
/*Función para salvar los metadatos*/
function save_your_general_animacion_meta( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_general_animacion_meta_box_nonce'], basename(__FILE__) ) ) {
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
	$old = get_post_meta( $post_id, 'general_animacion', true );
	$new = $_POST['general_animacion'];
	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'general_animacion', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'general_animacion', $old );
	}
}
add_action( 'save_post', 'save_your_general_animacion_meta' );
?>