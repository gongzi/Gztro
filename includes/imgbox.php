<div id="imgbox">
		<div id="slider">
			<ul>
				<?php 
				$args=array( 
				'posts_per_page' => 5,
				'post__in'  => get_option('sticky_posts'),
				'caller_get_posts' => 10
				); 
				query_posts($args);
				if (have_posts()) : while (have_posts()) : the_post(); 
				?> 
				
				<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank">
					<?php if ( get_post_meta($post->ID, 'show', true) ) : ?>
						<?php $image = get_post_meta($post->ID, 'show', true); ?>
						<img src="<?php echo $image; ?>"width="690" height="250" alt="<?php the_title(); ?>"/>
						<?php else: ?>
						<?php if (has_post_thumbnail()) { the_post_thumbnail('home-thumb' ,array( 'alt' => trim(strip_tags( $post->post_title )), 'title' => trim(strip_tags( $post->post_title )),'class' => 'home-thumb')); }
						else { ?>
							 <img src="<?php echo my_thumbnail() ?>" alt="<?php the_title(); ?>" width="690" height="250" />
						<?php } ?>
						<?php endif; ?>
						</a>
						<?php endwhile; endif; wp_reset_query();?> 
				</li>
			</ul>
		</div>	
</div>