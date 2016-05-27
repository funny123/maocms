<?php mc_template_part('header'); ?>
	<?php if(mc_option('homehdys')==2) : ?>
	<style>
		body {padding-top: 0;}
		#topnav { position: absolute;}
		#topnav.fixed-top {position: fixed; top:0!important;}
		#hometop2 {margin-bottom: 20px;}
		#hometop2 .img-div {background-position: center center; background-repeat: no-repeat; background-size: cover; opacity: 1; filter: alpha(opacity=100);}
		#hometop2 .carousel-indicators {bottom: auto; top:50px;}
		#hometop2 .carousel-indicators li {border: 0; background-color: #e2e5e9; border-width: 2px; border-radius: 20px; margin: 0 5px; width: 40px; height: 40px; opacity: 0.8; filter: alpha(opacity=80);}
		#hometop2 .carousel-indicators .active {background-color: #3f484f;}
		#hometop2 .goto {position: absolute; bottom: 110px; width: 100px; height: 100px; display: block; text-align: center; line-height: 100px; font-size: 80px; left: 50%; margin-left: -25px; z-index: 9999; color: #fff; opacity: 0.8; filter: alpha(opacity=80); animation: jumpdown 3s ease 1s infinite;-moz-animation: jumpdown 3s ease 1s infinite;	/* Firefox */-webkit-animation: jumpdown 3s ease 1s infinite;	/* Safari 和 Chrome */-o-animation: jumpdown 3s ease 1s infinite;	/* Opera */ text-decoration: none!important;}
		#hometop2 .goto:hover {color: #3f484f;}
		@keyframes jumpdown
		{
		0%   {bottom: 110px;}
		60%  {bottom: 110px;}
		70%  {bottom: 130px;}
		80%  {bottom: 110px;}
		90%  {bottom: 120px;}
		100% {bottom: 110px;}
		}
		
		@-moz-keyframes jumpdown /* Firefox */
		{
		0%   {bottom: 110px;}
		60%  {bottom: 110px;}
		70%  {bottom: 130px;}
		80%  {bottom: 110px;}
		90%  {bottom: 120px;}
		100% {bottom: 110px;}
		}
		
		@-webkit-keyframes jumpdown /* Safari 和 Chrome */
		{
		0%   {bottom: 110px;}
		60%  {bottom: 110px;}
		70%  {bottom: 130px;}
		80%  {bottom: 110px;}
		90%  {bottom: 120px;}
		100% {bottom: 110px;}
		}
		
		@-o-keyframes jumpdown /* Opera */
		{
		0%   {bottom: 110px;}
		60%  {bottom: 110px;}
		70%  {bottom: 130px;}
		80%  {bottom: 110px;}
		90%  {bottom: 120px;}
		100% {bottom: 110px;}
		}
	</style>
	<div id="hometop2">
		<a href="#home-main-1" class="goto">
			<i class="icon-circle-arrow-down"></i>
		</a>
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<?php if(mc_option('homehdimg2')) : ?>
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active">
						</li>
						<li data-target="#carousel-example-generic" data-slide-to="1">
						</li>
						<?php if(mc_option('homehdimg3')) : ?>
						<li data-target="#carousel-example-generic" data-slide-to="2">
						</li>
						<?php endif; ?>
					</ol>
					<?php endif; ?>
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<div class="item active">
							<a class="img-div" href="<?php echo mc_option('homehdlnk1'); ?>" style="background-image: url(<?php echo mc_option('homehdimg1'); ?>);"></a>
						</div>
						<?php if(mc_option('homehdimg2')) : ?>
						<div class="item">
							<a class="img-div" href="<?php echo mc_option('homehdlnk2'); ?>" style="background-image: url(<?php echo mc_option('homehdimg2'); ?>);"></a>
						</div>
						<?php endif; ?>
						<?php if(mc_option('homehdimg3')) : ?>
						<div class="item">
							<a class="img-div" href="<?php echo mc_option('homehdlnk3'); ?>" style="background-image: url(<?php echo mc_option('homehdimg3'); ?>);"></a>
						</div>
						<?php endif; ?>
					</div>
				</div>
	</div>
	<script>
		$(document).ready(function(){
			var height = $(window).height();
			$('#carousel-example-generic .img-div').css('height',height);
			$('#topnav').css('top',height-56);
		});
	</script>
	<?php endif; ?>
	<div class="container">
		<?php if(mc_option('homehdys')!=2) : ?>
		<div class="row mb-20 hidden-xs" id="home-top">
			<div class="col-md-12 col">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<?php if(mc_option('homehdimg2')) : ?>
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active">
						</li>
						<li data-target="#carousel-example-generic" data-slide-to="1">
						</li>
						<?php if(mc_option('homehdimg3')) : ?>
						<li data-target="#carousel-example-generic" data-slide-to="2">
						</li>
						<?php endif; ?>
					</ol>
					<?php endif; ?>
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<div class="item active">
							<a class="img-div" href="<?php echo mc_option('homehdlnk1'); ?>"><img src="<?php echo mc_option('homehdimg1'); ?>"></a>
						</div>
						<?php if(mc_option('homehdimg2')) : ?>
						<div class="item">
							<a class="img-div" href="<?php echo mc_option('homehdlnk2'); ?>"><img src="<?php echo mc_option('homehdimg2'); ?>"></a>
						</div>
						<?php endif; ?>
						<?php if(mc_option('homehdimg3')) : ?>
						<div class="item">
							<a class="img-div" href="<?php echo mc_option('homehdlnk3'); ?>"><img src="<?php echo mc_option('homehdimg3'); ?>"></a>
						</div>
						<?php endif; ?>
					</div>
					<?php if(mc_option('homehdimg2')) : ?>
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left">
						</span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right">
						</span>
					</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php if(mc_option('pro_close')!=1) : ?>
		<?php $newpro = M('page')->where('type="pro"')->order('id desc')->page(1,8)->select(); if($newpro) : ?>
		<div id="home-main-1" class="home-main">
			<div class="row">
				<div class="col-md-8 col-lg-9">
					<h4 class="title">
						<i class="icon-th-large"></i> 最新商品
						<a class="pull-right" href="<?php echo U('pro/index/index'); ?>"><i class="icon-angle-right"></i></a>
					</h4>
					<div class="row mb-20" id="pro-list">
					<?php foreach($newpro as $val) : ?>
					<?php $num_newproa++; ?>
						<div class="col-sm-6 col-md-4 col-lg-3 col <?php if($num_newproa==7 || $num_newproa==8) echo 'hidden-md'; ?>">
							<div class="thumbnail">
								<?php $fmimg_args = mc_get_meta($val['id'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
								<a class="img-div" href="<?php echo mc_get_url($val['id']); ?>"><img src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo mc_get_page_field($val['id'],'title'); ?>"></a>
								<div class="caption">
									<h4>
										<a href="<?php echo mc_get_url($val['id']); ?>"><?php echo mc_get_page_field($val['id'],'title'); ?></a>
									</h4>
									<p class="price pull-left">
										<span><?php echo mc_price_now($val['id']); ?></span> <small>元</small>
									</p>
									<?php if(mc_get_meta($val['id'],'kucun')<=0) : ?>
									<button type="button" class="btn btn-default btn-xs pull-right">
										<i class="icon-umbrella"></i> 暂时缺货
									</button>
									<?php else : ?>
									<a href="<?php echo U('home/perform/add_cart','id='.$val['id'].'&number=1'); ?>" class="btn btn-warning btn-xs pull-right">
										<i class="glyphicon glyphicon-plus"></i> 加入购物车
									</a>
									<?php endif; ?>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
				<div class="col-md-4 col-lg-3 hidden-xs hidden-sm home-side">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="icon-th-list"></i> 热门商品
						</div>
						<ul class="list-group">
							<?php 
							$Model = new \Think\Model();
							$newprob = $Model->query("select page_id from __PREFIX__meta where meta_key='views' and page_id in (select id from __PREFIX__page where type='pro') order by meta_value desc limit 0,4");
							?>
							<?php foreach($newprob as $val) : ?>
							<li class="list-group-item">
								<div class="media">
									<a class="pull-left img-div" href="<?php echo mc_get_url($val['page_id']); ?>">
										<?php $fmimg_args = mc_get_meta($val['page_id'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
										<img class="media-object" src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo mc_get_page_field($val['page_id'],'title'); ?>">
									</a>
									<div class="media-body">
										<h4 class="media-heading">
											<a href="<?php echo mc_get_url($val['page_id']); ?>"><?php echo mc_get_page_field($val['page_id'],'title'); ?></a>
										</h4>
										<p><span><?php echo mc_price_now($val['page_id']); ?></span> <small>元</small></p>
										<?php if(mc_get_meta($val['page_id'],'kucun')<=0) : ?>
										<button type="button" class="btn btn-default btn-xs">
											<i class="icon-umbrella"></i> 暂时缺货
										</button>
										<?php else : ?>
										<a href="<?php echo U('home/perform/add_cart','id='.$val['page_id'].'&number=1'); ?>" class="btn btn-warning btn-xs">
											<i class="glyphicon glyphicon-plus"></i> 加入购物车
										</a>
										<?php endif; ?>
									</div>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="icon-th-list"></i> 最新文章
							<a class="pull-right" href="<?php echo U('article/index/index'); ?>"><i class="icon-angle-right"></i></a>
						</div>
						<?php $newarticle = M('page')->where("type='article'")->order('id desc')->page(1,4)->select(); if($newarticle) : ?>
						<div class="list-group">
							<?php foreach($newarticle as $val) : ?>
							<a href="<?php echo mc_get_url($val['id']); ?>" class="list-group-item">
								<?php echo $val['title']; ?>
							</a>
							<?php endforeach; ?>
						</div>
						<?php else : ?>
						<div class="panel-body">
							暂时没有任何文章，现在就去
							<br>
							<a href="<?php echo U('article/index/index'); ?>">写下网站的第一篇文章!</a>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php else : ?>
		<div id="nothing">
			暂时没有任何商品，去<a href="<?php echo U('pro/index/index'); ?>">添加更多商品</a>吧！
		</div>
		<?php endif; endif; ?>
		<?php if(mc_option('group_close')!=1) : ?>
		<div class="home-main" id="home-main-3">
			<div class="row">
				<div class="col-sm-6 col-md-4 col col-1">
					<h4 class="title">
						<i class="icon-comments-alt"></i> 最新话题
						<a class="pull-right" href="<?php echo U('post/group/index'); ?>"><i class="icon-angle-right"></i></a>
					</h4>
					<?php if($page) : ?>
					<div class="row">
						<div class="col-sm-12" id="post-list-default">
							<ul class="list-group">
							<?php foreach($page as $val) : $postnum++; ?>
							<li class="list-group-item <?php if($postnum==7) echo 'hidden-md'; ?>" id="mc-page-<?php echo $val['id']; ?>">
								<div class="row">
									<div class="col-sm-12">
										<div class="media">
											<?php $author = mc_get_meta($val['id'],'author',true); ?>
											<a class="pull-left img-div" href="<?php echo mc_get_url($author); ?>">
												<img width="40" class="media-object" src="<?php echo mc_user_avatar($author); ?>" alt="<?php echo mc_user_display_name($author); ?>">
											</a>
											<div class="media-body">
												<h4 class="media-heading">
													<a href="<?php echo mc_get_url($val['id']); ?>"><?php echo $val['title']; ?></a>
												</h4>
												<p class="post-info hidden-xs">
													<i class="glyphicon glyphicon-user"></i><a href="<?php echo mc_get_url($author); ?>"><?php echo mc_user_display_name($author); ?></a>
													<i class="glyphicon glyphicon-home"></i><a href="<?php echo mc_get_url(mc_get_meta($val['id'],'group')); ?>"><?php echo mc_get_page_field(mc_get_meta($val['id'],'group'),'title'); ?></a>
													<span class="hidden-md"><i class="glyphicon glyphicon-time"></i><?php echo date('m月d日',mc_get_meta($val['id'],'time')); ?></span>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>
							<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<?php else : ?>
					<div id="nothing">
						暂无任何话题，没关系，加油！
					</div>
					<?php endif; ?>
				</div>
				<div class="col-sm-6 col-md-4 col col-2">
					<h4 class="title">
						<i class="icon-home"></i> 最新群组
						<a class="pull-right" href="<?php echo U('post/group/index'); ?>"><i class="icon-angle-right"></i></a>
					</h4>
					<?php $group = M('page')->where('type="group"')->order('date desc')->page(1,4)->select(); if($group) : ?>
					<div class="row mb-20" id="group-list">
						<?php foreach($group as $val) : ?>
						<div class="col-sm-6 col">
							<div class="panel panel-default">
								<a href="<?php echo mc_get_url($val['id']); ?>" class="img-div hidden-xs">
									<img src="<?php echo mc_fmimg($val['id']); ?>">
								</a>
								<a href="<?php echo mc_get_url($val['id']); ?>" class="panel-heading">
									<?php echo $val['title']; ?>
								</a>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					<?php else : ?>
					<div id="nothing">
						暂时没有任何群组，去<a href="<?php echo U('publish/index/add_group'); ?>">建立第一个群组</a>吧！
					</div>
					<?php endif; ?>
				</div>
				<div class="col-sm-6 col-md-4 col col-3 hidden-sm">
					<h4 class="title">
						<i class="icon-bullhorn"></i> 网站公告
					</h4>
					<div class="panel panel-default">
						<div class="panel-body">
							<?php echo mc_magic_out(mc_option('gonggao')); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php endif; ?>
	</div>
<?php mc_template_part('footer'); ?>