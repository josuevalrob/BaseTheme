<?php
/*Pintamos la cabecera*/
get_header();
?>
<?php
/*Categorías que tiene la entrada*/
global $cats;
$cats =  get_the_category();
/*Sidebars Activados*/
global $sidebar_id;
/*Configuración de los Sidebars*/
global $sidebar_config;
/*Recorremos los Sidebars activados*/
foreach ($sidebar_id as $sidebar) {
		/*Recorremos las categorías*/
	foreach ($cats as $cat) {
		/*Comprobamos si el sidebar está activado en la categoría actual*/
		if (isset($sidebar_config[$sidebar.'-category-'.$cat->slug]) && ($sidebar_config[$sidebar.'-category-'.$cat->slug] == $cat->slug)){
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
<?php
/*Configuración de los slider*/
global $slider_config;
/*Comprobamos si está activado el slider de categoría*/
if ($slider_config['cat'] == 'active') {
	get_template_part( 'views/sliderCat'); //Plantilla de slider de categoría
}
?>
<section id="main">
	<?php	
	get_template_part( 'views/categoryTab'); //Plantilla de categoría por pestañas
	?>
</section>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#marker-<?php echo $post->ID?>').click();
	});	
</script>
<?php
/*Pintamos el pie de página*/
get_footer();
?>
