<?php
/*Shortcode botones*/
function botones_shortcode() {  
	/*Entrada actual*/
	global $post;
	/*ID de la entrada actual*/
	$post_id = $post->ID;
	/*Obtenemos las categorías de la entrada*/
	$catcols = get_the_category($post_id);
	/*Recorremos las categorías*/
    foreach ($catcols as $catcol) {
        $term_id = $catcol->cat_ID;
    }
	$salida = "";
	/*Obtenemos los hijos de la categoría de la entrada*/
	$botones = get_term_children( $term_id, 'category' );
	/*Recorremos las categorías hijo*/
	foreach ($botones as $boton) {
		/*Nombre de la categoría*/
        $cat_name = get_cat_name( $boton );
		/*Enlace de la categoría*/
		$cat_link = get_category_link( $boton );
		/*Devolvemos HTML con cada botón*/
		$salida .= '<div class="falsoboton"><a href="'.$cat_link.'">'.__("[:es]Ir a[:en]Go to[:fr]Aller à[:pt]Ir para").' '.$cat_name.'</a></div>';
    }
	return $salida;
}
add_shortcode('botones', 'botones_shortcode');
?>