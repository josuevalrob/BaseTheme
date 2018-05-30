<?php
/*Shortcode TimeLine*/
function timeline_shortcode($atts) {
	global $post;
	/*Obtenemos la clase css*/
	$class = $atts["class"];
	/*Obtenemos la categoría a mostrar*/
	$category = get_category_by_slug($atts["category"]);
	/*Argumentos del loop*/
	$args5 = array(
				'cat' => $category->cat_ID,				
				'meta_key' => 'year_date',
				'orderby'   => 'meta_value',
				'order' => 'ASC',
				'posts_per_page'=> -1,
				'post_type' => array(
					'date'
				),
				
			);
	/*Devolvemos el script que activa el timeline*/
	$salida = 	'<script>
					jQuery(function(){
						jQuery().timelinr({
							arrowKeys: "true"
						})
					});
				</script>';
	
	/*Devolvemos la estructura HTML de los años*/
	$salida .= '<div id="timeline">
					<ul id="dates">';
	/*Cargamos el loop*/
	$the_query5 = new WP_Query($args5);
	/*Iniciamos el loop*/
	while ($the_query5->have_posts()):$the_query5->the_post();
		/*Obtenemos el año*/
		$meta = get_post_meta( $post->ID, 'year_date', true );
		/*Devolvemos el HTML que muestra cada año*/
		$salida .= '<li><a href="'.$meta['year'].'">'.$meta['year'].'</a></li>';
	endwhile;
	/*Devolvemos la estructura HTML del contenido*/
	$salida .= '</ul><ul id="issues">';
	/*Iniciamos el loop*/
	while ($the_query5->have_posts()):$the_query5->the_post();
		/*Obtenemos el año*/
		$meta = get_post_meta( $post->ID, 'year_date', true );
		/*Devolvemos el HTML que muestra el contenido de cada año*/
		$salida .= '<li id="'.$meta['year'].'">'.get_the_post_thumbnail().'
				<p>'.get_the_excerpt().'</p><a class="edit" href="'.get_edit_post_link().'">Editar fecha</a></li>';	
	endwhile;
	/*Devolvemos el HTML que cierra la estructura y añade el paginador con flechas*/
	$salida .= '</ul>
		<a href="#" id="next">+</a>
		<a href="#" id="prev">-</a>
				</div>';
	return $salida;
}
add_shortcode('timeline', 'timeline_shortcode');
?>