<?php
/**
 * @creDate :2019/11/13
 * @function: 教学管理员类
 * @author  :陈文艺
 * @editor  :修改人
 * @modDate :修改日期
 * @version :V0.1.0
 */
namespace app\index\controller;
namespace app\index\controller;
use app\index\model\Teacher as TeacherModel;
use app\index\model\StuArchives as StuArchivesModel;
use app\index\model\TeaExcellent as TeaExcellentModel;
use app\index\model\StuExcellent as StuExcellentModel;
use think\Session;
class Worker extends Common
{
/************************************=====================================课程信息管理=======================*******************************/
    /**
     * 查看课程信息
     */
    public function courseInfoList(){
        $Common = new Common(); //创建User对象
        $getList = $Common->courseInfoList();
        $getListCount = $Common->courseInfoCoure();
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('course');
    }
/************************************=====================================评优管理=======================***********************************/
    /**
     * 查看申请优秀
     */
    public function listEvaluation(){
        $StuExcellentModel = new StuExcellentModel(); //创建User对象
        $getList = $StuExcellentModel->getExcellent();
        $getListCount = $StuExcellentModel->getExcellentCount();
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('stu-evaluation');
    }

/************************************=====================================个人信息=======================***********************************/
    /**
     * @return mixed 显示个人档案信息
     */
    public function personalInformation()
    {
        $TeacherModel = new TeacherModel(); //创建User对象
        $stuInfo = $TeacherModel->getTeacherInfo(Session::get('TEA_ID'));
        $this->assign('getList', $stuInfo); //所有课程
        return $this->fetch('personal-information');
    }

    /**
     * @return mixed 显示个人账户信息
     */
    public function account()
    {
        $data = [];
        if (request()->isPost()) {
            $file = request()->file('file');
            if ($file) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'portrait');
                $data = [];
                if ($info) {
                    $StuArchivesModel = new StuArchivesModel(); //创建User对象
                    $data['user_id'] = Session::get('USER_ID');//用户ID
                    $data['user_img'] = $info->getSaveName(); //文件地址
                    $stuInfo = $this->userInfo($data, 3);
                    return $this->json(1, "照片更换成功成功", array());
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
            } else {
                $data['user_id'] = Session::get('USER_ID');//用户ID
                $data['user_pass'] = input('post.')['user_pass'];
                $stuInfo = $this->userInfo($data, 2);
                if ($stuInfo == 1) {
                    return $this->json(1, "修改成功", array());
                } else {
                    return $this->json(-1, "修改失败", array());
                }
            }
        } else {
            $data['user_id'] = Session::get('USER_ID');//用户ID
            $stuInfo = $this->userInfo($data, 1);
            $this->assign('stuInfo', $stuInfo); //所有课程
            return $this->fetch('account');
        }
    }
}
