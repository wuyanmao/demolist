<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;

class Login extends Controller
{
    public function index()
    {     //接受数据
    	if(request()->isPost()){
    	$admin=new Admin();
    	$num=$admin->login(input('post.'));
    	if($num==1){
    		$this->success('登录成功',url('index/index'));
    		//$this->error('用户不存在');
    	}
    	if($num==2){
    		$this->error('密码错误');
    		//$this->success('登录成功');
    	}
    	if($num==3){
    		$this->error('用户名不存在');
    	}
    	//$admin->login(input('post.'));
          return;
    	}
        return view();//助手函数
    }
}
