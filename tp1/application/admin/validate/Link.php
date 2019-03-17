<?php
namespace app\admin\validate;
use think\Validate;
class Link extends Validate
{   
     protected $rule=[
       'title'  => 'unique:link|require|max:25',
       'desc'   => 'require',
       'url' => 'url|require|max:60|unique:link',  
     ];
      protected $message  =   [
        'title.require' => '链接标题不得为空',
        'desc.require' => '描述不能为空',
        'title.max' => '链接长度不得大于25个字符',
        'title.unique' =>'链接标题不能重复',
        'url.unique' =>'链接地址不能重复',
        'url.require' =>'链接地址不能为空',
        'url.max' =>'链接地址长度不能超过60',
        'url.url' =>'链接地址格式不正确',
    ];

     protected $scene = [
        'add'  =>  ['title','url','desc'],
        'edit' => ['title','url','desc'],

    ];


}
