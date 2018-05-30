<?php
/*Ruta desde carpeta a la raíz del wordpress*/
require_once('/../../../../../wp-load.php');
$input = $_GET["hidden"];
/*Recogemos los tipos de entrada públicos*/
$pages = get_post_types(array('public'=>true));
$url = get_template_directory_uri();
/*Recorremos los tipos de entrada*/
$select = '<input id="postInput" type="hidden" value="'.$input.'">';
$select .= '<div><label style="display: block;">Selecciona el tipo de entrada:</label><select onchange="searchPostEntries(&#39;'.$url.'&#39;, this.value)" id="postType"><option value="">Seleccione un tipo de entrada</option>';
foreach ($pages as $page) {
	/*Formateamos el array con el valor de cada tipo de entrada*/
	$select .= '<option value="'.$page.'">'.get_post_type_object($page)->labels->name.'</option>';
}
$select .= '</select></div>';
echo $select;
?>