<?php mc_template_part('header'); ?>
	<div class="container home-main">
		<h4 class="title mb-0">
			<i class="icon-search"></i> 搜索结果
		</h4>
		<div class="row">
			<div class="col-sm-12" id="post-list-default">
				<?php if($page) : ?>
				<ul class="list-group">
				<?php foreach($page as $val) : ?>
				<li class="list-group-item" id="mc-page-<?php echo $val['id']; ?>">
					<div class="row">
						<div class="col-sm-6 col-md-7 col-lg-8">
							<div class="media">
								<?php $author = mc_get_meta($val['id'],'author',true); ?>
								<a class="pull-left img-div" href="<?php echo mc_get_url($author); ?>">
									<img width="40" class="media-object" src="<?php echo mc_user_avatar($author); ?>" alt="<?php echo mc_user_display_name($author); ?>">
								</a>
								<div class="media-body">
									<h4 class="media-heading">
										<a href="<?php echo mc_get_url($val['id']); ?>"><?php echo $val['title']; ?></a>
									</h4>
									<p class="post-info">
										<i class="glyphicon glyphicon-user"></i><a href="<?php echo mc_get_url($author); ?>"><?php echo mc_user_display_name($author); ?></a>
										<i class="glyphicon glyphicon-home"></i><a href="<?php echo mc_get_url(mc_get_meta($val['id'],'group')); ?>"><?php echo mc_get_page_field(mc_get_meta($val['id'],'group'),'title'); ?></a>
										<i class="glyphicon glyphicon-time"></i><?php echo date('Y-m-d H:i:s',$val['date']); ?>
									</p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-5 col-lg-4 text-right">
							<ul class="list-inline">
							<?php if(mc_last_comment_user($val['id'])) : ?>
							<li>最后：<?php echo mc_user_display_name(mc_last_comment_user($val['id'])); ?></li>
							<?php endif; ?>
							<li>点击：<?php echo mc_views_count($val['id']); ?></li>
							</ul>
						</div>
					</div>
				</li>
				<?php endforeach; ?>
				</ul>
				<?php echo mc_pagenavi($count,$page_now); ?>
				<?php else : ?>
				<div id="nothing">没有搜索到任何东东！</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php mc_template_part('footer'); ?>