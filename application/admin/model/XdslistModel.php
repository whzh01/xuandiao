<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class XdslistModel extends Model
{
	protected $name = "xdslist";
	protected $field = true;

	/**更新进度*/
	public function updateSchedule($param)
	{
		try{
			$result = $this->allowField(true)->save($param,['id' => $param['id']]);
			if(false === $result){            
                return ['code' => 1, 'data' => '', 'msg' => $this->getError()];
            }else{
                writelog(session('uid'),session('username'),'学生【'.$param['stuid'].'】进度修改成功',1);
                return ['code' => 0, 'data' => '', 'msg' => '学生进度修改成功'];
            }
		}catch(PDOException $e)
		{
			return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
		}
	}
	/*添加学生信息*/
	public function addStu($param)
	{

	    try{
	        $result = $this->validate('XdslistValidate')->allowField(true)->save($param);
	        if(false === $result){            
	            return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
	        }else{
	            writelog(session('uid'),session('username'),'学生【'.$param['name'].'】添加成功',1);
	            return ['code' => 0, 'data' => '', 'msg' => '添加学生信息成功'];
	        }
	    }catch( PDOException $e){
	        return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
	    }
	    
	}
	/*编辑学生信息*/
	public function editStu($param)
	{
		try{
            $result =  $this->allowField(true)->save($param, ['stuid' => $param['stuid']]);
            if(false === $result){            
                return ['code' => 1, 'data' => '', 'msg' => $this->getError()];
            }else{
                writelog(session('uid'),session('username'),'学生【'.$param['stuid'].'】编辑成功',1);
                return ['code' => 0, 'data' => '', 'msg' => '编辑学生信息成功'];
            }
        }catch( PDOException $e){
            return ['code' => -1, 'data' => '', 'msg' => $e->getMessage()];
        }
	}
	/*删除学生信息*/
	public function delStu($id)
	{
		try{
			$id = $id['id'];
			//$id = explode(',', $id);
			//var_dump($id);exit;
			$this->destroy($id);
            
          //  $id = implode(',','$id');
            writelog(session('uid'),session('username'),'用户【'.session('username').'】删除学生成功(ID='.$id.')',1);
            return ['code' => 0, 'data' => '', 'msg' => '删除学生成功'];

        }catch( PDOException $e){
        	var_dump("01");exit;
            return ['code' => 1, 'data' => '', 'msg' => $e->getMessage()];
        }
	}
	/*根据条件搜索用户的信息*/
	public function getStuByWhere($map, $Nowpage, $limits)
    {
        return $this->field('think_xdslist.*,title')->where($map)->page($Nowpage, $limits)->order('id desc')->select();
    }
    public function getCount()
    {
    	return $this->count();
    }
    /*根据id获取单个学生信息*/
    public function getOneStuInfo($id)
    {
        return $this->where('stuid', $id)->find(); 
    }
}