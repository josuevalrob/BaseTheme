<?php
/*Recogemos el ID del sidebar activo*/
global $sidebarLeft;
?>
<section id="sidebarLeft" class="sidebar">
	<?php /*Comprobamos si están activados los sidebars y pintamos el sidebar activo*/
	if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebarLeft)) : ?>
	<?php endif; ?> 	
</section>
<script type="text/javascript">
	/*Función que añade clase al body para maquetación automática del sidebar*/
	sidebarLeft();
</script>