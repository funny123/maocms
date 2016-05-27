<div id="comment">
	<?php foreach($comment as $val) : ?>
	<div class="media" id="comment-<?php echo $val['id']; ?>">
		<div class="pull-left">
			<a href="<?php echo U('user/index/index?id='.$val['user_id']); ?>"><img class="img-circle media-object" src="<?php echo mc_user_avatar($val['user_id']); ?>" alt="<?php echo mc_user_display_name($val['user_id']); ?>" width="60"></a>
		</div>
		<div class="media-body">
			<h4 class="media-heading">
				<a href="<?php echo U('user/index/index?id='.$val['user_id']); ?>"><?php echo mc_user_display_name($val['user_id']); ?></a>
				<?php if(mc_get_meta($val['user_id'],'user_level',true,'user')==10) : ?><span class="btn btn-danger btn-xs">管理员</span><?php elseif(mc_get_meta($val['user_id'],'user_level',true,'user')==6) : ?><span class="btn btn-info btn-xs">网站编辑</span><?php endif; ?>
				<small class="pull-right"><?php echo date('Y-m-d H:i:s',$val['date']); ?></small>
				<?php if(mc_get_meta(mc_user_id(),'user_level',true,'user')>5) : ?>
				<form class="inline" method="post" action="<?php echo U('home/perform/comment_delete'); ?>">
					<button type="submit" class="btn btn-danger btn-xs pull-right">删除</button>
					<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
				</form>
				<?php endif; ?>
			</h4>
			<p><?php echo mc_magic_out($val['action_value']); ?></p>
			<a class="btn btn-default btn-xs btn-huifu" href="#comment-textarea" huifu-data="@<?php echo mc_user_display_name($val['user_id']); ?> ">回复</a>	
		</div>
	</div>
	<?php endforeach; ?>
</div>