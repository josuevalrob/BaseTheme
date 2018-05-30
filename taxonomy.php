<?php
get_header();
$value = get_option('type_config');
?>
<?php
$slider = get_option('slider_config');
if ($slider['tax'] == 'active') {
	get_template_part( 'views/sliderTax');
}
?>
<section id="main">
<?php
if($value['theme'] == 'tabNavigation' ){	
	get_template_part( 'views/taxonomyTab');
} else {
	get_template_part( 'views/taxonomy');	
}
?>
</section>
<?php
get_footer();
?>

