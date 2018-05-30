<?php
/*Shortcode Botón Ver Más*/
function ver_mas_shortcode($atts) {
	/*Cargamos variable post actual*/
	global $post;
	/*Obtenemos el ID del post*/
	$current_post_id = $post->ID;
	/*Obtenemos la categoría del post*/
   	$category_id = get_the_category($current_post_id);
	/*URL de la categoría*/
   	$url = get_category_link( $category_id[0] );
	/*Devolvemos HTML con el enlace a la categoría*/
   	$salida = '<a class="vermas falsoboton" href="'.$url.'"><span>'.__("[:es]Ver Más[:en]See More[:fr]Voir Plus[:pt]Ver Mais").'</span></a>';
	return $salida;
}
add_shortcode('ver-mas', 'ver_mas_shortcode');
?>