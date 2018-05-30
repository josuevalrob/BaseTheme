<?php
/*Ruta desde carpeta a la raíz del wordpress*/
require_once('/../../../../../wp-load.php');
/*Recogemos categorías*/
$categorias = get_categories();
/*Formateamos el array para coger todas las categorías*/
$test['categoria'][0]['text'] =  'Todas las Categorías';
$test['categoria'][0]['value'] =  '';
$i = 1;
/*Recorremos recibidas categorías*/
foreach($categorias as $category){	
	/*Formateamos el array con el valor de cada categoría*/
	$test['categoria'][$i]['text'] =  $category->cat_name;
	$test['categoria'][$i]['value'] =  $category->slug;
	$i++;
}
/*Recogemos los tipos de entrada públicos*/
$pages = get_post_types(array('public'=>true));
$j=0;
/*Recorremos los tipos de entrada*/
foreach ($pages as $page) {
	/*Formateamos el array con el valor de cada tipo de entrada*/
	$test['entrada'][$j]['text'] = get_post_type_object($page)->labels->name;
	$test['entrada'][$j]['value'] = $page;
	$j++;
}
echo json_encode($test);
?>