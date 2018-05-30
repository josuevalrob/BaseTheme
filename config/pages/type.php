<?php
/*Añadimos las opciones de la página de configuración General*/
function type_settings() {
   	add_option( 'type_config', 'Opciones de Configuración del Slider');
	/*Registrar opciones de configuración*/
   	register_setting( 'type_option', 'type_config', 'type_callback' );
}
add_action( 'admin_init', 'type_settings' );
function config_theme_type(){
?>
	<div class="wrap">
		<h2>Configuración del Tema</h2>
	</div>
	<form action="options.php" method="post">
		<?php
		/*Declaramos la página*/
		settings_fields( 'type_option' );
		/*Cargar opciones de configuración*/
		$value = get_option('type_config');
		?>
		<div class="wrap">
			<div>
				<h3>Tipo de Tema</h3>			
				<div>
					<label for="type_config[theme]">Estilo de la Navegación</label>
					<select class="large-text" name="type_config[theme]">
						<option value="singlePage" <?php if (isset($value['theme']) && ($value['theme'] == 'singlePage')){ echo 'selected'; } ?>>Página Única</option>
						<option value="linkNavigation" <?php if (isset($value['theme']) && ($value['theme'] == 'linkNavigation')){ echo 'selected'; } ?>>Navegación por Links</option>
						<option value="tabNavigation" <?php if (isset($value['theme']) && ($value['theme'] == 'tabNavigation')){ echo 'selected'; } ?>>Navegación por Pestañas</option>					
					</select>
				</div>	
			</div>
			<div>			
				<h3>Opciones visuales</h3>
				<div>
					<label>Flechas de ancla en página principal</label>
					<input name="type_config[theme_arrows]" type="checkbox" value="active" <?php if (isset($value['theme_arrows']) && ($value['theme_arrows'] == 'active')){ echo 'checked'; } ?> />
				</div>
				<div>
					<label>Flecha Back To Top</label>
					<input name="type_config[backtop]" type="checkbox" value="active" <?php if (isset($value['backtop']) && ($value['backtop'] == 'active')){ echo 'checked'; } ?> />
				</div>
				<div>
					<label>Entradas de Portada con Altura completa</label>
					<input name="type_config[full]" type="checkbox" value="active" <?php if (isset($value['full']) && ($value['full'] == 'active')){ echo 'checked'; } ?> />
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