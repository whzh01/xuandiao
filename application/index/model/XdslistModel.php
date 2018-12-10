<?php
namespace app\index\model;
use think\Model;
use think\Db;

class XdslistModel extends Model
{
	protected $name="xdslist";
	/*添加学生信息*/
	public function addStu($param)
	{

	    try{
	        $result = $this->validate('XdslistValidate')->allowField(true)->save($param);
	        if(false === $result){            
	            return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
	        }else{
	        
	            return ['code' => 0, 'data' => '', 'msg' => '添加学生信息成功'];
	        }
	    }catch( PDOException $e){
	        return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
	    }
	    
	}
}	