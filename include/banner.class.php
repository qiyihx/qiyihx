<?php

// +----------------------------------------------------------------------
// | phpWeChat 会员操作类 Last modified 2016/5/25 21:33
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 phpWeChat https://qiyihx.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: ITS.ME <616743670@qq.com> <https://qiyihx.cn>
// +----------------------------------------------------------------------

namespace phpWeChat;

class Banner
{

	private static $mBannerTable='banner';
	public static $mPageString='';
	public static $mTotalPage=0;

	public static function getList($type, $status, $pagesize=20)
	{	
		$where='1';
		$where.=$type?' AND type = '.$type:'';
		$where.=$status?' AND status = '.$status:'';

		$orderby='`sort`';

		$result=DataList::getList(DB_PRE.self::$mBannerTable,$where,$orderby,max(isset($_GET['page'])?intval($_GET['page']):1,1),intval($pagesize),0,'right');

		self::$mPageString=DataList::$mPageString;
		self::$mTotalPage=DataList::$mTotalPage;
		return $result;
	}

	public static function bannerList()
	{
		return MySql::fetchAll("SELECT * FROM `".DB_PRE.self::$mBannerTable."` WHERE 1 ORDER BY `id` ASC");

	}


	public static function bannerEdit($info,$id)

	{
		return MySql::update(DB_PRE.self::$mBannerTable,$info,"`id`='".$id ."'");

	}

	public static function bannerAdd($info)

	{

		$info['id'] = md5(time() . mt_rand(0,1000));
		$info['createtime'] = time();
		return MySql::insert(DB_PRE.self::$mBannerTable,$info,true);

	}

	public static function bannerGet($id='',$f='*')

	{

		$r=MySql::fetchOne("SELECT * FROM `".DB_PRE.self::$mBannerTable."` WHERE `id`='".$id ."'");
		return $f=='*'?$r:$r[$f];

	}

	public static function bannerDelete($id)

	{
		return MySql::delete(DB_PRE.self::$mBannerTable,$id,'id');

	}
}