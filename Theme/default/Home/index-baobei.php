<?php mc_template_part('header'); ?>
	<div class="container">
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
		<?php if($page) : ?>
		<div id="home-main-baobei" class="home-main">
			<h4 class="title">
				<i class="icon-th-large"></i> 最新分享
				<?php $terms_baobei = M('page')->where('type="term_baobei"')->order('id desc')->select(); if($terms_baobei) : ?>
				<div class="pull-right">
					<a href="<?php echo U('baobei/index/index'); ?>" class="active">全部</a>
					<?php foreach($terms_baobei as $val) : ?>
					<a href="<?php echo U('baobei/index/term?id='.$val['id']); ?>"><?php echo $val['title']; ?></a>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</h4>
			<div class="row">
				<?php foreach($page as $val) : ?>
				<div class="col-xs-6 col-sm-3 col baobei">
					<div class="thumbnail">
						<a title="<?php echo $val['title']; ?>" href="<?php echo mc_get_url($val['id']); ?>"  class="img-div"><img src="<?php echo mc_fmimg($val['id']); ?>" alt="<?php echo $val['title']; ?>"></a>
						<div class="caption">
							<?php $author = mc_author_id($val['id']); ?>
							<div class="media">
								<div class="pull-left">
									<a href="<?php echo U('user/index/index?id='.$author); ?>"><img class="img-circle media-object" src="<?php echo mc_user_avatar($author); ?>" alt="<?php echo mc_user_display_name($author); ?>" width="60"></a>
								</div>
								<div class="media-body">
									<p class="media-heading">
										由 <a href="<?php echo U('user/index/index?id='.$author); ?>"><?php echo mc_user_display_name($author); ?></a> 分享到 <a href="<?php echo U('baobei/index/term?id='.mc_get_meta($val['id'],'term')); ?>"><?php echo mc_get_page_field(mc_get_meta($val['id'],'term'),'title'); ?></a>
									</p>
								</div>
							</div>
							<hr>
							<h4><?php echo $val['title']; ?></h4>
							<?php echo mc_cut_str(strip_tags($val['content']),140); ?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<div id="baobei-pagenavi">
				<?php echo mc_pagenavi($count,$page_now,2); ?>
			</div>
			<script type="text/javascript" src="//upcdn.b0.upaiyun.com/libs/jquery/jquery-1.7.2.min.js"></script>
			<script src="<?php echo mc_theme_url(); ?>/js/jquery.masonry.min.js"></script>
			<script src="<?php echo mc_theme_url(); ?>/js/jquery.infinitescroll.min.js"></script>
			<script>
				$(function() {
					var $container = $('#home-main-baobei .row');
			
					$container.imagesLoaded(function() {
						$container.masonry({
							itemSelector: '.col',
						});
					});
					$container.infinitescroll({
						navSelector: '#baobei-pagenavi',
						// selector for the paged navigation 
						nextSelector: '#baobei-pagenavi .next a',
						// selector for the NEXT link (to page 2)
						itemSelector: '.baobei',
						// selector for all items you'll retrieve
						loading: {
							finishedMsg: '<i class="icon-warning-sign"></i> 全部内容加载完毕...',
							img: '<?php echo mc_theme_url(); ?>/img/loading.gif'
						}
					},
					// trigger Masonry as a callback
					function(newElements) {
						// hide new items while they are loading
						var $newElems = $(newElements).css({
							opacity: 0
						});
						// ensure that images load before adding to masonry layout
						$newElems.imagesLoaded(function() {
							// show elems now they're ready
							$newElems.animate({
								opacity: 1
							});
							$container.masonry('appended', $newElems, true);
						});
					});
				});
			</script>
		</div>
		<?php else : ?>
		<div id="nothing">
			暂时没有任何分享，去<a href="<?php echo U('baobei/index/index'); ?>">分享更多宝贝</a>吧！
		</div>
		<?php endif; ?>
	</div>
<?php mc_template_part('footer'); ?>