<?php
/**
 * @creDate :2019/11/08
 * @function: 学院秘书角色类
 * @author  :陈文艺
 * @editor  :修改人
 * @modDate :修改日期
 * @version :V0.1.0
 */
namespace app\index\controller;
use app\index\model\CourseInfo as CourseInfoModel;
use think\Session;
use app\index\model\Teacher as TeacherModel;
use app\index\model\StuArchives as StuArchivesModel;
use app\index\model\TeaExcellent as TeaExcellentModel;
use app\index\model\StuExcellent as StuExcellentModel;
class Secretary extends Common
{
/******************=====================================课程信息管理=======================***************/
    /**
     * 课程信息列表
     * @return string
     */
    public function courseInfoList()
    {
        $CourseInfoModel = new CourseInfoModel(); //创建User对象
        $getList = $CourseInfoModel->getCourse();
        $getListCount = $CourseInfoModel->getCourseCount();
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
         return $this->fetch('se-add');

    }

    /**
     * 添加课程信息
     * @return string
     */
    public function do_upload(){
        //引入文件
        \think\Loader::import('PHPExcel.PHPExcel');
        $objPHPExcel = new \PHPExcel();
        //获取表单上传文件
        $file = request()->file('file');
        $info = $file->validate(['ext' => 'xlsx,xls'])->move(ROOT_PATH . 'public' . DS . 'curriculumFile');
        //数据为空返回错误
        if(empty($info)){
            $output['status'] = false;
            $output['info'] = '导入数据失败~';
            $this->ajaxReturn($output);
        }
        //获取文件名
        $exclePath = $info->getSaveName();
        //上传文件的地址
        $filename = ROOT_PATH . 'public' . DS . 'curriculumFile'.DS . $exclePath;
        $extension = strtolower( pathinfo($filename, PATHINFO_EXTENSION) );
        \think\Loader::import('PHPExcel.IOFactory.PHPExcel_IOFactory');
        if ($extension =='xlsx') {
            $objReader = new \PHPExcel_Reader_Excel2007();
            $objExcel = $objReader ->load($filename);
        } else if ($extension =='xls') {
            $objReader = new \PHPExcel_Reader_Excel5();
            $objExcel = $objReader->load($filename);
        }
        $excel_array=$objExcel->getsheet(0)->toArray();   //转换为数组格式
        //array_shift($excel_array);  //删除第一个数组(标题);
        array_shift($excel_array);  //删除th
        $data=[];
        foreach ($excel_array as $k=>$v){
            if($v[0]&& $v[1]&& $v[2]&& $v[3]&& $v[4]&& $v[5]&& $v[6]&& $v[7]){
                $data[$k]["course_name"]=$v[0];//课程名称
                $data[$k]["course_year"]=$v[1];
                if($v[2] =="上学期"){
                    $data[$k]["course_semester"]=0;
                }else  if($v[2] =="下学期"){
                    $data[$k]["course_semester"]=1;
                }else  if($v[2] =="全学年"){
                    $data[$k]["course_semester"]=2;
                }
                $data[$k]["course_credit"]=$v[3];
                $data[$k]["classes_name"]= $this->str($v[4]);
                if($v[5] =="合班"){
                    $data[$k]["course_type"]=1;
                }else  if($v[5] =="小班"){
                    $data[$k]["course_type"]=0;
                }
                $data[$k]["course_number"]=$v[6];
                $data[$k]["course_cycle"]=$v[7];
                if($v[8] =="考试"){
                    $data[$k]["course_examine"]=0;
                }else  if($v[8] =="考查"){
                    $data[$k]["course_examine"]=1;
                }
            }
        }
        $CourseInfoModel = new CourseInfoModel(); //创建User对象
        $add = $CourseInfoModel->batchAdd($data);
        return $this->json(1,"",array());
    }
/**********************************=====================================评优管理=======================***********************************/
    /**
     * 优秀学生申请
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
     * 优秀教师申请
     */
    public function teaListEvaluation(){
        $TeaExcellentModel = new TeaExcellentModel(); //创建User对象
        $getList = $TeaExcellentModel->getExcellent();
        $getListCount = $TeaExcellentModel->getExcellentCount();
        $this->assign('getListCount', $getListCount); //课程总数
        $this->assign('getList', $getList); //所有课程
        return $this->fetch('tea-evaluation');
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
