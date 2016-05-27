<?php mc_template_part('header'); ?>
	<div class="container">
		<div class="panel panel-default" id="checkout">
			<!-- Default panel contents -->
			<div class="panel-heading">
				<i class="glyphicon glyphicon-map-marker"></i> 支持TA的心愿
				<span class="pull-right" id="wish-checkout-total">￥<?php echo $_GET['price']; ?></span>
			</div>
			<?php 
			if(mc_is_mobile()) :
				$alipay_url = U('pro/alipay/alipay_wap_wish');
			elseif(mc_option('alipay_seller')) :
				$alipay_url = U('pro/alipay/alipay_wish');
			else : 
				$alipay_url = U('pro/alipay/alipay2_wish');
			endif;
			?>
			<form id="payment" role="form" method="post" action="<?php echo $alipay_url; ?>">
			<input type="hidden" name="price" value="<?php echo $_GET['price']; ?>">
			<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
			<div class="panel-body">
				<?php if(!mc_is_mobile()) : ?>
				<div class="well" style="border:0">
					<div id="checkout-type">
						<h2 class="title">请选择支付方式</h2>
						<ul class="sel-payment clear">
							<li class="cali">
								<input id="cali" name="bank_type" type="radio" value="0" checked="checked">
								<label class="icon-box0" for="cali">
								<img src="<?php echo mc_site_url(); ?>/pay/tenpay/image/alipay.jpg" width="135" height="32" style="border: 1px solid #ddd;">
								</label>
							</li>
							<?php if(mc_option('tenpay_seller')!='') : ?>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-21" value="0">
								<label class="icon-box21" for="J-b2c_ebank-icbc105-21">
								</label>
								<!--<li-->
							</li>
							<?php endif; ?>
							<div class="clearfix"></div>
							<?php if(mc_option('tenpay_seller')!='') : ?>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-1" value="1002">
								<label class="icon-box1" for="J-b2c_ebank-icbc105-1">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-2" value="1001">
								<label class="icon-box2" for="J-b2c_ebank-icbc105-2">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-3" value="1003">
								<label class="icon-box3" for="J-b2c_ebank-icbc105-3">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-4" value="1005">
								<label class="icon-box4" for="J-b2c_ebank-icbc105-4">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-5" value="1052">
								<label class="icon-box5" for="J-b2c_ebank-icbc105-5">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-6" value="1028">
								<label class="icon-box6" for="J-b2c_ebank-icbc105-6">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-7" value="1004">
								<label class="icon-box7" for="J-b2c_ebank-icbc105-7">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-8" value="1027">
								<label class="icon-box8" for="J-b2c_ebank-icbc105-8">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-9" value="1022">
								<label class="icon-box9" for="J-b2c_ebank-icbc105-9">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-10" value="1006">
								<label class="icon-box10" for="J-b2c_ebank-icbc105-10">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-11" value="1021">
								<label class="icon-box11" for="J-b2c_ebank-icbc105-11">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-12" value="1009">
								<label class="icon-box12" for="J-b2c_ebank-icbc105-12">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-13" value="1010">
								<label class="icon-box13" for="J-b2c_ebank-icbc105-13">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-14" value="1008">
								<label class="icon-box14" for="J-b2c_ebank-icbc105-14">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-15" value="1020">
								<label class="icon-box15" for="J-b2c_ebank-icbc105-15">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-16" value="1032">
								<label class="icon-box16" for="J-b2c_ebank-icbc105-16">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-17" value="1054">
								<label class="icon-box17" for="J-b2c_ebank-icbc105-17">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-18" value="1056">
								<label class="icon-box18" for="J-b2c_ebank-icbc105-18">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-19" value="1082">
								<label class="icon-box19" for="J-b2c_ebank-icbc105-19">
								</label>
								<!--<li-->
							</li>
							<li class="cten">
								<input type="radio" onclick="checkValue(this)" name="bank_type" id="J-b2c_ebank-icbc105-20" value="1076">
								<label class="icon-box20" for="J-b2c_ebank-icbc105-20">
								</label>
								<!--<li-->
							</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<script>	
				jQuery(document).ready(function(){
				    jQuery(".cali").click(function(){ 
				    	jQuery('#payment').attr('action','<?php echo $alipay_url; ?>');
				    });
				    jQuery(".cten").click(function(){ 
				    	jQuery('#payment').attr('action','<?php echo U('pro/alipay/tenpay_wish'); ?>');
				    });
				});
				</script>
				<?php endif; ?>
			</div>
			<div class="panel-footer">
				<a href="<?php echo mc_get_url($_GET['id']); ?>" class="btn btn-info">
					<i class="glyphicon glyphicon-circle-arrow-left"></i> 上一步
				</a>
				<button type="submit" class="btn btn-warning pull-right">
					<i class="glyphicon glyphicon-usd"></i> 立即支付
				</button>
			</div>
			</form>
		</div>
	</div>
<?php mc_template_part('footer'); ?>