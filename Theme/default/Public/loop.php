				<div class="panel panel-default" id="mc-page-<?php echo $val['id']; ?>">
					<div class="panel-heading">
						<h3 class="panel-title">
							<a href="<?php echo U('post/index/index?id='.$val['id']); ?>"><?php echo $val['id']; ?> - <?php echo $val['title']; ?></a>
						</h3>
					</div>
					<div class="panel-body">
						<?php echo $val['content']; ?>
						<hr>
						<?php echo mc_xihuan_btn($val['id']); ?>
						<?php echo mc_shoucang_btn($val['id']); ?>
						<?php echo mc_read_btn($val['id']); ?>
					</div>
					<div class="panel-footer">
						发布时间：<?php echo date('Y-m-d H:i:s',$val['date']); ?> 文章状态：<?php echo $val['type']; ?>
					</div>
				</div>