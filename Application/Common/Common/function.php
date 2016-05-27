<?php
//--------------- PUBLIC ---------------//
//调用option
function mc_option($meta_key,$type='public') {
	return M('option')->where("meta_key='$meta_key' AND type='$type'")->getField('meta_value');
};
//新增option
function mc_add_option($meta_key,$meta_value,$type='public') {
	$meta['meta_key'] = $meta_key;
	$meta['meta_value'] = $meta_value;
	$meta['type'] = $type;
	M('option')->data($meta)->add();
};
//更新option
function mc_update_option($meta_key,$meta_value,$type='public') {
	$optionx = M('option')->where("meta_key='$meta_key' AND type = '$type'")->getField('meta_value');
	if($optionx!='') {
		$meta['meta_value'] = $meta_value;
		M('option')->where("meta_key='$meta_key' AND type = '$type'")->save($meta);
	} else {
		M('option')->where("meta_key='$meta_key' AND type = '$type'")->delete();
		$meta['meta_key'] = $meta_key;
		$meta['meta_value'] = $meta_value;
		$meta['type'] = $type;
		M('option')->data($meta)->add();
	}
};
//网站地址
function mc_site_url() {
	return M('option')->where("meta_key='site_url'")->getField('meta_value');
};
//模板目录
function mc_theme_url() {
	return mc_site_url().'/Theme/'.mc_option('theme');
};
//加载公共模板
function mc_template_part($name) {
	echo W("Public/index",array($name));
};
//加载php文件
function mc_template($name) {
	require(THEME_PATH.$name.'.php');
}
//当前页面地址
function mc_page_url() {
	$url = (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') ? 'https://' : 'http://';
	$url .= $_SERVER['HTTP_HOST'];
	$url .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : urlencode($_SERVER['PHP_SELF']) . '?' . urlencode($_SERVER['QUERY_STRING']);
	return $url;
};
//获取用户真实IP
function mc_user_ip() {
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
		$ip = getenv("HTTP_CLIENT_IP");
	} elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	} elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
		$ip = getenv("REMOTE_ADDR");
	} elseif (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
		$ip = $_SERVER['REMOTE_ADDR'];
	} else {
		$ip = "unknown";
	};
	return $ip;
};
//发送邮件
require_once ('formail.php');
//全站标题
function mc_title() {
	if(MODULE_NAME=='Home') {
		if(CONTROLLER_NAME=='Index') {
			if(ACTION_NAME=='index') {
				if($_GET['keyword']) {
					$title = '搜索 - '.$_GET['keyword'].' - '.mc_option('site_name');
				} else {
					if(mc_option('home_title')) {
						$title = mc_option('home_title');
					} else {
						$title = mc_option('site_name');
					}
				};
			} else {
				$title = '未知页面 - '.mc_option('site_name');
			}
		} else {
			$title = '未知页面 - '.mc_option('site_name');
		};
	} elseif(MODULE_NAME=='Publish') {
		if(ACTION_NAME=='index') {
			$title = '发布商品 - '.mc_option('site_name');
		} elseif(ACTION_NAME=='add_group') {
			$title = '新建群组 - '.mc_option('site_name');
		} elseif(ACTION_NAME=='add_post') {
			$title = '新建主题 - '.mc_option('site_name');
		} elseif(ACTION_NAME=='edit') {
			$title = '编辑 - '.mc_option('site_name');
		} elseif(ACTION_NAME=='add_term') {
			$title = '添加分类 - '.mc_option('site_name');
		} elseif(ACTION_NAME=='add_baobei') {
			$title = '分享宝贝 - '.mc_option('site_name');
		} elseif(ACTION_NAME=='add_article') {
			$title = '写文章 - '.mc_option('site_name');
		} else {
			$title = '未知页面';
		}
	} elseif(MODULE_NAME=='Pro') {
		if(CONTROLLER_NAME=='Cart') {
			if(ACTION_NAME=='index') {
				$title = '我的购物车 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='checkout') {
				$title = '填写收货信息 - '.mc_option('site_name');
			} else {
				$title = '未知页面';
			}
		} elseif(ACTION_NAME=='index') {
			if(mc_option('pro_title')) {
				$title = mc_option('pro_title');
			} else {
				$title = '全部商品 - '.mc_option('site_name');
			}
		} elseif(ACTION_NAME=='term') {
			$title = mc_get_page_field($_GET['id'],'title').' - '.mc_option('site_name');
		} elseif(ACTION_NAME=='single') {
			$title = mc_get_page_field($_GET['id'],'title').' - '.mc_option('site_name');
		} else {
			$title = '未知页面';
		}
	} elseif(MODULE_NAME=='Article') {
		if(ACTION_NAME=='index') {
			if(mc_option('article_title')) {
				$title = mc_option('article_title');
			} else {
				$title = '全部文章 - '.mc_option('site_name');
			}
		} elseif(ACTION_NAME=='term') {
			$title = mc_get_page_field($_GET['id'],'title').' - '.mc_option('site_name');
		} elseif(ACTION_NAME=='tag') {
			$title = $_GET['tag'].' - '.mc_option('site_name');
		} elseif(ACTION_NAME=='single') {
			$title = mc_get_page_field($_GET['id'],'title').' - '.mc_option('site_name');
		} else {
			$title = '未知页面';
		}
	} elseif(MODULE_NAME=='Post') {
		if(CONTROLLER_NAME=='Group') {
			if(ACTION_NAME=='index') {
				if(mc_option('group_title')) {
					$title = mc_option('group_title');
				} else {
					$title = '社区 - '.mc_option('site_name');
				}
			} elseif(ACTION_NAME=='single') {
				$title = mc_get_page_field($_GET['id'],'title').' - 社区 - '.mc_option('site_name');
			} else {
				$title = '未知页面';
			}
		} else {
			$title = mc_get_page_field($_GET['id'],'title').' - 社区 - '.mc_option('site_name');
		}
	} elseif(MODULE_NAME=='User') {
		if(CONTROLLER_NAME=='Register') {
			$title = '注册 - '.mc_option('site_name');
		} elseif(CONTROLLER_NAME=='Login') {
			$title = '登陆 - '.mc_option('site_name');
		} elseif(CONTROLLER_NAME=='Lostpass') {
			$title = '找回密码 - '.mc_option('site_name');
		} elseif(CONTROLLER_NAME=='Index') {
			$display_name = mc_user_display_name($_GET['id']);
			if(ACTION_NAME=='index') {
				$title = $display_name.'的文章 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='edit') {
				$title = $display_name.'的资料 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='shoucang') {
				$title = $display_name.'的收藏 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='guanzhu') {
				$title = $display_name.'的关注 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='fans') {
				$title = $display_name.'的粉丝 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='pro') {
				$title = $display_name.'的订单 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='coins') {
				$title = '积分记录 - '.mc_option('site_name');
			} else {
				$title = '未知页面 - '.mc_option('site_name');
			}
		} else {
			$title = '未知页面 - '.mc_option('site_name');
		}
	} elseif(MODULE_NAME=='Control') {
		if(CONTROLLER_NAME=='Index') {
			if(ACTION_NAME=='index') {
				$title = '应用中心 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='set') {
				$title = '网站设置 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='pro_all') {
				$title = '订单管理 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='paytools') {
				$title = '支付接口 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='manage') {
				$title = '用户管理 - '.mc_option('site_name');
			} else {
				$title = '未知页面 - '.mc_option('site_name');
			}
		} elseif(CONTROLLER_NAME=='Weixin') {
			if(ACTION_NAME=='index') {
				$title = '接口设置 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='qunfa') {
				$title = '信息群发 - '.mc_option('site_name');
			} elseif(ACTION_NAME=='huifu') {
				$title = '自动回复 - '.mc_option('site_name');
			} else {
				$title = '未知页面 - '.mc_option('site_name');
			}
		} else {
			$title = '未知页面 - '.mc_option('site_name');
		}
	} else {
		$title = mc_option('site_name');
	};
	return $title;
};
//全站keywords+description
function mc_seo() {
	$nofollow = false;
	if(MODULE_NAME=='Home') {
		if(CONTROLLER_NAME=='Index') {
			if(ACTION_NAME=='index') {
				if($_GET['keyword']=='') {
					$keywords = mc_option('home_keywords');
					$description = mc_option('home_description');
				} else {
					$nofollow = true;
				};
			} else {
				$nofollow = true;
			}
		} else {
			$nofollow = true;
		};
	} elseif(MODULE_NAME=='Pro') {
		if(ACTION_NAME=='index') {
			$keywords = mc_option('pro_keywords');
			$description = mc_option('pro_description');
		} elseif(ACTION_NAME=='term') {
			$keywords = mc_get_page_field($_GET['id'],'title');
			$description = '';
		} elseif(ACTION_NAME=='single') {
			if(mc_get_meta($_GET['id'],'keywords')) {
				$keywords = mc_get_meta($_GET['id'],'keywords');
			} else {
				$keywords = mc_get_page_field($_GET['id'],'title');
			};
			if(mc_get_meta($_GET['id'],'description')) {
				$description = mc_cut_str(strip_tags(mc_get_meta($_GET['id'],'description')),152);
			} else {
				$description = mc_cut_str(strip_tags(mc_magic_out(mc_get_page_field($_GET['id'],'content'))),152);
			};
		} else {
			$nofollow = true;
		}
	} elseif(MODULE_NAME=='Post') {
		if(CONTROLLER_NAME=='Group') {
			if(ACTION_NAME=='index') {
				$keywords = mc_option('group_keywords');
				$description = mc_option('group_description');
			} elseif(ACTION_NAME=='single') {
				$keywords = mc_get_page_field($_GET['id'],'title');
				$description = mc_cut_str(strip_tags(mc_magic_out(mc_get_page_field($_GET['id'],'content'))),152);
			} else {
				$nofollow = true;
			}
		} else {
			$keywords = mc_get_page_field($_GET['id'],'title');
			$description = mc_cut_str(strip_tags(mc_magic_out(mc_get_page_field($_GET['id'],'content'))),152);
		}
	} elseif(MODULE_NAME=='Article') {
		if(ACTION_NAME=='index') {
			$keywords = mc_option('article_keywords');
			$description = mc_option('article_description');
		} elseif(ACTION_NAME=='term') {
			$keywords = mc_get_page_field($_GET['id'],'title');
			$description = '';
		} elseif(ACTION_NAME=='single') {
			$keywords = mc_get_page_field($_GET['id'],'title');
			$description = mc_cut_str(strip_tags(mc_magic_out(mc_get_page_field($_GET['id'],'content'))),152);
		} else {
			$nofollow = true;
		}
	} elseif(MODULE_NAME=='User') {
		if(CONTROLLER_NAME=='Index') {
			$display_name = mc_user_display_name($_GET['id']);
			if(ACTION_NAME=='index') {
				$keywords = mc_get_page_field($_GET['id'],'title');
				$description = mc_cut_str(strip_tags(mc_magic_out(mc_get_page_field($_GET['id'],'content'))),152);
			} else {
				$nofollow = true;
			}
		} else {
			$nofollow = true;
		}
	} else {
		$nofollow = true;
	};
	if($nofollow) {
		$meta .= '<meta name="robots" content="noindex,nofollow" />
';
	} else {
		$meta .= '<meta name="keywords" content="'.$keywords.'">
';
		$meta .= '<meta name="description" content="'.$description.'">
';
	}
	return $meta;
};
//截断
function mc_cut_str($sourcestr,$cutlength) {
	$returnstr='';
	$i=0;
	$n=0;
	$str_length=strlen($sourcestr);//字符串的字节数
	while (($n<$cutlength) and ($i<=$str_length)) {
		$temp_str=substr($sourcestr,$i,1);
		$ascnum=Ord($temp_str);//得到字符串中第$i位字符的ascii码
		if ($ascnum>=224)    //如果ASCII位高与224，
		{
		$returnstr=$returnstr.substr($sourcestr,$i,3); //根据UTF-8编码规范，将3个连续的字符计为单个字符
		$i=$i+3;            //实际Byte计为3
		$n++;            //字串长度计1
		}
		elseif ($ascnum>=192) //如果ASCII位高与192，
		{
		$returnstr=$returnstr.substr($sourcestr,$i,2); //根据UTF-8编码规范，将2个连续的字符计为单个字符
		$i=$i+2;            //实际Byte计为2
		$n++;            //字串长度计1
		}
		elseif ($ascnum>=65 && $ascnum<=90) //如果是大写字母，
		{
		$returnstr=$returnstr.substr($sourcestr,$i,1);
		$i=$i+1;            //实际的Byte数仍计1个
		$n++;            //但考虑整体美观，大写字母计成一个高位字符
		}
		else                //其他情况下，包括小写字母和半角标点符号，
		{
		$returnstr=$returnstr.substr($sourcestr,$i,1);
		$i=$i+1;            //实际的Byte数计1个
		$n=$n+0.5;        //小写字母和半角标点等与半个高位字符宽…
		}
	}
	if ($str_length>$cutlength){
		$returnstr = $returnstr . '…';//超过长度时在尾处加上省略号
	}
	return $returnstr;
};
//HTML危险标签过滤
function mc_remove_html($str) {
	$str = htmlspecialchars_decode($str);
	$str=preg_replace("/\s+/", " ", $str); //过滤多余回车 
	$str=preg_replace("/<[ ]+/si","<",$str); //过滤<__("<"号后面带空格) 
				
	$str=preg_replace("/<\!--.*?-->/si","",$str); //注释 
	$str=preg_replace("/<(\!.*?)>/si","",$str); //过滤DOCTYPE 
	$str=preg_replace("/<(\/?html.*?)>/si","",$str); //过滤html标签 
	$str=preg_replace("/<(\/?head.*?)>/si","",$str); //过滤head标签 
	$str=preg_replace("/<(\/?meta.*?)>/si","",$str); //过滤meta标签 
	$str=preg_replace("/<(\/?body.*?)>/si","",$str); //过滤body标签 
	$str=preg_replace("/<(\/?link.*?)>/si","",$str); //过滤link标签 
	$str=preg_replace("/<(\/?form.*?)>/si","",$str); //过滤form标签 
	$str=preg_replace("/cookie/si","COOKIE",$str); //过滤COOKIE标签 
				
	$str=preg_replace("/<(applet.*?)>(.*?)<(\/applet.*?)>/si","",$str); //过滤applet标签 
	$str=preg_replace("/<(\/?applet.*?)>/si","",$str); //过滤applet标签 
				
	$str=preg_replace("/<(style.*?)>(.*?)<(\/style.*?)>/si","",$str); //过滤style标签 
	$str=preg_replace("/<(\/?style.*?)>/si","",$str); //过滤style标签 
				
	$str=preg_replace("/<(title.*?)>(.*?)<(\/title.*?)>/si","",$str); //过滤title标签 
	$str=preg_replace("/<(\/?title.*?)>/si","",$str); //过滤title标签 
				
	$str=preg_replace("/<(object.*?)>(.*?)<(\/object.*?)>/si","",$str); //过滤object标签 
	$str=preg_replace("/<(\/?objec.*?)>/si","",$str); //过滤object标签 
				
	$str=preg_replace("/<(noframes.*?)>(.*?)<(\/noframes.*?)>/si","",$str); //过滤noframes标签 
	$str=preg_replace("/<(\/?noframes.*?)>/si","",$str); //过滤noframes标签 
				
	$str=preg_replace("/<(i?frame.*?)>(.*?)<(\/i?frame.*?)>/si","",$str); //过滤frame标签 
	$str=preg_replace("/<(\/?i?frame.*?)>/si","",$str); //过滤frame标签 
				
	$str=preg_replace("/<(script.*?)>(.*?)<(\/script.*?)>/si","",$str); //过滤script标签 
	$str=preg_replace("/<(\/?script.*?)>/si","",$str); //过滤script标签 
	$str=preg_replace("/javascript/si","Javascript",$str); //过滤script标签 
	$str=preg_replace("/vbscript/si","Vbscript",$str); //过滤script标签 
	$str=preg_replace("/on([a-z]+)\s*=/si","On\\1=",$str); //过滤script标签 
	$str=preg_replace("/&#/si","&＃",$str); //过滤script标签
	return $str;
}
//--------------- PUBLIC ---------------//

//--------------- META ---------------//
//新增meta
function mc_add_meta($page_id,$meta_key,$meta_value,$type='basic') {
	$meta['page_id'] = $page_id;
	$meta['meta_key'] = $meta_key;
	$meta['meta_value'] = $meta_value;
	$meta['type'] = $type;
	$meta_id = M('meta')->data($meta)->add();
	return $meta_id;
}
//调用meta
function mc_get_meta($page_id,$meta_key,$array=true,$type='basic') {
	$meta = M('meta')->where("page_id='$page_id' AND meta_key='$meta_key' AND type ='$type'");
	if($array) {
		return $meta->getField('meta_value');
	} else {
		return $meta->getField('meta_value',true);
	};
}
//更新meta
function mc_update_meta($page_id,$meta_key,$meta_value,$type='basic',$prev_value = false) {
	if($prev_value) {
		$meta_valuex = M('meta')->where("page_id='$page_id' AND meta_key='$meta_key' AND type = '$type' AND meta_value='$prev_value'")->getField('meta_value');
		if($meta_valuex!='') {
			$meta['meta_value'] = $meta_value;
			$meta['type'] = $type;
			M('meta')->where("page_id='$page_id' AND meta_key='$meta_key' AND type = '$type' AND meta_value='$prev_value'")->save($meta);
		} else {
			M('meta')->where("page_id='$page_id' AND meta_key='$meta_key' AND type = '$type' AND meta_value='$prev_value'")->delete();
			$meta['meta_value'] = $meta_value;
			$meta['type'] = $type;
			$meta['meta_key'] = $meta_key;
			$meta['page_id'] = $page_id;
			M('meta')->data($meta)->add();
		}
	} else {
		$meta_valuex = M('meta')->where("page_id='$page_id' AND meta_key='$meta_key' AND type = '$type'")->getField('meta_value');
		if($meta_valuex!='') {
			$meta['meta_value'] = $meta_value;
			$meta['type'] = $type;
			M('meta')->where("page_id='$page_id' AND meta_key='$meta_key' AND type = '$type'")->save($meta);
		} else {
			M('meta')->where("page_id='$page_id' AND meta_key='$meta_key' AND type = '$type'")->delete();
			$meta['meta_value'] = $meta_value;
			$meta['type'] = $type;
			$meta['meta_key'] = $meta_key;
			$meta['page_id'] = $page_id;
			M('meta')->data($meta)->add();
		}
	}
};
//删除meta
function mc_delete_meta($page_id,$meta_key,$type='basic',$prev_value = false) {
	if($prev_value) {
		M('meta')->where("page_id='$page_id' AND meta_key='$meta_key' AND type = '$type' AND meta_value='$prev_value'")->delete();
	} else {
		M('meta')->where("page_id='$page_id' AND meta_key='$meta_key' AND type = '$type'")->delete();
	}
};
//调用page封面图片
function mc_fmimg($id) {
	if(mc_get_meta($id,'fmimg')) {
		return mc_get_meta($id,'fmimg');
	} elseif(mc_catch_that_image($id)) {
		return mc_catch_that_image($id);
	} else {
		return mc_option('fmimg');
	}
};
//获取文章内容第一张图片
function mc_catch_that_image($id) {
	$content = mc_get_page_field($id,'content');
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
	$first_img = $matches [1] [0];
	return $first_img;
};
//获取page阅读数
function mc_views_count($id) {
	$views = mc_get_meta($id,'views');
	if($views) {
		return $views;
	} else {
		return 0;
	}
};
//设置page阅读数
function mc_set_views($id) {
	$views = mc_views_count($id);
	if($views) {
		mc_update_meta($id,'views',$views+1);
	} else {
		mc_add_meta($id,'views',1);
	}
};
//获取term下page数量
function mc_term_page_count($id) {
	$pages = M('meta')->where("meta_value='$id' AND meta_key='term'")->getField('id',true);
	return count($pages);
};
//--------------- META ---------------//

//--------------- ACTION ---------------//
//新增action
function mc_add_action($page_id,$action_key,$action_value) {
	$action['page_id'] = $page_id;
	$action['user_id'] = mc_user_id();
	$action['action_key'] = $action_key;
	$action['action_value'] = $action_value;
	$action['date'] = strtotime("now");
	$result = M('action')->data($action)->add();
	return $result;
};
//获取page评论数量
function mc_comment_count($id) {
	$comment = M('action')->where("page_id='$id' AND action_key='comment'")->getField('id',true);
	return count($comment);
};
//获取心愿需要的价格
function mc_total_wish_for($id) {
	$group_id = mc_get_meta($id,'group');
	$parameter = mc_get_meta($id,'parameter',false);
	$cart_price = mc_get_meta($group_id,'price');
	if($parameter) :
		foreach($parameter as $par) :
			list($key,$par_value) = explode('|',$par);
			$price = M('meta')->where("page_id='".$group_id."' AND meta_key='$par_value' AND type ='price'")->getField('meta_value');
			$cart_price += $price;
		endforeach;
	endif;
	$total = $cart_price*mc_get_meta($id,'number');
	if($total>0) {
		return $total;
	} else {
		return 0;
	}
};
//获取心愿支持总价
function mc_total_wish($id) {
	$cart = M('action')->where("page_id='$id' AND action_key='wish'")->select();
	foreach($cart as $val) {
		$price = $val['action_value'];
		$t = $price;
		$total+=$t;
	}
	if($total>0) {
		return $total;
	} else {
		return 0;
	}
};
//获取心愿支持总人数
function mc_total_count_wish($id) {
	$cart = M('action')->where("page_id='$id' AND action_key='wish'")->getField('id',true);
	return count($cart);
};
//获取用户购物车商品总价
function mc_total($id=false) {
	if($id) {
		$user_id = $id;
	} else {
		$user_id = mc_user_id();
	};
	$cart = M('action')->where("user_id='$user_id' AND action_key='cart'")->select();
	foreach($cart as $val) {
		$price = mc_cart_price($val['id']);
		$number = $val['action_value'];
		$t = $price*$number;
		$total+=$t;
	}
	return $total;
};
//获取用户购物车商品总数
function mc_cart_count($id=false) {
	if($id) {
		$user_id = $id;
	} else {
		$user_id = mc_user_id();
	};
	$cart = M('action')->where("user_id='$user_id' AND action_key='cart'")->getField('id',true);
	return count($cart);
};
//获取page最后评论人
function mc_last_comment_user($id) {
	$user_id = M('action')->where("page_id='$id' AND action_key='comment'")->order('id desc')->limit(1)->getField('user_id');
	return $user_id;
};
//获取评论所在文章
function mc_comment_page($id) {
	$page_id = M('action')->where("id='$id' AND action_key='comment'")->getField('page_id');
	return $page_id;
};
//获取评论所在群组
function mc_comment_group($id) {
	$page_id = M('action')->where("id='$id' AND action_key='comment'")->getField('page_id');
	if(mc_get_page_field($page_id,'type')=='group') {
		return $page_id;
	} else {
		return mc_get_meta($page_id,'group');
	}
};
//--------------- ACTION ---------------//

//--------------- PAGE ---------------//
//新增page
function mc_add_page($title,$content,$type='pending') {
	$page['title'] = $title;
	$page['content'] = $content;
	$page['type'] = $type;
	$page['date'] = strtotime("now");
	$result = M('page')->data($page)->add();
	if($result) {
		return $result;
	}
};
//更新page
function mc_update_page($id,$field,$for) {
	if($for=='title') {
		$page['title'] = $field;
	} elseif($for=='content') {
		$page['content'] = $field;
	} elseif($for=='type') {
		$page['type'] = $field;
	} elseif($for=='date') {
		$page['date'] = $field;
	};
	M('page')->where("id='$id'")->save($page);
};
//调用page字段
function mc_get_page_field($id,$for) {
	if($for=='title') {
		return M('page')->where("id='$id'")->getField('title');
	} elseif($for=='content') {
		return M('page')->where("id='$id'")->getField('content');
	} elseif($for=='type') {
		return M('page')->where("id='$id'")->getField('type');
	} elseif($for=='date') {
		return M('page')->where("id='$id'")->getField('date');
	};
};
//删除page
function mc_delete_page($id) {
	$type = mc_get_page_field($id,'type');
	if($type=='group') : 
	$group_post = M('meta')->where("meta_key='group' AND meta_value='$id'")->getField('page_id',true);
	if($group_post) : foreach($group_post as $val) :
	M('page')->where("id='$val'")->delete();
	M('meta')->where("page_id='$val'")->delete();
	M('action')->where("page_id='$val'")->delete();
	endforeach; endif;
	endif;
	if($type=='term_pro' || $type=='term_baobei') : 
	$term_post = M('meta')->where("meta_key='term' AND meta_value='$id'")->getField('page_id',true);
	if($term_post) : foreach($term_post as $val) :
	M('page')->where("id='$val'")->delete();
	M('meta')->where("page_id='$val'")->delete();
	M('action')->where("page_id='$val'")->delete();
	endforeach; endif;
	endif;
	M('page')->where("id='$id'")->delete();
	M('meta')->where("page_id='$id'")->delete();
	M('action')->where("page_id='$id'")->delete();
};
//列表页循环
function mc_pagenavi($count,$page_now,$size=false) {
	if($size) {
		$Page_size = $size;
	} else {
		$Page_size = mc_option('page_size');
	};
	$page_count = ceil($count/$Page_size); 
	
	$init=1; 
	$page_len=7; 
	$max_p=$page_count; 
	$pages=$page_count; 
	
	//判断当前页码 
	if(empty($page_now)||$page_now<0){ 
		$page=1; 
	}else { 
		$page=$page_now; 
	};
	$offset = $Page_size*($page-1);
	$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
	$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
	
	$key='<ul class="pagination">'; 
	$key.="<li class='disabled'><a href='#'>$page/$pages</a></li>"; //第几页,共几页 
	
	if($_GET['id']) {
		$page_url = __ACTION__."?id=".$_GET['id']."&";
	} elseif($_GET['keyword']) {
		$page_url = __ACTION__."?keyword=".$_GET['keyword']."&";
	} else {
		$page_url = __ACTION__."?";
	};
	
	if($page!=1){ 
		$key.="<li><a href=\"".$page_url."page=1\">&laquo;</a></li>"; //第一页 
		$key.="<li class='prev'><a href=\"".$page_url."page=".($page-1)."\">&lsaquo;</a></li>"; //上一页 
	}else { 
		$key.="<li class='disabled'><a href='#'>&laquo;</a></li>";//第一页 
		$key.="<li class='disabled'><a href='#'>&lsaquo;</a></li>"; //上一页 
	} 
	if($pages>$page_len){ 
		//如果当前页小于等于左偏移 
		if($page<=$pageoffset){ 
			$init=1; 
			$max_p = $page_len; 
		}else{//如果当前页大于左偏移 
			//如果当前页码右偏移超出最大分页数 
			if($page+$pageoffset>=$pages+1){ 
				$init = $pages-$page_len+1; 
			}else{ 
				//左右偏移都存在时的计算 
				$init = $page-$pageoffset; 
				$max_p = $page+$pageoffset; 
			} 
		} 
	} 
	for($i=$init;$i<=$max_p;$i++){ 
	if($i==$page){ 
		$key.='<li class="active"><a href="#">'.$i.'</a></li>'; 
	} else { 
		$key.="<li><a href=\"".$page_url."page=".$i."\">".$i."</a></li>"; 
	} 
	} 
	if($page!=$pages){ 
		$key.="<li class='next'><a href=\"".$page_url."page=".($page+1)."\">&rsaquo;</a>";//下一页 
		$key.="<li><a href=\"".$page_url."page={$pages}\">&raquo;</a></li>"; //最后一页 
	}else { 
		$key.='<li class="disabled"><a href="#">&rsaquo;</a></li>';//下一页 
		$key.='<li class="disabled"><a href="#">&raquo;</a></li>'; //最后一页 
	} 
	$key.='</ul>'; 
	
	if($count>$Page_size) {
		return $key;
	}
};
//喜欢数量
function mc_xihuan_count($page_id) {
	$user_xihuan = M('action')->where("page_id='$page_id' AND action_key='perform' AND action_value ='xihuan'")->getField('id',true);
	return count($user_xihuan);
};
//喜欢按钮
function mc_xihuan_btn($page_id) {
	if(mc_user_id()) {
		$user_xihuan = M('action')->where("page_id='$page_id' AND user_id ='".mc_user_id()."' AND action_key='perform' AND action_value ='xihuan'")->getField('id');
		if($user_xihuan) {
			$btn = '<a href="javascript:;" id="mc_xihuan_'.$page_id.'" class="active btn btn-danger btn-like"><i class="glyphicon glyphicon-heart"></i> 已喜欢<span>'.mc_xihuan_count($page_id).'</span></a>';
		} else {
			$btn = '<a href="javascript:mc_add_xihuan('.$page_id.');" id="mc_xihuan_'.$page_id.'" class="btn btn-danger btn-like"><i class="glyphicon glyphicon-heart-empty"></i> 喜欢<span>'.mc_xihuan_count($page_id).'</span></a>';
		};
	} else {
		$btn = '<a href="'.U('user/login/index').'" id="mc_xihuan_'.$page_id.'" class="btn btn-danger btn-like"><i class="glyphicon glyphicon-heart-empty"></i> 喜欢<span>'.mc_xihuan_count($page_id).'</span></a>';
	};
	return $btn;
};
function mc_xihuan_js() {
	if(mc_user_id()) {
		if(C('URL_MODEL')==0) {
			$url = U('home/perform/xihuan?add_xihuan=');
		} else {
			$url = U('home/perform/xihuan').'?add_xihuan=';
		};
		$js = "<script>
		function mc_add_xihuan(id) {
			$.ajax({
				url: '".$url."' + id,
				type: 'GET',
				dataType: 'html',
				timeout: 9000,
				error: function() {
					alert('提交失败！');
				},
				success: function(html) {
					var count = $('#mc_xihuan_'+id+' span').text()*1+1;
					$('#mc_xihuan_'+id).attr('href','javascript:;');
					$('#mc_xihuan_'+id).addClass('active');
					$('#mc_xihuan_'+id).html('<i class=\'glyphicon glyphicon-heart\'></i> 已喜欢<span>'+count+'</span>');
				}
			});
		};
		</script>";
		return $js;
	};
};
//收藏数量
function mc_shoucang_count($page_id) {
	$user_shoucang = M('action')->where("page_id='$page_id' AND action_key='perform' AND action_value ='shoucang'")->getField('id',true);
	return count($user_shoucang);
};
//收藏按钮
function mc_shoucang_btn($page_id) {
	if(mc_user_id()) {
		$user_shoucang = M('action')->where("page_id='$page_id' AND user_id ='".mc_user_id()."' AND action_key='perform' AND action_value ='shoucang'")->getField('id');
		if($user_shoucang) {
			$btn = '<a href="javascript:mc_remove_shoucang('.$page_id.');" id="mc_shoucang_'.$page_id.'" class="active btn btn-success btn-like"><i class="glyphicon glyphicon-star"></i> 取消收藏<span>'.mc_shoucang_count($page_id).'</span></a>';
		} else {
			$btn = '<a href="javascript:mc_add_shoucang('.$page_id.');" id="mc_shoucang_'.$page_id.'" class="btn btn-success btn-like"><i class="glyphicon glyphicon-star-empty"></i> 收藏<span>'.mc_shoucang_count($page_id).'</span></a>';
		};
	} else {
		$btn = '<a href="'.U('user/login/index').'" id="mc_shoucang_'.$page_id.'" class="btn btn-success btn-like"><i class="glyphicon glyphicon-star-empty"></i> 收藏<span>'.mc_shoucang_count($page_id).'</span></a>';
	};
	return $btn;
};
function mc_shoucang_js() {
	if(mc_user_id()) {
		if(C('URL_MODEL')==0) {
			$url = U('home/perform/add_shoucang?add_shoucang=');
		} else {
			$url = U('home/perform/add_shoucang').'?add_shoucang=';
		};
		if(C('URL_MODEL')==0) {
			$url2 = U('home/perform/remove_shoucang?remove_shoucang=');
		} else {
			$url2 = U('home/perform/remove_shoucang').'?remove_shoucang=';
		};
		$js .= "<script>
		function mc_add_shoucang(id) {
			$.ajax({
				url: '".$url."' + id,
				type: 'GET',
				dataType: 'html',
				timeout: 9000,
				error: function() {
					alert('提交失败！');
				},
				success: function(html) {
					var count = $('#mc_shoucang_'+id+' span').text()*1+1;
					$('#mc_shoucang_'+id).attr('href','javascript:mc_remove_shoucang('+id+');');
					$('#mc_shoucang_'+id).addClass('active');
					$('#mc_shoucang_'+id).html('<i class=\'glyphicon glyphicon-star\'></i> 取消收藏<span>'+count+'</span>');
				}
			});
		};
		</script>";
		$js .= "<script>
		function mc_remove_shoucang(id) {
			$.ajax({
				url: '".$url2."' + id,
				type: 'GET',
				dataType: 'html',
				timeout: 9000,
				error: function() {
					alert('提交失败！');
				},
				success: function(html) {
					var count = $('#mc_shoucang_'+id+' span').text()*1-1;
					$('#mc_shoucang_'+id).attr('href','javascript:mc_add_shoucang('+id+');');
					$('#mc_shoucang_'+id).removeClass('active');
					$('#mc_shoucang_'+id).html('<i class=\'glyphicon glyphicon-star-empty\'></i> 收藏<span>'+count+'</span>');
				}
			});
		};
		</script>";
		return $js;
	};
};
//关注数量
function mc_guanzhu_count($page_id) {
	$user_guanzhu = M('action')->where("page_id='$page_id' AND action_key='perform' AND action_value ='guanzhu'")->getField('id',true);
	return count($user_guanzhu);
};
//关注按钮
function mc_guanzhu_btn($page_id) {
	if(mc_user_id()) {
		if(mc_user_id()!=$page_id) {
			$user_guanzhu = M('action')->where("page_id='$page_id' AND user_id ='".mc_user_id()."' AND action_key='perform' AND action_value ='guanzhu'")->getField('id');
			if($user_guanzhu) {
				$btn = '<a href="javascript:mc_remove_guanzhu('.$page_id.');" id="mc_guanzhu_'.$page_id.'" class="active btn btn-info btn-like"><i class="glyphicon glyphicon-remove-circle"></i> 取消关注<span>'.mc_guanzhu_count($page_id).'</span></a>';
			} else {
				$btn = '<a href="javascript:mc_add_guanzhu('.$page_id.');" id="mc_guanzhu_'.$page_id.'" class="btn btn-info btn-like"><i class="glyphicon glyphicon-ok-circle"></i> 关注<span>'.mc_guanzhu_count($page_id).'</span></a>';
			}
		}
	} else {
		$btn = '<a href="'.U('user/login/index').'" id="mc_guanzhu_'.$page_id.'" class="btn btn-info btn-like"><i class="glyphicon glyphicon-ok-circle"></i> 关注<span>'.mc_guanzhu_count($page_id).'</span></a>';
	};
	return $btn;
};
function mc_guanzhu_js() {
	if(mc_user_id()) {
		if(C('URL_MODEL')==0) {
			$url = U('home/perform/add_guanzhu?add_guanzhu=');
		} else {
			$url = U('home/perform/add_guanzhu').'?add_guanzhu=';
		};
		if(C('URL_MODEL')==0) {
			$url2 = U('home/perform/remove_guanzhu?remove_guanzhu=');
		} else {
			$url2 = U('home/perform/remove_guanzhu').'?remove_guanzhu=';
		};
		$js .= "<script>
		function mc_add_guanzhu(id) {
			$.ajax({
				url: '".$url."' + id,
				type: 'GET',
				dataType: 'html',
				timeout: 9000,
				error: function() {
					alert('提交失败！');
				},
				success: function(html) {
					var count = $('#mc_guanzhu_'+id+' span').text()*1+1;
					$('#mc_guanzhu_'+id).attr('href','javascript:mc_remove_guanzhu('+id+');');
					$('#mc_guanzhu_'+id).addClass('active');
					$('#mc_guanzhu_'+id).html('<i class=\'glyphicon glyphicon-remove-circle\'></i> 取消关注<span>'+count+'</span>');
				}
			});
		};
		</script>";
		$js .= "<script>
		function mc_remove_guanzhu(id) {
			$.ajax({
				url: '".$url2."' + id,
				type: 'GET',
				dataType: 'html',
				timeout: 9000,
				error: function() {
					alert('提交失败！');
				},
				success: function(html) {
					var count = $('#mc_guanzhu_'+id+' span').text()*1-1;
					$('#mc_guanzhu_'+id).attr('href','javascript:mc_add_guanzhu('+id+');');
					$('#mc_guanzhu_'+id).removeClass('active');
					$('#mc_guanzhu_'+id).html('<i class=\'glyphicon glyphicon-ok-circle\'></i> 关注<span>'+count+'</span>');
				}
			});
		};
		</script>";
		return $js;
	};
};
//获取页面url
function mc_get_url($page_id) {
	$type = mc_get_page_field($page_id,'type');
	if($type=='pro') :
		if(C('URL_MODEL')==2) {
			$permalink = mc_site_url().'/pro-'.$page_id.'.html';
		} else {
			$permalink = U('pro/index/single?id='.$page_id);
		}
	elseif($type=='group') :
		$permalink = U('post/group/single?id='.$page_id);
	elseif($type=='article') :
		if(C('URL_MODEL')==2) {
			$permalink = mc_site_url().'/article-'.$page_id.'.html';
		} else {
			$permalink = U('article/index/single?id='.$page_id);
		}
	elseif($type=='user') :
		$permalink = U('user/index/index?id='.$page_id);
	elseif($type=='publish' || $type=='pending') :
		if(C('URL_MODEL')==2) {
			$permalink = mc_site_url().'/post-'.$page_id.'.html';
		} else {
			$permalink = U('post/index/single?id='.$page_id);
		}
	else :
		$permalink = 'javascript:;';
	endif;
	return $permalink;
};
//--------------- PAGE ---------------//

//--------------- USER ---------------//
//用户id
function mc_user_id() {
	$page_id = M('meta')->where("meta_key='user_name' AND meta_value='".session('user_name')."' AND type='user'")->getField('page_id');
	$user_pass_true = mc_get_meta($page_id,'user_pass',true,'user');
	if(session('user_name') && session('user_pass') && session('user_pass') == $user_pass_true) {
		return $page_id;
	}
}
//用户昵称
function mc_user_display_name($page_id) {
	$user_display_name = mc_get_page_field($page_id,'title');
	if($user_display_name) {
		return $user_display_name;
	} else {
		return mc_get_meta($page_id,'user_name',true,'user');
	}
};
//用户头像
function mc_user_avatar($page_id) {
	$user_display_name = mc_get_meta($page_id,'user_avatar',true,'user');
	if($user_display_name) {
		return $user_display_name;
	} else {
		return mc_theme_url().'/img/avatar.png';
	}
};
//是否为管理员
function mc_is_admin($id=false) {
	if($id) {
		$user_level = mc_get_meta($id,'user_level',true,'user');
	} else {
		$user_level = mc_get_meta(mc_user_id(),'user_level',true,'user');
	}
	if($user_level=='10') {
		return true;
	} else {
		return false;
	}
};
//是否为管理员
function mc_is_bianji($id=false) {
	if($id) {
		$user_level = mc_get_meta($id,'user_level',true,'user');
	} else {
		$user_level = mc_get_meta(mc_user_id(),'user_level',true,'user');
	}
	if($user_level>'5') {
		return true;
	} else {
		return false;
	}
};
//是否为群组管理员
function mc_is_group_admin($id) {
	if(is_numeric($id)) {
		$group_admin = mc_get_meta(mc_user_id(),'group_admin',false,'user');
		if(in_array($id,$group_admin)) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
};
//调用页面作者
function mc_author_id($id) {
	return mc_get_meta($id,'author',true);
};
//调用指定用户积分
function mc_coins($id) {
	if(mc_get_meta($id,'coins',true,'user')) {
		return mc_get_meta($id,'coins',true,'user');
	} else {
		return '0';
	}
};
//调用指定用户积分
function mc_update_coins($id,$coins) {
	if(mc_get_meta($id,'coins',true,'user')) {
		$old_coins = mc_get_meta($id,'coins',true,'user');
		$new_coins = $old_coins+$coins;
		mc_update_meta($id,'coins',$new_coins,'user');
	} else {
		$new_coins = $coins;
		mc_add_meta($id,'coins',$new_coins,'user');
	};
	return $new_coins;
};
//今日是否签到
function mc_is_qiandao() {
	$coins_action = M('action')->where("page_id='".mc_user_id()."' AND user_id='".mc_user_id()."' AND action_key='coins' AND action_value='3'")->order('id desc')->limit(1)->getField('date',true);
	$true_qiandao = date('Ymd',$coins_action[0]);
	$today_qiandao = date('Ymd',strtotime("now"));
	if($true_qiandao==$today_qiandao) {
		return true;
	} else {
		return false;
	}
};
//未读信息数量
function mc_user_trend_count() {
	if(mc_user_id()) {
		$count = M('action')->where("page_id='".mc_user_id()."' AND user_id='".mc_user_id()."' AND action_key='trend'")->getField('action_value');
		if($count) {
			return $count;
		} else {
			return 0;
		}
	} else {
		return 0;
	}
};
function mc_is_mobile() {
	static $is_mobile;

	if ( isset($is_mobile) )
		return $is_mobile;

	if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
		$is_mobile = false;
	} elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
		|| strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
		|| strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
		|| strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
		|| strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
		|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
		|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
			$is_mobile = true;
	} else {
		$is_mobile = false;
	}

	return $is_mobile;
}
//过滤字符
function mc_magic_in($content) {
	if(get_magic_quotes_gpc()){ 
	    $val = $content;
	} else {
	   	$val = mysql_real_escape_string($content);
	};
	return $val;
};
function mc_magic_out($content) {
	$content1 = str_replace('\r\n', ' ', $content);
	$val = stripslashes($content1);
	return $val;
};
//商品默认价格
function mc_price_now($id) {
	$price_now = mc_get_meta($id,'price');
	$parameter = M('option')->where("meta_key='parameter' AND type='pro'")->select();
	if($parameter) :
		foreach($parameter as $par) :
			$pro_parameter = mc_get_meta($id,$par['id'],false,'parameter');
			if($pro_parameter) :
				$num_now=0;
				foreach($pro_parameter as $pro_par) :
					$num_now++;
					if($num_now==1) :
						$price = M('meta')->where("page_id='$id' AND meta_key='$pro_par' AND type ='price'")->getField('meta_value');
						$price_now += $price;
					endif;
				endforeach;
			endif;
		endforeach;
	endif;
	return $price_now;
};
//订单内商品价格
function mc_cart_price($id) {
	$pro_id = M('action')->where("id='$id'")->getField('page_id');
	$cart_price = mc_get_meta($pro_id,'price');
	$parameter = M('action')->where("page_id='$id' AND action_key='parameter'")->order('id asc')->getField('action_value',true);
	if($parameter) :
		foreach($parameter as $par) :
			list($par_name,$par_value) = explode('|',$par);
			$price = M('meta')->where("page_id='$pro_id' AND meta_key='$par_value' AND type ='price'")->getField('meta_value');
			$cart_price += $price;
		endforeach;
	endif;
	return $cart_price;
};

//--------------- USER ---------------//
//--------------- go -----------------//
require_once ('class-go.php');
require_once ('go.php');
require_once (APP_PATH.'function.php');
function mc_site_update_url() {
	return "http://lockm.b0.upaiyun.com";
};
//--------------- go -----------------//
//------------- weixin ---------------//
require_once ('function_weixin.php');
//------------- weixin ---------------//
?>