<?php mc_template_part('header'); ?>
	<link rel="stylesheet" href="<?php echo mc_site_url(); ?>/Kindeditor/themes/default/default.css" />
	<form role="form" method="post" action="<?php echo U('home/perform/publish_pro'); ?>">
	<div id="single-top">
		<div class="container">
			<ol class="breadcrumb hidden-xs mb-20 mt-20" id="baobei-term-breadcrumb">
				<li>
					<a href="<?php echo U('home/index/index'); ?>">
						首页
					</a>
				</li>
				<li>
					<a href="<?php echo U('pro/index/index'); ?>">
						商品
					</a>
				</li>
				<li class="active">
					发布商品
				</li>
				<div class="pull-right">
					<?php if(mc_is_admin()) : ?>
					<a href="<?php echo U('publish/index/index'); ?>" class="active">发布商品</a>
					<?php endif; ?>
				</div>
			</ol>
			<div class="row">
				<div class="col-sm-6" id="pro-index-tl">
					<div id="pro-index-tlin">
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators" id="publish-carousel-indicators"><li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li></ol>
						<div class="carousel-inner" id="pub-imgadd">
							<div class="item active">
								<div class="imgshow"><img src="<?php echo mc_theme_url(); ?>/img/upload.jpg"></div>
							</div>
						</div>
					</div>
					</div>
				</div>
				<div class="col-sm-6" id="pro-index-tr">
					<div id="pro-index-trin">
					<h1>
						<textarea name="title" class="form-control" placeholder="请填写商品标题"></textarea>
					</h1>
					<h3>
						<div class="row">
							<div class="col-xs-6 col">
								<div class="input-group">
									<input name="price" type="text" class="form-control" placeholder="0.00">
									<span class="input-group-addon">
										元
									</span>
								</div>
							</div>
							<div class="col-xs-3 col">
								<input name="kucun" type="text" class="form-control ml-20" placeholder="库存">
							</div>
							<div class="col-xs-3 col">
								<input name="xiaoliang" type="text" class="form-control ml-20" placeholder="销量">
							</div>
						</div>
					</h3>
					<?php $parameter = M('option')->where("meta_key='parameter' AND type='pro'")->select(); if($parameter) : foreach($parameter as $par) : ?>
					<div class="form-group pro-parameter" id="pro-parameter-<?php echo $par['id']; ?>">
						<label><?php echo $par['meta_value']; ?></label>
						<div class="row">
							<div class="col-sm-7">
								<input name="pro-parameter[<?php echo $par['id']; ?>][1][name]" type="text" class="form-control" placeholder="参数">
							</div>
							<div class="col-sm-5">
								<input name="pro-parameter[<?php echo $par['id']; ?>][1][price]" type="text" class="form-control" placeholder="加价">
							</div>
						</div>
					</div>
					<a id="pro-parameter-btn-<?php echo $par['id']; ?>" href="#" class="btn btn-block btn-default mb-10">+</a>
					<script>
						num = 2;
						$('#pro-parameter-btn-<?php echo $par['id']; ?>').click(function(){
							$('<div class="row row-par"><div class="col-sm-7"><div class="input-group"><input name="pro-parameter[<?php echo $par['id']; ?>]['+num+'][name]" type="text" class="form-control" placeholder="参数"><span class="input-group-addon"><i class="icon-remove"></i></span></div></div><div class="col-sm-5"><input name="pro-parameter[<?php echo $par['id']; ?>]['+num+'][price]" type="text" class="form-control mt-10" placeholder="加价"></div></div>').appendTo('#pro-parameter-<?php echo $par['id']; ?>');
							$('#pro-parameter-<?php echo $par['id']; ?> .input-group .input-group-addon').click(function(){
								$(this).parents('.row-par').remove();
							});
							num++;
							return false;
						});
						$('#pro-parameter-<?php echo $par['id']; ?> .input-group .input-group-addon').click(function(){
							$(this).parent('.input-group').parent('.col-sm-7').parent('.row').remove();
						});
					</script>
					<?php endforeach; endif; ?>
					<div class="form-group">
						<label>
							选择分类
						</label>
						<select class="form-control" name="term">
							<?php $terms = M('page')->where('type="term_pro"')->order('id desc')->select(); ?>
							<?php foreach($terms as $val) : ?>
							<option value="<?php echo $val['id']; ?>">
								<?php echo $val['title']; ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container" id="pro-single">
		<div class="row">
			<div class="col-sm-12" id="single">
				<div id="entry">
					<div class="form-group">
						<textarea name="content" class="form-control" rows="3">在这里添加商品的详细描述</textarea>
					</div>
				</div>
				<div class="form-group">
					<input name="keywords" type="text" class="form-control" placeholder="关键词（Keywords），多个关键词以英文半角逗号隔开（选填）">
				</div>
				<div class="form-group">
					<textarea name="description" class="form-control" rows="3" placeholder="摘要（Description），会被搜索引擎抓取为网页描述（选填）"></textarea>
				</div>
				<button type="submit" class="btn btn-warning btn-block">
					<i class="glyphicon glyphicon-ok"></i> 提交
				</button>
			</div>
		</div>
	</div>
	</form>
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
						K('#pub-imgadd').click(function() {
							editor.loadPlugin('image', function() {
								editor.plugin.imageDialog({
									showRemote : false,
									clickFn : function(url, title, width, height, border, align) {
										$('.item').removeClass('active');
										$('<div class="item active"><div class="imgshow"><img src="'+url+'"></div><input type="hidden" name="fmimg[]" value="'+url+'"></div>').prependTo('#pub-imgadd');
										var index = $('.carousel-indicators li').last().index()*1+1;
										$('<li data-target="#carousel-example-generic" data-slide-to="'+index+'"></li>').appendTo('.carousel-indicators');
										editor.hideDialog();
									}
								});
							});
						});
					});
				</script>
<?php mc_template_part('footer'); ?>