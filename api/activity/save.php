<?php
// +----------------------------------------------------------------------
// | phpWeChat 地区读取select文件 Last modified 2016/5/5
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 phpWeChat https://qiyihx.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: ITS.ME <616743670@qq.com> <https://qiyihx.cn>
// +----------------------------------------------------------------------
use phpWeChat\Activity;

require substr(dirname(__FILE__),0,-13).'/include/common.inc.php';
require_once substr(dirname(__FILE__),0,-13).'/api/wxapp/lib/WxApp.Config.php';
require_once substr(dirname(__FILE__),0,-13)."/api/wxapp//lib/WxApp.Api.php";


$result = array('retcode' => 'SUCCESS', 'retmsg' => '活动发起成功，请耐心等待审核');

$wxAppApi = new WxAppApi();
$openidObj = $wxAppApi->getOpenid(WxAppConfig::APPID, WxAppConfig::APPSECRET,$_GET['code']);

$info['openid'] = $openidObj['openid'];
$info['id'] = $_GET['id'];
$info['title'] = $_GET['title'];
$info['detail'] = $_GET['detail'];
$info['location'] = $_GET['location'];
$info['type'] = $_GET['type'];
$info['picurl'] = $_GET['picurl'];
$info['date'] = $_GET['date'];
$info['time'] = $_GET['time'];
$info['user_name'] = $_GET['user_name'];
$info['user_headimg'] = $_GET['user_headimg'];
$info['form_id'] = $_GET['form_id'];

$result['data'] = Activity::save($info);

if($result['data'] == 0){
	// 拼接模版消息
	$datetime = new DateTime();
	$value1 = array('value' => $info['title'],'color' => '#000000');
	$value2 = array('value' => $info['detail'],'color' => '#000000');
	$value3 = array('value' => $info['location'],'color' => '#000000');
	$value4 = array('value' => $info['date'] . ' '. $info['time'],'color' => '#000000');
	$value5 = array('value' => $info['user_name'],'color' => '#000000');
	$value6 = array('value' => $datetime->format('Y-m-d H:i'),'color' => '#000000');
	
	$data = array('keyword1' => $value1,'keyword2' => $value2,'keyword3' => $value3,'keyword4' => $value4,'keyword5' => $value5, 'keyword6' => $value6);
	$result['resultSendTplMsg'] = $wxAppApi->sendTplMsg($info['openid'], WxAppConfig::WX_TPL_MSG_ACTIVITY_CREATE, $info['form_id'], $data, 'pages/activity-list/index?from=me', $timeOut = 6);
}else if($result['data'] == 'true'){
	$result['retmsg'] = "活动更新成功，请耐心等待审核";
}else{
	$result['retcode'] = "FAIL";
	$result['retmsg'] = "操作失败，请重试";
}

exit(json_encode($result));
?>