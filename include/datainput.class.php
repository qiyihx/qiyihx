<?php
// +----------------------------------------------------------------------
// | phpWeChat 数据过滤操作类 Last modified 2016/5/714:20
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 phpWeChat https://qiyihx.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: ITS.ME <616743670@qq.com> <https://qiyihx.cn>

// +----------------------------------------------------------------------

namespace phpWeChat;

class DataInput
{	
	static public function filterData(&$info)
	{
		foreach($info as $key => $val)
		{
			$info[$key]=$val;
		}
	}
}
?>