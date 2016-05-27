<?php mc_template_part('header'); ?>
<link rel="stylesheet" href="<?php echo mc_site_url(); ?>/Kindeditor/themes/default/default.css" />
	<div class="container">
		<?php mc_template_part('head-control-nav'); ?>
		<div class="row">
			<div class="col-lg-12">
				<div id="single">
				<form role="form" method="post" action="<?php echo mc_page_url(); ?>">
				    <div class="form-group">
				        <label>
				            网站名称
				        </label>
				        <input name="site_name" type="text" class="form-control" value="<?php echo mc_option('site_name'); ?>" placeholder="">
				        <p class="help-block">
				            网站的名字，会显示在title和主题的某些部分
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            网站地址
				        </label>
				        <input name="site_url" type="url" class="form-control" value="<?php echo mc_option('site_url'); ?>" placeholder="">
				        <p class="help-block">
				            访问网站的地址，请勿删除<code>http://</code>，最后请勿加<code>/</code>
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            主题
				        </label>
				        <input name="theme" type="text" class="form-control" value="<?php echo mc_option('theme'); ?>" placeholder="" disabled>
				        <p class="help-block">
				            网站使用的主题，默认为<code>default</code>
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            网站主色调
				        </label>
				        <div class="row">
				        	<div class="col-sm-3 col-md-2">
								<input name="site_color" type="color" class="form-control" value="<?php if(mc_option('site_color')) : echo mc_option('site_color'); else : echo '#ff4a00'; endif; ?>" placeholder="">
				        	</div>
				        </div>
				        <p class="help-block">
				            选色器仅支持Chrome、Safari、Opera等较新版本浏览器，其他浏览器请手动填写颜色代码，如：#ff4a00。
				        </p>
				    </div>
				    <div class="form-group">
						<label>
							LOGO设置
						</label>
						<div class="row">
							<div class="col-sm-6" id="pub-logoadd">
								<img class="default-img" src="<?php if(mc_option('logo')) : echo mc_option('logo'); else : ?><?php echo mc_theme_url(); ?>/img/logo-s.png<?php endif; ?>">
							</div>
						</div>
				        <p class="help-block">
				            建议LOGO大小不超过 161px x 55px
				        </p>
					</div>
				    <div class="form-group">
						<label>
							默认用户背景图片
						</label>
						<div class="row">
							<div class="col-sm-6" id="pub-imgadd">
								<img class="default-img" src="<?php if(mc_option('fmimg')) : echo mc_option('fmimg'); else : ?><?php echo mc_theme_url(); ?>/img/user_bg.jpg<?php endif; ?>">
							</div>
						</div>
					</div>
				    <div class="form-group">
				        <label>
				            每页文章数量
				        </label>
				        <input name="page_size" type="number" min="1" class="form-control" value="<?php echo mc_option('page_size'); ?>" placeholder="">
				        <p class="help-block">
				            请设置大于1的整数
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            评论审核
				        </label>
				        <div class="clearfix"></div>
				        <label class="radio-inline">
							<input type="radio" name="shenhe_comment" value="1" <?php if(mc_option('shenhe_comment')!=2) : ?>checked<?php endif; ?>>
							无须审核
						</label>
				        <label class="radio-inline">
							<input type="radio" name="shenhe_comment" value="1" <?php if(mc_option('shenhe_comment')==2) : ?>checked<?php endif; ?> disabled>
							需要审核
						</label>
				    </div>
				    <div class="form-group">
						<label>
							首页幻灯设置
						</label>
						<div class="row">
							<div class="col-sm-4" id="pub-imgadd-1">
								<?php if(mc_option('homehdimg1')) : ?>
								<img class="default-img mb-10" src="<?php echo mc_option('homehdimg1'); ?>">
								<input type="text" class="form-control mb-10" name="homehdimg1" value="<?php echo mc_option('homehdimg1'); ?>">
								<?php else : ?>
								<img class="default-img mb-10" src="<?php echo mc_theme_url(); ?>/img/upload.jpg">
								<input type="text" class="form-control mb-10" name="homehdimg1" value="" placeholder="幻灯图片地址-1">
								<?php endif; ?>
								<input type="url" class="form-control" name="homehdlnk1" placeholder="幻灯图片链接-1" value="<?php echo mc_option('homehdlnk1'); ?>">
							</div>
							<div class="col-sm-4" id="pub-imgadd-2">
								<?php if(mc_option('homehdimg2')) : ?>
								<img class="default-img mb-10" src="<?php echo mc_option('homehdimg2'); ?>">
								<input type="text" class="form-control mb-10" name="homehdimg2" value="<?php echo mc_option('homehdimg2'); ?>">
								<?php else : ?>
								<img class="default-img mb-10" src="<?php echo mc_theme_url(); ?>/img/upload.jpg">
								<input type="text" class="form-control mb-10" name="homehdimg2" value="" placeholder="幻灯图片地址-1">
								<?php endif; ?>
								<input type="url" class="form-control" name="homehdlnk2" placeholder="幻灯图片链接-2" value="<?php echo mc_option('homehdlnk2'); ?>">
							</div>
							<div class="col-sm-4" id="pub-imgadd-3">
								<?php if(mc_option('homehdimg3')) : ?>
								<img class="default-img mb-10" src="<?php echo mc_option('homehdimg3'); ?>">
								<input type="text" class="form-control mb-10" name="homehdimg3" value="<?php echo mc_option('homehdimg3'); ?>">
								<?php else : ?>
								<img class="default-img mb-10" src="<?php echo mc_theme_url(); ?>/img/upload.jpg">
								<input type="text" class="form-control mb-10" name="homehdimg3" value="" placeholder="幻灯图片地址-1">
								<?php endif; ?>
								<input type="url" class="form-control" name="homehdlnk3" placeholder="幻灯图片链接-3" value="<?php echo mc_option('homehdlnk3'); ?>">
							</div>
						</div>
					</div>
				    <div class="form-group">
				        <label>
				            幻灯样式
				        </label>
				        <div class="clearfix"></div>
				        <label class="radio-inline">
							<input type="radio" name="homehdys" value="1" <?php if(mc_option('homehdys')!=2) : ?>checked<?php endif; ?>>
							常规
						</label>
				        <label class="radio-inline">
							<input type="radio" name="homehdys" value="2" <?php if(mc_option('homehdys')==2) : ?>checked<?php endif; ?>>
							全屏
						</label>
				    </div>
				    <div class="form-group">
				        <label>
				            首页底部公告设置
				        </label>
				        <textarea name="gonggao" class="form-control" rows="3"><?php echo mc_option('gonggao'); ?></textarea>
				        <p class="help-block">
				            支持HTML代码，下一版本会提供更多控制方式
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            Sidebar内容设置
				        </label>
				        <textarea name="sidebar" class="form-control" rows="3"><?php echo mc_option('sidebar'); ?></textarea>
				        <p class="help-block">
				            支持HTML代码，下一版本会提供更多控制方式
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            邮件SMTP设置
				        </label>
				        <input name="stmp_from" type="text" class="form-control" value="<?php echo mc_option('stmp_from'); ?>" placeholder="发送邮件账号">
				    </div>
				    <div class="form-group">
				        <input name="stmp_name" type="text" class="form-control" value="<?php echo mc_option('stmp_name'); ?>" placeholder="发件人名字">
				    </div>
				    <div class="form-group">
				        <input name="stmp_host" type="text" class="form-control" value="<?php echo mc_option('stmp_host'); ?>" placeholder="SMTP服务器">
				    </div>
				    <div class="form-group">
				        <input name="stmp_port" type="text" class="form-control" value="<?php echo mc_option('stmp_port'); ?>" placeholder="SMTP服务器端口">
				    </div>
				    <div class="form-group">
				        <input name="stmp_username" type="text" class="form-control" value="<?php echo mc_option('stmp_username'); ?>" placeholder="SMTP服务用户名">
				    </div>
				    <div class="form-group">
				        <input name="stmp_password" type="text" class="form-control password" value="<?php echo mc_option('stmp_password'); ?>" placeholder="SMTP服务密码">
				        <p class="help-block">
				            设置STMP后，找回密码功能才可正常使用。如果不会设置，请前往Mao10CMS官网咨询。
				        </p>
				    </div>
				    <div class="form-group">
				        <label>
				            QQ快速登陆
				        </label>
				        <div class="clearfix"></div>
				        <label class="radio-inline">
							<input type="radio" name="loginqq" value="1" <?php if(mc_option('loginqq')!=2) : ?>checked<?php endif; ?>>
							关闭
						</label>
				        <label class="radio-inline">
							<input type="radio" name="loginqq" value="2" <?php if(mc_option('loginqq')==2) : ?>checked<?php endif; ?>>
							开启
						</label>
						<div class="clearfix"></div>
						<p class="help-block">
				            需伪静态支持，并在connect-qq/API/comm/inc.php中配置你的“QQ互联信息”。
				        </p>
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
									K('#pub-logoadd .default-img').click(function() {
										editor.loadPlugin('image', function() {
											editor.plugin.imageDialog({
												showRemote : false,
												clickFn : function(url, title, width, height, border, align) {
													$('#pub-logoadd .default-img').remove();
													$('<img src="'+url+'"><input type="hidden" name="logo" value="'+url+'">').prependTo('#pub-logoadd');
													editor.hideDialog();
												}
											});
										});
									});
									K('#pub-imgadd .default-img').click(function() {
										editor.loadPlugin('image', function() {
											editor.plugin.imageDialog({
												showRemote : false,
												clickFn : function(url, title, width, height, border, align) {
													$('#pub-imgadd .default-img').remove();
													$('<img src="'+url+'"><input type="hidden" name="fmimg" value="'+url+'">').prependTo('#pub-imgadd');
													editor.hideDialog();
												}
											});
										});
									});
									K('#pub-imgadd-1 .default-img').click(function() {
										editor.loadPlugin('image', function() {
											editor.plugin.imageDialog({
												showRemote : false,
												clickFn : function(url, title, width, height, border, align) {
													$('#pub-imgadd-1 .default-img').attr('src',url);
													$('#pub-imgadd-1 input.mb-10').val(url);
													editor.hideDialog();
												}
											});
										});
									});
									K('#pub-imgadd-2 .default-img').click(function() {
										editor.loadPlugin('image', function() {
											editor.plugin.imageDialog({
												showRemote : false,
												clickFn : function(url, title, width, height, border, align) {
													$('#pub-imgadd-2 .default-img').attr('src',url);
													$('#pub-imgadd-2 input.mb-10').val(url);
													editor.hideDialog();
												}
											});
										});
									});
									K('#pub-imgadd-3 .default-img').click(function() {
										editor.loadPlugin('image', function() {
											editor.plugin.imageDialog({
												showRemote : false,
												clickFn : function(url, title, width, height, border, align) {
													$('#pub-imgadd-3 .default-img').attr('src',url);
													$('#pub-imgadd-3 input.mb-10').val(url);
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