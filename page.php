<?php
/*Pintamos la cabecera*/
get_header();
?>
<?php
/*Categorías que tiene la página*/
$cats =  get_the_category();
/*Sidebars Activados*/
global $sidebar_id;
/*Configuración de los Sidebars*/
global $sidebar_config;
/*Recorremos los Sidebars activados*/
foreach ($sidebar_id as $sidebar) {
	/*Comprobamos si el sidebar está activado para páginas*/
	if (isset($sidebar_config[$sidebar.'-page-page']) && ($sidebar_config[$sidebar.'-page-page'] == 'page')) {
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
}
?>
<?php
/*Loop Wordpress para pintar la página actual*/
while ( have_posts() ) : the_post();
	/*Obtenemos URL de la imagen destacada a tamaño completo*/
	$thumb = get_the_post_thumbnail_url($post->ID);
	/*Comprobamos si tiene imagen destacada*/
	if (isset($thumb) && $thumb != "") {
		/*Si la imagen existe la pintamos con apariencia de slider*/
		?>
		<section id="slider" class="cat">
			<div class="item" style="background-image:url('<?php echo $thumb;?>'); height: 100%;"> 
			</div>
		</section>
		<?php
	}
	/*Pintamos el cuerpo de la página*/
	?>
	<section id="main" class="page page-<?php echo $post->post_name; /*clase con slug de la página para individualidades css*/?>">			
		<div class="title">
			<?php the_title();/*Título*/?>
		</div>
		<div class="content">
			<?php the_content();/*Contenido completo*/?>
			<a class="edit" href="<?php echo get_edit_post_link(); ?>">Editar página</a>		
		</div>	
	</section>
	<?php
endwhile;
?>
<?php
/*Pintamos el pie de página*/
get_footer();
?>