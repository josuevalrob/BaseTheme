<?php
/*Configuración de la cabecera*/
global $header_config;
/*Configuración del tema*/
global $type_config;
/*Configuración del pie de página*/
global $footer_config;
?>
<footer>
	<div id="subfooter">	
		<p>
			<?php
			/*Ponemos el contador a 0*/
			$n = 1;
			/*Recorremos los campos de texto del subfooter*/
			while ($n <= 5) {
				/*Comprobamos si tiene asociado un enlace*/
				if (isset($footer_config['link_text-'.$n]) && ($footer_config['link_text-'.$n] != '')) {
					?>
					<a href="<?php echo $footer_config['link_text-'.$n]?>">
					<?php
				}				
				/*Comprobamos si tiene asociado un texto*/
				if (isset($footer_config['text-'.$n]) && ($footer_config['text-'.$n] != '')) {
					echo $footer_config['text-'.$n];			
				}
				/*Comprobamos de nuevo si tiene asociado un enlace para cerrarlo*/
				if (isset($footer_config['link_text-'.$n]) && ($footer_config['link_text-'.$n] != '')) {
					?>
					</a>
					<?php
				}
				/*Incrementamos el contador*/
				$n++;
			}
			?>
		</p>
		<p>
			©<?php date_default_timezone_set('UTC');echo date("Y").' ';?> <?php bloginfo('name'); ?>/Todos los derechos reservados
		</p>
	</div>
	<script>
		<?php
		/*Comprobamos si está activada la cabecera animada*/
		if ($header_config['sticky'] == 'active') {
			/*Llamamos a la función de cabecera animada*/
			?>
			stickyHeader();
			<?php
		}
		/*Comprobamos si está activada la flecha para volver arriba*/
		if ($type_config['backtop'] == 'active') {
			/*Llamamos a la función de la flecha para volver arriba*/
			?>
			backTop();
			<?php
		}
		/*Comprobamos si están activadas las flechas de siguiente ancla*/
		if ($type_config['theme_arrows'] == 'active') {
			/*Llamamos a la función de las flechas de siguiente ancla*/
			?>
			nextAnchor();
			<?php
		}
		?>
	</script>
	<?php
	/*Cargamos el footer de wordpress*/
	wp_footer();
	?>	
</footer>
</body>
</html>