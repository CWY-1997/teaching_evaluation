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
use app\index\model\Guidance;
use app\index\model\TeaTeaching as TeaTeachingModel;
use app\index\model\Teacher as TeacherModel;
use app\index\model\CourseInfo as CourseInfoModel;
use app\index\model\Preselection as PreselectionModel;
use app\index\model\StuArchives as StuArchivesModel;
use app\index\model\TeaExcellent as TeaExcellentModel;
use app\index\model\SelectedTopic as SelectedTopicModel;
use app\index\model\Guidance as GuidanceModel;
use app\index\model\Inspect as InspectModel;
use app\index\model\Defence as DefenceModel;
use app\index\model\CourseAssignment as CourseAssignmentModel;
use app\index\model\CourseSubmi as CourseSubmiModel;
use think\Session;
class Teaching extends Common
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


/************************************=====================================培养方案=======================***********************************/
    /**
     * 查看培养方案
     */
    public function getTrainingPlan(){
        $this->assign('getListCount', $this->resourcesCount()); //课程总数
        $this->assign('getList', $this->resourcesList()); //所有课程
        return $this->fetch('plan-resources');
    }

    /**
     * 发布培养方案
     */
    public function addTrainingPlan(){

    }

    /**
     * 删除培养方案
     */
    public function deleTrainingPlan(){

    }





    /************************************=====================================教学任务=======================***********************************/
    /**
     * 查看教学任务
     */
    public function getTeachingTask(){
        $this->assign('getListCount', $this->resourcesCount()); //课程总数
        $this->assign('getList', $this->resourcesList()); //所有课程
        return $this->fetch('task-resources');
    }

    /**
     * 发布教学任务
     */
    public function addTeachingTask(){

    }

    /**
     * 删除教学任务
     */
    public function deleTeachingTask(){

    }
/************************************=====================================资源管理=======================**********************************/
    /**
     * 获取资源信息
     */
    public function getResources()
    {
        $this->assign('getListCount', $this->resourcesCount()); //课程总数
        $this->assign('getList', $this->resourcesList()); //所有课程
        return $this->fetch('su-resources');
    }
    /**
     * 上传资源
     */
    public function upResources()
    {
        $this->assign('getListCount', $this->resourcesCount()); //课程总数
        $this->assign('getList', $this->resourcesList()); //所有课程
        return $this->fetch('su-up-resources');
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

    /**
     * 审核优秀学生申请通过
     * @return mixed
     */
    public function adoptEvaluation(){
        //模型中操作查询数据
        $StuExcellentModel = new StuExcellentModel(); //创建User对象
        if(request()->isPost()) {
                $updateInfo = $StuExcellentModel->adoptEvaluation(input('post.')['stu_excellent_id']);  //教师ID
                if($updateInfo){
                    return $this->json(1,"审核成功",array());
                }else{
                    return $this->json(-1,"审核失败",array());
                }
        }
    }

    /**
     * 审核优秀教师申请不通过
     * @return mixed
     */
    public function notAdoptEvaluation($id=null){
        //模型中操作查询数据
        $StuExcellentModel = new StuExcellentModel(); //创建User对象
        if(request()->isPost()) {
            $data = [];
            $data['stu_excellent_id'] = input('post.')['stu_excellent_id'];
            $data['stu_examine_remarks'] = input('post.')['stu_examine_remarks'];
            $updateInfo = $StuExcellentModel->notAdoptEvaluation($data);  //教师ID
            if($updateInfo){
                return $this->json(1,"提交成功",array());
            }else{
                return $this->json(-1,"提交失败",array());
            }
        }else{
            $this->assign('stu_excellent_id', $id); //所有课程
            return $this->fetch('stu-model');
        }
    }

    /**
     * 查看申请优秀
     */
    public function teaListEvaluation(){
        $TeaExcellentModel = new TeaExcellentModel(); //创建User对象
        $getList = $TeaExcellentModel->getExcellent();
        $getListCount = $TeaExcellentModel->getExcellentCount();
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('tea-evaluation');
    }

    /**
     * 审核优秀教师申请通过
     * @return mixed
     */
    public function teaAdoptEvaluation(){
        //模型中操作查询数据
        $TeaExcellentModel = new TeaExcellentModel(); //创建User对象
        if(request()->isPost()) {
            $updateInfo = $TeaExcellentModel->adoptEvaluation(input('post.')['tea_excellent_id']);  //教师ID
            if($updateInfo){
                return $this->json(1,"审核成功",array());
            }else{
                return $this->json(-1,"审核失败",array());
            }
        }
    }

    /**
     * 审核优秀学生申请不通过
     * @return mixed
     */
    public function teaNotAdoptEvaluation($id=null){
        //模型中操作查询数据
        $TeaExcellentModel = new TeaExcellentModel(); //创建User对象
        if(request()->isPost()) {
            $data = [];
            $data['tea_excellent_id'] = input('post.')['tea_excellent_id'];
            $data['tea_excellent_remarks'] = input('post.')['tea_excellent_remarks'];
            $updateInfo = $TeaExcellentModel->notAdoptEvaluation($data);  //教师ID
            if($updateInfo){
                return $this->json(1,"提交成功",array());
            }else{
                return $this->json(-1,"提交失败",array());
            }
        }else{
            $this->assign('tea_excellent_id', $id); //所有课程
            return $this->fetch('tea-model');
        }
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
