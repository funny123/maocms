<?php
namespace User\Controller;
use Think\Controller;
class LostpassController extends Controller {
    public function index(){
        if(mc_user_id()) {
	        $this->success('您已经登陆',U('home/index/index'));
        } else {
	        $this->theme(mc_option('theme'))->display('User/lostpass');
        }
    }
    public function submit($user_email){
    	$page_id = M('meta')->where("meta_key='user_email' AND meta_value='".I('param.user_email')."' AND type='user'")->getField('page_id');
    	$pass = rand(100000,999999);
    	mc_update_meta($page_id,'user_pass',md5($pass.mc_option('site_key')),'user');
    	$body = '您的新密码为：'.$pass.',请尽快修改密码！';
    	mc_mail($user_email,'找回密码',$body);
    	$this->success('找回密码成功',U('user/login/index'),10);
    }
}