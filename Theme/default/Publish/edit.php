<?php mc_template_part('header'); ?>
	<link rel="stylesheet" href="<?php echo mc_site_url(); ?>/Kindeditor/themes/default/default.css" />
	<div class="container">
		<ol class="breadcrumb mb-20 mt-20" id="baobei-term-breadcrumb">
			<li>
				<a href="<?php echo U('home/index/index'); ?>">
					首页
				</a>
			</li>
			<li>
				<a href="<?php echo U('post/group/index'); ?>">
					群组
				</a>
			</li>
			<li>
				<a href="<?php echo U('post/group/single?id='.mc_get_meta($_GET['id'],'group')); ?>">
					<?php echo mc_get_page_field(mc_get_meta($_GET['id'],'group'),'title'); ?>
				</a>
			</li>
			<li class="active">
				编辑 - <?php echo mc_get_page_field($_GET['id'],'title'); ?>
			</li>
		</ol>
		<div class="row">
			<div class="col-sm-12">
				<form role="form" method="post" action="<?php echo U('Home/perform/edit'); ?>">
					<div class="row">
						<div class="col-sm-4 col-lg-3">
							<div class="form-group">
								<label>
									群组
								</label>
								<select class="form-control" name="group">
								<?php $group = M('page')->where('type="group"')->order('date desc')->select(); if($group) : foreach($group as $val) : ?>
									<option value="<?php echo $val['id']; ?>" <?php if($_GET['group']==$val['id']) echo 'selected'; ?>><?php echo $val['title']; ?></option>
								<?php endforeach; endif; ?>
								</select>
							</div>
						</div>
						<div class="col-sm-8 col-lg-9">
							<div class="form-group">
								<label>
									标题
								</label>
								<input name="title" type="text" class="form-control" placeholder="" value="<?php echo mc_get_page_field($_GET['id'],'title'); ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>
							主题内容
						</label>
						<textarea name="content" class="form-control" rows="3"><?php echo mc_magic_out(mc_get_page_field($_GET['id'],'content')); ?></textarea>
					</div>
					<input name="id" type="hidden" value="<?php echo $_GET['id']; ?>">
					<button type="submit" class="btn btn-warning btn-block">
						保存
					</button>
				</form>
			</div>
		</div>
	</div>
	<script charset="utf-8" src="<?php echo mc_site_url(); ?>/Kindeditor/kindeditor-min.js"></script>
	<script charset="utf-8" src="<?php echo mc_site_url(); ?>/Kindeditor/lang/zh_CN.js"></script>
	<script>
		var editor;
		KindEditor.ready(function(K) {
			editor = K.create('textarea[name="content"]', {
				resizeType : 1,
				allowPreviewEmoticons : false,
				allowImageUpload : true,
				height : 400,
				uploadJson : '<?php echo U('Publish/index/upload'); ?>',
				items : ['source', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'clearhtml', 'quickformat', 'selectall', '|', 
		'formatblock', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
		'italic', 'underline', 'strikethrough', 'removeformat', '|', 'image', 'multiimage', 'table', 'hr', 'emoticons', 'baidumap', 'link', 'unlink'],
				afterChange : function() {
					K(this).html(this.count('text'));
				}
			});
		});
					KindEditor.ready(function(K) {
				    	var editor = K.editor({
							uploadJson : '<?php echo U('Publish/index/upload'); ?>',
							allowFileManager : true
						});
						K('.default-img').click(function() {
							editor.loadPlugin('image', function() {
								editor.plugin.imageDialog({
									showRemote : false,
									clickFn : function(url, title, width, height, border, align) {
										$('<img src="'+url+'" class="default-img mb-10"><input type="hidden" name="fmimg[]" value="'+url+'">').prependTo('#pub-imgadd');
										editor.hideDialog();
									}
								});
							});
						});
					});
				</script>
		<script>
		function mc_fmimg_delete(id) {
			$.ajax({
				url: '<?php echo U('home/perform/fmimg_delete'); ?>&id=' + id,
				type: 'GET',
				dataType: 'html',
				timeout: 9000,
				error: function() {
					alert('提交失败！');
				},
				success: function(html) {
					$('#fmimg_'+id).remove();
				}
			});
		};
		</script>
<?php mc_template_part('footer'); ?>