<?php
namespace app\admin\validate;
use think\Validate;
class Article extends Validate
{   
     protected $rule=[
       'title'  => 'unique:article|require|max:25',
       'cateid'   => 'require',
       'content' => 'require',  
     ];
      protected $message  =   [
        //'title.require' => '链接标题不得为空',
        'title.require'=>'文章标题不能为空',
        'title.unique'=>'文章标题不能重复',
        'title.max'=>'文章标题不得超过25个字符',
        'content.require'=>'文章内容不能为空',
        'cateid.require'=>'所属栏目不能为空',

    ];

     protected $scene = [
        'add'  =>  ['title','cateid','content'],
        'edit' => ['title','cateid','content'],

    ];


}
