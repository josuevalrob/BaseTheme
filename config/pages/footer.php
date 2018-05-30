<?php
/*Añadimos las opciones de la página de configuración de Footer*/
function footer_settings() {
   	add_option( 'footer_config', 'Opciones de Configuración del Menú');
	/*Registrar opciones de configuración*/
   	register_setting( 'footer_option', 'footer_config', 'footer_callback' );
}
add_action( 'admin_init', 'footer_settings' );
function config_theme_footer() {
	/*Estructura HTML de la página*/
	$url = get_template_directory_uri();
	?>
	<div class="wrap">
		<h2>Configuración del Pie de Página</h2>
	</div>
	<form action="options.php" method="post">
		<?php
		/*Declaramos la página*/
		settings_fields( 'footer_option' );
		/*Cargar opciones de configuración*/
		$value = get_option('footer_config');
		?>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/config.js"></script>
		<h3>Configuración footer</h3>
		<div class="wrap">
			<div style="margin: 15px 0;">
				<label style="margin: 0 15px 0 0">Activar footer con Widget</label>
				<input name="footer_config[widget]" type="checkbox" value="active" <?php if (isset($value['widget']) && ($value['widget'] == 'active')){ echo 'checked'; } ?> />
			</div>
			<div style="margin: 15px 0;">
				<label style="margin: 0 15px 0 0">Footer visible en móviles</label>
				<input name="footer_config[widget_mobile]" type="checkbox" value="active" <?php if (isset($value['widget_mobile']) && ($value['widget_mobile'] == 'active')){ echo 'checked'; } ?> />
			</div>	
		</div>
		<h3>Configuración Subfooter</h3>
		<!-- Enlaces del subfooter, debería hacerse un repeater javascript-->	
		<div class="wrap" style="display: flex; padding: 10px 15px; border: 1px solid; align-items: center;">
			<div style="margin: 0 15px;">
				<label style="margin: 0 15px 0 0">Texto subfooter 1</label>
				<input name="footer_config[text-1]" class="regular-text" type="text" value="<?php if (isset($value['text-1'])){ echo $value['text-1']; }?>" />
			</div>
			<div style="margin: 0 15px;">
				<label style="margin: 0 15px 0 0">Enlace subfooter 1</label>
				<input name="footer_config[link_text-1]" class="regular-text" type="text" value="<?php if (isset($value['link_text-1'])){ echo $value['link_text-1']; }?>" />
				<div class="button button-primary" onclick="searchPostTypes('<?php echo $url; ?>', this)"><i class="dimaticon search"></i>Buscar</div>
			</div>	
		</div>
		<div class="wrap" style="display: flex; padding: 10px 15px; border: 1px solid; align-items: center;">
			<div style="margin: 0 15px;">
				<label style="margin: 0 15px 0 0">Texto subfooter 2</label>
				<input name="footer_config[text-2]" class="regular-text" type="text" value="<?php if (isset($value['text-2'])){ echo $value['text-2']; }?>" />
			</div>
			<div style="margin: 0 15px;">
				<label style="margin: 0 15px 0 0">Enlace subfooter 2</label>
				<input name="footer_config[link_text-2]" class="regular-text" type="text" value="<?php if (isset($value['link_text-2'])){ echo $value['link_text-2']; }?>" />
				<div class="button button-primary" onclick="searchPostTypes('<?php echo $url; ?>', this)"><i class="dimaticon search"></i>Buscar</div>
			</div>	
		</div>
		<div class="wrap" style="display: flex; padding: 10px 15px; border: 1px solid; align-items: center;">
			<div style="margin: 0 15px;">
				<label style="margin: 0 15px 0 0">Texto subfooter 3</label>
				<input name="footer_config[text-3]" class="regular-text" type="text" value="<?php if (isset($value['text-3'])){ echo $value['text-3']; }?>" />
			</div>
			<div style="margin: 0 15px;">
				<label style="margin: 0 15px 0 0">Enlace subfooter 3</label>
				<input name="footer_config[link_text-3]" class="regular-text" type="text" value="<?php if (isset($value['link_text-3'])){ echo $value['link_text-3']; }?>" />
				<div class="button button-primary" onclick="searchPostTypes('<?php echo $url; ?>', this)"><i class="dimaticon search"></i>Buscar</div>
			</div>	
		</div>
		<div class="wrap" style="display: flex; padding: 10px 15px; border: 1px solid; align-items: center;">
			<div style="margin: 0 15px;">
				<label style="margin: 0 15px 0 0">Texto subfooter 4</label>
				<input name="footer_config[text-4]" class="regular-text" type="text" value="<?php if (isset($value['text-4'])){ echo $value['text-4']; }?>" />
			</div>
			<div style="margin: 0 15px;">
				<label style="margin: 0 15px 0 0">Enlace subfooter 4</label>
				<input name="footer_config[link_text-4]" class="regular-text" type="text" value="<?php if (isset($value['link_text-4'])){ echo $value['link_text-4']; }?>" />
				<div class="button button-primary" onclick="searchPostTypes('<?php echo $url; ?>', this)"><i class="dimaticon search"></i>Buscar</div>
			</div>	
		</div>
		<div class="wrap" style="display: flex; padding: 10px 15px; border: 1px solid; align-items: center;">
			<div style="margin: 0 15px;">
				<label style="margin: 0 15px 0 0">Texto subfooter 5</label>
				<input name="footer_config[text-5]" class="regular-text" type="text" value="<?php if (isset($value['text-5'])){ echo $value['text-5']; }?>" />
			</div>
			<div style="margin: 0 15px;">
				<label style="margin: 0 15px 0 0">Enlace subfooter 5</label>
				<input name="footer_config[link_text-5]" class="regular-text" type="text" value="<?php if (isset($value['link_text-5'])){ echo $value['link_text-5']; }?>" />
				<div class="button button-primary" onclick="searchPostTypes('<?php echo $url; ?>', this)"><i class="dimaticon search"></i>Buscar</div>
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