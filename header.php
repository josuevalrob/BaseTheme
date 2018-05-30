<!DOCTYPE html>
<html>
<head>
    <?php
        $titulo = get_bloginfo('name');
        $contenido = get_bloginfo('description');
        if (is_category()) {
            $titulo = get_the_category()[0]->name;
            $contenido = get_bloginfo('name');
        } elseif (is_single() || is_page()) {
            $titulo = get_the_title();
            $contenido = get_bloginfo('name');
        }
	/*Configuraciones Generales del Tema. Se cargan con global en el resto dwe*/
	/*Configuración General*/
	global $type_config;
	$type_config = get_option('type_config');
	/*Configuración Cabecera*/
	global $header_config;
	$header_config = get_option('header_config');
	/*Configuración Categorías a mostrar en Menú de cabecera*/
	global $header_cats;
	$header_cats = get_option('header_cat');
	/*Configuración Pie de Página*/
	global $footer_config;
	$footer_config = get_option('footer_config');
	/*Configuración Slider*/
	global $slider_config;
	$slider_config = get_option('slider_config');
	/*Configuración Sidebar Activados*/
	global $sidebar_id;
	$sidebar_id = get_option('sidebar_id');
	/*Configuración Sidebar*/
	global $sidebar_config;
	$sidebar_config = get_option('sidebar_config');
	
    ?>
    <meta name="description" content="<?php echo $titulo.' - '.$contenido?>"/>
    <meta name="robots" content="index,follow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, minimum-scale=1"/>
    <meta charset="utf-8"/>
    
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
    <title>
        <?php
        if (is_home()) {
            bloginfo('name');
			echo ' – ';
            bloginfo('description');
        } elseif (is_category()) {
            single_cat_title();
            echo ' – ';
            bloginfo('name');
        } elseif (is_single() || is_page()) {
            single_post_title();
            echo ' – ';
            bloginfo('name');
        } elseif (is_search()) {
            bloginfo('name');
            echo 'Resultados de la búsqueda: ';
            echo wp_specialchars($s);
        } else {
            bloginfo('name');
			echo ' – ';
            bloginfo('description');
        }
        ?>
    </title>
   
    <!-- CSS del Tema -->
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" media="all"/>
    <!-- CSS editable -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/basetheme.css" rel="stylesheet" type="text/css" media="all" />
    
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/fonts/dimaticons.css" rel="stylesheet" type="text/css"/>
    
    <!-- CSS a incluir en basetheme -->       
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/slick.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/slick-theme.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/jtline.css" rel="stylesheet" type="text/css"/>
    
    <!-- Aos scroll animation library -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/aos/dist/aos.css" />
    
    
     <?php 
	wp_head();
	?>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/aos/dist/aos.js"></script>

    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/slick.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.timelinr-0.9.6.js"></script>

    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/custom.js"></script>
</head>
<body>
	<header class="headerFloat">
		<?php		
		if ($header_config['logo'] == 'active') {
		?>
			<a id="enlacelogo" href="<?php echo bloginfo('url'); ?>">
				<img id="logo" src="<?php echo get_theme_mod( 'm1_logo' );?>"/>
			</a>
		<?php
		}
		?>
		<?php
		if ($header_config['title'] == 'active') {
		?>
			<a id="enlacetitle" href="<?php echo bloginfo('url'); ?>">
				<h1><?php echo bloginfo('name');?></h1>
			</a>
		<?php
		}
		?>
		<!-- Import header
		headerCat trae un header con el menú de las categorias
		headerWidget trae un header con el menú sidebar customizable en los widgets.  -->
		<?php			
		if ($header_config['menu'] == 'catHead') {
			get_template_part( 'views/headerCat');
		} elseif ($header_config['menu'] == 'widgetHead') {
			get_template_part( 'views/headerWidget');
		}
		?>
		<?php
		if ($header_config['search'] == 'active') {
		?>
		<div class="menudiv searchform">
			 <i id="searchbutton" class="dimaticon search"></i>     
		</div>
		<?php
		}
		?>
	</header>
	<?php
	if ($type_config['backtop'] == 'active'){
	?>
		<div class="backtop" title="Volver arriba">
			<i class="dimaticon chevron-up"></i>
		</div>
	<?php
	}
	?>

