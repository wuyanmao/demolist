<?php
namespace app\admin\model;
use think\Model;
class Article extends Model
{  
  protected static function init()
    {
        Article::event('before_insert', function ($article) {
          if($_FILES['thumb']['tmp_name']){
        	$file = request()->file('thumb');
        	$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
          if($info){
        // 成功上传后 获取上传信息
        // 输出 jpg
         // $thumb=ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getExtension();
           $thumb='/tp/' . 'public' . DS . 'uploads'.'/'.$info->getSaveName();
           $article['thumb']=$thumb;
        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
           }
          }
      });



        Article::event('before_update', function ($article) {
          if($_FILES['thumb']['tmp_name']){
          $arts=Article::find($article->id);
          $thumbpath=$_SERVER['DOCUMENT_ROOT'].$arts['thumb'];
          if(file_exists($thumbpath)){
            @unlink($thumbpath);//图片修改且替换
          }
          $file = request()->file('thumb');
          $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
          if($info){
        // 成功上传后 获取上传信息
        // 输出 jpg
         // $thumb=ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getExtension();
           $thumb='/tp/' . 'public' . DS . 'uploads'.'/'.$info->getSaveName();
           $article['thumb']=$thumb;
        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
           }
          //D:/PhpStudy20180211/PHPTutorial/WWW
        }

      });


        Article::event('before_delete', function ($article) {
          $arts=Article::find($article->id);
          $thumbpath=$_SERVER['DOCUMENT_ROOT'].$arts['thumb'];
          if(file_exists($thumbpath)){
            @unlink($thumbpath);//图片修改且替换
          }
         
          //D:/PhpStudy20180211/PHPTutorial/WWW
        

      });


    }


      


    

}
