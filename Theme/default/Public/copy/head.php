<div class="container" id="header">
	<div class="row">
		<div class="col-sm-6">
			<a id="logo" href="<?php echo mc_site_url(); ?>"><img src="<?php echo mc_theme_url(); ?>/img/logo.png"></a>
		</div>
		<div class="col-sm-6">
			<form id="searchform" role="form" method="get" action="<?php echo mc_option('site_url'); ?>">
				<div class="form-group">
					<div class="input-group">
						<input name="keyword" type="text" class="form-control input-lg" placeholder="搜索你喜欢的话题～～">
						<span class="input-group-addon">
							<i class="glyphicon glyphicon-search"></i>
						</span>
					</div>
					<span class="help-block">热门搜索：</span>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="container">
	<nav id="main-nav" class="navbar navbar-inverse" role="navigation">
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li>
					<a href="<?php echo U('home/index/index'); ?>">
						最新
					</a>
				</li>
				<li>
					<a href="<?php echo U('publish/index/index'); ?>">
						发布新主题
					</a>
				</li>
			</ul>
		</div>
	</nav>
</div>