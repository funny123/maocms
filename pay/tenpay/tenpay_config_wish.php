<?php
$spname = '支持心愿';
$partner = mc_option('tenpay_seller');                                  	//财付通商户号
$key = mc_option('tenpay_key');											//财付通密钥

$return_url = mc_option('site_url').'/tenpay_return_url_wish.php';			//显示支付结果页面,*替换成payReturnUrl.php所在路径
$notify_url = mc_option('site_url').'/tenpay_notify_url_wish.php';			//支付完成后的回调处理页面,*替换成payNotifyUrl.php所在路径
?>