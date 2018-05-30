<?php
/*Shortcode Contador*/
function counter_shortcode($atts) {
	/*Obtenemos número*/
	$number = $atts["number"];
	/*Obtenemos símbolo*/
	$symbol = $atts["symbol"];
	/*Obtenemos texto*/
	$text = $atts["text"];
	/*Obtenemos unidad*/
	$unit = $atts["unit"];
	/*Obtenemos clase CSS*/
	$class = $atts["class"];
	/*Devolvemos HTMl que construlle el contador*/
	$salida = 	'<div class="Counter '.$class.'">
					<div class="stats-desc">
						'.$symbol.'
						<span class="count">'.$number.'</span>
						'.$unit.'
					</div>
					<div class="stats-text ult-responsive Indicador">
						'.$text.'
					</div>
				</div>';
	return $salida;
}
add_shortcode('counter', 'counter_shortcode');
?>