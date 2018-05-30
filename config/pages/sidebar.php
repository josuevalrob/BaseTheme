<?php
/*Añadimos las opciones de la página de configuración de Sidebar*/
function sidebar_settings() {
   	add_option( 'sidebar_config', 'Opciones de Configuración del Menú');
	/*Registrar opciones de configuración*/
   	register_setting( 'sidebar_option', 'sidebar_config', 'sidebar_callback' );
	/*Registrar opciones de sidebar activos*/
   	register_setting( 'sidebar_option', 'sidebar_id', 'sidebar_callback' );
}
add_action( 'admin_init', 'sidebar_settings' );
function config_theme_sidebar(){
?>
	<div class="wrap">
		<h2>Configuración de los sidebars</h2>
	</div>
	<form action="options.php" method="post">
		<?php
		/*Declaramos la página*/
		settings_fields( 'sidebar_option' );
		/*Cargar opciones de configuración*/
		$value = get_option('sidebar_config');
		/*Cargar opciones de sidebar activos*/
		$sidebarvalue = get_option('sidebar_id');
		/*Obtenemos todos los sidebars*/
		global $wp_registered_sidebars;
		/*Recorremos todos los sidebars*/
		foreach($wp_registered_sidebars as $sidebar){
			?>
			<div style="margin: 15px 0 5px;">
				<label style="margin: 0 15px 0 0">Activar <?php echo $sidebar['name']; ?></label>
				<input class="sidebar_check" name="sidebar_id[<?php echo $sidebar['id']; ?>]" type="checkbox" value="<?php echo $sidebar['id']; ?>" <?php if (isset($sidebarvalue[$sidebar['id']]) && ($sidebarvalue[$sidebar['id']] == $sidebar['id'])){ echo 'checked'; } ?> />
				<div class="sidebar_options">
					<div style="border: 1px solid; padding:0 5px;">
						<label style="margin: 0 0 10px; font-size: 400; font-size: 16px;">Posiciones donde mostrar sidebar <?php echo $sidebar[name]; ?></label>
						<div style="margin: 5px 0;">
							<input name="sidebar_config[<?php echo $sidebar['id']; ?>-position-header]" type="checkbox" value="header" <?php if (isset($value[$sidebar['id'].'-position-header']) && ($value[$sidebar['id'].'-position-header'] == 'header')){ echo 'checked'; } ?> />
							<label style="margin: 0">Cabecera</label>
						</div>
						<div style="margin: 5px 0;">						
							<input name="sidebar_config[<?php echo $sidebar['id']; ?>-position-sidebarLeft]" type="checkbox" value="sidebarLeft" <?php if (isset($value[$sidebar['id'].'-position-sidebarLeft']) && ($value[$sidebar['id'].'-position-sidebarLeft'] == 'sidebarLeft')){ echo 'checked'; } ?> />
							<label style="margin: 0">Lateral Izquierdo</label>
						</div>
						<div style="margin: 5px 0;">
							<input name="sidebar_config[<?php echo $sidebar['id']; ?>-position-sidebarRight]" type="checkbox" value="sidebarRight" <?php if (isset($value[$sidebar['id'].'-position-sidebarRight']) && ($value[$sidebar['id'].'-position-sidebarRight'] == 'sidebarRight')){ echo 'checked'; } ?> />
							<label style="margin: 0">Lateral Derecho</label>
						</div>
						<div style="margin: 5px 0;">
							<input name="sidebar_config[<?php echo $sidebar['id']; ?>-position-footer]" type="checkbox" value="footer" <?php if (isset($value[$sidebar['id'].'-position-footer']) && ($value[$sidebar['id'].'-position-footer'] == 'footer')){ echo 'checked'; } ?> />
							<label style="margin: 0">Pie de Página</label>
						</div>
					</div>
					<div style="margin: 0 10px; border: 1px solid; padding:0 5px;">
						<label style="margin: 0 0 10px; font-size: 400; font-size: 16px;">Categorías donde mostrar sidebar <?php echo $sidebar['name']; ?></label>
						<?php
						/*Obtenemos todas las categorías*/
						$categories = get_categories(
							array(
								'hide_empty'   => 0,
								'orderby' => 'name',
								'order' => 'ASC'
							)
						);
						/*Recorremos todas las categorías*/
						foreach ($categories as $category) {
							/*Comprobamos que las categorías no tienen padre*/
							if ($category->parent == 0){
								?>
								<div style="margin: 5px;">								
									<input name="sidebar_config[<?php echo $sidebar['id']; ?>-category-<?php echo $category->slug;?>]" type="checkbox" value="<?php echo $category->slug;?>" <?php if (isset($value[$sidebar['id'].'-category-'.$category->slug]) && ($value[$sidebar['id'].'-category-'.$category->slug] == $category->slug)){ echo 'checked'; } ?> />
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
										<input name="sidebar_config[<?php echo $sidebar['id']; ?>-category<?php echo $category->slug;?>]" type="checkbox" value="<?php echo $category_child->slug;?>" <?php if (isset($value[$sidebar['id'].'-category-'.$category->slug]) && ($value[$sidebar['id'].'-category-'.$category->slug] == $category_child->slug)){ echo 'checked'; } ?> />		
										<label style="margin: 0 15px 0 0"><?php echo $category_child->name;?></label>
									</div>
									<?php
								}
							}
						}
						?>
					</div>
					<div style="border: 1px solid; padding:0 5px;">
						<label style="margin: 0 0 10px; font-size: 400; font-size: 16px;">Tipos de entrada donde mostrar sidebar <?php echo $sidebar['name']; ?></label>
						<?php
						/*Obtenemos todos los tipos de entrada*/
						$pages = get_post_types(array('public'=>true));
						/*Recorremos los tipos de entrada*/
						foreach ($pages as $page) {
							/*Nombre de la entrada*/
							$name = get_post_type_object($page)->labels->name;
							?>
							<div style="margin: 5px;">								
								<input name="sidebar_config[<?php echo $sidebar['id']; ?>-page-<?php echo $page;?>]" type="checkbox" value="<?php echo $page;?>" <?php if (isset($value[$sidebar['id'].'-page-'.$page]) && ($value[$sidebar['id'].'-page-'.$page] == $page)){ echo 'checked'; } ?> />
								<label style="margin: 0 15px 0 0"><?php echo $name?></label>
							</div>
							<?php
						}
						?>
						<div style="margin: 5px;">								
							<input name="sidebar_config[<?php echo $sidebar['id']; ?>-page-home]" type="checkbox" value="home" <?php if (isset($value[$sidebar['id'].'-page-home']) && ($value[$sidebar['id'].'-page-home'] == 'home')){ echo 'checked'; } ?> />
							<label style="margin: 0 15px 0 0">Página Principal</label>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
		<script>			
			jQuery(document).ready(function() {
				/*Recorremos rodos los checkbox de sidebar*/
				jQuery('.sidebar_check').each(function(){
					/*Comprobamos los checkbox activos*/
					if (jQuery(this).is(':checked')){
						/*Mostramos las opciones del sidebar*/
						jQuery(this).siblings('.sidebar_options').addClass('show');
					}
				})
				/*Detectamos un cambio en el checkbox de sidebar*/
				jQuery('.sidebar_check').change(function() {
					/*Comprobamos si el checkbox está activo*/
					if (jQuery(this).is(':checked')){
						/*Mostramos las opciones*/
						jQuery(this).siblings('.sidebar_options').addClass('show');
					} else {
						/*Ocultamos las opciones*/
						jQuery(this).siblings('.sidebar_options').removeClass('show');
					}  
				});
			});
		</script>
		<style>
			.sidebar_options {
				display: none;
			}
			.sidebar_options.show {
				display: flex;
			}
		</style>		
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