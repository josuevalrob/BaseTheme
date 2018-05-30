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
$k = 0;
/*Contador para número de entradas a mostrar*/
while ($k < 10) {
	/*Formateamos el array con el valor para número de entradas a mostrar*/
	$test['mostrar'][$k]['text'] = $k + 1;
	$test['mostrar'][$k]['value'] = $k + 1;
	$k++;
}
$l = 0;
/*Contador para número de entradas a cargar*/
while ($l < 10) {
	/*Formateamos el array con el valor para número de entradas a cargar*/
	$test['cargar'][$l]['text'] = $l + 1;
	$test['cargar'][$l]['value'] = $l + 1;
	$l++;
}
/*Formateamos el array con el valor para cargar todas las entradas*/
$test['cargar'][$l]['text'] = Todas;
$test['cargar'][$l]['value'] = -1;
echo json_encode($test);
?>