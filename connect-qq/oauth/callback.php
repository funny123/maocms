<?php
require_once("./connect-qq/API/qqConnectAPI.php");
$qc = new QC();
$acs = $qc->qq_callback();
$oid = $qc->get_openid();
$qc = new QC($acs,$oid);
$uinfo = $qc->get_user_info();

$page_id = M('meta')->where("meta_key='user_qqoid' AND meta_value='".$oid."' AND type='user'")->getField('page_id');
if($page_id) :
	$user_name = mc_get_meta($page_id,'user_name',true,'user');
	$user_pass_true = mc_get_meta($page_id,'user_pass',true,'user');
	session('user_name',$user_name);
	session('user_pass',$user_pass_true);
	$this->success('登陆成功',U('user/index/edit?id='.mc_user_id()));
else :
	function mc_check_user_name($name) {
		$user_login = M('meta')->where("meta_key='user_login' AND type ='user'")->getField('meta_value',true);
	    if(in_array($name, $user_login)) :
	    	return true;
		else :
			return false;
	    endif;
	};
    do {
		$user_name_test = $oid.rand(1000,9999);
	}
	while (mc_check_user_name($user_name_test));
	$user['title'] = $uinfo["nickname"];
	$user['content'] = '';
	$user['type'] = 'user';
	$user['date'] = strtotime("now");
	$result = M("page")->data($user)->add();
	if($result) :
		mc_add_meta($result,'user_name',$user_name_test,'user');
		$user_pass = md5($oid.mc_option('site_key'));
		mc_add_meta($result,'user_pass',$user_pass,'user');
		mc_add_meta($result,'user_qqoid',$oid,'user');
		mc_add_meta($result,'user_level','1','user');
		session('user_name',$user_name_test);
	    session('user_pass',$user_pass);
		$this->success('登陆成功',U('user/index/edit?id='.mc_user_id()));
	else :
		$this->error('登陆失败');
	endif;
endif;
