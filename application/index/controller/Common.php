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
use app\index\model\Resources as ResourcesModel;
use think\Controller;
use think\Session;
use app\index\model\User as UserModel;
use app\index\model\StuArchives as StuArchivesModel;
class Common extends Controller
{

    public function _initialize()
    {
        if(!session('USER_ID')){
          //  $this->redirect(url('Login/login')); //直接跳转方法
            return $this->error('您没有登陆',url('Login/login'));
        }
    }
    /**
     * 课程信息列表
     * @return string
     */
    public function courseInfoList()
    {
        $CourseInfoModel = new CourseInfoModel(); //创建User对象
        return $CourseInfoModel->getCourse();
    }

    /**
     * 课程信息总数
     * @return string
     */
    public function courseInfoCoure()
    {
        $CourseInfoModel = new CourseInfoModel(); //创建User对象
        return $CourseInfoModel->getCourseCount();

    }
    /**
     * 资源查询总数
     */
    public function resourcesCount(){
        $ResourcesModel = new ResourcesModel(); //创建User对象
        return $ResourcesModel->getResourcesCount();
    }

    /**
     * 资源查询信息
     */
    public function resourcesList(){
        $ResourcesModel = new ResourcesModel(); //创建User对象
        return $ResourcesModel->getResources();
    }

    /**
     * 更新下载次数
     */
    public function upResources(){
        $ResourcesModel = new ResourcesModel(); //创建User对象
        $up = $ResourcesModel->upResourcesCount( input('post.')['res_id']);
        if($up){
            return $this->json(1,"下载成功",array());
        }else{
            return $this->json(-1,"下载失败",array());
        }
    }

    /**
     * 用户信息
     * @return string
     */
    public function userInfo($data,$type)
    {
        if($type==1){ //显示用户信息
            $UserModel = new UserModel(); //创建User对象
            return $UserModel->getUser($data['user_id']);
        }else if($type==2){ //修改密码
            $UserModel = new UserModel(); //创建User对象
            return $UserModel->upUser($data);
        }else {//修改头像
            $UserModel = new UserModel(); //创建User对象
            return $UserModel->upUserImg($data);
        }

    }
    /**
     * 查询学生信息
     */
    public function getStuInfo(){
        $StuArchivesModel = new StuArchivesModel(); //创建User对象
        $stuInfo = $StuArchivesModel->getArchivesId(Session::get('USER_ID')); //查询学生ID
        return $stuInfo;
    }
    /**
     * 验证Session是否存在
     */
    public function index(){
        if(Session::get('USER_DUTY')==0){ //student
            return $this->fetch('Login/stu_index');
        }else if(Session::get('USER_DUTY')==1){ //教师
            return $this->fetch('Login/tea_index');
        }else if(Session::get('USER_DUTY')==2){  //教学管理员
            return $this->fetch('Login/teaching_index');
        }else if(Session::get('USER_DUTY')==3){  //学院秘书
            return $this->fetch('Login/secretary_index');
        }else if(Session::get('USER_DUTY')==4){  //学工管理员
            return $this->fetch('Login/worker');
        }else if(Session::get('USER_DUTY')==5){ //系统管理员
            return $this->fetch('Login/sys_index');
        }else{
            return $this->fetch('Login/login');
        }
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
     * 将中文括号转为为因为阔号
     * @return string
     */
    public function str($val1){
        $str = str_replace('(','（',$val1);
        $str = str_replace(')','）',$str);
        return $str;
    }
}
