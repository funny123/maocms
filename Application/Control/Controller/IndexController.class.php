<?php
namespace Control\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	if(mc_user_id()) {
    		if(mc_is_admin()) {
	    		$this->theme(mc_option('theme'))->display('Control/index');
	    	} else {
		    	$this->error('您没有权限访问此页面！');
	    	};
    	} else {
	    	$this->success('请先登陆',U('User/login/index'));
	    };
    }
    public function set(){
    	if(mc_user_id()) {
    		if(mc_is_admin()) {
	    		if($_POST['site_name'] && $_POST['site_url'] && $_POST['page_size']) {
		    		mc_update_option('site_name',I('param.site_name'));
		    		mc_update_option('site_url',I('param.site_url'));
		    		mc_update_option('site_color',I('param.site_color'));
		    		mc_update_option('gonggao',$_POST['gonggao']);
		    		if($_POST['logo']) {
			    		mc_update_option('logo',I('param.logo'));
		    		};
		    		mc_update_option('stmp_from',I('param.stmp_from'));
		    		mc_update_option('stmp_name',I('param.stmp_name'));
		    		mc_update_option('stmp_host',I('param.stmp_host'));
		    		mc_update_option('stmp_port',I('param.stmp_port'));
		    		mc_update_option('stmp_username',I('param.stmp_username'));
		    		mc_update_option('stmp_password',I('param.stmp_password'));
		    		if($_POST['fmimg']) {
			    		mc_update_option('fmimg',I('param.fmimg'));
		    		};
		    		mc_update_option('homehdimg1',I('param.homehdimg1'));
		    		mc_update_option('homehdimg2',I('param.homehdimg2'));
		    		mc_update_option('homehdimg3',I('param.homehdimg3'));
		    		mc_update_option('homehdlnk1',I('param.homehdlnk1'));
		    		mc_update_option('homehdlnk2',I('param.homehdlnk2'));
		    		mc_update_option('homehdlnk3',I('param.homehdlnk3'));
		    		mc_update_option('homehdys',I('param.homehdys'));
		    		mc_update_option('sidebar',$_POST['sidebar']);
		    		mc_update_option('page_size',I('param.page_size'));
		    		mc_update_option('shehe_comment',I('param.shehe_comment'));
		    		mc_update_option('loginqq',I('param.loginqq'));
		    		$this->success('更新成功');
	    		} else {
		    		$this->theme(mc_option('theme'))->display('Control/set');
	    		}
	    	} else {
		    	$this->error('您没有权限访问此页面！');
	    	};
    	} else {
	    	$this->success('请先登陆',U('User/login/index'));
	    };
    }
    public function pro_all($page=1){
    	if(mc_user_id()) {
    		if(mc_is_admin()) {
		    	if($_POST['date'] && $_POST['wuliu'] && $_POST['user_id']) {
	    			M('action')->where("page_id='".$_POST['user_id']."' AND user_id='".$_POST['user_id']."' AND action_key='wl_wait_finished' AND date = '".$_POST['date']."'")->delete();
	    			$action['page_id'] = $_POST['user_id'];
					$action['user_id'] = $_POST['user_id'];
					$action['action_key'] = 'wl_wait_finished';
					$action['action_value'] = $_POST['wuliu'];
					$action['date'] = $_POST['date'];
					$result = M('action')->data($action)->add();
	    			$this->success('保存成功');
    			} else {
	    			$this->page = M('action')->where("action_key IN ('trade_wait_send','trade_wait_cofirm','trade_wait_finished','trade_wait_hdfk')")->order('id desc')->page($page,mc_option('page_size'))->select();
	    			$count = M('action')->where("action_key IN ('trade_wait_send','trade_wait_cofirm','trade_wait_finished','trade_wait_hdfk')")->count();
			        $this->assign('id',$id);
			        $this->assign('count',$count);
			        $this->assign('page_now',$page);
					$this->theme(mc_option('theme'))->display('Control/pro_all');
    			}
	    	} else {
		    	$this->error('请不要偷窥别人的购买记录哦～');
	    	}
	    } else {
		    $this->success('请先登陆',U('User/login/index'));
	    }
    }
    public function wish($page=1){
    	if(mc_user_id()) {
    		if(mc_is_admin()) {
		    	$this->page = M('meta')->where("meta_key='wish_done' AND meta_value='1'")->order('id desc')->page($page,mc_option('page_size'))->select();
	    		$count = M('meta')->where("meta_key='wish_done' AND meta_value='1'")->count();
	    		$this->assign('id',$id);
	    		$this->assign('count',$count);
	    		$this->assign('page_now',$page);
	    		$this->theme(mc_option('theme'))->display('Control/wish');
	    	} else {
		    	$this->error('请不要偷窥别人的购买记录哦～');
	    	}
	    } else {
		    $this->success('请先登陆',U('User/login/index'));
	    }
    }
    public function paytools(){
    	if(mc_user_id()) {
    		if(mc_is_admin()) {
	    		if($_POST['update_paytools']) {
		    		mc_update_option('alipay2_seller',I('param.alipay2_seller'));
		    		mc_update_option('alipay2_partner',I('param.alipay2_partner'));
		    		mc_update_option('alipay2_key',I('param.alipay2_key'));
		    		mc_update_option('alipay_seller',I('param.alipay_seller'));
		    		mc_update_option('alipay_partner',I('param.alipay_partner'));
		    		mc_update_option('alipay_key',I('param.alipay_key'));
		    		mc_update_option('alipay_wap_seller',I('param.alipay_wap_seller'));
		    		mc_update_option('alipay_wap_partner',I('param.alipay_wap_partner'));
		    		mc_update_option('alipay_wap_key',I('param.alipay_wap_key'));
		    		mc_update_option('tenpay_seller',I('param.tenpay_seller'));
		    		mc_update_option('tenpay_key',I('param.tenpay_key'));
		    		mc_update_option('huodaofukuan',I('param.huodaofukuan'));
		    		$this->success('更新成功');
	    		} else {
		    		$this->theme(mc_option('theme'))->display('Control/paytools');
	    		}
	    	} else {
		    	$this->error('您没有权限访问此页面！');
	    	};
    	} else {
	    	$this->success('请先登陆',U('User/login/index'));
	    };
    }
    public function manage($page=1){
    	if(is_numeric($page)) {
	    	if(mc_user_id()) {
	    		if(mc_is_admin()) {
	    			if(is_numeric($_POST['user_level']) && is_numeric($_POST['user_id'])) {
		    			if($_POST['user_id']==mc_user_id()) {
			    			$this->error('您不能修改自己的身份！',U('Control/index/manage'));
		    			} else {
			    			mc_update_meta($_POST['user_id'],'user_level',$_POST['user_level'],'user');
							$this->success('修改用户身份成功！');
		    			};
	    			} else {
		    			$this->page = M('page')->where("type='user'")->order('id desc')->page($page,mc_option('page_size'))->select();
						$count = M('page')->where("type='user'")->count();
						$this->assign('count',$count);
						$this->assign('page_now',$page);
						$this->theme(mc_option('theme'))->display('Control/manage');
	    			}
		    	} else {
			    	$this->error('您没有权限访问此页面！');
		    	};
	    	} else {
		    	$this->success('请先登陆',U('User/login/index'));
		    };
		} else {
			$this->error('参数错误！');
		}
    }
    public function tixian(){
    	if(mc_user_id()) {
    		if(mc_is_admin()) {
	    		if($_POST['id'] && $_POST['zhuangtai']) {
		    		$condition['action_value'] = $_POST['zhuangtai'];
		    		M('action')->where("id='".$_POST['id']."'")->save($condition);
		    		if($_POST['zhuangtai']==3) {
			    		$user_id = M('action')->where("id='".$_POST['id']."'")->getField('page_id');
			    		$date = M('action')->where("id='".$_POST['id']."'")->getField('date');
			    		$coins = M('action')->where("date='$date' AND action_key='coins'")->getField('action_value');
			    		mc_update_coins($user_id,-$coins);
		    		};
		    		$this->success('修改提现状态成功！');
	    		} else {
		    		$condition['action_value']  = array('lt',0);
			        $condition['action_key'] = 'coins';
					$this->page = M('action')->where($condition)->order('id desc')->page($page,mc_option('page_size'))->select();
				    $count = M('action')->where($condition)->count();
				    $this->assign('id',$id);
				    $this->assign('count',$count);
				    $this->assign('page_now',$page);
		    		$this->theme(mc_option('theme'))->display('Control/tixian');
	    		}
	    	} else {
		    	$this->error('您没有权限访问此页面！');
	    	};
    	} else {
	    	$this->success('请先登陆',U('User/login/index'));
	    };
    }
    public function images($page=1){
    	if(mc_user_id()) {
    		if(mc_is_admin()) {
	    		$this->content = M('attached')->order('id desc')->page($page,20)->select();
			    $count = M('page')->where($condition)->count();
			    $this->assign('count',$count);
			    $this->assign('page_now',$page);
			    $this->theme(mc_option('theme'))->display('Control/images');
	    	} else {
		    	$this->error('您没有权限访问此页面！');
	    	};
    	} else {
	    	$this->success('请先登陆',U('User/login/index'));
	    };
    }
}