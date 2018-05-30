
	<?php		
	$category = get_category( get_query_var( 'cat' ) );
	$cat_id = $category->cat_ID;
	$argscat = array(
		'post_type' => array(
			'pestana',
		),
		'cat' => $cat_id,
		'meta_key' => 'pestana_orden',		
		'orderby'=>array(
			'pestana_orden' => 'ASC',
			'title' => 'ASC'
		),
	);
	?>
	<script>		
		var paging = [];
	</script>
	<?php
	$the_querycat = new WP_Query($argscat);
	if ($the_querycat->have_posts()){
		while ($the_querycat->have_posts()):$the_querycat->the_post();
			?>
			<script>		
				paging.push('<?php the_title();?>');
			</script>
			<?php
		endwhile;
		?>
		<div class="cuerpotabs">		
		<?php
		while ($the_querycat->have_posts()):$the_querycat->the_post();
			?>
			<div class="tabcontent">			
				<div class="content">
					<?php the_content(); ?>
				</div>				
			</div>
		<?php
		endwhile;
		?>
		</div>
		<script>
		jQuery('.cuerpotabs').slick({
			slidesToShow: 1,
			infinite: false,
			slidesToScroll: 1,
			arrows: false,
			fade: false,
			focusOnSelect: true, 
			swipeToSlide: false,
			dots: true,
			dotsClass: 'barratabs',  
			adaptiveHeight: true,
			customPaging : function(slider, i) {
				return '<h2>'+paging[i]+'</h2>';
			},
			swipeToSlide: true,	
		});
	</script>
		<?php
	} else {
	get_template_part( 'views/category');
}	
	wp_reset_query();
	?>