<?php
/**
 * @creDate :2019/11/13
 * @function: 学生角色控制类
 * @author  :陈文艺
 * @editor  :修改人
 * @modDate :修改日期
 * @version :V0.1.0
 */
namespace app\index\controller;
use app\index\model\StuExcellent as StuExcellentModel;
use app\index\model\CourseInfo as CourseInfoModel;
use app\index\model\StuArchives as StuArchivesModel;
use app\index\model\Preselection as PreselectionModel;
use app\index\model\Classes as ClassesModel;
use app\index\model\StudentAchievement as StudentAchievementModel;
use app\index\model\GraduationAchievement as GraduationAchievementModel;
use app\index\model\SelectedTopic as SelectedTopicModel;
use app\index\model\Inspect as InspectModel;
use app\index\model\Defence as DefenceModel;
use app\index\model\Guidance as GuidanceModel;
use app\index\model\Teacher as TeacherModel;
use think\Session;

class Student extends Common
{
/******************=====================================课程管理=======================***************/
    /**
     * 查看学生课程表
     * @return mixed
     */
    public function situationCourse()
    {
        $PreselectionModel = new PreselectionModel(); //创建User对象
        $getListCount = $PreselectionModel->getHardCount(Session::get('STU_ID'));
        $getList = $PreselectionModel->getHard(Session::get('STU_ID'));
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('su-study-hard');
    }

    /**
     * 查看班级课程表
     * @return mixed
     */
    public function situClassCourse()
    {
        $CourseInfoModel = new CourseInfoModel(); //创建User对象
        $StuArchivesModel = new StuArchivesModel(); //创建User对象
        $ClassesModel = new ClassesModel(); //创建User对象
        $stuInfo = $StuArchivesModel->getArchivesId(Session::get('STU_ID')); //查询学生ID
        $classesInfo = $ClassesModel->getClassesNmae($stuInfo['classes_id']); //查询班级名称
        $str = $this->str($classesInfo['classes_name']);
        $getListCount = $CourseInfoModel->getClassCourseCount($str);
        $getListpage = $CourseInfoModel->getClassCourse($str);
        $getList = $CourseInfoModel->getClassCourse($str);
        $arr = $this->pretendClass($getList);
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $arr); //所有课程
        $this->assign('getListpage', $getListpage); //所有课程
        return $this->fetch('su-class-hard');
    }
    /**
     * 查询课程教师信息
     * @param $obj 数据集
     */
    public function pretendClass($obj){
        //模型中操作查询数据
        $TeacherModel = new TeacherModel(); //创建班级教师对象
        $list_copy = $obj->toArray();       //把原数据集对象转换成数
        for ($i=0;$i<count($list_copy['data']);$i++) {
            $courseId = $list_copy['data'][$i]['course_id'];
            $teaInfo = $TeacherModel->getTeacherId($courseId);
            $list_copy['data'][$i]['tea_name'] = $teaInfo['tea_name'];
            $list_copy['data'][$i]['teaching_status'] = $teaInfo['teaching_status'];
        }
        return $list_copy['data'];
    }
/******************=====================================选课管理=======================***************/
    /**
     * 查看已发布的所有课程
     * @return mixed
     */
    public function onlineCourse()
    {
        $CourseInfoModel = new CourseInfoModel(); //创建User对象
        $PreselectionModel = new PreselectionModel(); //创建User对象
        $getCourse = $CourseInfoModel->getCourseStatus();
        $getCourseCount = $CourseInfoModel->getCourseCountStatus();
        $list_copy = $getCourse->toArray();       //把原数据集对象转换成数
        for ($i = 0; $i < count($list_copy['data']); $i++) {
            $course_id = (int)$list_copy['data'][$i]['course_id'];
            $preseStatus = $PreselectionModel->getCourseId($course_id, Session::get('STU_ID'));
            if (empty($preseStatus)) { //学生不选课
                $list_copy['data'][$i]['prese_status'] = 3;
            } else {
                $list_copy['data'][$i]['prese_status'] = $preseStatus['prese_status'];
            }
        }
        $this->assign('getListCount', $getCourseCount); //课程总数
        $this->assign('getListPe', $getCourse); //课程总数
        $this->assign('getList', $list_copy['data']);
        return $this->fetch('online-course');
    }

    /**
     * 学生申请已发布的某个课程
     * @return mixed
     */
    public function applyCourse()
    {
        //模型中操作查询数据
        $PreselectionModel = new PreselectionModel(); //创建User对象
        if (request()->isPost()) {
            $data = [];
            $data['course_id'] = input('post.')['course_id'];
            $data['stu_id'] = Session::get('STU_ID');//学生ID
            $inspect = $PreselectionModel->inspectPreselection($data);
            if (empty($inspect)) {
                $data['prese_status'] = 0;
                $data['prese_hard'] = 0;
                $add = $PreselectionModel->addPreselection($data);
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



/******************=====================================成绩管理=======================***************/
    /**
     * 查看课程成绩
     * @return mixed
     */
    public function coursePerformance()
    {
        $StuArchivesModel = new StuArchivesModel(); //创建User对象
        $StudentAchievementModel = new StudentAchievementModel(); //创建User对象
        $getList = $StudentAchievementModel->getAchie(Session::get('STU_ID'));
        $getListCount = $StudentAchievementModel->getAchieCount(Session::get('STU_ID'));
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('stu-course-performance');

    }

    /**
     * 查看毕业设计成绩
     * @return mixed
     */
    public function graduationResults()
    {
        $StuArchivesModel = new StuArchivesModel(); //创建User对象
        $GraduationAchievementModel = new GraduationAchievementModel(); //创建User对象
        $stuInfo = $StuArchivesModel->getArchivesId(Session::get('STU_ID')); //查询学生ID
        $getList = $GraduationAchievementModel->getGradAchie($stuInfo['stu_id']);
        $getList['stu_name'] = $stuInfo['stu_name'];
        $getList['user_number'] = $stuInfo['user_number'];
        $this->assign('list', $getList); //所有课程
        return $this->fetch('stu-graduation-results');

    }


/******************=====================================学分管理=======================***************/
    /**
     * 学生查看学分
     */
    public function getCredit()
    {
        $StudentAchievementModel = new StudentAchievementModel(); //创建User对象
        $getList = $StudentAchievementModel->getCreditAll(Session::get('STU_ID'));
        $getListCount = $StudentAchievementModel->getCreditAllCount(Session::get('STU_ID'));
        $sum=0;
        $list_copy = $getList->toArray();       //把原数据集对象转换成数
        for ($i=0;$i<count($list_copy['data']);$i++) {
            $sum+=(float)$list_copy['data'][$i]['course_credit'];
        }
        $this->assign('getListCount',$getListCount); //课程总数
        $this->assign('getList',$getList); //所有课程
        $this->assign('sum',$sum); //所有课程
        return $this->fetch('stu-credit');
    }



/******************=====================================资源管理=======================***************/
    /**
     * 获取资源信息
     */
    public function getResources()
    {
        $this->assign('getListCount', $this->resourcesCount()); //课程总数
        $this->assign('getList', $this->resourcesList()); //所有课程
        return $this->fetch('su-resources');
    }


/******************=====================================毕业设计管理=======================***************/
    /**
     * 选题列表
     */
    public function topicList()
    {
        $SelectedTopicModel = new SelectedTopicModel(); //创建User对象
        $GuidanceModel = new GuidanceModel(); //创建User对象
        $getList = $SelectedTopicModel->getTopic(Session::get('STU_ID'));
        $getListCount = $SelectedTopicModel->getTopicCount(Session::get('STU_ID'));
        $topicInfo = $SelectedTopicModel->getTopicId(Session::get('STU_ID')); //查询审核通过的选题
        $teaInfo = $GuidanceModel->getGuidanceTeacher($topicInfo['stu_id']); //查询学生的指导教师
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        $this->assign('teaName', $teaInfo['tea_name']); //指导教师
        return $this->fetch('stu-topic-list');
    }

    /**
     * 选题材料文件上传
     */
    public function topicUpload()
    {
        $file = request()->file('file');
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'topic');
            $data = [];
            if ($info) {
                $SelectedTopicModel = new SelectedTopicModel(); //创建User对象
                $data['stu_id'] = Session::get('STU_ID');//学生ID
                $data['topic_year'] = date('Y');//申请年份
                $data['topic_path'] = $info->getSaveName(); //文件地址
                $data['topic_subject'] = $_FILES['file']['name']; //文件原名称
                $data['topic_status'] = 0; //检查备注
                $data['topic_apply'] = 0; //申请状态
                $data['topic_remarks'] = '已申请待审核'; //申请状态
                $up = $SelectedTopicModel->addTopicId($data);
                return $this->json(1, "材料上传成功", array());
            } else {
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }

    /**
     * 选题料删除
     */
    public function topicDele()
    {
        $SelectedTopicModel = new SelectedTopicModel(); //创建User对象
        $dele = $SelectedTopicModel->deleTopicId(input('post.')['topic_id']);
        if ($dele) {
            return $this->json(1, "删除成功", array());
        } else {
            return $this->json(-1, "删除失败", array());
        }
    }

    /**
     * 论文列表
     */
    public function inspectList()
    {
        $SelectedTopicModel = new SelectedTopicModel(); //创建User对象
        $GuidanceModel = new GuidanceModel(); //创建User对象
        $getTopicId = $SelectedTopicModel->getTopicId(Session::get('STU_ID'));
        $teaInfo = $GuidanceModel->getGuidanceTeacher($getTopicId['topic_id']); //查询学生的指导教师
        $InspectModel = new InspectModel(); //创建User对象
        $getList = $InspectModel->getInspect(Session::get('STU_ID'));
        $getListCount = $InspectModel->getInspectCount(Session::get('STU_ID'));
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        $this->assign('topicInfo', $getTopicId);
        $this->assign('teaName', $teaInfo['tea_name']); //指导教师
        return $this->fetch('stu-inspect-list');
    }

    /**
     * 论文检查材料文件上传
     */
    public function inspectUpload()
    {
        $file = request()->file('file');
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'inspect');
            $data = [];
            if ($info) {
                $InspectModel = new InspectModel(); //创建User对象
                $data['stu_id'] = Session::get('STU_ID');//学生ID
                $data['inspect_year'] = date('Y');//申请年份
                $data['inspect_path'] = $info->getSaveName(); //文件地址
                $data['inspect_name'] = $_FILES['file']['name']; //文件原名称
                $data['inspect_remarks'] = '已上传待检查'; //检查备注
                $data['inspect_status'] = 0; //申请状态
                $data['inspect_submi'] = 0;//提交状态
                $up = $InspectModel->addInspect($data);
                return $this->json(1, "材料上传成功", array());
            } else {
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }

    /**
     * 论文材料删除
     */
    public function inspectDele()
    {
        $InspectModel = new InspectModel(); //创建User对象
        $dele = $InspectModel->deleInspect(input('post.')['inspect_id']);
        if ($dele) {
            return $this->json(1, "删除成功", array());
        } else {
            return $this->json(-1, "删除失败", array());
        }
    }

    /**
     * 答辩列表
     */
    public function defenceList()
    {

        $SelectedTopicModel = new SelectedTopicModel(); //创建User对象
        $GuidanceModel = new GuidanceModel(); //创建User对象
        $getTopicId = $SelectedTopicModel->getTopicId(Session::get('STU_ID'));
        $teaInfo = $GuidanceModel->getGuidanceTeacher($getTopicId['topic_id']); //查询学生的指导教师
        $DefenceModel = new DefenceModel(); //创建User对象
        $getList = $DefenceModel->getDefence(Session::get('STU_ID'));
        $getListCount = $DefenceModel->getDefenceCount(Session::get('STU_ID'));
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        $this->assign('topicInfo', $getTopicId); //所有课程
        $this->assign('teaName', $teaInfo['tea_name']); //指导教师
        return $this->fetch('stu-defence-list');
    }



/******************=====================================评优管理=======================***************/

    /**
     * 学生评优申请
     */
    public function appEvaluation()
    {
        $StuExcellentModel = new StuExcellentModel(); //创建User对象
        $getList = $StuExcellentModel->getExcellent();
        $getListCount = $StuExcellentModel->getExcellentCount();
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('su-add-evaluation');
    }

    /**
     * 评优材料文件删除
     * @return mixed
     */
    public function deleEvaluation()
    {
        //模型中操作查询数据
        $StuExcellentModel = new StuExcellentModel(); //创建User对象
        if (request()->isPost()) {
            $ExcellInfo = $StuExcellentModel->getExcellentId(input('post.')['stu_excellent_id']);
            if ($ExcellInfo['stu_excellent_status'] == 0) {
                $dele = $StuExcellentModel->deleEvaluation(input('post.')['stu_excellent_id']);  //教师ID
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
     * 评优申请材料文件上传
     */
    public function fileUpload()
    {
        $StuExcellentModel = new StuExcellentModel(); //创建User对象
        $file = request()->file('file');
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'appraising/student');
            $data = [];
            if ($info) {
                $StuArchivesModel = new StuArchivesModel(); //创建User对象
                $data['stu_id'] = Session::get('STU_ID');//学生ID
                $data['stu_excellent_year'] = date('Y');//申请年份
                $data['stu_excellent_path'] = $info->getSaveName(); //文件地址
                $data['stu_excellent_name'] = $_FILES['file']['name']; //文件原名称
                $data['stu_excellent_status'] = 0; //审核状态
                $data['stu_excellent_apply'] = 0; //申请状态
                $up = $StuExcellentModel->excellentAdd($data);
                return $this->json(1, "材料上传成功", array());
            } else {
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }



/******************=====================================个人信息=======================***************/
    /**
     * @return mixed 显示学生个人档案信息
     */
    public function personalInformation()
    {
        $StuArchivesModel = new StuArchivesModel(); //创建User对象
        $ClassesModel = new ClassesModel(); //创建User对象
        $stuInfo = $StuArchivesModel->getArchivesId(Session::get('STU_ID')); //查询学生ID
        $classesInfo = $ClassesModel->getClassesNmae($stuInfo['classes_id']); //查询班级名称
        $stuInfo['classes_name'] = $classesInfo['classes_name'];
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
