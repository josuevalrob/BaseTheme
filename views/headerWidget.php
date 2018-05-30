<?php
/*Recogemos el ID del sidebar activo*/
global $sidebarHeader;
?>
<div id="headerWidget">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebarHeader) ) : ?>
	<?php endif; ?>
</div>
<script type="text/javascript">
	/*Función que pone el sidebar en el footer*/
	sidebarHeader();
</script>