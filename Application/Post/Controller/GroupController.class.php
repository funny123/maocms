<?php
namespace Post\Controller;
use Think\Controller;
class GroupController extends Controller {
    public function index($page=1){
    	if(is_numeric($page)) {
	    	$this->page = M('page')->where('type="publish"')->order('date desc')->page($page,mc_option('page_size'))->select();
		    $count = M('page')->where('type="publish"')->count();
		    $this->assign('id',$id);
		    $this->assign('count',$count);
		    $this->assign('page_now',$page);
			$this->theme(mc_option('theme'))->display('Post/group_home');
		} else {
			$this->error('参数错误！');
		}
	}
	public function pending($page=1){
    	if(mc_is_admin() || mc_is_bianji()) {
	    	$this->page = M('page')->where('type="pending"')->order('id desc')->page($page,mc_option('page_size'))->select();
		    $count = M('page')->where('type="pending"')->count();
		    $this->assign('id',$id);
		    $this->assign('count',$count);
		    $this->assign('page_now',$page);
			$this->theme(mc_option('theme'))->display('Post/pending');
		} else {
			$this->error('你没有权限查看此页面！');
		}
	}
	public function single($id,$page=1){
    	if(is_numeric($id) && is_numeric($page)) {
		    $condition['type'] = 'publish';
	        $args_id = M('meta')->where("meta_key='group' AND meta_value='$id'")->getField('page_id',true);
	        $condition['id']  = array('in',$args_id);
		    $this->page = M('page')->where($condition)->order('date desc')->page($page,mc_option('page_size'))->select();
		    $count = M('page')->where($condition)->count();
		    $this->assign('id',$id);
		    $this->assign('count',$count);
		    $this->assign('page_now',$page);
		    $this->theme(mc_option('theme'))->display('Post/group');
		} else {
	     	$this->error('参数错误！');
	    };
	}
}