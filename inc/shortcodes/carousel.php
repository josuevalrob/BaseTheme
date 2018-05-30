<?php
/*Shortcode carrousel*/
function carrousel_shortcode($atts) {
	global $wpdb;
	/*Obtenemos número de entradas a mostrar*/
    $show = $atts["show"];
	/*Obtenemos la paginación por puntos*/
	$dots = $atts["dots"];
	/*Obtenemos la navegación por flechas*/
	$arrows = $atts["arrows"];	
	/*Obtenemos lel tipo de entrada*/
	$post_type = $atts["post"];
	/*Obtenemos la clase CSS*/
	$class = $atts["class"];
	/*Obtenemos número de entradas a cargar*/
	$size = $atts["size"];
	/*Obtenemos número de entradas a mostrar*/
	$center = $atts["center"];
	/*Obtenemos la categoría a mostrar*/
	$category = get_category_by_slug($atts["category"]);
	/*Argumentos del loop*/
	$args3 = array(
		'cat' => $category,
		'posts_per_page'=> $size,
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
	/*Devolvemos estructura HTML que encierra al carousel*/
	$salida = '<div class="slider '.$class.'" id="slider'.$post_name.'">';
	/*Cargamos el loop*/
	$the_query3 = new WP_Query($args3);
	/*Iniciamos el loop*/
	while ($the_query3->have_posts()):$the_query3->the_post();
		/*Devolvemos estructura HTML de los elementos*/
		$salida .= '<div class="item-inside" style="background-image: url('. get_the_post_thumbnail_url($post->ID, 'large') .');">
			<a href="'.get_the_permalink().'">
				<div class="title" >
				'.get_the_title().'
				</div>
				<div class="content">
					'.get_the_excerpt().'
				</div>
			</a>
			<a class="edit" href="'.get_edit_post_link().'">Editar '.$post_type.'</a>
		</div>';			
	endwhile;
	/*Devolvemos HTML de cierre del carousel y Javascript para activar el carousel*/
	$salida .= "</div>
	<script>    
		jQuery('#slider".$post_id."').slick({
			slidesToShow: ".$show.",
			slidesToScroll: 1,
			dots: ".$dots.",
			arrows: ".$arrows.",
			autoplay: true,
			swipeToSlide: true,
			autoplaySpeed: 2000,
			centerMode: ".$center.",
		});
	</script>";
	wp_reset_postdata();
	wp_reset_query();
	/*Cargamos otra vez el post en el que estábamos para evitar conflictos con otros shortocodes*/
	$post = get_post($post_id);
	return $salida;
}
add_shortcode('carrousel', 'carrousel_shortcode');
?>