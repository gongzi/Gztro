<?php
/*
Template Name: Rss
*/
?>
<?php get_header(); ?>
<div id="content">
	<div id="postlist">
		<div class="post-single">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<?php
				require_once (ABSPATH . WPINC . '/class-feed.php');
				date_default_timezone_set('PRC');
				$feed = new SimplePie();
				$feed->set_feed_url('http://www.gongzi.me/sinarss2.php?id=1253095782');
				$feed->set_file_class('WP_SimplePie_File');
				$feed->set_cache_duration(1200);
				$feed->init();
				$feed->handle_content_type();
				$items = $feed->get_items(0,6);
				foreach($items as $item) {
				echo "<li>";
				echo '<a target="_blank" href="'.$item->get_link().'">'.$item->get_title().'</a><br />'.
				$item->get_date('Y-m-j G:i ').'<br />';
				echo "</li>";
				}
		?>
		</div>
		<?php endwhile; endif; ?>
	</div>
<?php get_footer(); ?>