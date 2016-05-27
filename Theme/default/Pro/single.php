<?php mc_template_part('header'); ?>
	<?php foreach($page as $val) : ?>
	<div class="container">
		<ol class="breadcrumb" id="baobei-breadcrumb">
			<li>
				<a href="<?php echo mc_site_url(); ?>">
					首页
				</a>
			</li>
			<li>
				<a href="<?php echo U('pro/index/index'); ?>">
					商品
				</a>
			</li>
			<?php $term_id = mc_get_meta($val['id'],'term'); $parent = mc_get_meta($term_id,'parent',true,'term'); if($parent) : ?>
			<li class="hidden-xs">
				<a href="<?php echo U('pro/index/term?id='.$parent); ?>">
					<?php echo mc_get_page_field($parent,'title'); ?>
				</a>
			</li>
			<?php endif; ?>
			<li>
				<a href="<?php echo U('pro/index/term?id='.$term_id); ?>">
					<?php echo mc_get_page_field($term_id,'title'); ?>
				</a>
			</li>
			<li class="active hidden-xs">
				<?php echo $val['title']; ?>
			</li>
		</ol>
	</div>
	<div id="single-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-6" id="pro-index-tl">
					<div id="pro-index-tlin">
					<?php $fmimg_args = mc_get_meta($val['id'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<?php foreach($fmimg_args as $fmimg) : ?>
							<?php $fmimg_num++; ?>
							<li data-target="#carousel-example-generic" data-slide-to="<?php echo $fmimg_num-1; ?>" class="<?php if($fmimg_num==1) echo 'active'; ?>"></li>
							<?php endforeach; ?>
						</ol>
						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							<?php $fmimg_num=0; ?>
							<?php foreach($fmimg_args as $fmimg) : ?>
							<?php $fmimg_num++; ?>
							<div class="item <?php if($fmimg_num==1) echo 'active'; ?>">
								<div class="imgshow"><img src="<?php echo $fmimg; ?>" alt="<?php echo $val['title']; ?>"></div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					</div>
				</div>
				<div class="col-sm-6" id="pro-index-tr">
					<div id="pro-index-trin">
					<h1>
						<?php echo $val['title']; ?>
					</h1>
					<h3>
						<div class="row">
							<div class="col-xs-6 col">
								<span id="price" price-data="<?php echo mc_get_meta($val['id'],'price'); ?>"><?php echo mc_price_now($val['id']); ?></span> 元
							</div>
							<div class="col-xs-6 col text-right">
								<small>库存：<?php echo mc_get_meta($val['id'],'kucun'); ?></small>
								<small>销量：<?php echo mc_get_meta($val['id'],'xiaoliang'); ?></small>
							</div>
						</div>
					</h3>
					<form method="post" action="<?php echo U('home/perform/add_cart'); ?>" id="pro-single-form">
					<?php $parameter = M('option')->where("meta_key='parameter' AND type='pro'")->select(); if($parameter) : foreach($parameter as $par) : ?>
					<?php $pro_parameter = mc_get_meta($val['id'],$par['id'],false,'parameter'); if($pro_parameter) : ?>
					<h4 class="pro-par-list-title"><?php echo $par['meta_value']; ?></h4>
					<ul class="list-inline pro-par-list" id="par-list-<?php echo $par['id']; ?>">
					<?php $num=0; ?>
					<?php foreach($pro_parameter as $pro_par) : $num++; ?>
						<?php 
							$price = M('meta')->where("page_id='".$val['id']."' AND meta_key='$pro_par' AND type ='price'")->getField('meta_value');
						?>
						<li>
							<label <?php if($num==1) echo 'class="active"'; ?> price-data="<?php if($price) : echo $price; else : echo '0'; endif; ?>">
								<span><?php echo $pro_par; ?></span>
								<input type="radio" name="parameter[<?php echo $par['id']; ?>]" value="<?php echo $pro_par; ?>"  <?php if($num==1) echo 'checked'; ?>>
							</label>
						</li>
					<?php endforeach; ?>
					<script>
						$('#par-list-<?php echo $par['id']; ?> label').click(function(){
							$('#par-list-<?php echo $par['id']; ?> label').removeClass('active');
							$(this).addClass('active');
							var price_now = $('#price').attr('price-data')*1;
							$.each($('.pro-par-list label.active'),function(){
								price_now += parseInt($(this).attr('price-data'));
							});
							$('#price').text(price_now);
						});
					</script>
					</ul>
					<?php endif; ?>
					<?php endforeach; endif; ?>
					<div class="form-group">
						<?php if(mc_get_meta($val['id'],'kucun')<=0) : ?>
						<button type="button" class="btn btn-default">
							<i class="icon-umbrella"></i> 暂时缺货
						</button>
						<?php else : ?>
						<div class="btn-group">
							<div class="btn-group">
								<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
									购买数量：<span id="buy-num">1</span>
									<span class="caret">
									</span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<?php do { $i++; ?>
									<li>
										<a href="javascript:;">
											<?php echo $i; ?>
										</a>
									</li>
									<?php } while ($i < 10); ?>
								</ul>
							</div>
							<button type="submit" class="btn btn-warning add-cart">
								<i class="glyphicon glyphicon-plus"></i> 加入购物车
							</button>
						</div>
						<?php endif; ?>
					</div>
					<div class="form-group">
						<button type="submit" class="wish">
							<i class="icon-heart"></i> 我想要
						</button>
					</div>
					<script>
						$('.add-cart').hover(function(){
							$('#pro-single-form').attr('action','<?php echo U('home/perform/add_cart'); ?>');
						});
						$('.wish').hover(function(){
							$('#pro-single-form').attr('action','<?php echo U('publish/index/add_post?group='.$val['id'].'&wish=1'); ?>');
						});
					</script>
					<input id="buy-num-input" type="hidden" name="number" value="1">
					<input type="hidden" value="<?php echo $val['id']; ?>" name="id">
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
	<div id="pro-single" class="mb-20">
		<div class="row">
			<div class="col-sm-12" id="single">
				<div id="entry">
					<?php echo mc_magic_out($val['content']); ?>
				</div>
				<hr>
				<div class="text-center">
					<?php if(!mc_is_admin() && !mc_is_bianji()) : ?>
					<?php echo mc_xihuan_btn($val['id']); ?>
					<?php echo mc_shoucang_btn($val['id']); ?>
					<?php else : ?>
					<a href="<?php echo U('publish/index/edit?id='.$val['id']); ?>" class="btn btn-info">
						<i class="glyphicon glyphicon-edit"></i> 编辑
					</a>
					<button class="btn btn-default" data-toggle="modal" data-target="#myModal">
						<i class="glyphicon glyphicon-trash"></i> 删除
					</button>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="home-main">
		<div class="row mb-20">
			<div class="col-sm-12" id="post-list-default">
				<h4 class="title mb-10">
					<i class="icon-globe"></i> 相关话题
					<a class="pull-right" href="<?php echo U('post/group/single?id='.$val['id']); ?>">
						<i class="icon-angle-right"></i>
					</a>
				</h4>
				<?php 
				$condition['type'] = 'publish';
		        $args_id = M('meta')->where("meta_key='group' AND meta_value='".$val['id']."'")->getField('page_id',true);
		        $condition['id']  = array('in',$args_id);
			    $page_group = M('page')->where($condition)->order('date desc')->limit(0,5)->select();
				if($page_group) :
				?>
				<ul class="list-group mb-0">
				<?php foreach($page_group as $val_group) : ?>
				<li class="list-group-item" id="mc-page-<?php echo $val_group['id']; ?>">
					<div class="row">
						<div class="col-sm-6 col-md-7 col-lg-8">
							<div class="media">
								<?php $author_group = mc_get_meta($val_group['id'],'author',true); ?>
								<a class="pull-left img-div" href="<?php echo mc_get_url($author_group); ?>">
									<img width="40" class="media-object" src="<?php echo mc_user_avatar($author_group); ?>" alt="<?php echo mc_user_display_name($author_group); ?>">
								</a>
								<div class="media-body">
									<h4 class="media-heading">
										<a href="<?php echo mc_get_url($val_group['id']); ?>"><?php echo $val_group['title']; ?></a>
									</h4>
									<p class="post-info">
										<i class="glyphicon glyphicon-user"></i><a href="<?php echo mc_get_url($author_group); ?>"><?php echo mc_user_display_name($author_group); ?></a>
										<i class="glyphicon glyphicon-time"></i><?php echo date('Y-m-d H:i:s',$val_group['date']); ?>
									</p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-5 col-lg-4 text-right">
							<ul class="list-inline">
							<?php if(mc_last_comment_user($val_group['id'])) : ?>
							<li>最后：<?php echo mc_user_display_name(mc_last_comment_user($val_group['id'])); ?></li>
							<?php endif; ?>
							<li>点击：<?php echo mc_views_count($val_group['id']); ?></li>
							</ul>
						</div>
					</div>
				</li>
				<?php endforeach; ?>
				</ul>
				<?php else : ?>
				<div id="nothing">
					没有任何相关话题！<a rel="nofollow" href="<?php echo U('post/group/single?id='.$val['id']); ?>">发表新话题</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<h4 class="title mb-0">
			<i class="icon-comments"></i> 商品评论
		</h4>
	</div>
	<div id="pro-single">
		<div class="row">
			<div class="col-sm-12 pt-0" id="single">
				<?php if(mc_user_id()) : ?>
				<form role="form" method="post" action="<?php echo U('home/perform/comment'); ?>">
					<div class="form-group">
						<textarea id="comment-textarea" name="content" class="form-control" rows="3" placeholder="请输入评论内容"></textarea>
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-block btn-warning">
							<i class="glyphicon glyphicon-ok"></i> 提交
						</button>
					</div>
					<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
				</form>
				<?php else : ?>
				<form role="form">
					<div class="form-group">
						<textarea id="comment-textarea" name="content" class="form-control" rows="3" placeholder="请输入评论内容" disabled></textarea>
						<p class="help-block">您必须在<a href="<?php echo U('user/login/index'); ?>">登陆</a>或<a href="<?php echo U('user/register/index'); ?>">注册</a>后，才可以发表评论！</p>
					</div>
				</form>
				<?php endif; ?>
				<?php if(mc_comment_count($val['id'])) : ?>
				<hr>
				<h3>全部评论（<?php echo mc_comment_count($val['id']); ?>）</h3>
				<hr>
				<?php echo W("Comment/index",array($val['id'])); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	</div>
	<?php if(mc_is_admin()) : ?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						
					</h4>
				</div>
				<div class="modal-body text-center">
					确认要删除这篇文章吗？
				</div>
				<div class="modal-footer" style="text-align:center;">
					<form method="post" action="<?php echo U('home/perform/delete'); ?>">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<i class="glyphicon glyphicon-remove"></i> 取消
					</button>
					<button type="submit" class="btn btn-danger">
						<i class="glyphicon glyphicon-ok"></i> 确定
					</button>
					<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<?php endif; ?>
	<?php endforeach; ?>
<?php mc_template_part('footer'); ?>