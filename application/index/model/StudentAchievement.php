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
class StudentAchievement extends Model
{
    protected $table = 'student_achievement'; //设置当前模型操作的数据表名
    /**
     * 查询学生的所有成绩
     */
    public function getAchie($stu_id){
        return Db::table('student_achievement')->where('stu_id',$stu_id)->field('a.*,b.course_name')->alias('a')->join('course_info b','a.course_id=b.course_id')->order('a.achie_id asc')->paginate(10);
    }

    /**
     * 查询学生的所有成绩总数
     */
    public function getAchieCount($stu_id){
        return Db::table('student_achievement')->where('stu_id',$stu_id)->order('achie_id desc')->count();
    }

    /**
     * 查询学生的所有学分
     */
    public function getCreditAll($stu_id){
        return Db::table('student_achievement')->where('achie_final','>=' ,60)->whereOr('achie_repair','>=' ,60)->where('stu_id',$stu_id)->field('a.*,b.course_name,b.course_credit')->alias('a')->join('course_info b','a.course_id=b.course_id')->order('a.achie_id asc')->paginate(10);
    }
    /**
     * 查询学生的所有学分总数
     */
    public function getCreditAllCount($stu_id){
        return Db::table('student_achievement')->where('achie_final','>=' ,60)->whereOr('achie_repair','>=' ,60)->where('stu_id',$stu_id)->field('a.*,b.course_name,b.course_credit')->alias('a')->join('course_info b','a.course_id=b.course_id')->order('a.achie_id asc')->count();
    }
}
