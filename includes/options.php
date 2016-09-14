<?php
add_action('admin_menu', 'Gztro_page');
function Gztro_page (){

			if ( count($_POST) > 0 && isset($_POST['Gztro_settings']) ){
		$options = array ('keywords','description','analytics','csecode','sid_ad_top','sid_ad_bottom');
		foreach ( $options as $opt ){
			delete_option ( 'Gztro_'.$opt, $_POST[$opt] );
			add_option ( 'Gztro_'.$opt, $_POST[$opt] );	
		}
	}
	add_theme_page(__('主题选项'), __('主题选项'), 'edit_themes', basename(__FILE__), 'Gztro_settings');
}
function Gztro_settings(){?>
<style>
	fieldset{width:700px;border:1px solid #aaa;padding-bottom:20px;margin-top:20px;}
	legend{margin-left:5px;padding:0 5px;color:#2481C6;background:#F9F9F9;}
	textarea{width:100%;font-size:11px;border:1px solid #aaa;background:none;}
	label{cursor:default;}


</style>
<div class="wrap">
<h2>Gztro 主题设置</h2>
<form method="post" action="">
	<fieldset>
	<legend><strong>统计代码添加</strong></legend>
		<table class="form-table">
		<tr><td>
				<textarea name="keywords" id="keywords" rows="1" cols="70"><?php echo get_option('Gztro_keywords'); ?></textarea><br />
				<label>网站关键词（Meta Keywords），中间用半角逗号隔开。如： Gztro,主题,设置</label>
			</td></tr>
			<tr><td>
				<textarea name="description" id="description" rows="2" cols="70"><?php echo get_option('Gztro_description'); ?></textarea>
				<label>网站描述（Meta Description），针对搜索引擎设置的网页描述。如：本站域名www.gongzi.org</label>
			</td></tr>
			<tr><td>
				<textarea name="analytics" id="analytics" rows="4" cols="70"><?php echo stripslashes(get_option('Gztro_analytics')); ?></textarea>
				<label>添加统计代码,包含script前后标签!</label>
			</td></tr>
			<tr><td>
				<textarea name="csecode" id="csecode" rows="1" cols="70"><?php echo get_option('Gztro_csecode'); ?></textarea><br />
				<label>输入谷歌自定义搜索代码，需前往：http://www.google.com/cse申请。</label>
			</td></tr>
		</table>
	</fieldset>
 <p>

	<fieldset>
	<legend><strong>侧边栏广告代码</strong></legend>
		<table class="form-table">
			<tr><td>
				<textarea name="sid_ad_top" id="sid_ad_top" rows="4" cols="70"><?php echo stripslashes(get_option('Gztro_sid_ad_top')); ?></textarea>
				<label>Gztro主题，侧边栏顶部广告位，在此粘贴你的广告联盟代码...</label>
			</td></tr>
			<tr><td>
				<textarea name="sid_ad_bottom" id="sid_ad_bottom" rows="4" cols="70"><?php echo stripslashes(get_option('Gztro_sid_ad_bottom')); ?></textarea>
				<label>Gztro主题，侧边栏广告位2，在此粘贴你的广告联盟代码...</label>
			</td></tr>
		</table>
	</fieldset>
 <p>

 <label>主题相关： <a href="http://www.gongzi.org/gztro.html" target="_blank">主题发布</a> |  <a href="http://www.gongzi.org/gztrohelp.html" target="_blank">主题帮助</a></label><br/>
 <label>发布网站： <a href="http://www.gongzi.org/" target="_blank">公子府 www.gongzi.org</a></label><br/><br/>
 <label><font color="red">注：本主题支持自动升级，请注意系统升级提示，升级后将覆盖本地修改，请注意备份。</font></label>
 </p>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="保存设置" />
		<input type="hidden" name="Gztro_settings" value="save" style="display:none;" />
		<input style="font-size:12px !important;" name="reset" type="submit" value="还原默认设置" /><label><font color="red">警告：将还原至初始状态！</font></label>
	</p>
 
</form>
</div>

<?php }