<?php

namespace app\api\controller;
use app\admin\model\XdslistModel;
use app\admin\controller\Base;
use think\Model;
use think\Db;

/*----------------------------弃用--------------*/
/**
 * swagger: 选调生管理api
 */
class Xds extends Base
{
	public function index()
	{
		$infoDb = new XdslistModel();
	//	var_dump(input('get.'));exit;
		$condition = input('get.');
		foreach ($condition as $key => $value) {
			# code...
			if($value == "")
			{
				unset($condition[$key]);
			}
			if($key == 'page')
			{
				$page = $value;
				unset($condition['page']);
			}
			if($key == 'limit')
			{
				$limit = $value;
				unset($condition['limit']);
			}
		}
		if(!isset($page) || !isset($limit))
		{
			$page = 1;
			$limit = 0;
		}
	//	var_dump($condition);exit;
		$page = $page;
		$limit = $limit;
		$info = $infoDb->where($condition)->limit(($page-1)*$limit,$limit)->order('subtime desc')->select();
	//	var_dump($info);
		$count = $infoDb->count();
		$result['code'] = 0;
		$result['count'] = $count;
		$result['msg'] = '';
		$result['data'] = array();
		foreach($info as $name => $val)
		{
			$result['data'][] = $val;
		}
	
		
	//	var_dump(json_encode($result));exit;
	//	echo (json_encode($result));
		return NULL;
	}
}