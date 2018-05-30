<?php
/*Añadimos las opciones de la página de configuración de Cabecera*/
function header_settings() {
   	add_option( 'header_config', 'Opciones de Configuración del Menú');
	/*Registrar opciones de configuración*/
   	register_setting( 'header_option', 'header_config', 'header_callback' );
	/*Registrar opciones de categorías ocultas*/
   	register_setting( 'header_option', 'header_cat', 'header_callback' );
}
add_action( 'admin_init', 'header_settings' );
function config_theme_header(){
?>
	<div class="wrap">
		<h2>Configuración del menú</h2>
	</div>
	<form action="options.php" method="post">
		<?php
		/*Declaramos la página*/
		settings_fields( 'header_option' );
		/*Cargar opciones de configuración*/
		$value = get_option('header_config');
		/*Cargar opciones de categorías ocultas*/
		$catvalue = get_option('header_cat');
		?>
		<div class="wrap">
			<div style="margin: 15px 0;">
				<label style="margin: 0 15px 0 0">Mostrar título</label>
				<input name="header_config[title]" type="checkbox" value="active" <?php if (isset($value['title']) && ($value['title'] == 'active')){ echo 'checked'; } ?> />
			</div>
			<div style="margin: 15px 0;">
				<label style="margin: 0 15px 0 0">Mostrar logo</label>
				<input name="header_config[logo]" type="checkbox" value="active" <?php if (isset($value['logo']) && ($value['logo'] == 'active')){ echo 'checked'; } ?> />
			</div>
			<div style="margin: 15px 0;">
				<label style="margin: 0 15px 0 0">Tipo de Menú</label>
				<select name="header_config[menu]">
					<option value="catHead" <?php if ($value['menu'] == 'catHead' ){ echo 'selected';}?>>Menú de Categorías</option>
					<option value="widgetHead" <?php if ($value['menu'] == 'widgetHead' ){ echo 'selected';}?>>Menú con Widget</option>
				</select>
			</div>
			<div style="margin: 15px 0;">
				<label style="margin: 0 15px 0 0">Cabecera animada</label>
				<input name="header_config[sticky]" type="checkbox" value="active" <?php if (isset($value['sticky']) && ($value['sticky'] == 'active')){ echo 'checked'; } ?> />
			</div>
			<div style="margin: 15px 0;">
				<label style="margin: 0 15px 0 0">Mostrar campo de búsqueda</label>
				<input name="header_config[search]" type="checkbox" value="active" <?php if (isset($value['search']) && ($value['search'] == 'active')){ echo 'checked'; } ?> />
			</div>
			<div>
				<label style="margin: 0 15px 0 0; font-size: 18px; font-weight: 500; display: block;">Ocultar categorías en el menú</label>
				<div style="border: 1px solid; display: inline-table;">
					<?php
					/*Obtenemos todas las categorías existentes*/
					$categories = get_categories(
						array(
							'hide_empty'   => 0,
							'orderby' => 'name',
							'order' => 'ASC'
						)
					);
					/*Recorremos las categorías*/
					foreach ($categories as $category) {
						/*Comprobamos las categorías que no tienen padre*/
						if ($category->parent == 0){
							?>
							<div style="margin: 5px;">								
								<input name="header_cat[<?php echo $category->slug;?>]" type="checkbox" value="<?php echo $category->slug;?>" <?php if (isset($catvalue[$category->slug]) && ($catvalue[$category->slug] == $category->slug)){ echo 'checked'; } ?> />
								<label style="margin: 0 15px 0 0"><?php echo $category->name;?></label>
							</div>
							<?php
							/*Obtenemos las categorías hijo*/
							$categories_child = get_categories(
								array(
									'hide_empty'   => 0,
									'orderby' => 'name',
									'order' => 'ASC',
									'child_of' => $category->cat_ID
								)
							);
							/*Recorremos las categorías hijo*/
							foreach ($categories_child as $category_child) {
								?>
								<div style="margin: 5px 25px;">
									<input name="header_cat[<?php echo $category_child->slug;?>]" type="checkbox" value="<?php echo $category_child->slug;?>" <?php if (isset($catvalue[$category_child->slug]) && ($catvalue[$category_child->slug] == $category_child->slug)){ echo 'checked'; } ?> />		
									<label style="margin: 0 15px 0 0"><?php echo $category_child->name;?></label>
								</div>
								<?php
							}
						}
					}
					?>
				</div>
			</div>
		</div>
		<div class="wrap">
			<?php
			/*Botón de Guardar*/
			submit_button();
			?>
		</div>
	</form>
<?php
}
?>