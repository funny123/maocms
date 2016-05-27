<?php mc_template_part('header'); ?>
	<header id="group-head" class="hidden-xs">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<h1>
						<a id="logo" class="pull-left img-div" href="<?php echo mc_get_url($_GET['id']); ?>"><img src="<?php echo mc_fmimg($_GET['id']); ?>"></a>
						<a href="<?php echo mc_get_url($_GET['id']); ?>" class="pull-left title">
							<?php if(mc_get_page_field($_GET['id'],'type')=='pro') : //商品版块 ?>
							<?php echo mc_get_page_field($_GET['id'],'title'); ?> 相关话题
							<?php else : //普通版块 ?>
							<?php echo mc_get_page_field($_GET['id'],'title'); ?>
							<?php endif; ?>
						</a>
					</h1>
				</div>
				<div class="col-sm-4">
					
				</div>
			</div>
		</div>
	</header>
	<div class="container">
		<ol class="breadcrumb mb-20 mt-20" id="baobei-term-breadcrumb">
			<li>
				<a href="<?php echo U('home/index/index'); ?>">
					首页
				</a>
			</li>
			<li>
				<a href="<?php echo U('post/group/index'); ?>">
					社区
				</a>
			</li>
			<li class="active">
				<?php echo mc_get_page_field($_GET['id'],'title'); ?>
			</li>
			<div class="pull-right">
				<a href="javascript:;" class="publish"><?php echo $count; ?></a>
			</div>
		</ol>
		<div class="row">
			<div class="col-sm-8 col-lg-9" id="group">
				<?php if(mc_get_page_field($_GET['id'],'type')=='pro') : //商品版块 ?>
				<?php else : //普通版块 ?>
				<div class="panel panel-default">
					<div class="panel-body">
						<?php echo mc_magic_out(mc_get_page_field($_GET['id'],'content')); ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if($page) : ?>
				<div id="post-list-default">
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
				</div>
				<?php else : ?>
				<div id="post-list-default">
					<ul class="list-group">
						<li class="list-group-item text-center" style="padding:120px 0;">
							暂无任何话题！
						</li>
					</ul>
				</div>
				<?php endif; ?>
				<div class="text-center">
					<?php if(!mc_is_admin()) : ?>
					<?php echo mc_xihuan_btn($_GET['id']); ?>
					<?php echo mc_shoucang_btn($val['id']); ?>
					<?php endif; ?>
					<?php if(mc_get_page_field($_GET['id'],'type')=='pro') : //商品版块 ?>
					<?php else : //普通版块 ?>
					<?php if(mc_is_admin() || mc_is_bianji()) { ?>
					<a href="<?php echo U('publish/index/edit?id='.$_GET['id']); ?>" class="btn btn-info">
						<i class="glyphicon glyphicon-edit"></i> 编辑
					</a>
					<button class="btn btn-default" data-toggle="modal" data-target="#myModal">
						<i class="glyphicon glyphicon-trash"></i> 删除
					</button>
					<?php } ?>
					<?php endif; ?>
				</div>
				<link rel="stylesheet" href="<?php echo mc_site_url(); ?>/Kindeditor/themes/default/default.css" />
				<form role="form" method="post" action="<?php echo U('home/perform/publish'); ?>">
					<div class="form-group">
						<label>
							标题
						</label>
						<input name="title" type="text" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label>
							主题内容
						</label>
						<textarea name="content" class="form-control" rows="3"></textarea>
					</div>
					<button type="submit" class="btn btn-warning btn-block">
						<i class="glyphicon glyphicon-ok"></i> 提交
					</button>
					<input type="hidden" name="group" value="<?php echo $id; ?>">
				</form>
				<script charset="utf-8" src="<?php echo mc_site_url(); ?>/Kindeditor/kindeditor-min.js"></script>
				<script charset="utf-8" src="<?php echo mc_site_url(); ?>/Kindeditor/lang/zh_CN.js"></script>
				<script>
					var editor;
					KindEditor.ready(function(K) {
						editor = K.create('textarea[name="content"]', {
							resizeType : 1,
							allowPreviewEmoticons : false,
							allowImageUpload : true,
							height : 300,
							uploadJson : '<?php echo U('Publish/index/upload'); ?>',
							items : ['source', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'clearhtml', 'quickformat', 'selectall', '|', 
					'formatblock', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
					'italic', 'underline', 'strikethrough', 'removeformat', '|', 'image', 'multiimage', 'table', 'hr', 'emoticons', 'baidumap', 'link', 'unlink'],
							afterChange : function() {
								K(this).html(this.count('text'));
							}
						});
					});
				</script>
			</div>
			<div class="col-sm-4 col-lg-3 hidden-xs" id="group-side">
				<ul class="nav nav-pills nav-stacked text-center mb-20">
					<li class="active"><a href="<?php echo U('post/group/single?id='.$_GET['id']); ?>">全部主题</a></li>
					<li><a href="<?php echo U('publish/index/add_post?group='.$_GET['id']); ?>">发起话题</a></li>
					<?php if(mc_is_admin() || mc_is_bianji()) : ?>
					<li><a href="<?php echo U('publish/index/add_group'); ?>">新建版块</a></li>
					<?php endif; ?>
				</ul>
				<?php if(mc_get_page_field($_GET['id'],'type')=='pro') : //商品版块 ?>
				<div class="thumbnail">
					<?php $fmimg_args = mc_get_meta($_GET['id'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
					<a class="img-div" href="<?php echo mc_get_url($_GET['id']); ?>"><img src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo mc_get_page_field($_GET['id'],'title'); ?>"></a>
					<div class="caption">
						<h4>
							<a href="<?php echo mc_get_url($_GET['id']); ?>"><?php echo mc_get_page_field($_GET['id'],'title'); ?></a>
						</h4>
						<p class="price pull-left">
							<span><?php echo mc_price_now($_GET['id']); ?></span> <small>元</small>
						</p>
						<?php if(mc_get_meta($_GET['id'],'kucun')<=0) : ?>
						<button type="button" class="btn btn-default btn-xs pull-right">
							<i class="icon-umbrella"></i> 暂时缺货
						</button>
						<?php else : ?>
						<form method="post" action="<?php echo U('home/perform/add_cart'); ?>">
						<button type="submit" class="btn btn-warning btn-xs pull-right">
							<i class="glyphicon glyphicon-plus"></i> 加入购物车
						</button>
						<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
						<input type="hidden" name="number" value="1">
						</form>
						<?php endif; ?>
						<div class="clearfix"></div>
					</div>
				</div>
				<?php else : ?>
				<?php mc_template_part('sidebar'); ?>
				<?php endif; ?>
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
					<p>确认要删除此版块吗？</p>
					注意：当前版块下的所有话题都会被删除！
				</div>
				<div class="modal-footer" style="text-align:center;">
					<form method="post" action="<?php echo U('home/perform/delete'); ?>">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<i class="glyphicon glyphicon-remove"></i> 取消
					</button>
					<button type="submit" class="btn btn-danger">
						<i class="glyphicon glyphicon-ok"></i> 确定
					</button>
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<?php endif; ?>
<?php mc_template_part('footer'); ?>