<?php
namespace app\admin\model;
use think\Model;
class Cate extends Model
{  
   public function catetree(){
     $cateres=$this->order('sort desc')->select();
    return $this->sort($cateres);
   }
   public function sort($data,$pid=0,$level=0){
   	static $arr=array();//栏目分类
   	foreach ($data as $k => $v) {
   		if($v['pid']==$pid){
   			 $v['level']=$level;
             $arr[]=$v;
             $this->sort($data,$v['id'],$level+1);
   	 	}
   	  }
   	  return $arr;
   }
   
    public function getchilren($cateid){
        $cateres=$this->select();
        return $this->_getchilren($cateres,$cateid);
    }

    public function _getchilren($cateres,$cateid){
        static $arr=array();
        foreach ($cateres as $k => $v) {
            if($v['pid'] == $cateid){
                $arr[]=$v['id'];
                $this->_getchilren($cateres,$v['id']);
            }
        }

        return $arr;
    }
   

}
