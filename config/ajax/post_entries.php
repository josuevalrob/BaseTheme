<?php
/*Ruta desde carpeta a la raíz del wordpress*/
require_once('/../../../../../wp-load.php');
$post = $_GET["value"];
/*Recogemos los tipos de entrada públicos*/
$args = array(
	'post_type' => array(
		$post,
	),
);
$select = '<div id="postDiv" style="margin-top: 10px;"><label style="display: block;">Selecciona la entrada:</label><select id="postEntry"><option value="">Seleccione una entrada</option>';
$the_query = new WP_Query($args);
/*Recorremos las entradas*/
while ($the_query->have_posts()):$the_query->the_post();
	$select .= '<option value="'.get_the_permalink().'">'.get_the_title().'</option>';
endwhile;
$select .= '</select></div><div id="aceptar" style="margin-top: 10px;" class="button button-primary" onclick="saveLink()">Aceptar</div>';
echo $select;
?>