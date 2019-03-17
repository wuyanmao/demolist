<?php
namespace app\admin\controller;
use think\View;
// use think\Db;
use app\admin\controller\Common;
use app\admin\model\Admin as AdminModel;
class Admin extends Common
{   
    
    public function lst()
  {    
    
       $admin=new AdminModel();
       $adminres=$admin->getadmin();
       $this->assign('adminres',$adminres);
       return view();
       // $admin=new AdminModel();
       // $res=$admin->select();
       // foreach ($res as $key => $value) {
       //  echo $value->name;
       //  echo "<br>";
       //}
        // die;
        // //return view();//助手函数
        //  $view=new View([
        //  'view_suffix'    =>'htm'
        //  ]);//空间类元素引入
        // return $view->fetch();
    }
    
    public function add()
    {
         if(request()->isPost()){
          //$res=Db::name('admin')->insert(input('post.'));//成功添加条数
          $admin=new AdminModel();
          if($admin->addadmin(input('post.'))){
            $this->success('添加管理员成功',url('admin/lst'));
          }else{
            $this->error('添加管理员失败!');
          }
          return;
         }
        //return view();//助手函数
        
        return view();
    }

     public function edit($id)
    {  
       $admins=db('admin')->find($id);
       if(request()->isPost()){
       $data=input('post.');
       $admin=new AdminModel();
         //dump($_POST);die;
         //return;
       $savenum=$admin->saveadmin($data,$admins);
       if($savenum=='2'){
        $this->error('管理员不能为空');
       }
      if($savenum!==false){
           $this->success('修改成功',url('lst'));
         }else{
           $this->error('修改失败');
         }
         return;
       }
      
      if(!$admins){
       $this->error('该管理员不存在');
      }
      $this->assign('admin',$admins);
        //return view();//助手函数
       return view();
    }
   public function del($id){
    $admin=new AdminModel();
    $delnum=$admin->deladmin($id);
    if($delnum =='1'){
     $this->success('删除管理员成功',url('lst'));
    }else{
       $this->error('删除管理员失败!');
    }
   }
   public function logout(){
    session(null);
    $this->success("退出系统成功",url('admin/login/index'));
   }


}
