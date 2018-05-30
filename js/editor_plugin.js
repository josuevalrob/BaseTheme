(function() {
	tinymce.PluginManager.add('custom_mce_button', function(editor, url) {
		/*URL relativa a la carpeta del tema*/
		var baseUrl = url.split('js')[0] + 'inc/shortcodes_ajax';
		/*Url de la imagen*/
		var imgUrl = url.split('js')[0] + 'img/ajax-loader.gif';
		/*Div imagen cargando*/
		var loader = '<div id="loader" style="background-color: rgba(0,0,0,0.3);position: absolute; left: 0; right: 0; top: 0; bottom: 0; display: flex; justify-content: center; align-items: center; z-index:9999999;"><img src="'+imgUrl+'"></div>';
		/*Añadimos botón al editor*/
    	editor.addButton('custom_mce_button', {			
			type: 'menubutton', /*Botón de tipo desplegable*/
            icon: 'false',
            text: 'Insertar Elemento',
			menu: [
				/*Elemento Nube*/
				{
					text: 'Nube de Logos',
					onclick: function(){
						/*Ajax para recoger categorías y tipos de entrada*/
						jQuery.ajax({
							type : 'get',
							dataType: 'json',
							url: baseUrl + '/nube_ajax.php',
							beforeSend: function(){
								/*Pintamos spìnner cargando*/
								jQuery('body').append(loader);
							},
							error: function(response){
								console.log(response);
								/*Avisamos de que se ha producido un error*/
								var categorias = 'Se ha producido un error en la carga';
								alert(categorias);
								/*Borramos spìnner cargando*/
								jQuery('#loader').remove();
							},
							success: function(response) {
								/*Borramos spìnner cargando*/
								jQuery('#loader').remove();
								/*Popup de nube*/
								editor.windowManager.open({
									title: 'Insertar Nube de Logos',
									body: [
										{
										type: 'listbox',
										name: 'categories',
										label: 'Categorías',
										values:
												response.categoria /*json de categorías obtenido del ajax*/

										},
										{
											type: 'listbox',
											name: 'post',
											label: 'Tipo de Entrada',
											values: 
											response.entrada /*json de tipos de entrada obtenido del ajax*/

										},
										{
											type: 'textbox',
											name: 'delay',
											label: 'Retardo de entradas en milisegundos',							
										},
										{
											type: 'textbox',
											name: 'cssclass',
											label: 'Estilo CSS',							
										},
									],
									onsubmit: function(e) {
										editor.insertContent(
											/*pintamos shortcode nube con las variables*/
											'[nube category="' + e.data.categories + '" post="' + e.data.post + '" delay="' + e.data.delay + '" class="' + e.data.cssclass + '"]' + editor.selection.getContent()
										);
									}
								});
							}
						});					
					}
				},
				/*Elemento Carousel*/
				{
					text: 'Carrousel',
					onclick: function() {
						/*Ajax para recoger categorías, tipos de entrada y número de elementos*/
						jQuery.ajax({
							type : 'get',
							dataType: 'json',
							url : baseUrl + '/carousel_ajax.php',
							beforeSend: function(){
								/*Pintamos spìnner cargando*/
								jQuery('body').append(loader);
							},
							error: function(response){
								/*Avisamos de que se ha producido un error*/
								console.log(response);							   
								var categorias = 'Se ha producido un error en la carga';
								alert(categorias);
								/*Borramos spìnner cargando*/
								jQuery('#loader').remove();
							},
							success: function(response) {
								/*Borramos spìnner cargando*/
								jQuery('#loader').remove();
								/*Popup de carousel*/
								editor.windowManager.open({
									title: 'Insertar Carrousel',
									body: [ 
										{
											type: 'listbox',
											name: 'categories',
											label: 'Categorías',
											values: response.categoria /*json de categorías obtenido del ajax*/
										},
										{
											type: 'listbox',
											name: 'post',
											label: 'Tipo de Entrada',
											values: response.entrada /*json de tipos de entrada obtenido del ajax*/
										},
										{
											type: 'listbox',
											name: 'pagination',
											label: 'Paginación',
											values: [
												{
													text: 'Sí',
													value: 'true'
												}, {
													text: 'No',
													value: 'false'
												}
											]
										}, 
										{
											type: 'listbox',
											name: 'navigation',
											label: 'Navegación',
											values: [
												{
													text: 'Sí',
													value: 'true'
												}, {
													text: 'No',
													value: 'false'
												}
											]
										},
										{
											type: 'listbox',
											name: 'position',
											label: 'Posición Diapositiva Activa',
											values: [{
												text: 'Izquierda',
												value: 'false'
											}, {
												text: 'Centro',
												value: 'true'
											}]
										},
										{
											type: 'listbox',
											name: 'size',
											label: 'Número de Entradas a Cargar',
											values: response.cargar /*json de número de elementos obtenido del ajax*/
										},
										{
											type: 'listbox',
											name: 'show',
											label: 'Número de Diapositivas a Mostrar',
											values: response.mostrar /*json de número de elementos obtenido del ajax*/
										},
										{
											type: 'textbox',
											name: 'cssclass',
											label: 'Estilo CSS',							
										},
									],
									onsubmit: function(e) {
										/*pintamos shortcode carrousel con las variables*/
										editor.insertContent(
											'[carrousel	category="' + e.data.categories + '"	post="' + e.data.post + '" dots="' + e.data.pagination + '"	arrows="' + e.data.navigation + '" center="' + e.data.position + '"	size="' + e.data.size + '" show="' + e.data.show + '" class="' + e.data.cssclass + '" ]' + editor.selection.getContent()
										);
									}
								});
							}
						});
					}
				},
				/*Elemento Timeline*/
				{
					text: 'Linea Temporal',
					onclick: function(){
						/*Ajax para recoger categorías*/
						jQuery.ajax({
							type : 'get',
							dataType: 'json',
							url : baseUrl + '/timeline_ajax.php',
							beforeSend: function(){
								/*Pintamos spìnner cargando*/
								jQuery('body').append(loader);
							},
							error: function(response){
								/*Avisamos de que se ha producido un error*/
								console.log(response);							   
								var categorias = 'Se ha producido un error en la carga';
								alert(categorias);
								/*Borramos spìnner cargando*/
								jQuery('#loader').remove();
							},
							success: function(response) {
								/*Borramos spìnner cargando*/
								jQuery('#loader').remove();
							   	/*Popup de timeline*/
								editor.windowManager.open({
									title: 'Insertar Timeline',
									body: [
										{
										type: 'listbox',
										name: 'categories',
										label: 'Categorías',
										values:
												response.categoria /*json de categorías obtenido del ajax*/
										},										
										{
											type: 'textbox',
											name: 'cssclass',
											label: 'Estilo CSS',							
										},
									],
									onsubmit: function(e) {
										/*pintamos shortcode timeline con las variables*/
										editor.insertContent(
											'[timeline	category="' + e.data.categories + '" class="' + e.data.cssclass + '" ]' + editor.selection.getContent()
										);
									}
								});
							}
						});					
					}
				},
				/*Elemento Dropdown*/
				{
					text: 'Lista Desplegable',
					onclick: function(){
						/*Ajax para recoger categorías y tipos de entrada*/
						jQuery.ajax({
							type : 'get',
							dataType: 'json',
							url: baseUrl + '/dropdown_ajax.php',
							beforeSend: function(){
								/*Pintamos spìnner cargando*/
								jQuery('body').append(loader);
							},
							error: function(response){
								/*Avisamos de que se ha producido un error*/
								console.log(response);							   
								var categorias = 'Se ha producido un error en la carga';
								alert(categorias);
								/*Borramos spìnner cargando*/
								jQuery('#loader').remove();
							},
							success: function(response) {
								/*Borramos spìnner cargando*/
								jQuery('#loader').remove();
							   	/*Popup de dropdown*/
								editor.windowManager.open({
									title: 'Insertar Lista Desplegable',
									body: [
										{
											type: 'listbox',
											name: 'categories',
											label: 'Categorías',
											values:
											response.categoria /*json de categorías obtenido del ajax*/

										},
										{
											type: 'listbox',
											name: 'post',
											label: 'Tipo de Entrada',
											values:  
											response.entrada /*json de tipos de entrada obtenido del ajax*/

										},
										{
											type: 'textbox',
											name: 'cssclass',
											label: 'Estilo CSS',							
										},
									],
									onsubmit: function(e) {
										/*pintamos shortcode dropdown con las variables*/
										editor.insertContent(
											'[dropdown	category="' + e.data.categories + '" post="' + e.data.post + '" class="' + e.data.cssclass + '"]' + editor.selection.getContent()
										);
									}
								});
							}
						});					
					}
				},
				/*Elemento botones*/
				{				
					text: 'Botones',
					onclick: function() {
						editor.insertContent(
							/*pintamos shortcode botones*/
							'[botones]' +
							editor.selection
							.getContent()
						);
					}
				},
				/*Elemento ver-mas*/
				{				
					text: 'Ver Más',
					onclick: function() {
						editor.insertContent(
							/*pintamos shortcode ver-mas*/
							'[ver-mas]' +
							editor.selection
							.getContent()
						);
					}
				},
				/*Elemento counter*/
				{				
					text: 'Contador',
					onclick: function() {
						/*Popup de counter*/
						editor.windowManager.open({
							title: 'Insertar Contador',
							body: [
								{
									type: 'textbox',
									name: 'symbol',
									label: 'Símbolo Matemático',							
								},{
									type: 'textbox',
									name: 'number',
									label: 'Número',							
								},{
									type: 'textbox',
									name: 'unit',
									label: 'Unidad',							
								},{
									type: 'textbox',
									name: 'text',
									label: 'Texto Asociado',							
								},{
									type: 'textbox',
									name: 'class',
									label: 'Clase CSS',							
								},
							],
							onsubmit: function(e) {
								editor.insertContent(
									/*pintamos shortcode counter con las variables*/
									'[counter symbol="' + e.data.symbol + '" number="' + e.data.number + '" unit="' + e.data.unit + '" text="' + e.data.text + '" class="' + e.data.class+ '"]' + 									editor.selection.getContent()
								);
							}
						});
					}
				}
			],							
        });
    });
})();
