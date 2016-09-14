<form method="get" class="searchbox" action="<?php bloginfo('url'); ?>/" >
<input class="search-input" name="s" type="text" placeholder="搜搜也精彩..."  onblur="if (this.value == '') {this.value = '';}" value="<?php echo $_GET['s']?$_GET['s']:''?>"><input type="submit" value="搜索" class="search-btn">
</form>