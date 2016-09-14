<div id="sidebar">

<?php if (get_option('Gztro_sid_ad_top')!="") {?>
	<div class="widget-adcode">
		<?php if (get_option('Gztro_sid_ad_top')!="") {?>
			<?php echo stripslashes(get_option('Gztro_sid_ad_top')); ?>
		<?php }?>
	</div>
<?php }?>
<?php if ( is_home()) { ?>
<div class="widget">
	<ul class="tab_menu">
		<li class="current"><?php printf( _e( 'sidmostpost','Gztro' ) ); ?></li>
	</ul>
	<div class="tab_content">
		<ul class="tab_post_links">
			<?php gztro_most_viewed(); ?>
		</ul>
	</div>
</div>
<?php } else {?>

	<div class="widget">
		<ul class="tab_menu">
			<li class="current"><?php printf( _e( 'sidnewpost','Gztro' ) ); ?></li>
		</ul>
		<div class="tab_content">
			<ul class="tab_post_links">
				<?php get_archives('postbypost', 10); ?>
			</ul>
		</div>
	</div>
<?php } ?>


<div class="widget">
		<ul class="tab_menu">
			<li class="current"><?php printf( _e( 'sidsearch','Gztro' ) ); ?></li>
		</ul>
		<div class="widget-search">
			<?php get_search_form()?>
		</div>
</div>
<?php if (get_option('Gztro_sid_ad_bottom')!="") {?>
	<div class="widget-adcode">
		<?php if (get_option('Gztro_sid_ad_bottom')!="") {?>
			<?php echo stripslashes(get_option('Gztro_sid_ad_bottom')); ?>
		<?php }?>
	</div>
<?php }?>

<div class="widget">
		<ul class="tab_menu">
			<li class="current"><?php printf( _e( 'sidcomm','Gztro' ) ); ?></li>
		</ul>
	<div class="tab_content">
		<div class="sid_comm">
		<ul>
			<?php
			$limit_num = '6';
			$my_email = "'" . get_bloginfo ('admin_email') . "'"; 
			$rc_comms = $wpdb->get_results("
			SELECT ID, post_title, comment_ID, comment_author, comment_author_email, comment_content
			FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts
			ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
			WHERE comment_approved = '1'
			AND comment_type = ''
			AND post_password = ''
			AND comment_author_email != $my_email
			ORDER BY comment_date_gmt
			DESC LIMIT $limit_num
			");
			$rc_comments = '';
			foreach ($rc_comms as $rc_comm) { 
			$rc_comments .= "<li>". get_avatar($rc_comm,$size='32') ."<span class='zsnos_comment_author'>" . $rc_comm->comment_author . ": </span><a href='"
			. get_permalink($rc_comm->ID) . "#comment-" . $rc_comm->comment_ID
			. "' title='on " . $rc_comm->post_title . "'>" . strip_tags($rc_comm->comment_content)
			. "</a></li>\n";
			}
			$rc_comments = convert_smilies($rc_comments);
			echo $rc_comments;
			?>
			</ul>
		</div>
	</div>
</div>

<?php if ( is_home()) { ?>

<div class="widget">
		<ul class="tab_menu">
			<li class="current"><?php printf( _e( 'sidlinks','Gztro' ) ); ?></li>
		</ul>
		<ul class="blogroll">
			<?php wp_list_bookmarks('title_li=&category=&categorize=0&orderby=rand&limit=11'); ?>
		<li><a href="/links"><?php printf( _e( 'sidlinksmore','Gztro' ) ); ?></a></li>
		</ul>
</div>
<?php } ?>
</div>
</div>
