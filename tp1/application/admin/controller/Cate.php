<?php
namespace app\admin\controller;
use think\View;
// use think\Db;
use app\admin\controller\Common;
use app\admin\model\Cate as CateModel;
use app\admin\model\Article as ArticleModel;
class Cate extends Common
{   
    protected $beforeActionList = [
       
        'delsoncate'  =>  ['only'=>'del'],
    ];

    public function lst()
    {        
       $cate=new CateModel();
       if(request()->isPost()){
        $sorts=input('post.');
        foreach ($sorts as $k => $v) {
            $cate->update(['id'=>$k,'sort'=>$v]);
        }
        $this->success("更新排序成功",url('lst'));
        return;
       }
       $cateres=$cate->catetree();      
       $this->assign('cateres',$cateres);
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
        $cate=new CateModel();
        if(request()->isPost()){
        $data=input('post.');
        $validate = \think\Loader::validate('Cate');
        if(!$validate->scene('add')->check($data)){
        $this->error($validate->getError());
    // dump($validate->getError());
     }
       $add=$cate->save($data);
       if($add){
        $this->success('添加成功',url('lst'));
       }else{
        $this->error('添加失败');
       }
      }
      $cateres=$cate->catetree();
      $this->assign('cateres',$cateres);
      return view();

    }
    public function del(){
      $del=db('cate')->delete(input('id'));
      if($del){
        $this->success('删除栏目成功',url('lst'));
      }else{
        $this->error('删除失败');
      }
    }
    public function delsoncate(){
      $cateid=input('id');
      // $cateid=input('id');
      //  //echo input('id');die;//接受id
       $cate=new CateModel();
       $sonid=$cate->getchilren($cateid);
       $allcateid=$sonid;
       $allcateid[]=$cateid;
       foreach ($allcateid as $k => $v) {
        $article=new ArticleModel;
        $article->where(array('cateid'=>$v))->delete();
       }
       if($sonid){
         db('cate')->delete($sonid);
       }
      
      }

         public function edit(){
             $cate=new CateModel();
             if(request()->isPost()){
             $data=input('post.');
             $validate = \think\Loader::validate('Cate');
             if(!$validate->scene('edit')->check($data)){
             $this->error($validate->getError());
    // dump($validate->getError());
              }
             $save=$cate->save($data,['id'=>$data['id']]);
             if($save !== false){
              $this->success('修改栏目成功',url('lst'));
             }else{
             $this->error('修改栏目失败');}
             return;
             }
            $cates=$cate->find(input('id'));
            $cateres=$cate->catetree();
            $this->assign(array('cateres'=>$cateres,
                        'cates'=>$cates,));
            return view();
             }
    
  


}
