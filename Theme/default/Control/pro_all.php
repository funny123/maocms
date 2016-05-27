<?php mc_template_part('header'); ?>
	<div class="container">
		<?php mc_template_part('head-control-nav'); ?>
		<div class="row">
			<div class="col-lg-12" id="pro-all-list">
				<?php foreach($page as $trade) : ?>
				<div class="panel panel-default">
				<div class="panel-heading">
					<a href="<?php echo U('user/index/index?id='.$trade['user_id']); ?>"><?php echo mc_user_display_name($trade['user_id']); ?></a> <?php echo date('Y-m-d H:i:s',$trade['date']); ?>
					<?php 
					$conis = M('action')->where("action_key='conis_wait_finished' AND date='".$trade['date']."'")->getField('action_value');
					if($conis>0) :
					?>
					<span class="pull-right">
						使用积分：<?php echo $conis; ?>
					</span>
					<?php endif; ?>
				</div>
				<ul class="list-group" id="cart" style="border:0">
				<?php $cart = M('action')->where("action_key IN ('wait_send','wait_cofirm','wait_finished','wait_hdfk') AND date='".$trade['date']."'")->order('id desc')->select(); ?>
				<?php foreach($cart as $val) : ?>
				<li class="list-group-item pr">
					<div class="media">
						<a class="pull-left img-div" href="<?php echo U('pro/index/single?id='.$val['page_id']); ?>">
							<?php $fmimg_args = mc_get_meta($val['page_id'],'fmimg',false); ?>
							<img class="media-object" src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo mc_get_page_field($val['page_id'],'title'); ?>">
						</a>
						<div class="media-body">
							<h4 class="media-heading">
								<a href="<?php echo U('pro/index/single?id='.$val['page_id']); ?>"><?php echo mc_get_page_field($val['page_id'],'title'); ?></a>
							</h4>
							<span class="btn btn-danger btn-sm">单价：<?php echo mc_cart_price($val['id']); ?> 元</span>
							<span class="btn btn-info btn-sm">数量：<?php echo $val['action_value']; ?></span>
							<?php $parameter = M('action')->where("page_id='".$val['id']."' AND user_id='".mc_user_id()."'")->order('id asc')->getField('action_value',true); if($parameter) : ?>
							<ul class="list-inline mt-10">
							<?php foreach($parameter as $par) : list($par_name,$par_value) = explode('|',$par); ?>
							<li><span class="btn btn-success btn-sm"><?php echo $par_name; ?>：<?php echo $par_value; ?></span></li>
							<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</div>
					</div>
					<div class="cart-status <?php echo $val['action_key']; ?>">
						<?php if($val['action_key']=='wait_send') : ?>
						等待发货
						<?php elseif($val['action_key']=='wait_cofirm') : ?>
						等待确认收货
						<?php elseif($val['action_key']=='wait_finished') : ?>
						交易完成
						<?php elseif($val['action_key']=='wait_hdfk') : ?>
						货到付款
						<?php endif; ?>
					</div>
				</li>
				<?php endforeach; ?>
				</ul>
				<div class="panel-footer">
					<?php
						echo M('action')->where("action_key IN ('address_wait_send','address_wait_cofirm','add_wait_finished','address_wait_hdfk') AND date='".$trade['date']."'")->getField('action_value');
					?>
					<form role="form" class="form-inline" method="post" action="<?php echo U('control/index/pro_all'); ?>">
						<div class="form-group">
							<input type="text" name="wuliu" class="form-control" value="<?php echo M('action')->where("action_key='wl_wait_finished' AND date='".$trade['date']."'")->getField('action_value'); ?>" placeholder="物流信息">
						</div>
						<input type="hidden" name="date" value="<?php echo $trade['date']; ?>">
						<input type="hidden" name="user_id" value="<?php echo $trade['user_id']; ?>">
						<button type="submit" class="btn btn-default">
							保存
						</button>
					</form>
				</div>
				</div>
				<?php endforeach; ?>
				<?php echo mc_pagenavi($count,$page_now); ?>
			</div>
		</div>
	</div>
<?php mc_template_part('footer'); ?>