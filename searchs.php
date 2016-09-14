<?php
/*
Template Name: searchs
*/
?>
<?php get_header(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="content">
	<div id="postlist">
		<div class="post-single">
		<div id="cse" style="width: 99%;">正在加载搜索结果,请稍候...</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
  google.load('search', '1', {language : 'zh-CN'});
  google.setOnLoadCallback(function(){
        var customSearchControl = new google.search.CustomSearchControl('<?php echo stripslashes(get_option('Gztro_csecode')); ?>');
        customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
        customSearchControl.draw('cse');
        var match = location.search.match(/q=([^&]*)(&|$)/);
        if(match && match[1]){
            var search = decodeURIComponent(match[1]);
            customSearchControl.execute(search);
        }
    });
</script>
<link rel="stylesheet" href="http://www.google.com/cse/style/look/default.css" type="text/css" /> <style type="text/css">
  .gsc-control-cse {
    font-family:'Century Gothic','Microsoft YaHei',Verdana;
    border-color: #FCFCFC;

    background-color: #FCFCFC;
  }
  input.gsc-input {
    border-color: #E9E9E9;
   /* -webkit-box-shadow: rgba(0, 0, 0, 0.199219) 0px 0px 5px;*/
		background: none;
		height:20px;
		border: 1px solid #AAA;
		
  }
  input.gsc-search-button {
    border-color: #CCCCCC;
    background-color: #FFF;
    border:1px dashed #CCC;
		cursor:pointer;
		height:20px;
		text-align: center;
		width: 50px;
		
  }
  .gsc-tabHeader.gsc-tabhInactive {
    border-color: #E9E9E9;
    background-color: #E9E9E9;
  }
  .gsc-tabHeader.gsc-tabhActive {
    border-top-color: #FF9900;
    border-left-color: #E9E9E9;
    border-right-color: #E9E9E9;
    background-color: #FCFCFC;
  }
  .gsc-tabsArea {
    border-color: #E9E9E9;
  }
  .gsc-webResult.gsc-result {
   /*  border-color: #B3D56A;
    border:1px dashed #B3D56A;
    background-color: #FFF;*/ 
    -webkit-transition: all .2s ease-in-out;
  }
  .gsc-webResult.gsc-result:hover {
   /*  border-color: #B3D56A;
	border:1px dashed #B3D56A;*/ 
    background-color: #A0D3FA;
    
  }
  .gs-webResult.gs-result a.gs-title:link,
  .gs-webResult.gs-result a.gs-title:link b {
    color: #21759B;
  }
  .gs-webResult.gs-result a.gs-title:visited,
  .gs-webResult.gs-result a.gs-title:visited b {
    color: #DA4E21;
  }
  .gs-webResult.gs-result a.gs-title:hover,
  .gs-webResult.gs-result a.gs-title:hover b {
    color: #DA4E21;
  }
  .gs-webResult.gs-result a.gs-title:active,
  .gs-webResult.gs-result a.gs-title:active b {
    color: #40A9FF;
  }
  .gsc-cursor-page {
    color: #40A9FF;
  }
  a.gsc-trailing-more-results:link {
    color: #40A9FF;
  }
  .gs-webResult.gs-result .gs-snippet {
    color: #555555;
  }
  .gs-webResult.gs-result .gs-visibleUrl {
    color: #488AC7;
  }
  .gs-webResult.gs-result .gs-visibleUrl-short {
    color: #488AC7;
  }
  
  .gs-webResult.gs-result .gs-visibleUrl-short {
    display: none;
  }
  .gs-webResult.gs-result .gs-visibleUrl-long {
    display: block;
  }
  .gsc-cursor-box {
    border-color: #B3D56A;
  }
  .gsc-results .gsc-cursor-page {
    border-color: #E9E9E9;
    background-color: #FAFAFA;
  }
  .gsc-results .gsc-cursor-page.gsc-cursor-current-page {
    border-color: #FF9900;
    background-color: #FFFFFF;
  }
  .gs-promotion.gs-result {
    border-color: #336699;
    background-color: #FFFFFF;
  }
  .gs-promotion.gs-result a.gs-title:link {
    color: #0000CC;
  }
  .gs-promotion.gs-result a.gs-title:visited {
    color: #0000CC;
  }
  .gs-promotion.gs-result a.gs-title:hover {
    color: #0000CC;
  }
  .gs-promotion.gs-result a.gs-title:active {
    color: #0000CC;
  }
  .gs-promotion.gs-result .gs-snippet {
    color: #000000;
  }
  .gs-promotion.gs-result .gs-visibleUrl,
  .gs-promotion.gs-result .gs-visibleUrl-short {
    color: #008000;
  }
</style> 
		</div>
		
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>