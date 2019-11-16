<?php
/**
 * @creDate :2019/09/27
 * @function: 登陆验证
 * @author  :陈文艺
 * @editor  :修改人
 * @modDate :修改日期
 * @version :V0.1.0
 * @team    :TuboSnail
 */
namespace app\index\model;
use think\Model;
use think\Db;
use think\Session;
class User extends Model
{
    /**
     * 检查用户是否存在
     * @param $data 账号和密码
     * @return mixed
     */
    public function inspect($data){
        $logIn = Db::table('user')->where('user_number',$data['user_number'])->find();
        if($logIn){
                if($logIn['user_pass'] == $data['user_pass']){ //登陆密码判断
                    Session::set('USER_DUTY',$logIn['user_duty']);
                    Session::set('USER_ID',$logIn['user_id']);
                    Session::set('USER_IMG',$logIn['user_img']);
                    if($logIn['user_duty'] ==0){ //将用户ID转为为学生ID
                        $stuId =  Db::name('stu_archives')->where('user_id',$logIn['user_id'])->find();
                        Session::set('STU_ID',$stuId['stu_id']);
                        Session::set('STU_NAME',$stuId['stu_name']);
                    }else{//将用户ID转为为教师ID
                        $teaId =  Db::name('teacher')->where('user_id',$logIn['user_id'])->find();
                        Session::set('TEA_ID',$teaId['tea_id']);
                        Session::set('TEA_NAME',$teaId['tea_name']);
                    }
                    $result=array('code'=>1, 'msg'=>"登录成功");
                    return 1;
                }else{
                    $result=array('code'=>-1, 'msg'=>"登录密码错误");
                    return -1;
                }
        }else{
            $result=array('code'=>-2, 'msg'=>"登录账号错误",array());
            return -1;
        }
    }
    /**
     * 返回用户信息
     * @return mixed
     */
    public function getUser($user_id){
        return Db::table('user')->where('user_id',$user_id)->find();
    }
    /**
     * 修改用户信息
     * @return mixed
     */
    public function upUser($data){
        return Db::table('user')->update(['user_pass' => $data['user_pass'],'user_id'=>$data['user_id']]);
    }
    /**
     * 添加用户信息
     * @return mixed
     */
    public function addUser($data){
        //$data = ['user_number' => '213', 'user_pass' => '123', 'user_duty' => '0', 'user_time' => date("Y-h-d"),'user_status' => '0'];
        Db::table('user')->insert($data);
    }
    /**
     * 添加用户信息
     * @return mixed
     */
    public function upUserImg($data){
        return Db::table('user')->update(['user_img' => $data['user_img'],'user_id'=>$data['user_id']]);
    }

}
