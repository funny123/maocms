<?php mc_template_part('header'); ?>
	<div class="container">
		<ol class="breadcrumb mb-20 mt-20" id="baobei-term-breadcrumb">
			<li class="hidden-xs">
				<a href="<?php echo mc_site_url(); ?>">
					首页
				</a>
			</li>
			<?php if(MODULE_NAME=='Home') : ?>
			<li class="hidden-xs">
				商品
			</li>
			<li class="active hidden-xs">
				搜索 - <?php echo $_GET['keyword']; ?>
			</li>
			<?php else : ?>
			<li class="active hidden-xs">
				商品
			</li>
			<?php endif; ?>
			<div class="pull-right">
				<?php if(mc_is_admin() || mc_is_bianji()) : ?>
				<a href="#" data-toggle="modal" data-target="#parameterModal">商品参数</a>
				<a href="#" data-toggle="modal" data-target="#addtermModal">添加分类</a>
				<a href="<?php echo U('publish/index/index'); ?>" class="publish">发布商品</a>
				<?php endif; ?>
			</div>
			<div class="clearfix"></div>
		</ol>
		<?php 
			$args_id = M('meta')->where("meta_key='parent' AND meta_value>'0' AND type='term'")->getField('page_id',true);
			if($args_id) :
			$condition['id']  = array('not in',$args_id);
			endif;
			$condition['type']  = 'term_pro';
			$terms_pro = M('page')->where($condition)->order('id desc')->select(); 
			if($terms_pro) :
		?>
		<ul class="nav nav-pills mb-10 term-list" role="tablist">
		<?php foreach($terms_pro as $val) : ?>
			<li role="presentation">
				<a href="<?php echo U('pro/index/term?id='.$val['id']); ?>">
					<?php echo $val['title']; ?>
				</a>
			</li>
		<?php endforeach; ?>
		</ul>
		<?php endif; ?>
		<div class="row" id="pro-list">
			<?php foreach($page as $val) : ?>
			<div class="col-sm-6 col-md-4 col-lg-3 col">
				<div class="thumbnail">
					<?php $fmimg_args = mc_get_meta($val['id'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
					<a class="img-div" href="<?php echo mc_get_url($val['id']); ?>"><img src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo $val['title']; ?>"></a>
					<div class="caption">
						<h4>
							<a href="<?php echo mc_get_url($val['id']); ?>"><?php echo $val['title']; ?></a>
						</h4>
						<p class="price pull-left">
							<span><?php echo mc_price_now($val['id']); ?></span> <small>元</small>
						</p>
						<?php if(mc_get_meta($val['id'],'kucun')<=0) : ?>
						<button type="button" class="btn btn-default btn-xs pull-right">
							<i class="icon-umbrella"></i> 暂时缺货
						</button>
						<?php else : ?>
						<form method="post" action="<?php echo U('home/perform/add_cart'); ?>">
						<button type="submit" class="btn btn-warning btn-xs pull-right">
							<i class="glyphicon glyphicon-plus"></i> 加入购物车
						</button>
						<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
						<input type="hidden" name="number" value="1">
						</form>
						<?php endif; ?>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
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
					<?php if($terms_pro) : ?>
					<div class="form-group">
						<label>
							父级分类
						</label>
						<select name="parent" class="form-control">
							<option>
								无父级分类...
							</option>
							<?php foreach($terms_pro as $val) : ?>
							<option value="<?php echo $val['id']; ?>">
								<?php echo $val['title']; ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
					<?php endif; ?>
					<input type="hidden" name="type" value="pro">
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
	<div class="modal fade" id="parameterModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
				</div>
				<?php $parameter = M('option')->where("meta_key='parameter' AND type='pro'")->select(); if($parameter) : ?>
				<form role="form" method="post" action="<?php echo U('home/perform/pro_parameter_edit'); ?>">
				<div class="modal-body">
					<div class="form-group">
						<label>
							参数列表
						</label>
						<?php foreach($parameter as $par) : ?>
						<div class="input-group">
							<input type="text" class="form-control" value="<?php echo $par['meta_value']; ?>" name="parameter[<?php echo $par['id']; ?>]">
							<span class="input-group-addon" data-dismiss="modal" data-toggle="modal" data-target="#delparameterModal" data-par-id="<?php echo $par['id']; ?>">
								<i class="icon-remove"></i>
							</span>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-warning btn-block">
						<i class="glyphicon glyphicon-ok"></i> 保存
					</button>
				</div>
				</form>
				<?php endif; ?>
				<form role="form" method="post" action="<?php echo U('home/perform/pro_parameter'); ?>">
				<div class="modal-body">
					<div class="form-group">
						<label>
							参数名称
						</label>
						<input name="parameter" type="text" class="form-control" placeholder="">
					</div>
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
	<div class="modal fade" id="delparameterModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
				</div>
				<div class="modal-body">
					删除操作无法撤销，请务必谨慎！
				</div>
				<div class="modal-footer">
					<form method="post" action="<?php echo U('home/perform/pro_parameter_del'); ?>">
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
		$('#parameterModal').on('show.bs.modal', function (e) {
			$('#parameterModal .input-group-addon').click(function(){
				var id = $(this).attr('data-par-id');
				$('#delparameterModal input').val(id);
			});
		})
	</script>
	<?php endif; ?>
<?php mc_template_part('footer'); ?>