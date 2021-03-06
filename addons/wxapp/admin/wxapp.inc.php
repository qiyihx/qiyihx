<?php
// +----------------------------------------------------------------------
// | phpWeChat 会员系统管理配置入口文件 Last modified 2016/5/25 21:49
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 phpWeChat https://qiyihx.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: ITS.ME <616743670@qq.com> <https://qiyihx.cn>
// +----------------------------------------------------------------------
use phpWeChat\Member;
use phpWeChat\Banner;
use phpWeChat\Activity;


!defined('IN_MANAGE') && exit('Access Denied!');

$mod='wxapp';
$file=@return_edefualt(str_callback_w($_GET['file']),'wxapp');
$action=@return_edefualt(str_callback_w($_GET['action']),'wxapp');

switch($action)
{
	/**
	 * 会员管理操作
	 */
	case 'wxapp':
		$username=htmlspecialchars(trim($username));
		$data=Member::wxappList($username,20);
		include_once parse_admin_tlp($file.'-'.$action,'wxapp');
		break;
	case 'wxapp_pwd':
		$userid=intval($userid);
		$data=Member::getUserByUserId($userid);

		if(!$data)
		{
			operation_tips('指定会员不存在 [-2]！','','error');
		}

		if(isset($dosubmit))
		{
			$newpassword=trim($newpassword);

			if($newpassword && !is_pwd($newpassword))
			{
				operation_tips('密码格式不正确 [-1]！','','error');
			}

			if($newpassword)
			{
				Member::memUpdate($userid,array('userpwd'=>md5($newpassword)));
				operation_tips('会员密码重置成功！','?mod=wxapp&file=wxapp&action=wxapp');
			}
			else
			{
				operation_tips('会员密码重置成功（无更改）！','?mod=wxapp&file=wxapp&action=wxapp');
			}
		}
		
		include_once parse_admin_tlp($file.'-'.$action,'wxapp');
		break;
	/*
		会员余额、积分、登录日志
	*/
	case 'amount_log':
		$userid=intval($userid);
		$data=Member::amountLogList($userid,20);
		include_once parse_admin_tlp($file.'-'.$action,'wxapp');
		break;
	case 'amount_log_clear':
		Member::amountLogClear();
		operation_tips('操作成功');
		break;
	case 'credits_log':
		$userid=intval($userid);
		$data=Member::creditsLogList($userid,20);
		include_once parse_admin_tlp($file.'-'.$action,'wxapp');
		break;
	case 'credits_log_clear':
		Member::creditsLogClear();
		operation_tips('操作成功');
		break;
	case 'login_log':
		$userid=intval($userid);
		$data=Member::loginLogList($userid,20);
		include_once parse_admin_tlp($file.'-'.$action,'wxapp');
		break;
	case 'login_log_clear':
		Member::loginLogClear();
		operation_tips('操作成功');
		break;
	/**
	 * 会员等级操作
	 */
	case 'level':
		if(isset($dosubmit))
		{
			if($levelid)
			{
				$op=Member::levelEdit($info,$levelid);
			}
			else
			{
				$op=Member::levelAdd($info);
			}

			if($op>0)
			{
				operation_tips('会员等级'.($levelid?'编辑':'添加').'成功！','?mod=wxapp&file=wxapp&action=level');
			}
			else
			{
				operation_tips('操作失败 ['.$op.']！','','error');
			}
		}

		if(isset($job))
		{
			switch($job)
			{
				case 'delete':
					Member::levelDelete($levelids);
					operation_tips('会员等级删除成功！');
					break 2;
			}
		}

		$data=array();

		if($levelid)
		{
			$data=Member::levelGet($levelid);
		}
		include_once parse_admin_tlp($file.'-'.$action,$mod);
		break;
	/**
	 * banner操作
	 */
	case 'banner':
		if(isset($dosubmit))
		{
			if($id)
			{
				$op=Banner::bannerEdit($info,$id);
			}
			else
			{
				$op=Banner::bannerAdd($info);
			}

			if($op>=0)
			{
				operation_tips('广告'.($id?'编辑':'添加').'成功！','?mod=wxapp&file=wxapp&action=banner');
			}
			else
			{
				operation_tips('操作失败 ['.$op.']！','','error');
			}
		}

		if(isset($job))
		{
			switch($job)
			{
				case 'delete':
					Banner::bannerDelete($id);
					operation_tips('广告删除成功！');
					break 2;
			}
		}

		$data=array();

		if($id)
		{
			$data=Banner::bannerGet($id);
		}
		include_once parse_admin_tlp($file.'-'.$action,$mod);
		break;
	/**
	 * banner操作
	 */
	case 'activity':
		if(isset($dosubmit))
		{
			if($id)
			{
				$op=Activity::activityEdit($info,$id);
			}
			else
			{
				$op=Activity::activityAdd($info);
			}

			if($op>=0)
			{
				operation_tips('活动'.($id?'编辑':'添加').'成功！','?mod=wxapp&file=wxapp&action=activity');
			}
			else
			{
				operation_tips('操作失败 ['.$op.']！','','error');
			}
		}

		if(isset($job))
		{
			switch($job)
			{
				case 'delete':
					Activity::activityDelete($id);
					operation_tips('活动删除成功！');
					break 2;
				case 'across':
					Activity::activityUpdateStatus($id,'1');
					operation_tips('活动通过操作成功！');
					break 2;
				case 'noacross':
					Activity::activityUpdateStatus($id,'2');
					operation_tips('活动不通过操作成功！');
					break 2;
			}
		}

		$data=array();

		if($id)
		{
			$data=Activity::activityGet($id);
		}
		include_once parse_admin_tlp($file.'-'.$action,$mod);
		break;
}
?>