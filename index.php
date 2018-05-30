<?php
/*Pintamos la cabecera*/
get_header();
?>
<?php
/*Configuración de los slider*/
global $slider_config;
/*Comprobamos si está activado el slider de la página principal*/
if ($slider_config['home'] == 'active') {	
	get_template_part( 'views/sliderHome');//Plantilla de slider de página principal
}
?>
<?php
/*Sidebars Activados*/
global $sidebar_id;
/*Configuración de los Sidebars*/
global $sidebar_config;
/*Recorremos los Sidebars activados*/
if($sidebar_id != ""){
	foreach ($sidebar_id as $sidebar) {
		/*Comprobamos si el sidebar está activado en la página principal*/
		if (isset($sidebar_config[$sidebar.'-page-home']) && ($sidebar_config[$sidebar.'-page-home'] == 'home')){
			/*Vemos en qué posición hay que pintar el sidebar*/
			if ($sidebar_config[$sidebar.'-position-header'] == 'header') {
				$sidebarHeader = $sidebar; //Variable global con el ID del sidebar
				get_template_part( 'views/sidebarHeader'); //Plantilla de posición del sidebar
			} else if ($sidebar_config[$sidebar.'-position-sidebarLeft'] == 'sidebarLeft') {
				$sidebarLeft = $sidebar; //Variable global con el ID del sidebar
				get_template_part( 'views/sidebarLeft'); //Plantilla de posición del sidebar
			} else if ($sidebar_config[$sidebar.'-position-sidebarRight'] == 'sidebarRight') {
				$sidebarRight = $sidebar; //Variable global con el ID del sidebar
				get_template_part( 'views/sidebarRight'); //Plantilla de posición del sidebar
			} else if ($sidebar_config[$sidebar.'-position-footer'] == 'footer') {
				$sidebarFooter = $sidebar; //Variable global con el ID del sidebar
				get_template_part( 'views/sidebarFooter'); //Plantilla de posición del sidebar
			}		
		}
	}
}
?>
<section id="main">
	<?php		
	/*Configuración general del tema*/
	global $type_config;
	/*Filtro para mostrar sólo entradas tipo portada*/
	$argsindex = array(
		'post_type' => array(
			'portada',
		),
		'cat' => '',
	);
	$the_queryindex = new WP_Query($argsindex);
	while ($the_queryindex->have_posts()):$the_queryindex->the_post();
		/*Opciones personalizadas de apariencia de portada*/
		$apariencia = get_post_meta( $post->ID, 'apariencia_portada', true );
		/*Ruta de la imagen destacada*/
		$thumb_url = get_the_post_thumbnail_url($post->ID);
		$thumb = "";
		/*Comprobamos si usamos la imagen destacada como fondo*/
		if (isset($apariencia['back'])&& $apariencia['back'] == 'active') {
			$thumb = 'style="background-image:url('.$thumb_url.');"';
		}
		/*Slug de la portada*/
		$post_slug = $post->post_name;
		?>
		<div id="id-<?php echo $post_slug ?>" class="portada <?php if($type_config['full'] == 'active'){ echo 'full';} if(isset($apariencia['parallax']) && $apariencia['parallax'] == 'active'){ echo ' parallax';}?>" <?php echo $thumb?>>
			<?php
			/*Comprobamos si mostramos el título o no*/	
			if (isset($apariencia['title']) && $apariencia['title'] == 'mostrar') {
				?>
				<div id="title-<?php echo $post_slug ?>" data-aos="zoom-in"	class="title" >
					<?php the_title();?>
				</div>
				<?php 
				}
			?>
			<div id="body-<?php echo $post_slug ?>" data-aos="animate-<?php echo $post_slug ?>" data-aos-anchor-placement="center-bottom" class="content-<?php echo $post_slug ?> content">
				<?php	
				/*Comprobamos si no usamos la imagen destacada como fondo*/
				if($thumb == "") {
					the_post_thumbnail($post->ID, ',medium');
				}
				?>
				<?php the_content(); ?>
			</div>
			<?php			
			/*Comprobamos si usamos las flechas de siguiente ancla*/
			if($type_config['theme_arrows'] == 'active'){
				?>
				<div class="nextAnchor"><i class="dimaticon chevron-down"></i></div>
				<?php
			}?>
			<a class="edit" href="<?php echo get_edit_post_link(); ?>">Editar portada</a>
		</div>
		<?php
	endwhile;
	wp_reset_query();
	?>
</section>
<?php
/*Pintamos el pie de página*/
get_footer();
?>