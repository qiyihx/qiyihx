<?php
// +----------------------------------------------------------------------
// | phpWeChat 验证码文件 Last modified 2016-03-25 16:45
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 phpWeChat https://qiyihx.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: ITS.ME <616743670@qq.com> <https://qiyihx.cn>
// +----------------------------------------------------------------------
use phpWeChat\Captcha;

require substr(dirname(__FILE__),0,-12).'/include/common.inc.php';

Captcha::setCaptcha(CAPTCHA_WIDTH,CAPTCHA_HEIGHT,CAPTCHA_LEN);
Captcha::drawCaptcha();
?>