<?php
/*Añadimos las opciones de la página de configuración de Slider*/
function slider_settings() {
	add_option( 'slider_config', 'Opciones de Configuración del Slider');
	/*Registrar opciones de configuración*/
	register_setting( 'slider_option', 'slider_config', 'slider_callback' );
}
add_action( 'admin_init', 'slider_settings' );
function config_theme_slider(){
?>
	<div class="wrap">
		<h2>Activar Slider</h2>
	</div>
	<form action="options.php" method="post">
		<?php
		/*Declaramos la página*/
		settings_fields( 'slider_option' );
		/*Cargar opciones de configuración*/
		$value = get_option('slider_config');
		?>
		<div class="wrap">
			<div>
				<h3>Slider Página Principal</h3>
				<label>Activar Slider en Página Principal</label>
				<input id="slider_home" class="slider_check"  name="slider_config[home]" type="checkbox" value="active" <?php if (isset($value['home']) && ($value['home'] == 'active')){ echo 'checked'; } ?> />
				<div class="slider_options">
					<div>
						<label>Activar paginado por puntos</label>
						<input name="slider_config[home_dots]" type="checkbox" value="active" <?php if (isset($value['home_dots']) && ($value['home_dots'] == 'active')){ echo 'checked'; } ?> />
					</div>
					<div>
						<label for="slider_config[home_dots_style]">Estilo de la Paginación</label>
						<select class="large-text" name="slider_config[home_dots_style]">
							<option value="dotCirculos" <?php if (isset($value['home_dots_style']) && ($value['home_dots_style'] == 'dotCirculos')){ echo 'selected'; } ?>>Círculos</option>
							<option value="dotCircunferencias" <?php if (isset($value['home_dots_style']) && ($meta['home_dots_style'] == 'dotCircunferencias')){ echo 'selected'; } ?>>Circunferencias</option>
							<option value="dotRayasVerticales" <?php if (isset($value['home_dots_style']) && ($value['home_dots_style'] == 'dotRayasVerticales')){ echo 'selected'; } ?>>Rayas Verticales</option>
							<option value="dotRayasHorizontales" <?php if (isset($value['home_dots_style']) && ($value['home_dots_style'] == 'dotRayasHorizontales')){ echo 'selected'; } ?>>Rayas Horizontales</option>
							<option value="dotCuadrados" <?php if (isset($value['home_dots_style']) && ($value['home_dots_style'] == 'dotCuadrados')){ echo 'selected'; } ?>>Cuadrados</option>
							<option value="dotHexagonos" <?php if (isset($value['home_dots_style']) && ($value['home_dots_style'] == 'dotHexagonos')){ echo 'selected'; } ?>>Hexágonos</option>
						</select>
					</div>
					<div>
						<label>Activar flechas</label>
						<input name="slider_config[home_arrows]" type="checkbox" value="active" <?php if (isset($value['home_arrows']) && ($value['home_arrows'] == 'active')){ echo 'checked'; } ?> />
					</div>
					<div>
						<label for="slider_config[home_arrows_style]">Estilo de las Flechas</label>
						<select class="large-text" name="slider_config[home_arrows_style]">
							<option value="arrowCirculos" <?php if (isset($value['home_arrows_style']) && ($value['home_arrows_style'] == 'arrowCirculos')){ echo 'selected'; } ?>>Círculos</option>
							<option value="arrowCircunferencias" <?php if (isset($value['home_arrows_style']) && ($value['home_arrows_style'] == 'arrowCircunferencias')){ echo 'selected'; } ?>>Circunferencias</option>
							<option value="arrowVerticales" <?php if (isset($value['home_arrows_style']) && ($value['home_arrows_style'] == 'arrowVerticales')){ echo 'selected'; } ?>>Rayas Verticales</option>
							<option value="arrowCuadrado" <?php if (isset($value['home_arrows_style']) && ($value['home_arrows_style'] == 'arrowCuadrado')){ echo 'selected'; } ?>>Cuadrado</option>
							<option value="arrowHexagonos" <?php if (isset($value['home_arrows_style']) && ($value['home_arrows_style'] == 'arrowHexagonos')){ echo 'selected'; } ?>>Hexágonos</option>
						</select>
					</div>
					<div>
						<label>Activar AutoPlay</label>
						<input name="slider_config[home_autoplay]" type="checkbox" value="active" <?php if (isset($value['home_autoplay']) && ($value['home_autoplay'] == 'active')){ echo 'checked'; } ?> />
					</div>
					<div>
						<label>Duración Diapositiva en milisegundos</label>
						<input name="slider_config[home_autoplaySpeed]" type="number" value="<?php if (isset($value['home_autoplaySpeed'])){ echo $value['home_autoplaySpeed']; } ?>"  />
					</div>
					<div>
						<label>Activar PauseOnHover</label>
						<input name="slider_config[home_pauseonhover]" type="checkbox" value="active" <?php if (isset($value['home_pauseonhover']) && ($value['home_pauseonhover'] == 'active')){ echo 'checked'; } ?> />
					</div>
				</div>	
			</div>
			<div>			
				<h3>Slider Página de Categoría</h3>
				<label>Slider por Categoría</label>
				<input id="slider_cat" class="slider_check" name="slider_config[cat]" type="checkbox" value="active" <?php if (isset($value['cat']) && ($value['cat'] == 'active')){ echo 'checked'; } ?> />
				<div class="slider_options">
					<div>
						<label>Activar paginado por puntos</label>
						<input name="slider_config[cat_dots]" type="checkbox" value="active" <?php if (isset($value['cat_dots']) && ($value['cat_dots'] == 'active')){ echo 'checked'; } ?> />
					</div>
					<div>
						<label for="slider_config[cat_dots_style]">Estilo de la Paginación</label>
						<select class="large-text" name="slider_config[cat_dots_style]">
							<option value="dotCirculos" <?php if (isset($value['cat_dots_style']) && ($value['cat_dots_style'] == 'dotCirculos')){ echo 'selected'; } ?>>Círculos</option>
							<option value="dotCircunferencias" <?php if (isset($value['cat_dots_style']) && ($value['cat_dots_style'] == 'dotCircunferencias')){ echo 'selected'; } ?>>Circunferencias</option>
							<option value="dotRayasVerticales" <?php if (isset($value['cat_dots_style']) && ($value['cat_dots_style'] == 'dotRayasVerticales')){ echo 'selected'; } ?>>Rayas Verticales</option>
							<option value="dotRayasHorizontales" <?php if (isset($value['cat_dots_style']) && ($value['cat_dots_style'] == 'dotRayasHorizontales')){ echo 'selected'; } ?>>Rayas Horizontales</option>
							<option value="dotCuadrados" <?php if (isset($value['cat_dots_style']) && ($value['cat_dots_style'] == 'dotCuadrados')){ echo 'selected'; } ?>>Cuadrados</option>
							<option value="dotHexagonos" <?php if (isset($value['cat_dots_style']) && ($value['cat_dots_style'] == 'dotHexagonos')){ echo 'selected'; } ?>>Hexágonos</option>
						</select>
					</div>
					<div>
						<label>Activar flechas</label>
						<input name="slider_config[cat_arrows]" type="checkbox" value="active" <?php if (isset($value['cat_arrows']) && ($value['cat_arrows'] == 'active')){ echo 'checked'; } ?> />
					</div>
					<div>
						<label for="slider_config[cat_arrows_style]">Estilo de las Flechas</label>
						<select class="large-text" name="slider_config[cat_arrows_style]">
							<option value="arrowCirculos" <?php if (isset($value['cat_arrows_style']) && ($value['cat_arrows_style'] == 'arrowCirculos')){ echo 'selected'; } ?>>Círculos</option>
							<option value="arrowCircunferencias" <?php if (isset($value['cat_arrows_style']) && ($value['cat_arrows_style'] == 'arrowCircunferencias')){ echo 'selected'; } ?>>Circunferencias</option>
							<option value="arrowVerticales" <?php if (isset($value['cat_arrows_style']) && ($value['cat_arrows_style'] == 'arrowVerticales')){ echo 'selected'; } ?>>Rayas Verticales</option>
							<option value="arrowCuadrado" <?php if (isset($value['cat_arrows_style']) && ($value['cat_arrows_style'] == 'arrowCuadrado')){ echo 'selected'; } ?>>Cuadrado</option>
							<option value="arrowHexagonos" <?php if (isset($value['cat_arrows_style']) && ($value['cat_arrows_style'] == 'arrowHexagonos')){ echo 'selected'; } ?>>Hexágonos</option>
						</select>
					</div>
					<div>
						<label>Activar AutoPlay</label>
						<input name="slider_config[cat_autoplay]" type="checkbox" value="active" <?php if (isset($value['cat_autoplay']) && ($value['cat_autoplay'] == 'active')){ echo 'checked'; } ?> />
					</div>
					<div>
						<label>Duración Diapositiva en milisegundos</label>
						<input name="slider_config[cat_autoplaySpeed]" type="number" value="<?php if (isset($value['cat_autoplaySpeed'])){ echo $value['cat_autoplaySpeed']; } ?>"  />
					</div>
					<div>
						<label>Activar PauseOnHover</label>
						<input name="slider_config[cat_pauseonhover]" type="checkbox" value="active" <?php if (isset($value['cat_pauseonhover']) && ($value['cat_pauseonhover'] == 'active')){ echo 'checked'; } ?> />
					</div>
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
	<script>
		jQuery(document).ready(function() {
			/*Recorremos rodos los checkbox de slider*/
			jQuery('.slider_check').each(function(){
				/*Comprobamos los checkbox activos*/
				if (jQuery(this).is(':checked')){
					/*Mostramos las opciones del sidebar*/
					jQuery(this).siblings('.slider_options').addClass('show');
				}
			})
			/*Detectamos un cambio en el checkbox de slider*/
			jQuery('.slider_check').change(function() {
				/*Comprobamos si el checkbox está activo*/
				if (jQuery(this).is(':checked')){
					/*Mostramos las opciones*/
					jQuery(this).siblings('.slider_options').addClass('show');
				} else {
					/*Ocultamos las opciones*/
					jQuery(this).siblings('.slider_options').removeClass('show');
				}  
			});
		});
	</script>
	<style>
		.slider_options {
			display: none;
		}
		.slider_options.show {
			display: flex;
			flex-wrap: wrap;
			border: 1px solid;
			margin: 15px;
			padding: 2px;
			justify-content: flex-start;
		}
		.slider_options.show > div {
			margin: 2px 10px;
			padding: 5px 10px;
			display: flex;
			align-items: center;
		}
		.slider_options.show label {
			margin: 0 5px 0 0;
		}
	</style>
<?php
}
?>