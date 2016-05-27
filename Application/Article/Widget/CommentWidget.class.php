<?php
namespace Article\Widget;
use Think\Controller;
class CommentWidget extends Controller {
    public function index($id){
        $this->comment = M('action')->where("page_id='$id' AND action_key='comment'")->order('id desc')->select();
        $this->theme(mc_option('theme'))->display("Public:comment");
    }
}