<?php
/*Cargamos la categoría en la que estamos*/
global $cats;
$category = $cats;
$cat_id = $category->cat_ID;
/*Argumentos para seleccionar las páginas de la categoría activa*/
$argsindex = array(
	'post_type' => array(
		'page',
	),
	'cat' => $cat_id,
);
/*Cargamos el loop*/
$the_queryindex = new WP_Query($argsindex);
/*Recorremos el loop*/
while ($the_queryindex->have_posts()):$the_queryindex->the_post();
	/*Animacion*/
	$animacion = get_post_meta( $post->ID, 'general_animacion', true );
	$dataaos = "";
	$dataaosinverse = "";
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
	/*URL de la imagen destacada*/
	$thumb = get_the_post_thumbnail_url($post->ID);?>
	<div id="<?php echo $post->post_name?>" class="category">
	
		<div class="title" >
			<h1><?php the_title();?></h1>
		</div>
		<div class="content">
			<img src="<?php echo $thumb;?>">
			<?php the_content(); ?>					
		</div>	
		<a class="edit" href="<?php echo get_edit_post_link(); ?>">Editar página</a>					
	</div>
<?php
endwhile;
wp_reset_query();
?>