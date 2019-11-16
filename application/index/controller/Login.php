<?php
/**
 * @creDate :2019/11/05
 * @function: 公共类
 * @author  :陈文艺
 * @editor  :修改人
 * @modDate :修改日期
 * @version :V0.1.0
 * @team    :TuboSnail
 */
namespace app\index\controller;
use app\index\model\CourseInfo as CourseInfoModel;
use think\Session;
use think\Controller;
use app\index\model\User as UserModel;
class Login extends Controller
{
     /**
     * 登陆页面显示
     * @return string
     */
    public function login()
    {
        if(request()->isPost()) {
            $UserModel = new UserModel(); //创建User对象
            $data['user_number']=input('post.')['user_number'];
            $data['user_pass']=input('post.')['user_pass'];
            if($UserModel->inspect($data) ==1){
                return $this->json(1,"登录成功",array());
            }else if($UserModel->inspect($data) ==-1){
                return $this->json(-1,"登录密码错误",array());
            }else{
                return $this->json(-2,"登录账号错误",array());
            }
        }
        return $this->fetch('login');
    }

    /**
     * 返回json数据
     * @param $code
     * @param string $msg
     * @param array $data
     */
    function json($code,$msg="",$data=array()){
        $result=array(
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        );
        //输出json
        echo json_encode($result);
        exit;
    }
    /**
     * 系统信息显示
     */
    public function welcome(){
        return $this->fetch('welcome');
    }

    /**
     * 退出系统情况session值
     * @return mixed
     */
    public function signOut()
    {
        session(null);
        return $this->fetch('login');
    }
}
