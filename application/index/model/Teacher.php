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
class Teacher extends Model
{
    protected $table = 'teacher'; //设置当前模型操作的数据表名

    /**
     * 根据选题ID查询教师信息
     */
    public function getTeacherTopic($topic_id){
        return Db::table('teacher')->where('a.topic_id',$topic_id)->where('a.guidance_status',1)->field('a.*,b.tea_name,b.tea_phone')->alias('a')->join('teacher b','a.tea_id=b.tea_id')->find();
    }

    /**
     * 根据课程ID查询教师信息
     */
    public function getTeacherId($courseId){
        return Db::table('tea_teaching')->where('a.course_id',$courseId)->where('a.teaching_apply_status',1)->field('a.*,b.tea_name')->alias('a')->join('teacher b','a.tea_id=b.tea_id')->find();
    }
    /**
     * 根据教师ID查询教师信息
     */
    public function getTeacherInfo($tea_id){
        return Db::table('teacher')->where('tea_id',$tea_id)->find();
    }
}
