	<?php		
		$category = get_category( get_query_var( 'cat' ) );
		$cat_id = $category->cat_ID;
		$argsindex = array(
			'post_type' => array(
				'page',
			),
			'cat' => $cat_id,
		);
		$the_queryindex = new WP_Query($argsindex);
		while ($the_queryindex->have_posts()):$the_queryindex->the_post();
			$thumb = get_the_post_thumbnail_url($post->ID);?>
			<div class="category" style="background-image:url('<?php echo $thumb;?>');">
				<div class="title" >
					<?php the_title();?>
				</div>
				<div class="content">
					<?php the_content(); ?>
				</div>				
			</div>
		<?php
		endwhile;
		wp_reset_query();
		?>
