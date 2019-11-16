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
class CourseAssignment extends Model
{
    protected $table = 'course_assignment'; //设置当前模型操作的数据表名
    /**
     * 获取教师发布的所有作业
     * @return mixed
     */
    public function getAssignment($teaID){
        return Db::name('course_assignment')->where('tea_id',$teaID)->field('a.*,b.course_id,b.course_name')->alias('a')->join('course_info b','a.course_id=b.course_id')->order('a.ass_status asc')->paginate(10);
    }

    /**
     * 查询教师个人课程表总数
     */
    public function getAssignmentCoure($teaID){
        return Db::table('course_assignment')->where('tea_id',$teaID)->order('ass_status desc')->count();
    }
}
