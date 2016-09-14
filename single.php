<?php get_header(); ?>
<div id="content">
	<div id="postlist">
	<?php if(have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post-single">

			<div class="post-title-single"><h2><?php if (is_sticky()) {echo "<font style='color:#D54E21;'>[推荐]</font>";} ?><?php the_title(); ?><em><?php $t1=$post->post_date; $t2=date("Y-m-d H:i:s"); $diff=(strtotime($t2)-strtotime($t1))/3600; if($diff<24){echo "<font style='color:red;font-size:10px;'> New</font>";} ?></em></h2></div>
			
			
			<div class="post-single-info">
				<span class="post-info-category">分类：<?php the_category(', ') ?></span>
				<span class="post-info-tags">标签: <?php the_tags('', ',', ' '); ?></span>
				<?php    
					$furl = get_post_meta($post->ID, 'FromURL', true);
					$fname = get_post_meta($post->ID, 'FromName', true);
					if ($furl||$fname) {            
					echo "<span class='post-info-url'><a href='$furl' rel='nofollow' target='_blank'>$fname</a></span>";         
					 }
				?>
				<span class="post-info-view"><?php printf( _e( 'viewsa','Gztro' ) ); ?> <?php post_views(' '); ?> <?php printf( _e( 'viewsb','Gztro' ) ); ?></span>
				&nbsp;<?php edit_post_link('编辑本文', '', ''); ?>

			</div>
			<div class="post-content">
			

			<?php the_content(__('阅读全文')); ?>
		
			<?php wp_link_pages(array('before' => '<div class="pnext-st">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '上一页', 'nextpagelink' => "")); ?>   <?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>   <?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "下一页")); ?>
		
		<div class="crinfo">

			更新日期: <?php the_time('Y-m-d H:i:s'); ?>
			<br/>文章标签: <?php the_tags('', ',', ' '); ?>
			<br/>文章链接: <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a> 
			<br/>站方声明: 除特别标注, 本站所有文章均为原创, 互联分享, 尊重版权, 转载请注明.<br />
			<br/>
		</div>

<br/>
</div>


<div class="frontback"><div class="next"><?php  if (get_next_post()) {next_post_link('上一篇：%link'); } else { echo "上一篇：已经是第一篇了"; }; ?></div><br/><div class="pre"><?php  if (get_previous_post()) {previous_post_link('下一篇：%link'); } else { echo "下一篇：已经是最后一篇了"; }; ?></div></div>


<div id="comments"><?php comments_template('', true); ?></div>
	</div>
	<?php endwhile; endif; ?>
	
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>