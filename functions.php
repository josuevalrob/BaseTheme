<?php
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
?>
<?php
/*****************************Cargar jQuery*************/
function jQuery_init() {
	wp_enqueue_script('jquery');
}
add_action('init', 'jQuery_init');
?>
<?php
/**************************Miniaturas********************/

if(function_exists('add_theme_support')){
	add_theme_support('post-thumbnails');
}
?>

<?php 
/*****Subir SVG****/

function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

?>

<?php
/*************************Imágenes con categorías***************/

function wptp_add_categories_to_attachments() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}

add_action( 'init' , 'wptp_add_categories_to_attachments' );
?>
<?php
/*************************Páginas con categorías***************/

function wptp_add_categories_to_pages() {
    register_taxonomy_for_object_type( 'category', 'page' );
}

add_action( 'init' , 'wptp_add_categories_to_pages' );
?>
<?php
/******incluir dimaticons en admin******/

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
	echo '<link rel="stylesheet" href="'.get_stylesheet_directory_uri().'/css/fonts/dimaticons.css" type="text/css" media="all" />';
	echo '<link rel="stylesheet" href="'.get_stylesheet_directory_uri().'/css/fonts/custom.css" type="text/css" media="all" />';
}
 
add_action('after_setup_theme', 'remove_admin_bar'); 

function remove_admin_bar() {
	show_admin_bar(false);
}
?>

<?php
/*****Logo tema****/

function m1_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'm1_logo' );       
    $wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'm1_logo', array(
				'label'    => __( 'Upload Logo (replaces text)', 'm1' ),
				'section'  => 'title_tagline',
				'settings' => 'm1_logo',
			)
		)
	);
}

add_action( 'customize_register', 'm1_customize_register' );
?>
<?php
/******************Incluir Custom Post Types************************/
function custom_post_type_folder() {
	$url = get_theme_file_path().'/inc/custom_post_type';
	$dir = opendir($url);
	while (($filename = readdir($dir)) !== false) {	
		if ($filename != '.' && $filename != '..') {
			include $url.'/'.$filename;	 
		} 
	}
	closedir($dir);
};
 
custom_post_type_folder();
?>
<?php
/******************Incluir Shortcodes************************/
function shortcode_folder() {
	$url = get_theme_file_path().'/inc/shortcodes';
	$dir = opendir($url);
	while (($filename = readdir($dir)) !== false) {	
		if ($filename != '.' && $filename != '..') {
			include $url.'/'.$filename;	 
		} 
	}
	closedir($dir);
} 
shortcode_folder();
?>
<?php
/******************Incluir Taxonomias************************/

function taxonomy_folder() {
	$url = get_theme_file_path().'/inc/taxonomies';
	$dir = opendir($url);
	while (($filename = readdir($dir)) !== false) {	
		if ($filename != '.' && $filename != '..') {
			include $url.'/'.$filename;	 
		} 
	}
	closedir($dir);
} 

taxonomy_folder();
?>
<?php
/******************Incluir Sidebars************************/

function sidebar_folder() {
	$url = get_theme_file_path().'/inc/sidebars';
	$dir = opendir($url);
	while (($filename = readdir($dir)) !== false) {	
		if ($filename != '.' && $filename != '..') {
			include $url.'/'.$filename;	 
		} 
	}
	closedir($dir);
} 

sidebar_folder();
?>
<?php
/******************Incluir Config************************/
function config_folder() {
	$url = get_theme_file_path().'/config/pages';
	$dir = opendir($url);
	while (($filename = readdir($dir)) !== false) {	
		if ($filename != '.' && $filename != '..') {
			include($url.'/'.$filename);	 
		} 
	}
	closedir($dir);
} 

config_folder();
?>
<?php
/*******Config Menu******/
function config_theme(){
	add_menu_page('Configuración del Tema', 'Configuración del Tema', 'manage_options', 'theme-options', 'config_theme_landing', 'dashicons-admin-customizer', 20);
	add_submenu_page( 'theme-options', 'Opciones Generales', 'Opciones Generales', 'manage_options', 'theme-type', 'config_theme_type');
	add_submenu_page( 'theme-options', 'Opciones Cabecera', 'Opciones Cabecera', 'manage_options', 'theme-header', 'config_theme_header');
	add_submenu_page( 'theme-options', 'Opciones Slider', 'Opciones Slider', 'manage_options', 'theme-slider', 'config_theme_slider');
	add_submenu_page( 'theme-options', 'Opciones Sidebar', 'Opciones Sidebar', 'manage_options', 'theme-sidebar', 'config_theme_sidebar');
	add_submenu_page( 'theme-options', 'Opciones Footer', 'Opciones Footer', 'manage_options', 'theme-footer', 'config_theme_footer');
}
add_action('admin_menu', 'config_theme');
function config_theme_landing(){
	
	
	echo '<div class="wrap"><h2>Configuración Actual del Tema</h2></div>';
	$type = get_option('type_config');	
	echo '<div class="wrap"><h3>Opciones Generales</h3>';
	if (isset($type) && $type != "") {
		foreach($type as $key_type => $value_type){
			echo '<div style="display:flex; margin: 5px 20px;"><b style="margin-right:10px;">'.__($key_type, 'baseTheme').':</b>'.__($value_type, 'baseTheme').'</div>';
		}
	} else {
		echo 'No existen configuraciones Generales';
	}
	echo '</div>';
	$header = get_option('header_config');
	echo '<div class="wrap"><h3>Opciones Cabecera</h3>';
	if (isset($header) && $header != "") {
		foreach($header as $key_header => $value_header){		
			echo '<div style="display:flex; margin: 5px 20px;"><b style="margin-right:10px;">'.__($key_header, 'baseTheme').':</b>'.__($value_header, 'baseTheme').'</div>';
		}
	} else {
		echo 'No existen configuraciones asociadas al Header';
	}
	echo '</div>';
	$slider = get_option('slider_config');
	echo '<div class="wrap"><h3>Opciones Slider</h3>';
	if (isset($slider) && $slider != "") {
		foreach($slider as $key_slider => $value_slider){
			$clase = $key_slider;
			$class = explode("_", $clase);
			if ($clase == 'home') {
				$class = 'home prin';
			} elseif ($class[0] == 'home') {
				$class = 'home';
			} elseif ($clase == 'cat') {
				$class = 'cat prin';
			} else if ($class[0] == 'cat') {
				$class = 'cat';
			}
			echo '<div class="'.$class.'" style="display:flex; margin: 5px 20px;"><b style="margin-right:10px;">'.__($key_slider, 'baseTheme').':</b>'.__($value_slider, 'baseTheme').'</div>';
		}
	} else {
		echo 'No existen configuraciones asociadas al Slider';
	}
	echo '</div>';
	$sidebar = get_option('sidebar_config');
	echo '<div class="wrap"><h3>Opciones Sidebar</h3>';
	if (isset($sidebar) && $sidebar != "") {
		foreach($sidebar as $key_sidebar => $value_sidebar){				
			echo '<div style="display:flex; margin: 5px 20px;"><b style="margin-right:10px;">'.__($key_sidebar, 'baseTheme').':</b>'.__($value_sidebar, 'baseTheme').'</div>';
		}	
	} else {
		echo 'No existen configuraciones asociadas al Sidebar';
	}
	echo '</div>';
	$footer = get_option('footer_config');
	echo '<div class="wrap"><h3>Opciones del Pie de Página</h3>';
	if (isset($footer) && $footer != "") {
		foreach($footer as $key_footer => $value_footer){
			echo '<div style="display:flex; margin: 5px 20px;"><b style="margin-right:10px;">'.__($key_footer, 'baseTheme').':</b>'.__($value_footer, 'baseTheme').'</div>';
		}	
	} else {
		echo 'No existen configuraciones asociadas al Pie de Página';
	}
	echo '</div>';	
	echo '<script>
			jQuery("document").ready(function(){
				if(jQuery(".home.prin").length){
				} else {
					jQuery(".home").css("display", "none");
				}
				if(jQuery(".cat.prin").length){
					jQuery(".cat.prin").css("margin-top","40px");
				} else {
					jQuery(".cat").css("display", "none");
				}
			});
		</script>';
}
?>

<?php
function my_move_post () {
    global $menu;
	$positions = $menu;
	$menu = "";
	$i = 0;
	foreach ($positions as $position) {
		$menu[$i] = $position;
		$i = $i+10;
	}
	foreach ($menu as $key=>$value) {	
		
		if($value[2] == 'edit.php?post_type=portada') {			
			$portada = $key;
		} elseif($value[2] == 'edit.php?post_type=diapositiva') {			
			$diapositiva = $key;
		} elseif($value[2] == 'edit.php?post_type=pestana') {			
			$pestana = $key;
		} elseif($value[2] == 'edit.php') {			
			$post = $key;
		} elseif($value[2] == 'edit.php?post_type=page') {			
			$page = $key;
		} elseif($value[2] == 'upload.php') {			
			$media = $key;
		} elseif($value[2] == 'edit-comments.php') {			
			$comments = $key;
		}
		/****************Custom post type posición actual menú, hacer por cada custom post type que se quiera reordenar********/
		elseif($value[2] == 'edit.php?post_type=ejemplo') {			
			$ejemplo = $key;
		}
	}
	$menu[2] = $menu[$diapositiva];
	unset($menu[$diapositiva]);
	$menu[3] = $menu[$portada];
	unset($menu[$portada]);
	$menu[4] = $menu[$pestana];
	unset($menu[$pestana]);
	
	$menu[66] = $menu[$post];
	unset($menu[$post]);
	$menu[67] = $menu[$page];
	unset($menu[$page]);
	$menu[68] = $menu[$media];
	unset($menu[$media]);
	$menu[69] = $menu[$comments];
	unset($menu[$comments]);
	
	/************posición custom post type a reordenar se empieza desde el 11 hasta el 65*****/
	$menu[11] = $menu[$ejemplo];
	unset($menu[$ejemplo]);
}
add_action('admin_menu', 'my_move_post');
?>
<?php
load_theme_textdomain('baseTheme', get_template_directory().'/lang');
?>
<?php
/*Ajax Editor de Texto*/
add_action( 'wp_enqueue_scripts', 'ajax_test_enqueue_scripts' );
function ajax_test_enqueue_scripts() {
  wp_enqueue_script( 'editor-plugin', plugins_url( '/js/editor-plugin.js', __FILE__ ), array('jquery'), '1.0', true );
}
?>
<?php
/******************Editor de Texto***************/
function custom_mce_button() {  
  if ( !current_user_can( 'edit_posts' ) || !current_user_can( 'edit_pages' ) ) {
    return;
  }
  if ( 'true' == get_user_option( 'rich_editing' ) ) {
    add_filter( 'mce_external_plugins', 'custom_tinymce_plugin' );
    add_filter( 'mce_buttons', 'register_mce_button' );
  }
}
add_action('admin_head', 'custom_mce_button');
function custom_tinymce_plugin( $plugin_array ) {
  $plugin_array['custom_mce_button'] = get_template_directory_uri() .'/js/editor_plugin.js';
  return $plugin_array;
}
function register_mce_button( $buttons ) {
  array_push( $buttons, 'custom_mce_button' );
  return $buttons;
}
?>