<?php
namespace app\admin\controller;
use think\View;
// use think\Db;
use app\admin\controller\Common;
use app\admin\model\Article as ArticleModel;
use app\admin\model\Cate as CateModel;
class Article extends Common
{   
    
     public function lst(){
        $artres=db('article')->field('a.*,b.catename')->alias('a')->join('tp_cate b','a.cateid=b.id')->paginate(3);
        $this->assign('artres',$artres);
       // dump($artres);die;
        return view();
    }


    public function add(){
        $article=new ArticleModel;
    	  if(request()->isPost()){
        $data=input('post.');
        $validate = \think\Loader::validate('Article');
        if(!$validate->scene('add')->check($data)){
        $this->error($validate->getError());
    // dump($validate->getError());
     }
        if($article->save($data)){
        	$this->success('添加文章成功',url('lst'));
        }
        else{
        	$this->error('添加文章失败');
        } 
        return;
    	}
       $cate=new CateModel();
       $cateres=$cate->catetree();       
       $this->assign('cateres',$cateres);
      return view();
    }


    public function edit(){
        if(request()->isPost()){
        $data=input('post.');
        $validate = \think\Loader::validate('Article');
        if(!$validate->scene('edit')->check($data)){
        $this->error($validate->getError());
    // dump($validate->getError());
        }
            //dump(input('post.'));die;
            $article=new ArticleModel;
            $save=$article->update($data);
            //$save=db('article')->update(input('post.'));
            //dump($save);die;
            if($save){
                $this->success('修改文章成功',url('lst'));
            }else{
                $this->error('修改失败');
            }
            return;
        }
      $cate=new CateModel();
      $cateres=$cate->catetree();
      $arts=db('article')->find(input('id')) ;
      $this->assign(array('cateres'=>$cateres,'arts'=>$arts));
      return view();
    }
    
  public function del(){
     
  if(ArticleModel::destroy(input('id'))){
    $this->success('删除文章成功',url('lst'));
  }else{
    $this->error('删除文章失败');
  }

}
}