<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index($page=1){
        if(mc_site_url()) {
	        if(is_numeric($page)) {
		        if($_GET['keyword']) {
			        if($_GET['type']=='pro') {
						$condition['type']  = 'pro';
					} elseif($_GET['type']=='baobei') {
						$condition['type']  = 'baobei';
					} elseif($_GET['type']=='article') {
						$condition['type']  = 'article';
					} elseif($_GET['type']=='post') {
						$condition['type']  = 'publish';
					};
			        $where['content']  = array('like', "%{$_GET['keyword']}%");
					$where['title']  = array('like',"%{$_GET['keyword']}%");
					$where['_logic'] = 'or';
					$condition['_complex'] = $where;
					$this->page = M('page')->where($condition)->order('id desc')->page($page,mc_option('page_size'))->select();
			        $count = M('page')->where($condition)->count();
			        $this->assign('count',$count);
			        $this->assign('page_now',$page);
			        if($_GET['type']=='pro') {
						$this->theme(mc_option('theme'))->display('Pro/index');
					} elseif($_GET['type']=='baobei') {
						$this->theme(mc_option('theme'))->display('Baobei/index');
					} elseif($_GET['type']=='article') {
						$this->theme(mc_option('theme'))->display('Article/index');
					} elseif($_GET['type']=='post') {
						$this->theme(mc_option('theme'))->display('Home/search');
					} else {
						$this->error('无效的搜索类型！');
					};
		        } else {
		        	if(is_numeric($_GET['ref'])) {
				        session('mc_reffer',$_GET['ref']);
				        if(mc_user_id() && mc_user_id()!=session('mc_reffer') && session('mc_reffer')) {
					        $user_id = mc_user_id();
					        $ref_a = mc_get_meta($user_id,'ref',true,'user');
					        if(!is_numeric($ref_a)) {
						        mc_add_meta($user_id,'ref',session('mc_reffer'),'user');
					        };
				        };
			        };
			        $condition['type'] = 'publish';
				    $this->page = M('page')->where($condition)->order('date desc')->page($page,7)->select();
				    $count = M('page')->where($condition)->count();
				    $this->assign('count',$count);
				    $this->assign('page_now',$page);
			        if(mc_option('home_mode')=='pro') {
				        $this->theme(mc_option('theme'))->display('Home/index-pro');
			        } else {
				        $this->theme(mc_option('theme'))->display('Home/index');
			        }
			    }
		    } else {
			    $this->error('参数错误！');
		    }
        } else {
	        $site_url = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];
	        $site_url = preg_replace("/\/[a-z0-9]+\.php.*/is", "", $site_url);
	        $url = $site_url.'/install.php';
	        Header("Location:$url");
        }
    }
    public function publish($id){
        if(is_numeric($id)) {
	        if(mc_is_admin()) {
	        	mc_update_page($id,'publish','type');
				$this->success('审核成功！');
			} else {
		        $this->error('您没有权限访问此页面！');
	        }
        } else {
	        $this->error('参数错误！');
        }
    }
}