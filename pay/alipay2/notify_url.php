<?php
require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代

	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
	
    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	
	//商户订单号
	$out_trade_no = $_POST['out_trade_no'];

	//支付宝交易号
	$trade_no = $_POST['trade_no'];

	//交易状态
	$trade_status = $_POST['trade_status'];
	
	$user_id = round($out_trade_no/1000000000000000000,0);


	if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
	//该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
	
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
			
        echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        //M('action')->where("user_id='$user_id' AND action_key='wait_pay'")->delete();
        $cart = M('action')->where("user_id='$user_id' AND action_key='cart'")->order('id desc')->select();
        $action['date'] = strtotime("now");
        $action['action_key'] = 'wait_pay';
        foreach($cart as $val) :
        M('action')->where("id='".$val['id']."'")->save($action);
        endforeach;
        $action['action_key'] = 'address_wait_pay';
        M('action')->where("user_id='$user_id' AND action_key='address_pending'")->save($action);
        $action['action_key'] = 'trade_wait_pay';
        M('action')->where("user_id='$user_id' AND action_key='trade_pending'")->save($action);
        $action['action_key'] = 'coins_wait_pay';
        M('action')->where("user_id='$user_id' AND action_key='coins_pending'")->save($action);
    }
	else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
	//该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货
	
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
			
        echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        $date = M('action')->where("user_id='$user_id' AND action_key='trade_wait_pay' AND action_value='$out_trade_no'")->getField('date');
        $cart = M('action')->where("user_id='$user_id' AND action_key='wait_pay' AND date='$date'")->order('id desc')->select();
        $action['action_key'] = 'wait_send';
        foreach($cart as $val) :
        M('action')->where("id='".$val['id']."'")->save($action);
        endforeach;
        $action['action_key'] = 'address_wait_send';
        M('action')->where("user_id='$user_id' AND action_key='address_wait_pay' AND date='$date'")->save($action);
        $action['action_key'] = 'trade_wait_send';
        M('action')->where("user_id='$user_id' AND action_key='trade_wait_pay' AND date='$date'")->save($action);
        $action['action_key'] = 'coins_wait_send';
        M('action')->where("user_id='$user_id' AND action_key='coins_wait_pay' AND date='$date'")->save($action);
    }
	else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
	//该判断表示卖家已经发了货，但买家还没有做确认收货的操作
	
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
			
        echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        $date = M('action')->where("user_id='$user_id' AND action_key='trade_wait_send' AND action_value='$out_trade_no'")->getField('date');
        $cart = M('action')->where("user_id='$user_id' AND action_key='wait_send' AND date='$date'")->order('id desc')->select();
        $action['action_key'] = 'wait_cofirm';
        foreach($cart as $val) :
        M('action')->where("id='".$val['id']."'")->save($action);
        endforeach;
        $action['action_key'] = 'address_wait_cofirm';
        M('action')->where("user_id='$user_id' AND action_key='address_wait_send' AND date='$date'")->save($action);
        $action['action_key'] = 'trade_wait_cofirm';
        M('action')->where("user_id='$user_id' AND action_key='trade_wait_send' AND date='$date'")->save($action);
        $action['action_key'] = 'coins_wait_cofirm';
        M('action')->where("user_id='$user_id' AND action_key='coins_wait_send' AND date='$date'")->save($action);
    }
	else if($_POST['trade_status'] == 'TRADE_FINISHED') {
	//该判断表示买家已经确认收货，这笔交易完成
	
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
			
        echo "success";		//请不要修改或删除

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        //即时到帐
        $date = M('action')->where("user_id='$user_id' AND action_key='trade_wait_pay' AND action_value='$out_trade_no'")->getField('date');
        if($date) :
        $cart = M('action')->where("user_id='$user_id' AND action_key='wait_pay' AND date='$date'")->order('id desc')->select();
        $action['action_key'] = 'wait_finished';
        foreach($cart as $val) :
        M('action')->where("id='".$val['id']."'")->save($action);
        endforeach;
        $action['action_key'] = 'add_wait_finished';
        M('action')->where("user_id='$user_id' AND action_key='address_wait_pay' AND date='$date'")->save($action);
        $action['action_key'] = 'trade_wait_finished';
        M('action')->where("user_id='$user_id' AND action_key='trade_wait_pay' AND date='$date'")->save($action);
        $action['action_key'] = 'coins_wait_finished';
        M('action')->where("user_id='$user_id' AND action_key='coins_wait_cofirm' AND date='$date'")->save($action);
        else :
        //担保交易
        $date2 = M('action')->where("user_id='$user_id' AND action_key='trade_wait_cofirm' AND action_value='$out_trade_no'")->getField('date');
        $cart2 = M('action')->where("user_id='$user_id' AND action_key='wait_cofirm' AND date='$date2'")->order('id desc')->select();
        $action['action_key'] = 'wait_finished';
        foreach($cart2 as $val) :
        M('action')->where("id='".$val['id']."'")->save($action);
        endforeach;
        $action['action_key'] = 'add_wait_finished';
        M('action')->where("user_id='$user_id' AND action_key='address_wait_cofirm' AND date='$date2'")->save($action);
        $action['action_key'] = 'trade_wait_finished';
        M('action')->where("user_id='$user_id' AND action_key='trade_wait_cofirm' AND date='$date2'")->save($action);
        $action['action_key'] = 'coins_wait_finished';
        M('action')->where("user_id='$user_id' AND action_key='coins_wait_cofirm' AND date='$date2'")->save($action);
        endif;
    }
    else {
		//其他状态判断
        echo "success";

        //调试用，写文本函数记录程序运行情况是否正常
        //logResult ("这里写入想要调试的代码变量值，或其他运行的结果记录");
    }

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "fail";

    //调试用，写文本函数记录程序运行情况是否正常
    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
}
?>