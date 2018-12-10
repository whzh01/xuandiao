<?php
namespace app\index\controller;
use app\index\model\XdslistModel;
use think\Db;
use think\Controller;


class Index extends controller
{
	/**提供于前台学生提交*/
    public function index()
    {
    	if(request()->isPost())
    	{
            $param = input('post.');
         //   var_dump($param);exit;
            $info = new XdslistModel();
            $param['subtime'] = date("Y-m-d H:i:s");
            $flag = $info->addStu($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $provinces = Db::name('provincial')->column('Provincial');
        $this->assign([
        	"province" => $provinces,
        ]);
        return $this->fetch('add');
       
    }
	
	public function test() {
		return view('test');	
	}
}
