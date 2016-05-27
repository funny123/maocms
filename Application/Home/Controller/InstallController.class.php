<?php
namespace Home\Controller;
use Think\Controller;
class InstallController extends Controller {
    public function index(){
        $Model = M();
	        $db_prefix = C('DB_PREFIX');
	        $table[] = "CREATE TABLE IF NOT EXISTS ".$db_prefix."page (
	        	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	        	PRIMARY KEY(id),
	        	title text,
	        	content longtext,
	        	type varchar(20),
	        	date int
				) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			$table[] = "CREATE TABLE IF NOT EXISTS ".$db_prefix."meta (
	        	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	        	PRIMARY KEY(id),
	        	page_id bigint(20) UNSIGNED,
	        	meta_key varchar(20),
	        	meta_value varchar(255),
	        	type varchar(20)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			$table[] = "CREATE TABLE IF NOT EXISTS ".$db_prefix."action (
	        	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	        	PRIMARY KEY(id),
	        	page_id bigint(20) UNSIGNED,
	        	user_id bigint(20) UNSIGNED,
	        	action_key varchar(20),
	        	action_value varchar(255),
	        	date int
				) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			$table[] = "CREATE TABLE IF NOT EXISTS ".$db_prefix."option (
	        	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	        	PRIMARY KEY(id),
	        	meta_key varchar(20),
	        	meta_value varchar(255),
	        	type varchar(20)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			$table[] = "CREATE TABLE IF NOT EXISTS ".$db_prefix."attached (
	        	id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	        	PRIMARY KEY(id),
	        	src varchar(255),
	        	type varchar(20)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8";
	        foreach($table as $query) {
				$Model->query($query);
			}
			$site_url = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];
			$site_url = preg_replace("/\/[a-z0-9]+\.php.*/is", "", $site_url);
			$Data = M('option');
			$site['meta_key'] = 'site_url';
			$site['meta_value'] = $site_url;
			$site['type'] = 'public';
			$result = $Data->data($site)->add();
			$site1['meta_key'] = 'site_name';
			$site1['meta_value'] = 'Mao10CMS';
			$site1['type'] = 'public';
			$result1 = $Data->data($site1)->add();
			$site2['meta_key'] = 'site_key';
			$site2['meta_value'] = rand(1000000000,9999999999);
			$site2['type'] = 'public';
			$result2 = $Data->data($site2)->add();
			$site3['meta_key'] = 'theme';
			$site3['meta_value'] = 'default';
			$site3['type'] = 'public';
			$result3 = $Data->data($site3)->add();
			$site4['meta_key'] = 'page_size';
			$site4['meta_value'] = '10';
			$site4['type'] = 'public';
			$result4 = $Data->data($site4)->add();
			$user['title'] = C('ADMIN_LOGIN');
			$user['content'] = '';
			$user['type'] = 'user';
			$user['date'] = strtotime("now");
			$result5 = M("page")->data($user)->add();
			if($result && $result1 && $result2 && $result3 && $result4 && $result5) {
				mc_add_meta($result5,'user_name',C('ADMIN_LOGIN'),'user');
				$user_pass = md5(C('ADMIN_PASS').mc_option('site_key'));
				mc_add_meta($result5,'user_pass',$user_pass,'user');
				mc_add_meta($result5,'user_email','','user');
				mc_add_meta($result5,'user_level','10','user');
				session('user_name',C('ADMIN_LOGIN'));
		        session('user_pass',$user_pass);
		        unlink('InstallController.class.php');
				$this->success('数据库建立成功！',U('home/index/index'));
			} else {
				$this->error('写入数据库失败');
			}
    }
}