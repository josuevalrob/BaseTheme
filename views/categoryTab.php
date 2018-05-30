<?php
/*Cargamos la categoría en la que estamos*/
global $cats;
$category = $cats;
$cat_id = $category->cat_ID;
/*Argumentos para seleccionar las pestañas de la categoría activa*/
$argscat = array(
	'post_type' => array(
		'pestana',
	),
	'cat' => $cat_id,
	'meta_key' => 'pestana_orden',		
	'orderby'=>array(
		'pestana_orden' => 'ASC',
		'title' => 'ASC'
	),
);
?>
<script>
	/*Iniciamos el array de paginador personalizado*/
	var paging = [];
</script>
<?php
/*Cargamos el loop*/
$the_querycat = new WP_Query($argscat);
/*Comprobamos si el loop tiene elementos*/
if ($the_querycat->have_posts()){
	/*Inicilizamos el loop para crear el paginador personalizado*/
	while ($the_querycat->have_posts()):$the_querycat->the_post();
		?>
		<script>		
			/*Ponemos IDs con el nombre del post y con el título como texto*/
			paging.push('<h2 id="<?php echo $post->post_name ?>"><?php the_title();?></h2>');
		</script>
		<?php
	endwhile;
	?>
	<div class="cuerpotabs">		
	<?php
	/*Inicializamos de nuevo el loop para crear las pestañas*/
	while ($the_querycat->have_posts()):$the_querycat->the_post();
		?>
		<div class="tabcontent">			
			<div class="content tab-<?php echo $post->post_name ?>">
				<?php the_content(); ?>
			</div>
			<a class="edit" href="<?php echo get_edit_post_link(); ?>">Editar pestaña</a>			
		</div>
	<?php
	endwhile;
	?>
	</div>
	<script>
		/*Función para navegar a pestaña seleccionada cuando el enlace lleva ancla*/
		jQuery(document).ready(function(){
			var urlParams = '#' + window.location.hash.substr(1);
			console.log(urlParams); // el ancla
			jQuery(urlParams).click();
		});
		/*Función para crear las pestañas*/
		jQuery('.cuerpotabs').slick({
			slidesToShow: 1,
			infinite: false,
			slidesToScroll: 1,
			arrows: false,
			fade: false,
			focusOnSelect: true, 
			swipeToSlide: false,
			dots: true,
			dotsClass: 'barratabs',  
			adaptiveHeight: true,
			customPaging : function(slider, i) {
				return paging[i];
			},
		});
	</script>
	<?php
} else {
	/*Si no existen pestañas para dicha categoría, mostrar la vista de categoría estándar*/
	get_template_part( 'views/category');
}	
wp_reset_query();
?>