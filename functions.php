<?php
	if ( function_exists('register_nav_menus') ) {
		register_nav_menus(array('nav' => '导航栏'));
	}

if ( !isset( $wpsmiliestrans ) ) {
		$wpsmiliestrans = array(
		':mrgreen:' => 'icon_mrgreen.gif',
		':neutral:' => 'icon_neutral.gif',
		':twisted:' => 'icon_twisted.gif',
		  ':arrow:' => 'icon_arrow.gif',
		  ':shock:' => 'icon_eek.gif',
		  ':smile:' => 'icon_smile.gif',
		    ':???:' => 'icon_confused.gif',
		   ':cool:' => 'icon_cool.gif',
		   ':evil:' => 'icon_evil.gif',
		   ':grin:' => 'icon_biggrin.gif',
		   ':idea:' => 'icon_idea.gif',
		   ':oops:' => 'icon_redface.gif',
		   ':razz:' => 'icon_razz.gif',
		   ':roll:' => 'icon_rolleyes.gif',
		   ':wink:' => 'icon_wink.gif',
		    ':cry:' => 'icon_cry.gif',
		    ':eek:' => 'icon_surprised.gif',
		    ':lol:' => 'icon_lol.gif',
		    ':mad:' => 'icon_mad.gif',
		    ':see:' => 'icon_see.gif',
			':!!!:' => 'icon_exclamation.gif',
			':ymy:' => 'icon_youmuyou.gif',
			':sbq:' => 'icon_sbq.gif',
			 ':sx:' => 'icon_shaoxiang.gif',
			 ':gl:' => 'icon_gl.gif',
			':bgl:' => 'icon_bgl.gif',
			':kbz:' => 'icon_kbz.gif',
			':gg:' => 'icon_gg.gif',
		      '8-)' => 'icon_cool.gif',
		      '8-O' => 'icon_eek.gif',
		      ':-(' => 'icon_sad.gif',
		      ':-)' => 'icon_smile.gif',
		      ':-?' => 'icon_confused.gif',
		      ':-D' => 'icon_biggrin.gif',
		      ':-P' => 'icon_razz.gif',
		      ':-o' => 'icon_surprised.gif',
		      ':-x' => 'icon_mad.gif',
		      ':-|' => 'icon_neutral.gif',
		      ';-)' => 'icon_wink.gif',
		       '8)' => 'icon_cool.gif',
		       '8O' => 'icon_eek.gif',
		       ':(' => 'icon_sad.gif',
		       ':)' => 'icon_smile.gif',
		       ':?' => 'icon_confused.gif',
		       ':D' => 'icon_biggrin.gif',
		       ':P' => 'icon_razz.gif',
		       ':o' => 'icon_surprised.gif',
		       ':x' => 'icon_mad.gif',
		       ':|' => 'icon_neutral.gif',
		       ';)' => 'icon_wink.gif',
		      ':!:' => 'icon_exclaim.gif',
		      ':?:' => 'icon_question.gif',
		);
	}
remove_action( 'wp_head',             'feed_links',                    2     );
remove_action( 'wp_head',             'feed_links_extra',              3     );
remove_action( 'wp_head',             'rsd_link'                             );
remove_action( 'wp_head',             'wlwmanifest_link'                     );
remove_action( 'wp_head',             'index_rel_link'                       );
remove_action( 'wp_head',             'parent_post_rel_link',          10, 0 );
remove_action( 'wp_head',             'start_post_rel_link',           10, 0 );
remove_action( 'wp_head',             'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head',             'wp_generator'                         );
remove_action( 'wp_head',             'wp_shortlink_wp_head',          10, 0 );

function pagenavi( $p = 2 ) {
	if ( is_singular() ) return;
	global $wp_query, $paged;
	$max_page = $wp_query->max_num_pages;
	if ( $max_page == 1 ) return;
	if ( empty( $paged ) ) $paged = 1;
	echo '<span class="page-numbers">' . $paged . ' / ' . $max_page . ' </span> ';
	if ( $paged > 1 ) p_link( $paged - 1, '上一页', '上一页' );
	if ( $paged > $p + 1 ) p_link( 1, '最前页' );
	if ( $paged > $p + 2 ) echo '<span class="page-numbers">...</span>';
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
	if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );
	}
	if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers">...</span>';
	if ( $paged < $max_page - $p ) p_link( $max_page, '最末页' );
	if ( $paged < $max_page ) p_link( $paged + 1,'下一页', '下一页' );
}

function p_link( $i, $title = '', $linktype = '' ) {
if ( $title == '' ) $title = "第 {$i} 页";
if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";
}

function custom_smilies_src($src, $img){
    return get_bloginfo('template_directory').'/images/smilies/' . $img;
}
add_filter('smilies_src', 'custom_smilies_src', 10, 2);

remove_filter('comment_text', 'make_clickable', 9);

/*** 头像缓存 ***/
function my_avatar( $email, $size = '42', $default = '', $alt = '' ) {
  $alt = esc_attr( $alt );
  $f = md5( strtolower( $email ) );
  $w = WP_CONTENT_URL; // 如果想放在 wp-content 路徑之下, 改為 $w = WP_CONTENT_URL;
  $a = $w. '/avatar/'. $f. '.jpg';
  $e = WP_CONTENT_DIR. '/avatar/'. $f. '.jpg'; // 如果想放在 wp-content 路徑之下, 改為 $e = WP_CONTENT_DIR. '/avatar/'. $f. '.jpg';
  $t = 1209600; //設定14天, 單位:秒
  if ( empty($default) ) $default = $w. '/avatar/default.jpg';
  if ( !is_file($e) || (time() - filemtime($e)) > $t ){ //當頭像不存在或文件超過14天才更新
    $r = get_option('avatar_rating');
    //$g = sprintf( "http://%d.gravatar.com", ( hexdec( $f{0} ) % 2 ) ). '/avatar/'. $f. '?s='. $size. '&d='. $default. '&r='. $r; // wp 3.0 的服務器
    $g = 'http://www.gravatar.com/avatar/'. $f. '?s='. $size. '&d='. $default. '&r='. $r; // 舊服務器 (哪個快就開哪個)
    copy($g, $e); $a = esc_attr($g); //新頭像 copy 時, 取 gravatar 顯示
  }
  if (filesize($e) < 500) copy($default, $e);
  echo "<img title='{$alt}' alt='{$alt}' src='{$a}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
}


/*** 回复邮件通知 ***/
function comment_mail_notify($comment_id) {
  $comment = get_comment($comment_id);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam')) {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#','', strtolower($_SERVER['SERVER_NAME'])); //e-mail 發出點, no-reply 可改為可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '你在  [' . get_option("blogname") . '] 的留言有了新的回复';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 你好!</p>
      <p>你在《<b>' . get_the_title($comment->comment_post_ID) . '</b>》的留言有了新的回复:<br /><b>你</b>的留言：<br>'
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p><b>' . trim($comment->comment_author) . ' </b>給你的回复:<br />'
       . trim($comment->comment_content) . '<br /></p>
      <p>你可以 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看完整回复內容并再次回复Ta</a></p>
      <p>感谢你关注 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a> .</p>
      <p>(注:若你未在本站留言,请忽略此邮件!此邮件由系统自动发出,请勿回复!)
     
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');
// -- END ---------------------------------------

/*** 随机文章 ***/
function matt_random_redirect() {
	global $wpdb;
	$query = "SELECT ID FROM $wpdb->posts WHERE post_type = 'post' AND post_password = '' AND 	post_status = 'publish' ORDER BY RAND() LIMIT 1";
	if ( isset( $_GET['random_cat_id'] ) ) {
		$random_cat_id = (int) $_GET['random_cat_id'];
		$query = "SELECT DISTINCT ID FROM $wpdb->posts AS p INNER JOIN $wpdb->term_relationships AS tr ON (p.ID = tr.object_id AND tr.term_taxonomy_id = $random_cat_id) INNER JOIN  $wpdb->term_taxonomy AS tt ON(tr.term_taxonomy_id = tt.term_taxonomy_id AND taxonomy = 'category') WHERE post_type = 'post' AND post_password = '' AND 	post_status = 'publish' ORDER BY RAND() LIMIT 1";
	}
	if ( isset( $_GET['random_post_type'] ) ) {
		$post_type = preg_replace( '|[^a-z]|i', '', $_GET['random_post_type'] );
		$query = "SELECT ID FROM $wpdb->posts WHERE post_type = '$post_type' AND post_password = '' AND 	post_status = 'publish' ORDER BY RAND() LIMIT 1";
	}
	$random_id = $wpdb->get_var( $query );
	wp_redirect( get_permalink( $random_id ) );
	exit;
}
if ( isset( $_GET['random'] ) )
	add_action( 'template_redirect', 'matt_random_redirect' );

function Gztro_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   global $commentcount;$page = ( !empty($in_comment_loop) ) ? get_query_var('cpage') : get_page_of_comment( $comment->comment_ID, $args );$cpp=get_option('comments_per_page');if(!$commentcount) {if ($page > 1) {$commentcount = $cpp * ($page - 1);} else {$commentcount = 0;}}
?>
	<li <?php comment_class(); ?> <?php if( $depth > 1){echo ' style="margin-left:' . ceil(80/$depth) . 'px;"';} ?> id="li-comment-<?php comment_ID() ?>" >
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="commentmeta">
			<?php echo get_avatar( $comment->comment_author_email, $size='42', $default ); ?>
			</div>
				<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is awaiting moderation.') ?></em><br />
				<?php endif; ?>
			<div class="Floor">&nbsp;&nbsp;<span><?php if(!$parent_id = $comment->comment_parent) {printf('%1$sF', ++$commentcount);} ?><?php if( $depth > 1){printf('%1$sB', $depth-1);} ?></span></div>
			<div class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('@回复Ta')))) ?></div>
			<div class="vcard"><span class="vcard-uid"><?php printf(__('%s'), get_comment_author_link()) ?></span>&nbsp;&nbsp;<font style="color:#DDD;">于&nbsp;&nbsp;<?php printf(__('%1$s - %2$s'), get_comment_date(),  get_comment_time()) ?>说：</font>
			
			<?php if (function_exists("CID_init")) { CID_print_comment_flag(); echo ' '; CID_print_comment_browser(); } ?></div>
			<?php comment_text() ?>
		</div>
<?php
}

function archives_list_SHe() {
     global $wpdb,$month;
     $lastpost = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_date <'" . current_time('mysql') . "' AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC LIMIT 1");
     $output = get_option('SHe_archives_'.$lastpost);
     if(empty($output)){
         $output = '';
         $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'SHe_archives_%'");
         $q = "SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts FROM $wpdb->posts p WHERE post_date <'" . current_time('mysql') . "' AND post_status='publish' AND post_type='post' AND post_password='' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";
         $monthresults = $wpdb->get_results($q);
         if ($monthresults) {
             foreach ($monthresults as $monthresult) {
             $thismonth    = zeroise($monthresult->month, 2);
             $thisyear    = $monthresult->year;
             $q = "SELECT ID, post_date, post_title, comment_count FROM $wpdb->posts p WHERE post_date LIKE '$thisyear-$thismonth-%' AND post_date AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC";
             $postresults = $wpdb->get_results($q);
             if ($postresults) {
                 $text = sprintf('%s %d', $month[zeroise($monthresult->month,2)], $monthresult->year);
                 $postcount = count($postresults);
                 $output .= '<ul class="archives-list"><li><span class="archives-yearmonth">' . $text . ' &nbsp;(' . count($postresults) . '&nbsp;篇文章)</span><ul class="archives-monthlisting">' . "\n";
             foreach ($postresults as $postresult) {
                 if ($postresult->post_date != '0000-00-00 00:00:00') {
                 $url = get_permalink($postresult->ID);
                 $arc_title    = $postresult->post_title;
                 if ($arc_title)
                     $text = wptexturize(strip_tags($arc_title));
                 else
                     $text = $postresult->ID;
                     $title_text = 'View this post, &quot;' . wp_specialchars($text, 1) . '&quot;';
                     $output .= '<li>' . mysql2date('d日', $postresult->post_date) . ':&nbsp;' . "<a href='$url' title='$title_text'>$text</a>";
                     $output .= '&nbsp;(' . $postresult->comment_count . ')';
                     $output .= '</li>' . "\n";
                 }
                 }
             }
             $output .= '</ul></li></ul>' . "\n";
             }
         update_option('SHe_archives_'.$lastpost,$output);
         }else{
             $output = '<div class="errorbox">Sorry, no posts matched your criteria.</div>' . "\n";
         }
     }
     echo $output;
 }
 
 // 防止访客冒充博主发表评论 by zww
function z_user_check($incoming_comment) {
global $user_ID;
$isSpam = 0;
if ( strtolower(trim($incoming_comment['comment_author'])) == '你的名字' ) $isSpam = 1;
if ( strtolower(trim($incoming_comment['comment_author_email'])) == '你的邮箱') $isSpam = 1;
if (!$isSpam || intval($user_ID) > 0) { return $incoming_comment; } else { err('请勿冒充博主发表评论!'); }
}
add_filter( 'preprocess_comment', 'z_user_check' );


include("includes/options.php");
require_once(TEMPLATEPATH . '/includes/theme-update-checker.php'); 
$theme_update_checker = new ThemeUpdateChecker(
	'Gztro',
	'http://www.gongzi.org/tools/themes/Gztro/info.json'
);

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('Gztro', get_template_directory() . '/languages');
}


/* -----------------------------------------------
<<小牆>> Anti-Spam v1.8 by Willin Kan.
*/
//建立
class anti_spam {
function anti_spam() {
	if ( !current_user_can('level_0') ) {
	add_action('template_redirect', array($this, 'w_tb'), 1);
	add_action('init', array($this, 'gate'), 1);
	add_action('preprocess_comment', array($this, 'sink'), 1);
} }
//設欄位
function w_tb() {
	if ( is_singular() ) {
	ob_start(create_function('$input','return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
	"textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);') );
} }
//檢查
function gate() {
( !empty($_POST['w']) && empty($_POST['comment']) ) ?
$_POST['comment'] = $_POST['w'] : $_POST['spam_confirmed'] = 1;
}
//處理
function sink( $comment ) {
if ( !empty($_POST['spam_confirmed']) ) {
//方法一:直接擋掉, 將 die(); 前面兩斜線刪除即可.
//die();
//方法二:標記為spam, 留在資料庫檢查是否誤判.
add_filter('pre_comment_approved', create_function('','return "spam";'));
$is_ping = in_array( $comment['comment_type'], array('pingback', 'trackback') );
$comment['comment_content'] = ( $is_ping ) ?
"◎ 這是 Pingback/Trackback, 小牆懷疑這可能是 Spam!\n" . $comment['comment_content'] :
"[ 小牆判斷這是Spam! ]\n" . $comment['comment_content'];
}
return $comment;
} }
$anti_spam = new anti_spam();
// -- END ----------------------------------------


if(function_exists('add_theme_support')){
    add_theme_support( 'post-thumbnails' );
}
function my_thumbnail(){
    if(has_post_thumbnail()){ 
       the_post_thumbnail();
    } else {
        global $post, $posts;
        $post_img = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $post_img_src = $matches [1][0];
        $post_img = $post_img_src; 
        if(empty($post_img_src)){ 
			$post_img = bloginfo('template_url').  '/images/default.jpg';
        }
        echo $post_img;
    }
}

//Get most VidedPost
function gztro_most_viewed($posts_num=10, $days=90){
    global $wpdb;
    $sql = "SELECT ID , post_title , comment_count
            FROM $wpdb->posts
           WHERE post_type = 'post' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days
		   AND ($wpdb->posts.`post_status` = 'publish' OR $wpdb->posts.`post_status` = 'inherit')
           ORDER BY comment_count DESC LIMIT 0 , $posts_num ";
    $posts = $wpdb->get_results($sql);
    $output = "";
    foreach ($posts as $post){
        $output .= "\n<li><a href= \"".get_permalink($post->ID)."\" target=\"_blank\" rel=\"bookmark\" title=\"".$post->post_title." (".$post->comment_count."条评论)\" >". mb_strimwidth($post->post_title,0,45)."</a></li>";
    }
    echo $output;
}

function cut_str($src_str,$cut_length)
{
    $return_str='';
    $i=0;
    $n=0;
    $str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length))
    {
        $tmp_str=substr($src_str,$i,1);
        $ascnum=ord($tmp_str);
        if ($ascnum>=224)
        {
            $return_str=$return_str.substr($src_str,$i,3);
            $i=$i+3;
            $n=$n+2;
        }
        elseif ($ascnum>=192)
        {
            $return_str=$return_str.substr($src_str,$i,2);
            $i=$i+2;
            $n=$n+2;
        }
        elseif ($ascnum>=65 && $ascnum<=90)
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+2;
        }
        else 
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+1;
        }
    }
    if ($i<$str_length)
    {
        $return_str = $return_str . '';
    }
    if (get_post_status() == 'private')
    {
        $return_str = $return_str . '（private）';
    }
    return $return_str;
}

//postviews  
function record_visitors()
{
	if (is_singular()) 
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID) 
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  
		  
		  if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');  

function post_views($echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo number_format($views);
  else return $views;
}


//Add Edit's btn
add_action('admin_print_scripts', 'my_quicktags');
function my_quicktags() {
    wp_enqueue_script(
        'my_quicktags',
        get_stylesheet_directory_uri().'/js/my_quicktags.js',
        array('quicktags')
    );
    };
	
//Auto Link Tags
$match_num_from = 1;  //一个关键字少于多少不替换
$match_num_to = 1; //一个关键字最多替换
add_filter('the_content','tag_link',1); 
function tag_sort($a, $b){
	if ( $a->name == $b->name ) return 0;
	return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
}
function tag_link($content){
global $match_num_from,$match_num_to;
	 $posttags = get_the_tags();
	 if ($posttags) {
		 usort($posttags, "tag_sort");
		 foreach($posttags as $tag) {
			 $link = get_tag_link($tag->term_id); 
			 $keyword = $tag->name;
			 $cleankeyword = stripslashes($keyword);
			 $url = "<a href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('View all posts in %s'))."\"";
			 $url .= ' target="_blank" class="tag_link"';
			 $url .= ">".addcslashes($cleankeyword, '$')."</a>";
			 $limit = rand($match_num_from,$match_num_to);
             $content = preg_replace( '|(<a[^>]+>)(.*)('.$ex_word.')(.*)(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
			 $content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
				$cleankeyword = preg_quote($cleankeyword,'\'');
					$regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
				$content = preg_replace($regEx,$url,$content,$limit);
	$content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);
		 }
	 } 
    return $content; 
}

function link_to_menu_editor( $args )
{
    if ( ! current_user_can( 'manage_options' ) )
    {
        return;
    }
    extract( $args );
    $link = $link_before
        . '<a href="' .admin_url( 'nav-menus.php' ) . '">' . $before . '点击此处设置菜单' . $after . '</a>'
        . $link_after;
    if ( FALSE !== stripos( $items_wrap, '<ul' )
        or FALSE !== stripos( $items_wrap, '<ol' )
    )
    {
        $link = "<li>$link</li>";
    }
    $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
    if ( ! empty ( $container ) )
    {
        $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }
    if ( $echo )
    {
        echo $output;
    }
    return $output;
}

class Disable_Google_Fonts {
        public function __construct() {
                add_filter( 'gettext_with_context', array( $this, 'disable_open_sans' ), 888, 4 );
        }
        public function disable_open_sans( $translations, $text, $context, $domain ) {
                if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
                        $translations = 'off';
                }
                return $translations;
        }
}
$disable_google_fonts = new Disable_Google_Fonts;

function mytheme_get_avatar( $avatar ) {
	$avatar = preg_replace("/http:\/\/(www|\d).gravatar.com/","https://secure.gravatar.com",$avatar );
	return $avatar;
	}
add_filter( 'get_avatar', 'mytheme_get_avatar' );

?>