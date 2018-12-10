<?php

namespace app\admin\controller;
use app\admin\model\XdslistModel;
use think\Config;
use think\Loader;
use think\Db;


class Xuandiao extends Base
{

	public function index()
	{
		$infoDb = new XdslistModel();
	//	var_dump(input('get.'));exit;
		$condition = input('get.');
//		var_dump($condition);
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
	//	var_dump($condition);
		$page = $page;
		$limit = $limit;
		$info = $infoDb->where($condition)->limit(($page-1)*$limit,$limit)->order('subtime desc')->select();
	//	var_dump($info);exit;
		$count = $infoDb->where($condition)->count();
		$result['code'] = 0;
		$result['count'] = $count;
		$result['msg'] = '';
		$result['data'] = array();
		foreach($info as $name => $val)
		{
			$result['data'][] = $val;
		}
	
		
	//	var_dump(json_encode($result));exit;
		echo (json_encode($result));
	}
	/*显示进度页面*/
	public function jindu()
	{
		return $this->fetch('jindu');
	}

	public function jinduShow()
	{

	}
	/*修改学生进度*/
	public function jinduAlter()
	{
		if(request()->isPost())
		{
			$infoDb = new XdslistModel();
			$condition = input('post.');
			//$condition['id'] = implode(',', $condition['id']);
			//trim($condition['id'],',');
			$condition['suid'] = explode(',', trim($condition['suid'],','));
			$param[$condition['processName']] = '通过';
			
			for($i=0;$i<sizeof($condition['id']);$i++)
			{
				$param['id'] = $condition['id'][$i];
				$param['stuid'] = $condition['suid'][$i]; 
				//var_dump($param);exit;
				$res = $infoDb->updateSchedule($param);
				if($res['code'] != 0)
					break;
			}
			//exit;
			return $res;
		}
		return $this->fetch('jindu');
	}
	public function dealData($condition)
	{
		$infoDb = new XdslistModel();
	//	$condition = input('get.');
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
			$limit = -1;
		}
	//	var_dump($condition);exit;
		$page = $page;
		$limit = $limit;
		$info = $infoDb->where($condition)->order('subtime desc')->select();
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
		return  json_encode($result);
	}
	/*显示学生信息管理页面*/
	public function info()
	{
		// $condition = input('get.');
		// //echo $this->dealData($condition);
		// $this->assign([
		// 	"infoData" => $this->dealData($condition),
		// ]);
		return $this->fetch('index');
	}
	/*显示学生信息页面*/
	public function infoShow()
	{

	}
	/*添加学生信息*/
	public function infoAdd()
	{
		 if(request()->isPost()){

            $param = input('post.');
         //   var_dump($param);exit;
            $info = new XdslistModel();
            $param['subtime'] = date("Y-m-d H:i:s");
            $flag = $info->addStu($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $provinces = Db::name('provincial')->column('Provincial');
         $this->assign([
            
            'province' => $provinces,
        ]);
        return $this->fetch('add');
	}
	/*修改学生信息*/
	public function infoAlter()
	{
		$info = new XdslistModel();
		$provinces = Db::name('provincial')->column('Provincial');
        if(request()->isPost()){

            $param = input('post.');
            $flag = $info->editStu($param);  
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $get = input('get.');
       // var_dump($get);exit;
        $allData = $info->getOneStuInfo($get['id']);

        $this->assign([
            'stuInfo' => $allData,
            'province' => $provinces,
        ]);
        return $this->fetch('edit');
	}
	/*删除学生信息*/
	public function infoDelete()
	{
		$condition = input('post.');
		if(!isset($condition))
		{
			return json(['code' => 1]);
		}
		$info = new XdslistModel();

		if(request()->isAjax()){

            $param = input('post.');

            $flag = $info->delStu($param);  
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
	}
	/*查询学生信息*/
	public function infoSelect()
	{

	}

}