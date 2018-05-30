<?php
/*Configuración de los slider*/
global $slider_config;
/*Comprobamos si está activada la paginación por puntos*/
if ($slider_config['home_dots'] == 'active') {
	$dots = 'true';		
} else {
	$dots = 'false';
}
/*Comprobamos si están activadan las flechas de siguiente diapositiva*/
if ($slider_config['home_arrows'] == 'active') {
	$arrows = 'true';		
} else {
	$arrows = 'false';
}
/*Comprobamos si está activada la reproducción automática*/
if ($slider_config['home_autoplay'] == 'active') {
	$autoplay = 'true';		
} else {
	$autoplay = 'false';
}
/*Comprobamos si está activada la pausa con ratón*/
if ($slider_config['home_pauseonhover'] == 'active') {
	$pauseonhover = 'true';		
} else {
	$pauseonhover = 'false';
}
?>
<section id="slider" class="home <?php echo $slider_config['home_dots_style'].' '.$slider_config['home_arrows_style']; /*Pintamos las clases que dan la apariencia predeterminada*/ ?> ">
	<?php
	/*Argumentos para el loop de wordpress que nos muestre las diapositivas activas para el home*/
	$argshome = array(
		'post_type' => array(
			'diapositiva',
		),
		'cat' => '',
		'meta_query' => array(
			array(
				'key'     => 'diapositiva_config',
				'value'   => 'activehome',
				'compare' => 'LIKE',
			),
		),
	);
	/*Cargamos el loop*/
	$the_queryhome = new WP_Query($argshome);
	/*Lanzamos el loop*/
	while ($the_queryhome->have_posts()):$the_queryhome->the_post();
		/*Configuración de cada diapositiva*/
		$diapositiva_config = get_post_meta( $post->ID, 'diapositiva_config', true );
		/*URL de la imagen destacada*/
		$thumb = get_the_post_thumbnail_url($post->ID);
		?>
		<div class="item <?php echo $diapositiva_config['position'].' '.$diapositiva_config['animation']; /*Pintamos la posición y animación del texto*/ ?>" style="background-image:url('<?php echo $thumb; /*Utilizamos la imagen destacada como fondo*/ ?>');">
			<div class="text">
				<?php
				/*Comprobamos si hay que pintar el título*/
				if ($diapositiva_config['title'] == 'active'){
					?>
					<div class="title" >
						<?php the_title();?>
					</div>
					<?php
				}
				?>
				<?php
				/*Comprobamos si hay que pintar el cuerpo*/
				if ($diapositiva_config['content'] == 'active'){
					?>
					<div class="content">
						<?php the_content(); ?>
					</div>
					<?php
				}
				?>
			</div>
			<a class="edit" href="<?php echo get_edit_post_link(); ?>">Editar diapositiva</a>
		</div>
	<?php
	endwhile;
	wp_reset_query();
	?>	
</section>
<script>
	jQuery('#slider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: <?php echo $dots;?>,
		arrows: <?php echo $arrows;?>,
		autoplay: <?php echo $autoplay;?>,
		pauseOnHover: <?php echo $pauseonhover;?>,
		autoplaySpeed: <?php echo $slider_config['home_autoplaySpeed'];/*Velocidad de reproducción de la diapositiva*/?>,
	});
</script>