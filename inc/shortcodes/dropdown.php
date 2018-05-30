<?php 
/*Shortcode Desplegable*/
function dropdown_shortcode($atts) {
	/*Obtenemos tipo de post*/
	$post_type = $atts["type"];
	/*Obtenemos categoría*/
	$category = get_category_by_slug($atts["category"]);
	/*Obtenemos clase CSS*/
	$class = $atts["class"];
	/*Argumento del loop*/ 
	$args3 = array(
		'cat' => $category,
		'post_type' => array(
			$post_type,
		),
	);
	/*Entrada actual*/
	global $post;
	/*ID de la entrada actual*/
	$post_id = $post->ID;
	/*Slug de la entrada actual*/
	$post_name = $post->name;
	/*Devolvemos HTML que envuelve al dropdown*/
	$salida = '<div class="dropdownlist '.$class.'" id="nube'.$post_name.'">';
	/*Cargamos el loop*/
	$the_query3 = new WP_Query($args3);
	/*Iniciamos el loop*/
	while ($the_query3->have_posts()):$the_query3->the_post();
		/*Devolvemos HTML de los elementos*/
		$salida .= '<div class="dropdown '.$class.'">
			<p class="title" onClick="ShowContent(this)">
				'.get_the_title().' <i class="dimaticon chevron-down"></i>
				<div class="content" style="display:none;">'.apply_filters( 'the_content', $post->post_content ).'
				</div>
			</p>
			<a class="edit" href="'.get_edit_post_link().'">Editar '.$post_type.'</a>
		</div>';
	endwhile;
	/*Devolvemos el HTML de cierre del dropdown*/
	$salida .= "</div>";
	wp_reset_postdata();
	wp_reset_query();
	/*Cargamos otra vez el post en el que estábamos para evitar conflictos con otros shortocodes*/
	$post = get_post($post_id);
	return $salida;
}
add_shortcode('dropdown', 'dropdown_shortcode');
?>