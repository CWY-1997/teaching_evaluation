<?php
/**
 * @creDate :2019/11/13
 * @function: 教师处理类
 * @author  :陈文艺
 * @editor  :修改人
 * @modDate :修改日期
 * @version :V0.1.0
 */
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
class Teacher extends Common
{
/********************************=====================================教师课程管理=======================********************************/

    /**
     * 教师课程表
     */
    public function timetable(){
        $TeaTeachingModel = new TeaTeachingModel(); //创建User对象
        $getList = $TeaTeachingModel->getTimetable(Session::get('TEA_ID'));
        $getListCount = $TeaTeachingModel->getTimetableCoure(Session::get('TEA_ID'));
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('timetable');
    }

    /**
     * 修改正在授课
     */
    public function beingCourse(){
        $TeaTeachingModel = new TeaTeachingModel(); //创建User对象
        $up = $TeaTeachingModel->setBeingCourse(input('post.')['teaching_id']);
        if($up){
            return $this->json(1,"修改成功",array());
        }else{
            return $this->json(-1,"修改失败",array());
        }
    }

    /**
     * 修改正在授课
     */
    public function endCourse(){
        $TeaTeachingModel = new TeaTeachingModel(); //创建User对象
        $up = $TeaTeachingModel->setEndCourse(input('post.')['teaching_id']);
        if($up){
            return $this->json(1,"修改成功",array());
        }else{
            return $this->json(-1,"修改失败",array());
        }
    }

    /**
     * 查看已发布的所有课程
     * @return mixed
     */
    public function onlineCourse()
    {
        $CourseInfoModel = new CourseInfoModel(); //创建User对象
        $TeaTeachingModel = new TeaTeachingModel(); //创建User对象
        $getCourse = $CourseInfoModel->getCourseStatus();
        $getCourseCount = $CourseInfoModel->getCourseCountStatus();
        $list_copy = $getCourse->toArray();       //把原数据集对象转换成数
        for ($i = 0; $i < count($list_copy['data']); $i++) {
            $course_id = (int)$list_copy['data'][$i]['course_id'];
            $preseStatus = $TeaTeachingModel->getCourseId($course_id, Session::get('TEA_ID'));
            if (empty($preseStatus)) { //教师还没有申请过课程
                $list_copy['data'][$i]['teaching_apply_status'] = 3;
            } else {
                $list_copy['data'][$i]['teaching_apply_status'] = $preseStatus['teaching_apply_status'];
            }
        }
        $this->assign('getListCount', $getCourseCount); //课程总数
        $this->assign('getListPe', $getCourse); //课程总数
        $this->assign('getList', $list_copy['data']);
        return $this->fetch('tea-online-course');
    }

    /**
     * 教师申请已发布的某个课程
     * @return mixed
     */
    public function applyCourse()
    {
        //模型中操作查询数据
        $TeaTeachingModel = new TeaTeachingModel(); //创建User对象
        if (request()->isPost()) {
            $data = [];
            $data['course_id'] = input('post.')['course_id'];
            $data['tea_id'] = Session::get('TEA_ID');//学生ID
            $inspect = $TeaTeachingModel->inspectPreselection($data);
            if (empty($inspect)) {
                $data['teaching_apply_status'] = 0;
                $data['teaching_status'] = 0;
                $add = $TeaTeachingModel->addPreselection($data);
                if ($add) {
                    return $this->json(1, "申请成功", array());
                } else {
                    return $this->json(-1, "申请失败", array());
                }
            } else {
                return $this->json(-1, "已申请过，请等待审核", array());
            }
        }
    }

    /**
     * 教师审核学生选课问题
     */
    public function courseSelection(){
        $TeaTeachingModel = new TeaTeachingModel(); //创建User对象
        $getList = $TeaTeachingModel->getTimetable(Session::get('TEA_ID'));
        $getListCount = $TeaTeachingModel->getTimetableCoure(Session::get('TEA_ID'));
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('course-selection');
    }
    /**
     * 查看教师课程有哪些学生加入
     */
    public function applyCourseStu($course_id){
        $CourseInfoModel = new CourseInfoModel(); //创建User对象
        $PreselectionModel = new PreselectionModel(); //创建User对象
        $getList = $PreselectionModel->getPreselectionStuAll($course_id);
        $getListCount = $PreselectionModel->getPreselectionStuAll($course_id);
        $getCountInfo = $CourseInfoModel->getCountInfo($course_id);
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        $this->assign('getCountInfo', $getCountInfo); //所有课程
        return $this->fetch('apply-course-stu');
    }
/***********************************=====================================作业与实验管理=======================******************************/
    /**
     * 作业实验批改
     */
    public function homeworkCorrection(){
        $CourseAssignmentModel = new CourseAssignmentModel(); //创建User对象
        $getList = $CourseAssignmentModel->getAssignment(Session::get('TEA_ID'));
        $getListCount = $CourseAssignmentModel->getAssignmentCoure(Session::get('TEA_ID'));
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('homework-correction');
    }

    /**
     * 查看该课程已经提交作业的的学生
     */
    public function homeworkPreselection($ass_id){
        $CourseSubmiModel = new CourseSubmiModel(); //创建User对象
        $getList = $CourseSubmiModel->getSubmiInfo($ass_id);
        $getListCount = $CourseSubmiModel->getSubmiInfoCount($ass_id);
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('homework-correction-model');
    }
    /**
     * 布置作业
     */
    public function assignment(){
        $CourseAssignmentModel = new CourseAssignmentModel(); //创建User对象
        $getList = $CourseAssignmentModel->getAssignment(Session::get('TEA_ID'));
        $getListCount = $CourseAssignmentModel->getAssignmentCoure(Session::get('TEA_ID'));
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('homework-assignment');
    }

/***********************************=====================================课程成绩管理=======================******************************/
    /**
     * 课程成绩录入
     */
    public function coursePerformance(){
        $TeaTeachingModel = new TeaTeachingModel(); //创建User对象
        $getList = $TeaTeachingModel->getTimetable(Session::get('TEA_ID'));
        $getListCount = $TeaTeachingModel->getTimetableCoure(Session::get('TEA_ID'));
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('course-performance');
    }

    /**
     * 查看教师课程有哪些学生加入
     */
    public function preselection($course_id){
        $CourseInfoModel = new CourseInfoModel(); //创建User对象
        $PreselectionModel = new PreselectionModel(); //创建User对象
        $getList = $PreselectionModel->getPreselectionStu($course_id);
        $getListCount = $PreselectionModel->getPreselectionStuCount($course_id);
        $getCountInfo = $CourseInfoModel->getCountInfo($course_id);
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        $this->assign('getCountInfo', $getCountInfo); //所有课程
        return $this->fetch('course-performance-model');
    }

    /**
     * 录入毕业设计分数
     */
    public function graduation(){
        $StuArchivesModel = new StuArchivesModel();
        $GuidanceModel = new GuidanceModel(); //创建User对
        $getList = $GuidanceModel->getPreselectionStu(Session::get('TEA_ID'));
        for ($i = 0; $i < count($getList); $i++) {
            $stu_id = $getList[$i]['stu_id'];
            $stuInfo = $StuArchivesModel->getArchivesId($stu_id);
            $getList[$i]['user_number'] = $stuInfo['user_number'];
            $getList[$i]['stu_name'] = $stuInfo['stu_name'];
        }
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('graduation-results');
    }

/************************************************=====================================学生毕业设计=======================*********************************/
    /**
     * 添加教师所指导的学生
     */
    public function addGuidanceStu()
    {
        $GuidanceModel = new GuidanceModel(); //创建User对象
        $getList = $GuidanceModel->getGuidanceStu(Session::get('TEA_ID'));
        $getListCount = $GuidanceModel->getGuidanceStuCount(Session::get('TEA_ID'));
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('tea-add-guidance');
    }
    /**
     * 添加指导学生
     * @return mixed
     */
    public function addStudent()
    {
        $StuArchivesModel = new StuArchivesModel(); //创建User对象
        $GuidanceModel = new GuidanceModel(); //创建User对象
        if(request()->isPost()) {
            $stuInfo = $StuArchivesModel->getArchivesNumber(input('post.')['user_number']);
            if (empty($stuInfo)){
                return $this->json(1, "添加失败，学生没有档案存在，请联系教学管理员添加学生进入系统", array());
            }else{
                $this->assign('stuInfo', $stuInfo); //学生信息
                $data['tea_id'] = Session::get('TEA_ID');
                $data['stu_id'] = $stuInfo['stu_id'];
                $data['guidance_year'] = date("Y");
                $data['guidance_status'] = 0;
                $add = $GuidanceModel->insertApplicant($data);
                if ($add) {
                    return $this->json(1, "添加成功", array());
                } else {
                    return $this->json(-1, "添加失败", array());
                }
            }
        }

    }

    /**
     * 删除指导学生
     * @return mixed
     */
    public function deleStudent()
    {
        $GuidanceModel = new GuidanceModel(); //创建User对象
        if(request()->isPost()) {
                $stuInfo = $GuidanceModel->delegGuidance(input('post.')['guidance_id']);
                if ($stuInfo) {
                    return $this->json(1, "删除成功", array());
                } else {
                    return $this->json(-1, "删除失败", array());
                }
        }

    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * 获取当前年份内某位教师所指导的毕业学生选题相关信息
     */
    public function getTopic()
    {
        $StuArchivesModel = new StuArchivesModel(); //创建User对象
        $GuidanceModel = new GuidanceModel(); //创建User对象
        $getList = $GuidanceModel->getGuidanceInfo(Session::get('TEA_ID'));
        $getListCount = $GuidanceModel->getGuidanceInfoCount(Session::get('TEA_ID'));
        for ($i = 0; $i < count($getList); $i++) {
            $stu_id = (int)$getList[$i]['stu_id'];
            $stuInfo = $StuArchivesModel->getArchivesId($stu_id);
            $getList[$i]['user_number'] = $stuInfo['user_number'];
            $getList[$i]['stu_name'] = $stuInfo['stu_name'];
        }
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('tea-topic-list');
    }

    /**
     * 审核学生选题情况
     */
    public function adoptTopic()
    {
        $SelectedTopicModel = new SelectedTopicModel(); //创建User对象
        $topic_type = input('post.')['topic_type'];
        $topic_id  = input('post.')['topic_id'];
        if($topic_type == 1){
            $Info = $SelectedTopicModel->examineAdopt($topic_id);
            if ($Info == 1) {
                return $this->json(1, "审核成功", array());
            } else {
                return $this->json(-1, "审核失败", array());
            }
        }else{
            $Info = $SelectedTopicModel->examineNotAdopt($topic_id);
            if ($Info == 1) {
                return $this->json(1, "审核成功", array());
            } else {
                return $this->json(-1, "审核失败", array());
            }
        }
    }

    /**
     * 获取当前年份内某位教师所指导的毕业学生论文情况
     */
    public function getInspect()
    {
        $StuArchivesModel = new StuArchivesModel(); //创建User对象
        $GuidanceModel = new GuidanceModel(); //创建User对象
        $SelectedTopicModel = new SelectedTopicModel(); //创建User对象
        $getList = $GuidanceModel->getInspectInfo(Session::get('TEA_ID'));
        $getListCount = $GuidanceModel->getInspectInfoCount(Session::get('TEA_ID'));
        for ($i = 0; $i < count($getList); $i++) {
            $stu_id = (int)$getList[$i]['stu_id'];
            $stuInfo = $StuArchivesModel->getArchivesId($stu_id);
            $topicInfo = $SelectedTopicModel->getTopicId($stu_id);
            $getList[$i]['user_number'] = $stuInfo['user_number'];
            $getList[$i]['stu_name'] = $stuInfo['stu_name'];
            $getList[$i]['topic_subject'] = $topicInfo['topic_subject'];
        }
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('tea-inspect-list');
    }

    /**
     * 检查学生的论文情况
     */
    public function adoptInspect()
    {
        $InspectModel = new InspectModel(); //创建User对象
        $inspect_type = input('post.')['inspect_type'];
        $inspect_id  = input('post.')['inspect_id'];
        if($inspect_type == 1){
            $Info = $InspectModel->examineAdopt($inspect_id);
            if ($Info == 1) {
                return $this->json(1, "检查成功", array());
            } else {
                return $this->json(-1, "检查失败", array());
            }
        }else{
            $Info = $InspectModel->examineNotAdopt($inspect_id);
            if ($Info == 1) {
                return $this->json(1, "检查成功", array());
            } else {
                return $this->json(-1, "检查失败", array());
            }
        }
    }

    /**
     * 获取当前年份内某位教师所指导的毕业学生论文答辩情况
     */
    public function getDefence()
    {
        $StuArchivesModel = new StuArchivesModel(); //创建User对象
        $GuidanceModel = new GuidanceModel(); //创建User对象
        $SelectedTopicModel = new SelectedTopicModel(); //创建User对象
        $getList = $GuidanceModel->getDefenceInfo(Session::get('TEA_ID'));
        $getListCount = $GuidanceModel->getDefenceCount(Session::get('TEA_ID'));
        for ($i = 0; $i < count($getList); $i++) {
            $stu_id = (int)$getList[$i]['stu_id'];
            $stuInfo = $StuArchivesModel->getArchivesId($stu_id);
            $topicInfo = $SelectedTopicModel->getTopicId($stu_id);
            $getList[$i]['user_number'] = $stuInfo['user_number'];
            $getList[$i]['stu_name'] = $stuInfo['stu_name'];
            $getList[$i]['topic_subject'] = $topicInfo['topic_subject'];
        }
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('tea-defence-list');
    }

    /**
     * 检查学生的论文答辩情况
     */
    public function adoptDefence()
    {
        $DefenceModel = new DefenceModel(); //创建User对象
        $defence_type = input('post.')['defence_type'];
        $defence_id  = input('post.')['defence_id'];
        if($defence_type == 1){
            $Info = $DefenceModel->examineAdopt($defence_id);
            if ($Info == 1) {
                return $this->json(1, "提交成功", array());
            } else {
                return $this->json(-1, "提交失败", array());
            }
        }else{
            $Info = $DefenceModel->examineNotAdopt($defence_id);
            if ($Info == 1) {
                return $this->json(1, "提交成功", array());
            } else {
                return $this->json(-1, "提交失败", array());
            }
        }
    }
/**********************************=====================================评优管理=======================***********************************/
    /**
     * 优秀教师申请
     */
    public function appEvaluation()
    {
        $TeaExcellentModel = new TeaExcellentModel(); //创建User对象
        $getList = $TeaExcellentModel->getExcellent();
        $getListCount = $TeaExcellentModel->getExcellentCount();
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('tea-add-evaluation');
    }

    /**
     * 优秀教师材料文件删除
     * @return mixed
     */
    public function deleEvaluation()
    {
        //模型中操作查询数据
        $TeaExcellentModel = new TeaExcellentModel(); //创建User对象
        if (request()->isPost()) {
            $ExcellInfo = $TeaExcellentModel->getExcellentId(input('post.')['tea_excellent_id']);
            if ($ExcellInfo['tea_excellent_status'] == 0) {
                $dele = $TeaExcellentModel->deleEvaluation(input('post.')['tea_excellent_id']);  //教师ID
                if ($dele) {
                    return $this->json(1, "删除成功", array());
                } else {
                    return $this->json(-1, "删除失败", array());
                }
            } else {
                return $this->json(-1, "已审核，无法删除", array());
            }

        }
    }

    /**
     * 优秀教师申请材料文件上传
     */
    public function fileUpload()
    {
        $TeaExcellentModel = new TeaExcellentModel(); //创建User对象
        $file = request()->file('file');
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'appraising/teacher');
            $data = [];
            if ($info) {
                $StuArchivesModel = new StuArchivesModel(); //创建User对象
                $data['tea_id'] = Session::get('TEA_ID');//学生ID
                $data['tea_excellent_year'] = date('Y');//申请年份
                $data['tea_excellent_path'] = $info->getSaveName(); //文件地址
                $data['tea_excellent_name'] = $_FILES['file']['name']; //文件原名称
                $data['tea_excellent_status'] = 0; //审核状态
                $data['tea_excellent_apply'] = 0; //申请状态
                $up = $TeaExcellentModel->excellentAdd($data);
                return $this->json(1, "材料上传成功", array());
            } else {
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
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

/******************************=====================================个人信息=======================******************************************/
    /**
     * @return mixed 显示学生个人档案信息
     */
    public function personalInformation()
    {
        $TeacherModel = new TeacherModel(); //创建User对象
        $stuInfo = $TeacherModel->getTeacherInfo(Session::get('TEA_ID')); //查询学生ID
        $this->assign('getList', $stuInfo); //所有课程
        return $this->fetch('personal-information');
    }

    /**
     * @return mixed 显示学生个人账户信息
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
