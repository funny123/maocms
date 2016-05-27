<ul id="user-nav" class="nav nav-pills nav-justified mb-20">
	<li <?php if(ACTION_NAME=='index') echo 'class="active"'; ?>>
		<a href="<?php echo U('user/index/index?id='.$_GET['id']); ?>">
			<i class="icon-home"></i> 首页
		</a>
	</li>
	<li <?php if(ACTION_NAME=='pages') echo 'class="active"'; ?>>
		<a href="<?php echo U('user/index/pages?id='.$_GET['id']); ?>">
			<i class="icon-list"></i> 主题
		</a>
	</li>
	<li <?php if(ACTION_NAME=='shoucang') echo 'class="active"'; ?>>
		<a href="<?php echo U('user/index/shoucang?id='.$_GET['id']); ?>">
			<i class="icon-star"></i> 收藏
		</a>
	</li>
	<li <?php if(ACTION_NAME=='guanzhu') echo 'class="active"'; ?>>
		<a href="<?php echo U('user/index/guanzhu?id='.$_GET['id']); ?>">
			<i class="glyphicon glyphicon-ok-circle"></i> 关注
		</a>
	</li>
	<li <?php if(ACTION_NAME=='fans') echo 'class="active"'; ?>>
		<a href="<?php echo U('user/index/fans?id='.$_GET['id']); ?>">
			<i class="glyphicon glyphicon-ok-circle"></i> 粉丝
		</a>
	</li>
	<?php if(mc_user_id()==$_GET['id']) : ?>
	<li <?php if(ACTION_NAME=='edit') echo 'class="active"'; ?>>
		<a href="<?php echo U('user/index/edit?id='.$_GET['id']); ?>">
			<i class="glyphicon glyphicon-cog"></i> 资料
		</a>
	</li>
	<?php endif; ?>
	<?php if(mc_user_id()==$_GET['id'] && mc_option('pro_close')!=1) : ?>
	<li <?php if(ACTION_NAME=='pro') echo 'class="active"'; ?>>
		<a href="<?php echo U('user/index/pro?id='.$_GET['id']); ?>">
			<i class="glyphicon glyphicon-shopping-cart"></i> 商品
		</a>
	</li>
	<?php endif; ?>
</ul>