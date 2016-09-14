<div class="clear"></div>
<?php wp_footer(); ?>

<!--[if IE 6]>
<script type="text/javascript" src="http://wp.cdn.gongzi.org/gztro/file/js/zh_CN.js"></script>
<![endif]-->


<div id="footer">
<div id="footer-body">
<div id="footer-content">
<?php printf( _e( 'baidumap','Gztro' ) ); ?> <?php printf( _e( 'Googlemap','Gztro' ) ); ?></a>
<br>&copy; <?php echo date("Y"); ?> <a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a><?php printf( _e( 'lic_wp','Gztro' ) ); ?><?php printf( _e( 'lic_theme','Gztro' ) ); ?>
<?php if (get_option('Gztro_analytics')!="") {?>
<?php echo stripslashes(get_option('Gztro_analytics')); ?>
<?php }?>
</div>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.1.4.0.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/Gztro.js"></script>
<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?>
<div style="display:none;"><li><a href="<?php bloginfo('url'); ?>/sitemap_baidu.xml" title="sitemap_baidu">sitemap_baidu</a></li><div>
<li style="display:none"></li>

<script type="text/javascript">
$(function(){
$(".widget ul li:last").css("border","none");
$(".widget .tab_post_links li:last").css("border","none");
$(".widget .sid_comm li:last").css("border","none");
$(".widget .blogroll li:last").css("border-bottom","1px dashed #CCC");
})
</script>
<script>
	$(function () {
		$.scrollUp();
	});
</script>
</body>
</html>