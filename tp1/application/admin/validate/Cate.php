<?php
namespace app\admin\validate;
use think\Validate;
class Cate extends Validate
{   
     protected $rule=[
       'catename'  => 'unique:cate|require|max:25',
     ];
      protected $message  =   [
        //'title.require' => '链接标题不得为空',
        'catename.require'=>'栏目不得为空',
        'catename.unique'=>'栏目不能重复',

    ];

     protected $scene = [
        'add'  =>  ['catename'],
        'edit'  =>  ['catename'],
       

    ];


}
