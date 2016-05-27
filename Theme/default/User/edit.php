<?php mc_template_part('header'); ?>
<?php mc_template_part('head-user'); ?>
<link rel="stylesheet" href="<?php echo mc_site_url(); ?>/Kindeditor/themes/default/default.css" />
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php mc_template_part('head-user-nav'); ?>
				<div id="single">
				<form role="form" method="post" action="<?php echo mc_page_url(); ?>">
				    <div class="form-group">
				        <label>
				            用户名
				        </label>
				        <input type="text" class="form-control" value="<?php echo mc_get_meta(mc_user_id(),'user_name',true,'user'); ?>" placeholder="" disabled>
				        <p class="help-block">
				            用户名无法修改
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            昵称
				        </label>
				        <input name="title" type="text" class="form-control" value="<?php echo mc_user_display_name(mc_user_id()); ?>" placeholder="">
				        <p class="help-block">
				            您在本站显示的名字
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            邮箱
				        </label>
				        <input name="user_email" type="text" class="form-control" value="<?php echo mc_get_meta(mc_user_id(),'user_email',true,'user'); ?>" placeholder="">
				        <p class="help-block">
				            邮箱是您找回密码的唯一途径
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            新密码
				        </label>
				        <input name="pass" type="text" class="form-control password" value="" placeholder="">
				    </div>
				    <div class="form-group">
				        <label>
				            确认新密码
				        </label>
				        <input name="pass2" type="text" class="form-control password" value="" placeholder="">
				        <p class="help-block">
				            不修改密码无需填写，请务必牢记您的密码
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            头像
				        </label>
				        <div class="row" id="pub-imgadd">
				            <div class="col-sm-2" id="pub-imgadd-btn">
				                <img class="default-img" src="<?php echo mc_user_avatar(mc_user_id()); ?>">
				            </div>
				        </div>
				        <p class="help-block">
				            点击上传新头像
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            个人空间背景
				        </label>
				        <div class="row" id="pub-imgadd2">
				            <div class="col-sm-6" id="pub-imgadd-btn2">
				                <img class="default-img" src="<?php if(mc_fmimg(mc_user_id())) : echo mc_fmimg(mc_user_id()); else : echo mc_theme_url().'/img/user_bg.jpg'; endif; ?>">
				            </div>
				        </div>
				        <p class="help-block">
				            点击更换个人空间头部背景
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            签名
				        </label>
				        <textarea name="content" class="form-control" rows="3"><?php echo mc_get_page_field(mc_user_id(),'content'); ?></textarea>
				        <p class="help-block">
				            签名会显示在您发布的文章底部
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            收货信息
				        </label>
				        <input name="buyer_name" type="text" class="form-control" value="<?php echo mc_get_meta(mc_user_id(),'buyer_name',true,'user'); ?>" placeholder="收货人姓名">
				    </div>
				    <div class="form-group">
				    	<div class="row">
				    		<div class="col-sm-6">
				    			<input name="buyer_province" type="text" class="form-control" value="<?php echo mc_get_meta(mc_user_id(),'buyer_province',true,'user'); ?>" placeholder="省份/自治区">
				    		</div>
				    		<div class="col-sm-6">
				    			<input name="buyer_city" type="text" class="form-control" value="<?php echo mc_get_meta(mc_user_id(),'buyer_city',true,'user'); ?>" placeholder="城市/地区/自治区">
				    		</div>
				    	</div>
				    </div>
				    <div class="form-group">
				        <textarea name="buyer_address" class="form-control" rows="3" placeholder="区县、街道、门牌号"><?php echo mc_get_meta(mc_user_id(),'buyer_address',true,'user'); ?></textarea>
				    </div>
				    <div class="form-group">
				        <input name="buyer_phone" type="text" class="form-control" value="<?php echo mc_get_meta(mc_user_id(),'buyer_phone',true,'user'); ?>" placeholder="联系电话，非常重要">
				    </div>
				    <div class="text-center">
					    <button type="submit" class="btn btn-warning">
					        <i class="glyphicon glyphicon-ok"></i> 保存
					    </button>
				    </div>
				</form>
				</div>
				<script charset="utf-8" src="<?php echo mc_site_url(); ?>/Kindeditor/kindeditor-min.js"></script>
				<script charset="utf-8" src="<?php echo mc_site_url(); ?>/Kindeditor/lang/zh_CN.js"></script>
				<script>
								KindEditor.ready(function(K) {
							    	var editor = K.editor({
										uploadJson : '<?php echo U('publish/index/upload'); ?>',
										allowFileManager : true
									});
									K('#pub-imgadd-btn').click(function() {
										editor.loadPlugin('image', function() {
											editor.plugin.imageDialog({
												showRemote : false,
												clickFn : function(url, title, width, height, border, align) {
													$('#pub-imgadd-btn').remove();
													$('<div class="col-sm-2" id="pub-imgadd-btn"><img src="'+url+'" class="default-img"></div><input type="hidden" name="user_avatar" value="'+url+'">').prependTo('#pub-imgadd');
													editor.hideDialog();
												}
											});
										});
									});
								});
								KindEditor.ready(function(K) {
							    	var editor = K.editor({
										uploadJson : '<?php echo U('publish/index/upload'); ?>',
										allowFileManager : true
									});
									K('#pub-imgadd-btn2').click(function() {
										editor.loadPlugin('image', function() {
											editor.plugin.imageDialog({
												showRemote : false,
												clickFn : function(url, title, width, height, border, align) {
													$('#pub-imgadd-btn2').remove();
													$('<div class="col-sm-6" id="pub-imgadd-btn2"><img src="'+url+'" class="default-img"></div><input type="hidden" name="fmimg" value="'+url+'">').prependTo('#pub-imgadd2');
													editor.hideDialog();
												}
											});
										});
									});
								});
							</script>
			</div>
		</div>
	</div>
<?php mc_template_part('footer'); ?>