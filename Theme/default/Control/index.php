<?php mc_template_part('header'); ?>
	<div class="container">
		<?php mc_template_part('head-control-nav'); ?>
		<div class="row">
			<div class="col-lg-12" id="app-center">
				<div id="single">
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-2">
							<div class="app-list text-center">
								<a href="<?php echo U('control/index/set'); ?>">网站设置</a>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-2">
							<div class="app-list text-center">
								<a href="<?php echo U('control/index/pro_all'); ?>">订单管理</a>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-2">
							<div class="app-list text-center">
								<a href="<?php echo U('control/index/wish'); ?>">心愿订单</a>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-2">
							<div class="app-list text-center">
								<a href="<?php echo U('control/index/paytools'); ?>">支付接口</a>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-2">
							<div class="app-list text-center">
								<a href="<?php echo U('control/weixin/index'); ?>">微信连接</a>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-2">
							<div class="app-list text-center">
								<a href="<?php echo U('control/index/manage'); ?>">用户管理</a>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-2">
							<div class="app-list text-center">
								<a href="<?php echo U('control/index/tixian'); ?>">提现记录</a>
							</div>
						</div>
						<div class="col-sm-3 col-md-3 col-lg-2">
							<div class="app-list text-center">
								<a href="<?php echo U('control/index/images'); ?>">图片管理</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php mc_template_part('footer'); ?>