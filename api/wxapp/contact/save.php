<?php
// +----------------------------------------------------------------------
// | phpWeChat 地区读取select文件 Last modified 2016/5/5
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 phpWeChat https://qiyihx.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: ITS.ME <616743670@qq.com> <https://qiyihx.cn>
// +----------------------------------------------------------------------
use phpWeChat\Wxappcontact;

require dirname(__FILE__).'/../../../include/common.inc.php';
require_once dirname(__FILE__).'/../../wxapp/lib/WxApp.Config.php';
require_once dirname(__FILE__)."/../../wxapp//lib/WxApp.Api.php";


$result = array('retcode' => 'SUCCESS', 'retmsg' => '成功');
$key = $_GET['key'];
$val = $_GET['val'];
$info[$key] = $val;
$info['appid'] = WxAppConfig::APPID;
$wxAppApi = new WxAppApi();
$openidObj = $wxAppApi->getOpenid(WxAppConfig::APPID, WxAppConfig::APPSECRET,$_GET['code']);
$info['openid'] = $openidObj['openid'];

$result['data'] = Wxappcontact::save($info);
$ret = Wxappcontact::findByOpenid($info['openid']);
$result['id'] = $ret['id'];

exit(json_encode($result));
?>