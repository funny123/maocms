<?php
namespace Home\Controller;
use Think\Controller;
class PerformController extends Controller {
    public function xihuan($add_xihuan){
        $add_xihuan = mc_magic_in($_GET['add_xihuan']);
        $user_xihuan = M('action')->where("page_id='$add_xihuan' AND user_id ='".mc_user_id()."' AND action_key='perform' AND action_value ='xihuan'")->getField('id');
        if(empty($user_xihuan)) {
        	mc_add_action($add_xihuan,'perform','xihuan');
        	$user_id = mc_author_id($add_xihuan);
        	do_go('add_xihuan_end',$user_id);
        };
        $this->error('哥们，你放弃治疗了吗?',U('home/index/index'));
        //$date = strtotime("+8HOUR"); echo date('Y-m-d H:i:s',$date);
    }
    public function add_shoucang($add_shoucang){
        $add_shoucang = mc_magic_in($_GET['add_shoucang']);
        $user_shoucang = M('action')->where("page_id='$add_shoucang' AND user_id ='".mc_user_id()."' AND action_key='perform' AND action_value ='shoucang'")->getField('id');
        if(empty($user_shoucang)) {
        	mc_add_action($add_shoucang,'perform','shoucang');
        	$user_id = mc_author_id($add_shoucang);
        	do_go('add_shoucang_end',$user_id);
        };
        $this->error('哥们，你放弃治疗了吗?',U('home/index/index'));
    }
    public function remove_shoucang($remove_shoucang){
        $remove_shoucang = mc_magic_in($_GET['remove_shoucang']);
        M('action')->where("page_id='$remove_shoucang' AND user_id='".mc_user_id()."' AND action_key='perform' AND action_value = 'shoucang'")->delete();
        $user_id = mc_author_id($remove_shoucang);
        do_go('remove_shoucang_end',$user_id);
        $this->error('哥们，你放弃治疗了吗?',U('home/index/index'));
    }
    public function add_guanzhu($add_guanzhu){
        $add_guanzhu = mc_magic_in($_GET['add_guanzhu']);
        $user_guanzhu = M('action')->where("page_id='$add_guanzhu' AND user_id ='".mc_user_id()."' AND action_key='perform' AND action_value ='guanzhu'")->getField('id');
        if(empty($user_guanzhu)) {
        	mc_add_action($add_guanzhu,'perform','guanzhu');
			do_go('add_guanzhu_end',$add_guanzhu);
        };
        $this->error('哥们，你放弃治疗了吗?',U('home/index/index'));
    }
    public function remove_guanzhu($remove_guanzhu){
        $remove_guanzhu = mc_magic_in($_GET['remove_guanzhu']);
        M('action')->where("page_id='$remove_guanzhu' AND user_id='".mc_user_id()."' AND action_key='perform' AND action_value = 'guanzhu'")->delete();
        do_go('remove_guanzhu_end',$remove_guanzhu);
        $this->error('哥们，你放弃治疗了吗?',U('home/index/index'));
    }
    public function comment($id,$content){
        if(mc_user_id()) {
	        $id = mc_magic_in($_POST['id']);
	        $content = mysql_real_escape_string(strip_tags($_POST['content']));
	        if($content) {
		        $content_array = explode(' ',$content);
				foreach($content_array as $val) :
				$content_s = strstr($val, '@');
				$to_user = substr($content_s, 1);
				if($to_user) :
				$idx = M('page')->where("title='$to_user'")->getField('id');
				$content_s2 .= '<a href="'.U('user/index/index?id='.$idx).'">'.$content_s.'</a> ';
				else :
				$content_s2 .= $val.' ';
				endif;
				endforeach;
		        $result = mc_add_action($id,'comment',$content_s2);
		        foreach($content_array as $val) :
				$content_s = strstr($val, '@');
				$to_user = substr($content_s, 1);
				if($to_user) :
				$idx = M('page')->where("title='$to_user'")->getField('id');
				mc_add_action($idx,'at',$result);
				do_go('publish_at_end',$idx);
				endif;
				endforeach;
				$user_id = mc_author_id($id);
				do_go('publish_comment_end',$user_id);
		        $type = mc_get_page_field($id,'type');
		        if($type=='publish') {
		        	if(mc_option('paixu')==2) {
		        		mc_update_page($id,strtotime("now"),'date');
		        	};
			        $this->success('评论成功！',U('post/index/single?id='.$id.'#comment-'.$result));
		        } elseif($type=='article') {
			        $this->success('评论成功！',U('article/index/single?id='.$id.'#comment-'.$result));
		        } else {
			        $this->success('评论成功！',U('pro/index/single?id='.$id.'#comment-'.$result));
		        }
	        } else {
		        $this->error('请填写评论内容！');
	        }
	    } else {
		    $this->success('请先登陆',U('user/login/index'));
	    }
    }
    public function publish(){
    	if(mc_user_id()) {
	    	if($_POST['title'] && $_POST['content']) {
	    		$page['title'] = mc_magic_in($_POST['title']);
	    		$page['content'] = mc_magic_in(mc_remove_html($_POST['content']));
	    		if(mc_option('shenhe_post')==2) {
	    			if(mc_is_admin()) {
		    			$page['type'] = 'publish';
	    			} else {
		    			$page['type'] = 'pending';
	    			}
	    		} else {
		    		$page['type'] = 'publish';
	    		};
	    		$page['date'] = strtotime("now");
	    		$result = M('page')->data($page)->add();
		    	if($result) {
		    		mc_add_meta($result,'author',mc_user_id());
		    		if(is_numeric($_POST['group'])) {
			    		mc_add_meta($result,'group',$_POST['group']);
			    		mc_update_page(mc_magic_in($_POST['group']),strtotime("now"),'date');
			    		mc_add_meta($result,'time',strtotime("now"));
			    		if(is_numeric($_POST['number'])) {
				    		mc_add_meta($result,'number',$_POST['number']);
				    		mc_add_meta($result,'buyer_phone',$_POST['buyer_phone']);
				    		mc_add_meta($result,'buyer_address',$_POST['buyer_address']);
				    		mc_add_meta($result,'buyer_city',$_POST['buyer_city']);
				    		mc_add_meta($result,'buyer_province',$_POST['buyer_province']);
				    		mc_add_meta($result,'buyer_name',$_POST['buyer_name']);
				    		mc_add_meta($result,'wish',0);
				    		$parameter = $_POST['parameter'];
				    		if($parameter) :
								foreach($parameter as $key=>$valp) :
									mc_add_meta($result,'parameter',$key.'|'.$valp);
								endforeach;
							endif;
			    		}
		    		}
		    		do_go('publish_post_end',$result);
		    		$this->success('发布成功，请耐心等待审核',U('post/index/single?id='.$result));
	    		} else {
		    		$this->error('发布失败！');
	    		}
	    	} else {
	    		$this->error('请填写标题和内容');
	    	};
	    } else {
		    $this->error('哥们，你放弃治疗了吗?',U('home/index/index'));
	    };
    }
    public function publish_pro(){
    	if(mc_is_admin() || mc_is_bianji()) {
	    	if($_POST['title'] && $_POST['content'] && is_numeric($_POST['price'])) {
	    		$page['title'] = mc_magic_in($_POST['title']);
	    		$page['content'] = mc_magic_in($_POST['content']);
	    		$page['type'] = 'pro';
	    		$page['date'] = strtotime("now");
	    		$result = M('page')->data($page)->add();
		    	if($result) {
		    		mc_add_meta($result,'term',mc_magic_in($_POST['term']));
		    		if($_POST['fmimg']) {
		    			foreach($_POST['fmimg'] as $val) {
		    				mc_add_meta($result,'fmimg',$val);
		    			}
		    		};
		    		if(is_numeric($_POST['kucun'])) {
		    			mc_add_meta($result,'kucun',mc_magic_in($_POST['kucun']));
		    		};
		    		if(is_numeric($_POST['xiaoliang'])) {
		    			mc_add_meta($result,'xiaoliang',mc_magic_in($_POST['xiaoliang']));
		    		};
		    		if($_POST['pro-parameter']) {
		    			$parameter = I('param.pro-parameter');
		    			foreach($parameter as $key=>$val) {
			    			foreach($val as $vals) {
			    				if($vals['name']!='') {
			    					mc_add_meta($result,$key,$vals['name'],'parameter');
			    					if($vals['price']>0) {
				    					mc_add_meta($result,$vals['name'],$vals['price'],'price');
			    					} else {
				    					mc_add_meta($result,$vals['name'],0,'price');
			    					}
			    				}
			    			}
		    			}
		    		};
		    		if($_POST['keywords']) {
		    			mc_add_meta($result,'keywords',$_POST['keywords']);
		    		};
		    		if($_POST['description']) {
		    			mc_add_meta($result,'description',$_POST['description']);
		    		};
		    		mc_add_meta($result,'price',mc_magic_in($_POST['price']));
		    		mc_add_meta($result,'author',mc_user_id());
		    		do_go('publish_pro_end',$result);
		    		$this->success('发布成功，请耐心等待审核',U('pro/index/single?id='.$result));
	    		} else {
		    		$this->error('发布失败！');
	    		}
	    	} else {
	    		$this->error('请填写标题和内容');
	    	};
	    } else {
		    $this->error('哥们，你放弃治疗了吗?',U('home/index/index'));
	    };
    }
    public function publish_group(){
    	if(mc_is_admin() || mc_is_bianji()) {
	    	if($_POST['title'] && $_POST['content']) {
	    		$page['title'] = mc_magic_in($_POST['title']);
	    		$page['content'] = mc_magic_in($_POST['content']);
	    		$page['type'] = 'group';
	    		$page['date'] = strtotime("now");
	    		$result = M('page')->data($page)->add();
		    	if($result) {
		    		if($_POST['fmimg']) {
		    			mc_add_meta($result,'fmimg',mc_magic_in($_POST['fmimg']));
		    		};
		    		mc_add_meta($result,'author',mc_user_id());
		    		mc_add_meta(mc_user_id(),'group_admin',$result,'user');
		    		do_go('publish_group_end',$result);
		    		$this->success('新建群组成功！',U('post/group/index?id='.$result));
	    		} else {
		    		$this->error('发布失败！');
	    		}
	    	} else {
	    		$this->error('请填写群组名称和介绍');
	    	};
	    } else {
		    $this->error('哥们，你放弃治疗了吗?',U('home/index/index'));
	    };
    }
    public function publish_article(){
    	if(mc_is_admin() || mc_is_bianji()) {
	    	if($_POST['title'] && $_POST['content']) {
	    		$page['title'] = mc_magic_in($_POST['title']);
	    		$page['content'] = mc_magic_in($_POST['content']);
	    		$page['type'] = 'article';
	    		$page['date'] = strtotime("now");
	    		$result = M('page')->data($page)->add();
		    	if($result) {
		    		if($_POST['fmimg']) {
		    			mc_add_meta($result,'fmimg',mc_magic_in($_POST['fmimg']));
		    		};
		    		if(I('param.tags')) {
			    		$tags = explode(' ',I('param.tags'));
			    		foreach($tags as $tag) :
			    			if($tag) :
			    				mc_add_meta($result,'tag',$tag);
			    			endif;
			    		endforeach;
		    		};
		    		mc_add_meta($result,'term',mc_magic_in($_POST['term']));
		    		mc_add_meta($result,'author',mc_user_id());
		    		do_go('publish_article_end',$result);
		    		$this->success('发布成功！',U('article/index/single?id='.$result));
	    		} else {
		    		$this->error('发布失败！');
	    		}
	    	} else {
	    		$this->error('请填写标题和内容');
	    	};
	    } else {
		    $this->error('哥们，你放弃治疗了吗?',U('home/index/index'));
	    };
    }
    public function edit(){
    	if(mc_is_admin() || mc_is_bianji() || mc_author_id($_POST['id'])==mc_user_id()) {
	    	if($_POST['title'] && $_POST['content'] && is_numeric($_POST['id'])) {
	    		if(mc_get_page_field($_POST['id'],'type')=='pro') {
	    			if($_POST['term']) {
		    			mc_update_meta($_POST['id'],'term',mc_magic_in($_POST['term']));
		    		} else {
		    			$this->error('请设置分类！');
		    		};
	    			if(is_numeric($_POST['price'])) {
	    				mc_update_meta($_POST['id'],'price',mc_magic_in($_POST['price']));
	    			} else {
						$this->error('请填写价格！');
					};
		    		if(is_numeric($_POST['kucun'])) {
		    			mc_update_meta($_POST['id'],'kucun',$_POST['kucun']);
		    		};
		    		if(is_numeric($_POST['xiaoliang'])) {
		    			mc_update_meta($_POST['id'],'xiaoliang',$_POST['xiaoliang']);
		    		};
					M('meta')->where("page_id='".$_POST['id']."' AND type = 'parameter'")->delete();
					M('meta')->where("page_id='".$_POST['id']."' AND type = 'price'")->delete();
					if($_POST['pro-parameter']) {
		    			$parameter = $_POST['pro-parameter'];
		    			foreach($parameter as $key=>$val) {
			    			$val = array_reverse($val);
			    			foreach($val as $vals) {
			    				if($vals['name']!='') {
			    					mc_add_meta($_POST['id'],$key,$vals['name'],'parameter');
			    					if($vals['price']>0) {
				    					mc_add_meta($_POST['id'],$vals['name'],$vals['price'],'price');
			    					} else {
				    					mc_add_meta($_POST['id'],$vals['name'],0,'price');
			    					}
			    				}
			    			}
		    			}
		    		};
					if($_POST['fmimg']) {
		    			mc_delete_meta($_POST['id'],'fmimg');
		    			foreach($_POST['fmimg'] as $val) {
		    				mc_add_meta($_POST['id'],'fmimg',$val);
		    			}
		    		} else {
		    			$this->error('请设置商品图片！');
		    		};
		    		if($_POST['keywords']) {
		    			mc_update_meta($_POST['id'],'keywords',$_POST['keywords']);
		    		};
		    		if($_POST['description']) {
		    			mc_update_meta($_POST['id'],'description',$_POST['description']);
		    		};
	    		};
	    		if(mc_get_page_field($_POST['id'],'type')=='group') {
	    			mc_update_meta($_POST['id'],'fmimg',mc_magic_in($_POST['fmimg']));
	    		};
	    		if(mc_get_page_field($_POST['id'],'type')=='publish') {
	    			mc_update_meta($_POST['id'],'group',mc_magic_in($_POST['group']));
	    		};
	    		if(mc_get_page_field($_POST['id'],'type')=='article') {
	    			mc_update_meta($_POST['id'],'fmimg',mc_magic_in($_POST['fmimg']));
		    		if(I('param.tags')) {
			    		mc_delete_meta($_POST['id'],'tag');
			    		$tags = explode(' ',I('param.tags'));
			    		foreach($tags as $tag) :
			    			if($tag) :
			    				mc_add_meta($_POST['id'],'tag',$tag);
			    			endif;
			    		endforeach;
		    		};
		    		if($_POST['term']) {
		    			mc_update_meta($_POST['id'],'term',mc_magic_in($_POST['term']));
		    		} else {
		    			$this->error('请设置分类！');
		    		};
	    		};
	    		$page['title'] = mc_magic_in($_POST['title']);
	    		$page['content'] = mc_magic_in($_POST['content']);
	    		M('page')->where("id='".$_POST['id']."'")->save($page);
	    		if(mc_get_page_field($_POST['id'],'type')=='pro') {
		        	$this->success('编辑成功',U('pro/index/single?id='.$_POST['id']));
	        	} elseif(mc_get_page_field($_POST['id'],'type')=='publish' || mc_get_page_field($_POST['id'],'type')=='pending') {
		        	$this->success('编辑成功',U('post/index/single?id='.$_POST['id']));
	        	} elseif(mc_get_page_field($_POST['id'],'type')=='group') {
		        	$this->success('编辑成功',U('post/group/index?id='.$_POST['id']));
	        	} elseif(mc_get_page_field($_POST['id'],'type')=='article') {
		        	$this->success('编辑成功',U('article/index/single?id='.$_POST['id']));
	        	} else {
		        	$this->error('未知的Page类型',U('home/index/index'));
	        	}
	    	} else {
		    	$this->error('请完整填写信息！');
	    	}
	    } else {
		    $this->error('哥们，你放弃治疗了吗?',U('home/index/index'));
	    };
    }
    public function add_cart($id,$number){
    	if(is_numeric($id) && is_numeric($number) && $number > 0) {
	    	if(mc_user_id()) {
	    		if(mc_get_meta($id,'kucun')<=0) {
	    			$this->error('商品库存不足！');
	    		} else {
		    		if($_POST['parameter']) {
				    	$parameter = $_POST['parameter'];
						$cart = M('action')->where("page_id='$id' AND user_id='".mc_user_id()."' AND action_key='cart'")->getField('id',true);
						if($cart) {
							$par_false = 0;
							foreach($cart as $cart_id) {
								$par_old = M('action')->where("page_id='$cart_id' AND user_id='".mc_user_id()."'")->getField('id',true);
								if($par_old) {
									$par_count = 0;
									foreach($parameter as $key=>$val) {
						    			$par_name = M('option')->where("id='$key'")->getField('meta_value');
							    		$par_id = M('action')->where("page_id='$cart_id' AND action_key='parameter' AND user_id='".mc_user_id()."' AND action_value='$par_name|$val'")->getField('id');
							    		if($par_id) {
								    		$par_count++;
							    		}
						    		}
						    		$par_old_count = count($par_old);
						    		if($par_count==$par_old_count) {
							    		//商品参数完全匹配
							    		$number2 = M('action')->where("id='$cart_id' AND page_id='$id' AND user_id='".mc_user_id()."' AND action_key='cart'")->getField('action_value');
							    		$action['action_value'] = $number2+$number;
										M('action')->where("id='$cart_id' AND page_id='$id' AND action_key='cart' AND user_id='".mc_user_id()."'")->save($action);
						    		} else {
							    		$par_false++;
						    		}
								} else {
									//当前购物车内的商品参数为空
									$result = mc_add_action($id,'cart',$number);
						    		if($result) {
							    		if($_POST['parameter']) {
							    			$parameter = $_POST['parameter'];
							    			foreach($parameter as $key=>$val) {
							    				$par_name = M('option')->where("id='$key' AND type='pro'")->getField('meta_value');
								    			mc_add_action($result,'parameter',$par_name.'|'.$val);
							    			}
							    		}
						    		}
								}
				    		}
				    		$cart_count = count($cart);
				    		if($par_false==$cart_count) {
					    		//所有商品参数均不匹配
					    		$result = mc_add_action($id,'cart',$number);
						    	if($result) {
							    	if($_POST['parameter']) {
							    		$parameter = $_POST['parameter'];
							    		foreach($parameter as $key=>$val) {
							    			$par_name = M('option')->where("id='$key' AND type='pro'")->getField('meta_value');
								    		mc_add_action($result,'parameter',$par_name.'|'.$val);
							    		}
							    	}
						    	}
				    		}
				    	} else {
					    	//购物车中不存在本商品
					    	$result = mc_add_action($id,'cart',$number);
				    		if($result) {
					    		if($_POST['parameter']) {
					    			$parameter = $_POST['parameter'];
					    			foreach($parameter as $key=>$val) {
					    				$par_name = M('option')->where("id='$key'")->getField('meta_value');
						    			mc_add_action($result,'parameter',$par_name.'|'.$val);
					    			}
					    		}
				    		}
				    	}
		    		} else {
			    		//本商品不存在多种型号
			    		$cart = M('action')->where("page_id='$id' AND user_id='".mc_user_id()."' AND action_key='cart'")->getField('id',true);
			    		if($cart) {
				    		foreach($cart as $cart_id) {
					    		$par_old = M('action')->where("page_id='$cart_id' AND user_id='".mc_user_id()."'")->getField('id',true);
					    		if($par_old) {
						    		//购物车内商品存在参数
					    		} else {
						    		$number2 = M('action')->where("id='$cart_id' AND page_id='$id' AND user_id='".mc_user_id()."' AND action_key='cart'")->getField('action_value');
						    		$action['action_value'] = $number2+$number;
									M('action')->where("id='$cart_id' AND page_id='$id' AND action_key='cart' AND user_id='".mc_user_id()."'")->save($action);
					    		}
				    		}
			    		} else {
				    		//购物车内不存在相同商品
				    		$result = mc_add_action($id,'cart',$number);
			    		}
		    		}
		    		$this->success('加入购物车成功',U('pro/cart/index'));
	    		}
	    	} else {
			    $this->success('请先登陆',U('user/login/index'));
		    }
	    } else {
		    $this->error('参数错误！');
	    }
    }
    public function cart_delete($id){
    	if(is_numeric($id)) {
	    	M('action')->where("id='$id' AND user_id='".mc_user_id()."'")->delete();
	    	M('action')->where("page_id='$id' AND user_id='".mc_user_id()."' AND action_key='parameter'")->delete();
			$this->success('删除成功',U('pro/cart/index'));
    	} else {
	    	$this->error('参数错误！');
    	}
    }
    public function pro_parameter(){
    	if(mc_is_admin()) {
	    	$parameter = mc_magic_in($_POST['parameter']);
	    	if($parameter) {
		    	mc_add_option('parameter',$parameter,$type='pro');
		    	$this->success('新增参数成功');
	    	} else {
		        $this->error('参数错误！');
	        }
    	} else {
	    	$this->error('哥们，请不要放弃治疗！',U('Home/index/index'));
    	}
    }
    public function pro_parameter_edit(){
    	if(mc_is_admin()) {
    		$parameter = mc_magic_in($_POST['parameter']);
    		if($parameter) {
    			 foreach($parameter as $key=>$val) {
	    			 $option['meta_value'] = $val;
	    			 M('option')->where("id='$key' AND meta_key='parameter' AND type = 'pro'")->save($option);
    			 }
    			 $this->success('修改参数成功');
    		} else {
		        $this->error('参数错误！');
	        }
    	} else {
	    	$this->error('哥们，请不要放弃治疗！',U('Home/index/index'));
    	}
    }
    public function pro_parameter_del($id){
    	if(mc_is_admin()) {
    		if(is_numeric($id)) {
	    		M('option')->where("id='$id' AND meta_key='parameter' AND type='pro'")->delete();
	    		$this->success('删除参数成功');
    		} else {
	    		$this->error('参数错误！');
    		}
    	} else {
	    	$this->error('哥们，请不要放弃治疗！',U('Home/index/index'));
    	}
    }
    public function nav_del($id){
    	if(mc_is_admin()) {
    		if(is_numeric($id)) {
	    		M('option')->where("id='$id' AND type='nav'")->delete();
	    		$this->success('删除导航成功');
    		} else {
	    		$this->error('参数错误！');
    		}
    	} else {
	    	$this->error('哥们，请不要放弃治疗！',U('Home/index/index'));
    	}
    }
    public function comment_delete($id){
    	if(mc_is_admin() || mc_is_bianji()) {
	    	if(is_numeric($id)) {
		    	M('action')->where("id='$id' AND action_key='comment'")->delete();
		    	M('action')->where("action_value='$id' AND action_key='at'")->delete();
		    	$this->success('删除成功');
		    } else {
		    	$this->error('参数错误！');
	    	}
    	} else {
	    	$this->error('哥们，请不要放弃治疗！',U('Home/index/index'));
    	}
    }
    public function publish_term(){
    	if(mc_is_admin() || mc_is_bianji()) {
	    	if($_POST['title']) {
	    		$page['title'] = mc_magic_in($_POST['title']);
	    		$page['type'] = 'term_'.mc_magic_in($_POST['type']);
	    		$page['date'] = strtotime("now");
	    		$result = M('page')->data($page)->add();
		    	if($result) {
		    		if(is_numeric($_POST['parent'])) {
			    		mc_add_meta($result,'parent',$_POST['parent'],'term');
		    		};
		    		$this->success('新建分类成功！',U(mc_magic_in($_POST['type']).'/index/term?id='.$result));
	    		} else {
		    		$this->error('发布失败！');
	    		}
	    	} else {
	    		$this->error('请填写分类名称');
	    	};
	    } else {
		    $this->error('哥们，你放弃治疗了吗?',U('home/index/index'));
	    };
    }
    public function edit_term($id){
    	if(mc_is_admin() && is_numeric($id)) {
	    	if($_POST['title']) {
	    		$page['title'] = mc_magic_in($_POST['title']);
	    		M('page')->where("id='$id'")->save($page);
	    		$type = mc_get_page_field($id,'type');
	    		if($type=='term_pro') {
		    		if(is_numeric($_POST['parent'])) {
		    			if($_POST['parent']==$id) {
			    			$this->error('父分类不能为自己！');
		    			} else {
			    			if(mc_get_meta($id,'parent',true,'term')) {
				    			mc_update_meta($id,'parent',$_POST['parent'],'term');
			    			} else {
				    			mc_add_meta($id,'parent',$_POST['parent'],'term');
			    			}
		    			}
		    		} else {
		    			mc_delete_meta($id,'parent','term');
		    		};
		    		$type_name = 'pro';
	    		} elseif($type=='term_baobei') {
	    			$type_name = 'baobei';
	    		};
		    	$this->success('编辑分类成功！',U($type_name.'/index/term?id='.$id));
	    	} else {
	    		$this->error('请填写分类名称');
	    	};
	    } else {
		    $this->error('哥们，你放弃治疗了吗?',U('home/index/index'));
	    };
    }
    public function qiandao(){
    	if(mc_is_qiandao()) {
	    	$this->error('您已签到过了哦～');
	    } else {
	    	if(mc_user_id()) {
		    	$coins = 3;
		    	mc_update_coins(mc_user_id(),$coins);
		    	mc_add_action(mc_user_id(),'coins',$coins);
		    	$this->success('签到成功！',U('home/index/index'));
		    } else {
			    $this->success('请先登陆',U('user/login/index'));
		    }
    	}
    }
    public function review($id){
	    if(mc_is_admin() || mc_is_bianji()) {
	    	$type = mc_get_page_field($id,'type');
	    	if($type=='pending') {
		    	mc_update_page($id,'publish','type');
		    	$this->success('审核成功！',U('post/index/single?id='.$id));
	    	} else {
		    	$this->error('未知页面类型');
	    	}
	    } else {
		    $this->error('请不要放弃治疗');
	    }
    }
    public function delete($id){
        if(is_numeric($id)) {
	        if(mc_is_admin()) {
		         if(mc_get_meta($id,'user_level',true,'user')!=10) {
			         mc_delete_page($id);
			         $this->success('删除成功',U('Home/index/index'));
		         } else {
			         $this->error('请不要伤害管理员');
		         };
	        } else {
	        	$this->error('哥们，请不要放弃治疗！',U('Home/index/index'));
	        }
        } else {
	        $this->error('参数错误！');
        }
    }
    public function delete_img($id){
        if(is_numeric($id)) {
	        if(mc_is_admin()) {
		         if(mc_get_meta($id,'user_level',true,'user')!=10) {
		         	 $src = M('attached')->where("id='$id'")->getField('src');
			         M('attached')->where("id='$id'")->delete();
			         unlink($src);
			         $this->success('删除成功');
		         };
	        } else {
	        	$this->error('哥们，请不要放弃治疗！',U('Home/index/index'));
	        }
        } else {
	        $this->error('参数错误！');
        }
    }
    public function ip_false($id){
        if(is_numeric($id)) {
	        if(mc_is_admin()) {
		         if(mc_get_meta($id,'user_level',true,'user')!=10) {
			         $ip_array = M('action')->where("page_id='$id' AND action_key='ip'")->getField('action_value',true);
			         if($ip_array) {
				        foreach($ip_array as $ip) {
					        mc_add_option('ip_false',$ip,'user');
				        };
			         };
			         mc_delete_page($id);
			         $this->success('操作成功',U('Home/index/index'));
		         } else {
			         $this->error('请不要伤害管理员');
		         };
	        } else {
	        	$this->error('哥们，请不要放弃治疗！',U('Home/index/index'));
	        }
        } else {
	        $this->error('参数错误！');
        }
    }
}