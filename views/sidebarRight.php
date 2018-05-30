<?php
/*Recogemos el ID del sidebar activo*/
global $sidebarRight;
?>
<section id="sidebarRight" class="sidebar">
	<?php /*Comprobamos si están activados los sidebars y pintamos el sidebar activo*/
	if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebarRight)) : ?>
	<?php endif; ?> 
</section>
<script type="text/javascript">
	/*Función que añade clase al body para maquetación automática del sidebar*/
	sidebarRight();
</script>