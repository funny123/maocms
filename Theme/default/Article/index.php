<?php mc_template_part('header'); ?>
	<div class="container">
		<ol class="breadcrumb mb-20 mt-20" id="baobei-term-breadcrumb">
			<li>
				<a href="<?php echo mc_site_url(); ?>">
					首页
				</a>
			</li>
			<?php if(MODULE_NAME=='Home') : ?>
			<li>
				文章
			</li>
			<li class="active hidden-xs">
				搜索 - <?php echo $_GET['keyword']; ?>
			</li>
			<?php else : ?>
			<li class="active">
				文章
			</li>
			<?php endif; ?>
			<div class="pull-right">
				<?php if(mc_is_admin() || mc_is_bianji()) : ?>
				<a href="#" data-toggle="modal" data-target="#addtermModal">添加分类</a>
				<a href="<?php echo U('publish/index/add_article'); ?>" class="publish">写文章</a>
				<?php endif; ?>
			</div>
		</ol>
		<div id="article-list">
			<div class="row">
				<?php foreach($page as $val) : ?>
				<div class="col-md-6">
					<div class="thumbnail">
						<a href="<?php echo mc_get_url($val['id']); ?>" class="img-div"><img src="<?php echo mc_fmimg($val['id']); ?>" alt="<?php echo $val['title']; ?>"></a>
						<div class="caption">
							<h3>
								<a href="<?php echo mc_get_url($val['id']); ?>"><?php echo $val['title']; ?></a>
							</h3>
							<p>
								<?php echo mc_cut_str(strip_tags(mc_magic_out($val['content'])),200); ?>
							</p>
							<ul class="list-inline">
								<li><?php echo mc_xihuan_btn($val['id']); ?></li>
								<li><?php echo mc_shoucang_btn($val['id']); ?></li>
							</ul>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php echo mc_pagenavi($count,$page_now); ?>
	</div>
	<?php if(mc_is_admin() || mc_is_bianji()) : ?>
	<!-- Modal -->
	<div class="modal fade" id="addtermModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
				</div>
				<form role="form" method="post" action="<?php echo U('home/perform/publish_term'); ?>">
				<div class="modal-body">
					<div class="form-group">
						<label>
							分类名称
						</label>
						<input name="title" type="text" class="form-control" placeholder="">
					</div>
					<input type="hidden" name="type" value="article">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-warning btn-block">
						<i class="glyphicon glyphicon-ok"></i> 保存
					</button>
				</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<?php endif; ?>
<?php mc_template_part('footer'); ?>