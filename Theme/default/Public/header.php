<!DOCTYPE html>
<html>
<head>
<title><?php echo mc_title(); ?></title>
<?php echo mc_seo(); ?>
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo mc_site_url(); ?>/favicon.ico" mce_href="<?php echo mc_site_url(); ?>/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo mc_site_url(); ?>/favicon.ico" mce_href="<?php echo mc_site_url(); ?>/favicon.ico" type="image/x-icon">
<!-- Bootstrap -->
<link rel="stylesheet" href="<?php echo mc_theme_url(); ?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo mc_theme_url(); ?>/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo mc_theme_url(); ?>/style.css" type="text/css" media="screen" />
<?php $site_color = mc_option('site_color'); if($site_color!='') : ?>
<style>
a {color: <?php echo $site_color; ?>;}
a:hover {color: #3f484f;}
.btn-warning {color: #fff; background-color:<?php echo $site_color; ?>; border-color: <?php echo $site_color; ?>;}
.btn-warning:hover {background-color:<?php echo $site_color; ?>; border-color: <?php echo $site_color; ?>;}
.label-warning {background-color: <?php echo $site_color; ?>;}

.home-main h4.title a.pull-right:hover {background-color: <?php echo $site_color; ?>; }
#pro-list .thumbnail h4 a:hover,
.home-side .media-heading a:hover {color: #3f484f;}

.home-side .panel-heading,
#home-top .carousel-indicators .active,
#topnav .navbar-right .count,
#topnav .navbar-right a:hover .count,
#topnav .dropdown-menu > li > a:hover,
#single-top #pro-index-tlin .carousel-indicators li.active,
#user-nav li.active > a,
#user-nav > li.active > a:hover,
#user-nav > li.active > a:focus,
#baobei-term-breadcrumb .pull-right a:hover,
#instantclick-bar {background-color: <?php echo $site_color; ?>;}

#site-control,
#backtotop:hover,
#total span,
#checkout .input-group-addon,
#total-true span {color: <?php echo $site_color; ?>;}

#post-list-default .list-group-item > .row {border-left-color: <?php echo $site_color; ?>;}

#group-side ul.nav-stacked li.active a,
#group-side ul.nav-stacked a:hover {background-color: <?php echo $site_color; ?>; border-color: <?php echo $site_color; ?>; }
</style>
<?php endif; ?>
<?php if(mc_option('logo')) : ?>
<style>
	.modal .modal-header {background-image:url(<?php echo mc_option('logo'); ?>);}
</style>
<?php endif; ?>
<link href="<?php echo mc_theme_url(); ?>/css/media.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo mc_theme_url(); ?>/js/jquery.min.js"></script>
<!--[if lt IE 9]>
<script src="<?php echo mc_theme_url(); ?>/js/html5shiv.min.js"></script>
<script src="<?php echo mc_theme_url(); ?>/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<a id="site-top"></a>
<nav id="topnav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-top-navbar-collapse">
				<span class="sr-only">
					Toggle navigation
				</span>
				<span class="icon-bar">
				</span>
				<span class="icon-bar">
				</span>
				<span class="icon-bar">
				</span>
			</button>
			<a <?php if(mc_option('logo')) echo 'style="background-image:url('.mc_option('logo').');"'; ?> class="navbar-brand" href="<?php echo mc_option('site_url'); ?>"></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-top-navbar-collapse">
			<ul class="nav navbar-nav" id="bs-top-navbar-nav">
				<li>
					<a href="<?php echo mc_site_url(); ?>">
						首页
					</a>
				</li>
				<?php 
					if(mc_option('pro_close')!=1) :
					$args_id = M('meta')->where("meta_key='parent' AND meta_value>'0' AND type='term'")->getField('page_id',true);
					if($args_id) :
					$condition['id']  = array('not in',$args_id);
					endif;
					$condition['type']  = 'term_pro';
					$terms_pro = M('page')->where($condition)->order('id desc')->select(); 
					if($terms_pro) :
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						商品
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="<?php echo U('pro/index/index'); ?>">全部</a>
						</li>
						<?php foreach($terms_pro as $val) : ?>
						<li>
							<a href="<?php echo U('pro/index/term?id='.$val['id']); ?>"><?php echo $val['title']; ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</li>
				<?php else : ?>
				<li>
					<a href="<?php echo U('pro/index/index'); ?>">
						商品
					</a>
				</li>
				<?php endif; endif; ?>
				<?php if(mc_option('group_close')!=1) : ?>
				<li>
					<a href="<?php echo U('post/group/index'); ?>">
						社区
					</a>
				</li>
				<?php endif; ?>
				<?php if(mc_option('article_close')!=1) : $terms_article = M('page')->where('type="term_article"')->order('id desc')->select(); if($terms_article) : ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						文章
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="<?php echo U('article/index/index'); ?>">全部</a>
						</li>
						<?php foreach($terms_article as $val) : ?>
						<li>
							<a href="<?php echo U('article/index/term?id='.$val['id']); ?>"><?php echo $val['title']; ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</li>
				<?php else : ?>
				<li>
					<a href="<?php echo U('article/index/index'); ?>">
						文章
					</a>
				</li>
				<?php endif; endif; ?>
				<?php $nav = M('option')->where("type='nav'")->order('id asc')->select(); foreach($nav as $val) : ?>
				<li>
					<a href="<?php echo $val['meta_value']; ?>">
						<?php echo $val['meta_key']; ?>
					</a>
				</li>
				<?php endforeach; ?>
				<?php if(mc_is_admin()) : ?>
				<li>
					<a href="#" data-toggle="modal" data-target="#navModal">
						<i class="icon-plus"></i>
					</a>
				</li>
				<?php endif; ?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#" data-toggle="modal" data-target="#searchModal">
						<i class="icon-search"></i>
					</a>
				</li>
				<?php if(mc_user_id()) { ?>
				<li>
					<a href="<?php echo U('user/index/index?id='.mc_user_id()); ?>">
						<i class="icon-user"></i>
						<?php if(mc_user_trend_count()) : ?><span class="count"><?php echo mc_user_trend_count(); ?></span><?php endif; ?>
					</a>
				</li>
				<!--li>
					<a href="<?php //echo U('user/reffer/index?id='.mc_user_id()); ?>">
						<i class="icon-trophy"></i>
					</a>
				</li-->
				<?php if(mc_is_admin()) : ?>
				<li>
					<a href="<?php echo U('control/index/index'); ?>">
						<i class="icon-cogs"></i>
					</a>
				</li>
				<?php endif; ?>
				<li class="dropdown">
					<a href="#" data-toggle="modal" data-target="#qiandaoModal">
						<i class="icon-money"></i>
					</a>
				</li>
				<?php if(mc_option('pro_close')!=1) : ?>
				<li>
					<a href="<?php echo U('pro/cart/index'); ?>">
						<i class="icon-shopping-cart"></i>
						<span class="count"><?php echo mc_cart_count(); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<li>
					<a href="javascript:;" id="head-logout-btn">
						<i class="icon-off"></i>
					</a>
				</li>
				<?php } else { ?>
				<li>
					<a href="#" data-toggle="modal" data-target="#loginModal">
						登陆
					</a>
				</li>
				<li>
					<a href="#" data-toggle="modal" data-target="#registerModal">
						注册
					</a>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>
<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
			</div>
			<div class="modal-body">
				<form id="searchform" role="form" method="get" action="<?php echo mc_option('site_url'); ?>">
					<input id="search-type" type="hidden" name="type" value="<?php if(mc_option('pro_close')!=1) : echo 'pro'; elseif(mc_option('baobei_close')!=1) : echo 'baobei'; elseif(mc_option('article_close')!=1) : echo 'article'; else : echo 'post'; endif; ?>">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span id="search-type-text"><?php if(mc_option('pro_close')!=1) : echo '商品'; elseif(mc_option('article_close')!=1) : echo '文章'; else : echo '主题'; endif; ?></span>
									<span class="caret">
									</span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<?php if(mc_option('pro_close')!=1) : ?>
									<li>
										<a href="javascript:search_type('pro','商品');">
											商品
										</a>
									</li>
									<?php endif; ?>
									<?php if(mc_option('article_close')!=1) : ?>
									<li>
										<a href="javascript:search_type('article','文章');">
											文章
										</a>
									</li>
									<?php endif; ?>
									<?php if(mc_option('group_close')!=1) : ?>
									<li>
										<a href="javascript:search_type('post','主题');">
											主题
										</a>
									</li>
									<?php endif; ?>
								</ul>
							</div>
							<!-- /btn-group -->
							<input name="keyword" type="text" class="form-control input-lg" placeholder="请输入搜索内容～～">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-search"></i>
							</span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php if(mc_user_id()) : ?>
<div class="modal fade" id="qiandaoModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				
			</div>
			<div class="modal-body">
				<div id="mycoins" class="text-center">
					<h4>我的积分：<span id="mycoinscount"><?php echo mc_coins(mc_user_id()); ?></span></h4>
					<p><a href="<?php echo U('user/index/coins?id='.mc_user_id()); ?>">查看积分记录</a></p>
					<p>每日签到最多可获得<span class="text-danger">3</span>积分！</p>
					<?php if(mc_is_qiandao()) : ?>
					<a href="javascript:;" id="qiandao" class="btn btn-warning mb-10">已签到</a>
					<?php else : ?>
					<a href="javascript:mc_qiandao();" id="qiandao" class="btn btn-warning mb-10">签到</a>
					<script>
					function mc_qiandao() {
						$.ajax({
							url: '<?php echo U('home/perform/qiandao'); ?>',
							type: 'GET',
							dataType: 'html',
							timeout: 9000,
							error: function() {
								alert('提交失败！');
							},
							success: function(html) {
								var count = $('#mycoinscount').text()*1+3;
								$('#mycoinscount').text(count);
								$('#qiandao').attr('href','javascript:;');
								$('#qiandao').text('已签到');
							}
						});
					};
					</script>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php else : ?>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				
			</div>
			<div class="modal-body">
				<form role="form" method="post" action="<?php echo U('user/login/submit'); ?>">
					<div class="form-group">
						<input type="text" name="user_name" class="form-control bb-0 input-lg" placeholder="账号">
						<input type="text" name="user_pass" class="form-control input-lg password" placeholder="密码">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-warning btn-block btn-lg">
							立即登陆
						</button>
					</div>
					<?php if(mc_option('loginqq')==2) : ?>
					<div class="form-group">
						<a href="<?php echo mc_site_url(); ?>/connect-qq/oauth/index.php"><img src="<?php echo mc_site_url(); ?>/connect-qq/qq_logo.png"></a>
					</div>
					<?php endif; ?>
					<div class="form-group">
						<p class="help-block">
							<a href="<?php echo U('user/lostpass/index'); ?>">忘记密码？</a>
						</p>
					</div>
					<div class="form-group">
						<a href="<?php echo U('user/register/index'); ?>" class="btn btn-default btn-block btn-lg">
							注册账号
						</a>
					</div>
					<input type="hidden" name="comefrom" value="<?php echo mc_page_url(); ?>">
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				
			</div>
			<div class="modal-body">
				<form role="form" method="post" action="<?php echo U('user/register/submit'); ?>">
					<div class="form-group">
						<input type="text" name="user_name" class="form-control bb-0 input-lg" placeholder="账号">
						<input type="email" name="user_email" class="form-control bb-0 input-lg" placeholder="邮箱">
						<input type="text" name="user_pass" class="form-control bb-0 input-lg password" placeholder="密码">
						<input type="text" name="user_pass2" class="form-control input-lg password" placeholder="重复密码">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-warning btn-block btn-lg">
							立即注册
						</button>
					</div>
					<?php if(mc_option('loginqq')==2) : ?>
					<div class="form-group">
						<a href="<?php echo mc_site_url(); ?>/connect-qq/oauth/index.php"><img src="<?php echo mc_site_url(); ?>/connect-qq/qq_logo.png"></a>
					</div>
					<?php endif; ?>
					<div class="form-group">
						<p class="help-block">
							已有账号<a href="<?php echo U('user/login/index'); ?>">请此登陆</a>
						</p>
					</div>
					<input type="hidden" name="comefrom" value="<?php echo mc_page_url(); ?>">
				</form>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if(mc_is_admin()) : ?>
<div class="modal fade" id="navModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				
			</div>
			<div class="modal-body">
				<div class="form-group">
					<?php foreach($nav as $val) : ?>
					<div class="input-group">
						<input type="text" class="form-control" value="<?php echo $val['meta_key']; ?>" disabled>
						<span class="input-group-addon" data-dismiss="modal" data-toggle="modal" data-target="#delnavModal" data-nav-id="<?php echo $val['id']; ?>">
							<i class="icon-remove"></i>
						</span>
					</div>
					<?php endforeach; ?>
				</div>
				<form role="form" method="post" action="<?php echo U('user/index/site_nav'); ?>">
					<div class="form-group">
						<input type="text" name="nav_text" class="form-control" placeholder="新增导航文本">
					</div>
					<div class="form-group">
						<input type="text" name="nav_link" class="form-control" placeholder="新增导航链接">
					</div>
					<input name="nav_control" type="hidden" value="ok">
					<button type="submit" class="btn btn-warning btn-block">
						<i class="glyphicon glyphicon-ok-circle"></i> 保存
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="delnavModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				
			</div>
			<div class="modal-body">
				删除操作无法撤销，请务必谨慎！
			</div>
			<div class="modal-footer">
				<form method="post" action="<?php echo U('home/perform/nav_del'); ?>">
					<button type="submit" class="btn btn-warning btn-block">
						<i class="glyphicon glyphicon-ok"></i> 确认删除
					</button>
					<input type="hidden" name="id" value="">
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<script>
	$('#navModal').on('show.bs.modal', function (e) {
		$('#navModal .input-group-addon').click(function(){
			var id = $(this).attr('data-nav-id');
			$('#delnavModal input').val(id);
		});
	})
</script>
<?php endif; ?>
<!-- Modal -->
<form method="post" class="inline" id="head-logout" action="<?php echo U('user/login/logout'); ?>">
	<input type="hidden" name="logout" value="ok">
</form>
<script>
	$('#head-logout-btn').click(function(){
		$('#head-logout').submit();
	});
</script>