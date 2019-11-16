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
class CourseInfo extends Model
{
    protected $table = 'course_info'; //设置当前模型操作的数据表名
    /**
     * 获取全部课程信息
     * @return mixed
     */
    public function getCourse(){
        return Db::table('course_info')->order('course_id desc')->paginate(10);
    }

    /**
     * 查询全部课程总数
     */
    public function getCourseCount(){
        return Db::table('course_info')->order('course_id desc')->count();
    }
    /**
     * 获取已发布课程信息
     * @return mixed
     */
    public function getCourseStatus(){
        return Db::table('course_info')->where('course_status',1)->order('course_id desc')->paginate(10);
    }

    /**
     * 查询已发布课程总数
     */
    public function getCourseCountStatus(){
        return Db::table('course_info')->where('course_status',1)->order('course_id desc')->count();
    }
    /**
     * 批量添加课程
     */
    public function batchAdd($list){
        return $this->saveAll($list);
    }
    /**
     * 查询班级课程表总数
     */
    public function getClassCourseCount($classes_name){
        return Db::table('course_info')->where('classes_name',$classes_name)->order('course_id desc')->count();
    }

    /**
     * 查询班级课程信息
     */
    public function getClassCourse($classes_name){
        return Db::table('course_info')->where('classes_name',$classes_name)->order('course_id desc')->paginate(10);
    }
    /**
     *根据课程号查询课程信息
     */
    public function getCountInfo($course_id){
        return Db::table('course_info')->where('course_id',$course_id)->find();
    }
}
