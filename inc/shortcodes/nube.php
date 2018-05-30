<?php
/*Shortcode Nube de Logos*/
function nube_shortcode($atts) {
	/*Obtenemos tipo de post a mostrar*/
	$post_type = $atts["post"];
	/*Obtenemos la clase CSS*/
	$class = $atts["class"];
	/*Obtenemos el retraso de la animación*/
	$retraso = $atts["delay"];
	$delay = $retraso;
	/*Obtenemos la categoría*/
	$category = get_category_by_slug($atts["category"]);
	/*Argumento del loop*/
	$args5 = array(
			'cat' => $category->cat_ID,
			'posts_per_page'=> -1,
			'post_type' => array(
				$post_type,
		),
	);
	/*Entrada actual*/
	global $post;
	/*ID de la entrada actual*/
	$post_id = $post->ID;
	//print_r($post);
	/*Slug de la entrada actual*/
	$post_name = $post->post_name;
	/*Devolvemos HTML que envuelve a la nube*/
	$salida = '<div class="nube '.$class.'" id="nube'.$post_name.'">';
	/*Cargamos el loop*/
	$the_query5 = new WP_Query($args5);
	/*Iniciamos el loop*/
	while ($the_query5->have_posts()):$the_query5->the_post();
		/*Devolvemos el HTML de cada elemento*/
		/*Animacion*/
		$animacion = get_post_meta( $post->ID, 'general_animacion', true );
		$dataaos = "";
		if (isset($animacion['animacion'])){
			$dataaos .= 'data-aos="'.$animacion['animacion'].'" ';
		}
		if (isset($animacion['anchor-placement'])){
			$dataaos .= 'data-aos-anchor-placement="'.$animacion['anchor-placement'].'" ';
		}
		if (isset($animacion['easing'])){
			$dataaos .= 'data-aos-easing="'.$animacion['easing'].'" ';
		}
		if (isset($animacion['duracion'])){
			$dataaos .= 'data-aos-duration="'.$animacion['duracion'].'" ';
		}
		if ($dataaos != ""){
			$dataaos .= 'data-aos-delay="'.$delay.'" data-aos-anchor="#nube'.$post_name.'"';			
		}
		/*Hay que arreglar esto*/
		$salida .= '<div '.$dataaos.' id="id-'.$class.'" class="item-inside '.$class.'-item" 
			style="background-image: url('. get_the_post_thumbnail_url($post->ID, 'large') .'); background-position: center">';		
				$salida .= '<a href="'.get_the_permalink().'">';
				$salida .= '<div class="'.$class.'-title" >
						'.get_the_title().'
					</div>';
			
		$salida .= '</a><a class="edit" href="'.get_edit_post_link().'">Editar '.$post_type.'</a>
			</div>';
		$delay = $delay + $retraso;
	endwhile;
	/*Devolvemos el HTML de cierre de la nube*/
	$salida .= '</div>';
	wp_reset_postdata();
	wp_reset_query();
	/*Cargamos otra vez el post en el que estábamos para evitar conflictos con otros shortocodes*/
	$post = get_post($post_id);
	return $salida;
}
add_shortcode('nube', 'nube_shortcode');
?>