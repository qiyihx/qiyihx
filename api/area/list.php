<?php
// +----------------------------------------------------------------------
// | phpWeChat 地区读取select文件 Last modified 2016/5/5
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 phpWeChat https://qiyihx.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: ITS.ME <616743670@qq.com> <https://qiyihx.cn>
// +----------------------------------------------------------------------
use phpWeChat\Banner;

require substr(dirname(__FILE__),0,-9).'/include/common.inc.php';

$result = array('retcode' => 'SUCCESS', 'retmsg' => '成功');
$result['data'] = Banner::getList($_GET['type'], $_GET['status']);
exit(json_encode($result));
?>