<div id="categorias">
	<?php
	/*Comprobamos si estamos en una página de categoría*/
	if (is_category()) {
		$cat_query = get_query_var('cat');
		/*Categoría actual*/
		$actual_cat = get_category($cat_query);
	}
	/*Configuración Categorías a mostrar en Menú de cabecera*/
	global $header_cats;
	/*Comprobamos si hay alguna categoría marcada*/
	if (isset($header_cats) && $header_cats != "") {
		/*Recorremos el array de categorías*/
		foreach ($header_cats as $header_cat) {
			/*Hacemos un array con las categorías que no vamos a mostrar*/
			$cat_not_in[] = get_category_by_slug($header_cat)->cat_ID;
		}
	}
	/*Argumentos de las categorías*/
	$args = array(
		'orderby' => 'description',
		'order' => 'ASC',
		'exclude' => $cat_not_in
	);
	/*Obtenemos las categorías filtradas*/
	$catheads = get_categories($args);
	$catheads = get_categories($args);
	/*Recorremos las categorías*/
	foreach ($catheads as $cathead) {
		/*Padre de la categoría*/
		$padre = $cathead->category_parent;		
		/*Comprobamos que el padre es 0*/
		if ($padre == '0') {
			/*ID de la categoría*/
			$cathead_id = $cathead->cat_ID;
			/*Nombre de la categoría*/
			$cathead_name = $cathead->cat_name;
			/*Enlace de la categoría*/
			$cathead_link = get_category_link($cathead_id);
			/*Argumentos de las categorías hijo*/
			$args_sub = array(
				'child_of' => $cathead_id,
				'orderby' => 'description',
				'order' => 'ASC',
			);
			/*Obtenemos las categorías hijo*/
			$catsubheads = get_categories($args_sub);
			/*Comprobamos si la categoría en la que estamos es la categoría actual*/
			if ($actual_cat->cat_ID == $cathead_id || $actual_cat->category_parent == $cathead_id) {
				$active_cat = 'active';
			} else {
				$active_cat = '';
			}
			?>
			<div class="menudiv <?php echo $active_cat; /*Pintamos clase para mostrar la categoría en la que estamos en el menú*/ ?>">
				<?php
				/*Comprobamos si no hay categorías hijo para pintar un enlace*/
				if($catsubheads[0] == "") {
					?>
					<a class="enlaceheader" href="<?php echo $cathead_link ?>">

					<?php
				/*Comprobamos si hay categorías hijo para pintar un elemento no clickable*/	
				} else {
					?>									
					<p class="enlaceheader">
					<?php
				}
				/*Pintamos el nombre de la categoría padre*/
				echo $cathead_name;
				/*Comprobamos si no hay categorías hijo para cerrar el enlace*/
				if($catsubheads[0] == "") {
					?>									
					</a>
					<?php
				/*Comprobamos si hay categorías hijo para pintar el desplegable*/
				} else {
					?>
					<div class="barranavegacion">
						<?php
						/*Recorremos las categorías hijo*/
						foreach ($catsubheads as $catsubhead) {
							/*Nombre de la categoría hijo*/
							$catsubhead_name = $catsubhead->cat_name;
							/*ID de la categoría hijo*/
							$catsubhead_id = $catsubhead->cat_ID;
							/*Enlace de la categoría hijo*/
							$catsubhead_link = get_category_link($catsubhead_id);							
							?>
							<a href="<?php echo esc_url($catsubhead_link); ?>">
								<?php echo $catsubhead_name; ?>
							</a>
							<?php
						}
						?>
					</div>
					<?php
				}
			}
			?>			
		</div>
		<?php
	}
	?>
</div>