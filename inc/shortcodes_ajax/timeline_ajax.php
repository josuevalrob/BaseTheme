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
echo json_encode($test);
?>