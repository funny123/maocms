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
					社区
				</a>
			</li>
			<li class="active">
				新建主题
			</li>
		</ol>
		<div class="row">
			<div class="col-sm-12 home-main">
				<?php if($_GET['wish'] && mc_get_page_field($_GET['group'],'type')=='pro') : ?>
				<h4 class="title mb-0">
					<i class="icon-heart"></i> 写下你的心愿，让大家帮你一起实现！
				</h4>
				<div class="wishbox mb-20">
					<?php $fmimg_args = mc_get_meta($_GET['group'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
					<div class="row">
						<div class="col-sm-8">
							<div class="media">
								<a class="pull-left" href="<?php echo mc_get_url($_GET['group']); ?>">
									<img width="100" src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo mc_get_page_field($_GET['group'],'title'); ?>">
								</a>
								<div class="media-body">
									<h4 class="media-heading mb-20">
										我想要 <a href="<?php echo mc_get_url($_GET['group']); ?>"><?php echo mc_get_page_field($_GET['group'],'title'); ?></a>
									</h4>
									<?php if($parameter) : foreach($parameter as $key=>$valp) : $par_name = M('option')->where("id='$key'")->getField('meta_value'); ?><p><?php echo $par_name.' : '.$valp; ?></p><?php endforeach; endif; ?>
									<p class="mb-0">数量 : <?php echo $cart; ?></p>
								</div>
							</div>
						</div>
						<div class="col-sm-4 text-right">
							<?php
								$cart_price = mc_get_meta($_GET['group'],'price');
								if($parameter) :
									foreach($parameter as $key=>$valp) :
										$price = M('meta')->where("page_id='".$_GET['group']."' AND meta_key='$valp' AND type ='price'")->getField('meta_value');
										$cart_price += $price;
									endforeach;
								endif;
							?>
							总价格：<span><?php echo $cart_price*$cart; ?></span>元
						</div>
					</div>
				</div>
				<?php endif; ?>
				<form role="form" method="post" action="<?php echo U('Home/perform/publish'); ?>">
					<?php if($_GET['wish'] && mc_get_page_field($_GET['group'],'type')=='pro') : ?>
					<input type="hidden" name="number" value="<?php echo $cart; ?>">
					<?php if($parameter) : foreach($parameter as $key=>$valp) : ?>
					<input type="hidden" name="parameter[<?php echo $key; ?>]" value="<?php echo $valp; ?>">
					<?php endforeach; endif; ?>
					<?php endif; ?>
					<div class="row">
						<div class="col-sm-4 col-lg-3">
							<div class="form-group">
								<label>
									版块
								</label>
								<select class="form-control" name="group">
								<?php if(mc_get_page_field($_GET['group'],'type')=='pro') : ?>
									<option value="<?php echo $_GET['group']; ?>" selected><?php echo mc_get_page_field($_GET['group'],'title'); ?></option>
								<?php else : ?>
								<?php $group = M('page')->where('type="group"')->order('date desc')->select(); if($group) : foreach($group as $val) : ?>
									<option value="<?php echo $val['id']; ?>" <?php if($_GET['group']==$val['id']) echo 'selected'; ?>><?php echo $val['title']; ?></option>
								<?php endforeach; endif; ?>
								<?php endif; ?>
								</select>
							</div>
						</div>
						<div class="col-sm-8 col-lg-9">
							<div class="form-group">
								<label>
									标题
								</label>
								<input name="title" type="text" class="form-control" placeholder="" value="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>
							主题内容
						</label>
						<textarea name="content" class="form-control" rows="3"><?php if($_GET['wish'] && mc_get_page_field($_GET['group'],'type')=='pro') : ?><h4 class="mb-20">我为什么想要这件商品</h4><p>写下自己需要这款商品的原因，大家支持你完成这个心愿后，你会如何回报大家。写的越详细，心愿就越容易实现哦。</p><?php endif; ?></textarea>
					</div>
					<?php if($_GET['wish'] && mc_get_page_field($_GET['group'],'type')=='pro') : ?>
					<div class="form-group">
						<label>
							收货信息 - 心愿达成后，我们会发货到以下地址
						</label>
						<div class="row">
							<div class="col-sm-4">
								<input type="text" name="buyer_name" class="form-control" placeholder="收货人姓名" value="<?php echo mc_get_meta(mc_user_id(),'buyer_name',true,'user'); ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<?php if(mc_get_meta(mc_user_id(),'buyer_province',true,'user') && mc_get_meta(mc_user_id(),'buyer_city',true,'user')) : ?>
						<div class="row" id="repcbox">
							<div class="col-sm-4">
								<div class="input-group">
									<input type="text" class="form-control" value="<?php echo mc_get_meta(mc_user_id(),'buyer_province',true,'user').' '.mc_get_meta(mc_user_id(),'buyer_city',true,'user'); ?>" disabled>
									<span class="input-group-addon" id="repc">
										<i class="glyphicon glyphicon-refresh"></i>
									</span>
									<input type="hidden" name="buyer_province" value="<?php echo mc_get_meta(mc_user_id(),'buyer_province',true,'user'); ?>">
									<input type="hidden" name="buyer_city" value="<?php echo mc_get_meta(mc_user_id(),'buyer_city',true,'user'); ?>">
								</div>
							</div>
						</div>
						<script>
							$('#repc').click(function(){
								$('#repcbox').html('<div class="col-sm-2"><select class="form-control" id="province" tabindex="4" runat="server" onchange="selectprovince(this);" name="buyer_province" datatype="*" errormsg="必须选择您所在的地区"></select></div><div class="col-sm-2"><select class="form-control" id="city" tabindex="4" disabled="disabled" runat="server" name="buyer_city"></select></div>');
								jQuery.getScript("<?php echo mc_theme_url(); ?>/js/address.js");
							});
						</script>
						<?php else : ?>
						<div class="row">
							<div class="col-sm-2">
								<select class="form-control" id="province" tabindex="4" runat="server" onchange="selectprovince(this);" name="buyer_province" datatype="*" errormsg="必须选择您所在的地区"></select>
							</div>
							<div class="col-sm-2">
								<select class="form-control" id="city" tabindex="4" disabled="disabled" runat="server" name="buyer_city"></select>
							</div>
						</div>
						
						<?php endif; ?>
					</div>
					<script src="<?php echo mc_theme_url(); ?>/js/address.js"></script>
					<div class="form-group">
						<textarea class="form-control" name="buyer_address" rows="3" placeholder="区县、街道、门牌号"><?php echo mc_get_meta(mc_user_id(),'buyer_address',true,'user'); ?></textarea>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<input type="text" class="form-control" name="buyer_phone" placeholder="联系电话，非常重要" value="<?php echo mc_get_meta(mc_user_id(),'buyer_phone',true,'user'); ?>">
							</div>
						</div>
					</div>
					<?php endif; ?>
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