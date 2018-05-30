<?php
/*****Shortcode carrousel****/
function solucion_shortcode($atts) {
    global $switched;
	global $wpdb; 
	$blog = get_current_blog_id();	
    $blog_switch = $atts["blog"];
    switch_to_blog($blog_switch);
	$class = $atts["class"];
	$post_id = $atts["post"];
	$salida = '<div class="solucion '.$class.'" id="solucion'.$post_id.'">';
	
	get_post($post_id);
	
	$meta = get_post_meta( $post_id, 'solucion', true );	 
	$salida .= '<div class="content">
		<div class="detail">
			<div class="thumbnail" style="background-image: url('. get_the_post_thumbnail_url($post_id, 'large') .');"></div>';
		if ($meta['logo']) {
			global $wpdb;
			$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $meta['logo'] ));				
			$image_thumb = wp_get_attachment_image_src($attachment[0], 'medium');
			$salida .= '<div class="logo" style="background-image: url('.$image_thumb[0].');">
						</div>';
		}
		$salida .= '</div>
			'.get_the_excerpt($post_id).'
		</div>';
		
		$salida .= '<a class="falsoboton verproyecto" href="'.get_the_permalink($post_id).'"><span>'.__("[:es]Vista Detallada[:en]Detailed View[:fr]Vue Détaillée[:pt]Vista Detalhada").'</span></a></div>';
			

    switch_to_blog($blog);
	return $salida;
}
add_shortcode('solucion', 'solucion_shortcode');

?>