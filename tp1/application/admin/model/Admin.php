<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{  
   
   public function addadmin($data){
       if(empty($data) || !is_array($data)){
        return false;
       }
       if($data['password']){
        $data['password']=md5($data['password']);
       }
       if($this->save($data)){
        return true;
       }else
       {
        return false;
       }
    }
    
    public function getadmin(){
        return $this::paginate(5,false,[
         'type'=>'bot',
         'var_dump'=>'page',
        ]);
    }
    public function saveadmin($data,$admins){
        if(!$data['name']){
        return 2;
        }
        if(!$data['password']){
        //$this->error('请输入密码');
          $data['password']=$admins['password'];
        }
        else{
          $data['password']=md5($data['password']);
        }

        //$admin=new AdminModel();//实例化

        return $this::update(['name'=>$data['name'],'password'=>$data['password']],['id'=>$data['id']]);
    }

    
     public function deladmin($id){
       if($this::destroy($id)){
        return 1;
       }else{
        return 2;
       }

     }


     public function login($data){
      $admin=Admin::getByName($data['name']);
        if($admin){
          if($admin['password']==md5($data['password'])){
            session('id',$admin['id']);
            session('name',$admin['name']);
            return 1;//登录信息成功
          }else{
            return 2;//密码错误
          }
        }
           else{
          return 3;
        }
        //var_dump($admin);die;
      }
    
     
   

}
