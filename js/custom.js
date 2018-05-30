/****************************************************************************************/
/****************************************************************************************/
/*************************************GENERALES******************************************/
/****************************************************************************************/
/****************************************************************************************/

/*Click sobre la imagen del logo hace el mismo efecto que sobre el link, no es necesario pero corrige posibles fallos que se puedan dar*/
jQuery(document).ready(function(){
	document.getElementById('logo').addEventListener('click', function() {
		jQuery("#enlacelogo").click();
	});
});

/*Función de limpieza de anclas, deja una url más amigable Revisar y añadir altura del header*/
jQuery(document).ready(function(){
	/*Click sobre enlace con ancla*/
    jQuery('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function (event) {
    	if ( location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname ) {
			// Figure out element to scroll to
			var target = jQuery(this.hash);c
			target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
            // Does a scroll target exist?
            if (target.length) {
				// Only prevent default if animation is actually gonna happen
                event.preventDefault();
                var header = jQuery('header').outerHeight();
		        jQuery('html, body').animate({ scrollTop: target.offset().top - header  }, 1000, function () {
					// Callback after animation
                    // Must change focus!
                    var $target = jQuery(target);
                    $target.focus();
                    if ($target.is(":focus")) { // Checking if the target was focused
                    	return false;
                    } else {
						$target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
						$target.focus(); // Set focus again
					}
				});
			}
		}
	});          
});



/*Función para navegar a la siguiente ancla*/
function nextAnchor() {
	jQuery('.nextAnchor').click(function(){
		var position = jQuery(this).parent().next().position();
		//counter();
		var header = jQuery('header').outerHeight();
		jQuery('html, body').animate( {scrollTop : position.top - header}, 500 );
	});
}
/*Función para ayuda a maquetación cuando Sidebar derecho está activo*/
function sidebarRight() {
	jQuery("body").addClass("sidebarRight");
}
/*Función para ayuda a maquetación cuando Sidebar izquierdo está activo*/
function sidebarLeft() {
	jQuery("body").addClass("sidebarLeft");
}
/*Función para situar el sidebar en el pie de página*/
function sidebarFooter() {
	jQuery(document).ready(function(){
		jQuery("footer").prepend(jQuery("#sidebarfooter"));
	});
}
/*Función para situar el sidebar en la cabecera*/
function sidebarHeader() {
	jQuery(document).ready(function(){
		jQuery("header").append(jQuery("#headerWidget"));
	});
}
/*Función para desplegar y encoger la barra de búsqueda*/
function searchButton() {
	jQuery("#searchbutton").click(function(){
        jQuery("#searchform").toggle("500");
    });
}
/*Función para que la cabecera sea animada cuando se hace scroll*/
function stickyHeader() {
	jQuery(window).scroll(function (e) {
		var height = jQuery(window).scrollTop();
		if (height > 1) {
            jQuery("header").removeClass("headerFloat").addClass("headerFix");
			jQuery("body").addClass("headerFix");		
        } else {			
			jQuery("header").removeClass("headerFix").addClass("headerFloat");
			jQuery("body").removeClass("headerFix");		
        }
	});
}
/*Función para mostrar la flecha de volver a arriba y animar el click*/
function backTop() {
	jQuery(window).scroll(function (e) {
		var height = jQuery(window).scrollTop();
		if (height > 1) {			
            jQuery(".backtop").css("bottom", "0");			
        } else {
            jQuery(".backtop").css("bottom", "-100px");			
        }
	});
	jQuery(".backtop").click(function(){
		jQuery('html, body').animate( {scrollTop : 0}, 500 );
	});
}

/****************************************************************************************/
/****************************************************************************************/
/*************************************SHORTCODES*****************************************/
/****************************************************************************************/
/****************************************************************************************/


/*Función para Shortcode Dropdown*/
function ShowContent(div) {
	if (jQuery(div).find(".content").hasClass('Expanded')) {
		jQuery(div).find(".content").removeClass('Expanded');
		jQuery(div).find(".dimaticon").removeClass('chevron-up').addClass('chevron-down');
	} else {
		jQuery(div).find(".content").addClass('Expanded');
		jQuery(div).find(".dimaticon").removeClass('chevron-down').addClass('chevron-up');

	}
}
/****************AREGLAR FUNCIÓN DEL CONTADOR************/
// var executed = false;
// function counter() {
// 	if (!executed){
// 		executed = true;
// 		jQuery('.count').each(function () {			
// 			jQuery(this).prop('Counter',0).animate({
// 				Counter: jQuery(this).text()    
// 			}, {
// 				duration: 2000,
// 				easing: 'swing',
// 				step: function (now) {
// 					jQuery(this).text(Math.ceil(now));
// 				}					
// 			});
// 		});	
// 	}
// }


/****************************************************************************************/
/****************************************************************************************/
/*************************************ANIMACIONES****************************************/
/****************************************************************************************/
/****************************************************************************************/
/*Inicializando Aos */ 
// All you have to do is to add data-aos attribute to html element, like so:
//   <div data-aos="animation_name">
jQuery(document).ready(function(){
	AOS.init({
		offset: 0,
		duration: 800,
		//delay: 10,
	});
});