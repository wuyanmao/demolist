<?php
namespace app\admin\controller;
use think\View;
// use think\Db;
use app\admin\controller\Common;
use app\admin\model\Link as LinkModel;
class Link extends Common
{   
    

    public function lst()
    {      
       $link=new LinkModel;  
       if(request()->isPost()){
        $sorts=input('post.');
        foreach ($sorts as $k => $v) {
            $link->update(['id'=>$k,'sort'=>$v]);
        }
        $this->success("更新排序成功",url('lst'));
        return;
       }
      $linkers=$link::order('sort desc')->paginate(3);
      $this->assign('linkers',$linkers);
       return view();
       // $cate=new AdminModel();
       // $res=$cate->select();
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
    
    public function add(){
     if(request()->isPost()){
     $data=input('post.');
     $validate = \think\Loader::validate('link');
     if(!$validate->scene('add')->check($data)){
      $this->error($validate->getError());
    // dump($validate->getError());
     }
       $add=db('link')->insert($data);
       if($add){
        $this->success('添加链接成功',url('lst'));
       }else{
        $this->error('添加链接失败');
       }
    }
    return view();
    }




  public function del(){
    $del=LinkModel::destroy(input('id'));
    if($del){
      $this->success('删除链接成功',url('lst'));
    }else{
      $this->error('删除链接失败');
    }
  }

  public function edit(){
     if(request()->isPost()){
     $data=input('post.');
     $validate = \think\Loader::validate('link');
     if(!$validate->scene('edit')->check($data)){
      $this->error($validate->getError());
    // dump($validate->getError());
     }
     $link=new LinkModel;  
      $save=$link->save($data,['id'=>$data['id']]);
      if($save!==false){
        $this->success('修改链接成功',url('lst'));
      }else{
        $this->error('修改链接失败');
      }
    }
    $links=LinkModel::find(input('id'));
    $this->assign('links',$links);
    return view();
  }


}
